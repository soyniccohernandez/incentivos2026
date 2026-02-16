<?php

namespace App\Livewire\Sitio;

use App\Models\Socio;
use App\Models\Proyecto;
use App\Models\Convocatoria;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Carbon\Carbon;

#[Layout('layouts.guest')]
class ValidarSocio extends Component
{
    public $identificacion = '';
    public $proyectoId = null; 

    protected $rules = [
        'identificacion' => 'required|numeric',
    ];

    public function mount($proyecto = null)
    {
        // Captura el ID si el socio viene de un botón en la tabla de inscritos
        $this->proyectoId = $proyecto;
    }

    public function validar()
    {
        $this->resetErrorBag();
        $this->validate();

        // 1. Buscamos al socio
        $socio = Socio::where('identificacion', $this->identificacion)->first();

        if (!$socio) {
            $this->addError('identificacion', 'Socio no encontrado en nuestra base de datos.');
            return;
        }

        // 2. SEGURIDAD: Si intentó entrar a un proyecto específico desde la vista pública
        if ($this->proyectoId) {
            $proyectoSeleccionado = Proyecto::find($this->proyectoId);
            if ($proyectoSeleccionado && $proyectoSeleccionado->socio_id !== $socio->id) {
                $this->addError('identificacion', 'Esta identificación no corresponde al proponente de este proyecto.');
                return;
            }
        }

        // 3. Validaciones de Inhabilidad (Edad, Morosidad, etc.)
        $inhabilidad = $this->verificarInhabilidadesSocio($socio);
        if ($inhabilidad !== "OK") {
            $this->addError('identificacion', $inhabilidad);
            return;
        }

        // 4. Obtener Convocatoria actual
        $convocatoria = Convocatoria::where('estado', 'abierta')->first() 
                        ?? Convocatoria::where('estado', 'cerrada')->latest()->first();

        if (!$convocatoria) {
            $this->addError('identificacion', 'No se encontró una convocatoria activa.');
            return;
        }

        // 5. BLOQUEO Y REDIRECCIÓN: Verificar si ya tiene un proyecto registrado
        $proyecto = Proyecto::where('socio_id', $socio->id)
            ->where('convocatoria_id', $convocatoria->id)
            ->first();

        if ($proyecto) {
            session(['socio_id' => $socio->id]);

            // Mapeo lógico según tu tabla de estados
            switch ($proyecto->estado_id) {
                case 1: // Inscrito (Ya completó el formulario inicial)
                case 2: // En revisión etapa 1
                    $this->addError('identificacion', "Usted ya cuenta con un proyecto inscrito: '{$proyecto->titulo}' (Radicado: {$proyecto->codigo_radicado}). No se permite realizar más de una inscripción.");
                    return;

                case 3: // Subsanación etapa 1
                    return redirect()->route('subsanar-etapa-1', $proyecto->id);

                case 4: // En etapa 2 (Aprobado fase técnica)
                    return redirect()->route('inscripcion.etapa2', $proyecto->id);

                case 5: // Revisión etapa 2
                case 6: // Avanza etapa 3
                case 7: // Revisión etapa 3
                    $this->addError('identificacion', "Su proyecto ya se encuentra en fase de evaluación técnica o jurados. Estado actual: {$proyecto->estado->nombre}.");
                    return;

                case 8: // Eliminado
                case 9: // No seleccionado
                case 10: // Seleccionado (Ganador)
                    $this->addError('identificacion', "El proceso para su postulación ha finalizado. Resultado: {$proyecto->estado->nombre}.");
                    return;

                default:
                    $this->addError('identificacion', "Ya tiene un registro activo para esta convocatoria.");
                    return;
            }
        }

        // 6. FLUJO NUEVO: Si llega aquí es porque NO tiene ningún proyecto creado
        if ($convocatoria->estado === 'abierta') {
            session([
                'socio_id' => $socio->id,
                'convocatoria_id' => $convocatoria->id,
            ]);
            return redirect()->route('inscripcion.etapa1');
        }

        $this->addError('identificacion', 'La convocatoria actual está cerrada para nuevas inscripciones.');
    }

    private function verificarInhabilidadesSocio(Socio $socio)
    {
        if ($socio->fecha_nacimiento && Carbon::parse($socio->fecha_nacimiento)->diffInYears(now()) < 18) {
            return "Inhabilidad: El participante debe ser mayor de edad.";
        }

        if ($socio->estado !== 'activo') {
            $mensajes = [
                'moroso'          => "Inhabilidad por mora en obligaciones administrativas/financieras.",
                'sancionado'      => "Inhabilidad por sanción ética o disciplinaria vigente.",
                'bloqueado_cargo' => "Inhabilidad: Los miembros de órganos de administración no pueden participar.",
                'retirado'        => "El socio se encuentra en estado de retiro.",
            ];
            return $mensajes[$socio->estado] ?? "Su estado de socio ($socio->estado) no le permite participar.";
        }

        return "OK";
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}