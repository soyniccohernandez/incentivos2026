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

    protected $rules = [
        'identificacion' => 'required|numeric',
    ];

    public function validar()
    {
        $this->resetErrorBag();
        $this->validate();

        // 1. ¿Existe el socio?
        $socio = Socio::where('identificacion', $this->identificacion)->first();

        if (!$socio) {
            $this->addError('identificacion', 'La identificación ingresada no se encuentra registrada como socio de ACTORES S.C.G.');
            return;
        }

        // 2. ¿Puede participar? (Edad, Estado, etc.)
        $inhabilidad = $this->verificarInhabilidadesSocio($socio);
        if ($inhabilidad !== "OK") {
            $this->addError('identificacion', $inhabilidad);
            return;
        }

        // 3. Buscar Convocatoria
        $convocatoria = Convocatoria::where('estado', 'abierta')->first()
            ?? Convocatoria::where('estado', 'cerrada')->latest()->first();

        if (!$convocatoria) {
            $this->addError('identificacion', 'No existe una convocatoria activa en este momento.');
            return;
        }

        // --- CARGA DE ETAPAS PARA CONTROL DEL ADMIN ---
        // Orden 1: Inscripción y Subsanación de documentos
        $etapaDocs = $convocatoria->etapas()->where('orden', 1)->first();
        // Orden 2: Formulario Técnico (Etapa 2)
        $etapaTecnica = $convocatoria->etapas()->where('orden', 2)->first();

        // Guardamos al socio en sesión
        session(['socio_id' => $socio->id]);

        // 4. GESTOR DE TRÁFICO
        $proyecto = Proyecto::where('socio_id', $socio->id)
            ->where('convocatoria_id', $convocatoria->id)
            ->first();

        if ($proyecto) {
            switch ($proyecto->estado_id) {

                case 2: // "En Subsanación"
                    // El Admin controla esto con la vigencia de la Etapa 1
                    if (!$etapaDocs || !$etapaDocs->estaActiva()) {
                        $msj = ($etapaDocs && $etapaDocs->haVencido())
                            ? "El plazo para subsanar venció el " . $etapaDocs->fecha_fin->format('d/m/Y H:i')
                            : "El módulo de subsanación no está habilitado.";
                        $this->addError('identificacion', $msj);
                        return;
                    }
                    return redirect()->route('subsanar-etapa-1', $proyecto->id);

                case 4: // "En etapa 2"
                    // El Admin controla esto con la vigencia de la Etapa 2
                    if (!$etapaTecnica || !$etapaTecnica->estaActiva()) {
                        $msj = ($etapaTecnica && $etapaTecnica->haVencido())
                            ? "El plazo para la Etapa Técnica venció el " . $etapaTecnica->fecha_fin->format('d/m/Y H:i')
                            : "La Etapa Técnica aún no ha iniciado.";
                        $this->addError('identificacion', $msj);
                        return;
                    }
                    return redirect()->route('inscripcion.etapa2', $proyecto->id);

                case 1: // Inscrito
                case 3: // En revisión de subsanación
                case 5: // Etapa 2 - En Revisión
                    $this->addError('identificacion', "Usted ya tiene un proyecto radicado: '{$proyecto->titulo}'. Actualmente se encuentra en: {$proyecto->estado->nombre}. Por favor, espere la validación del equipo técnico.");
                    return;

                case 8: // No continúa / Eliminado
                case 9: // No seleccionado
                    // En lugar de addError, lo enviamos a ver sus razones
                    return redirect()->route('proyecto.retroalimentacion', $proyecto->id);

                default:
                    $this->addError('identificacion', "Su proceso se encuentra en estado: {$proyecto->estado->nombre}. No requiere acciones adicionales por ahora.");
                    return;
            }
        }

        // 5. SI NO TIENE PROYECTO: Intentar nueva inscripción
        // Validamos que la Etapa 1 esté activa según el calendario del Admin
        if (!$etapaDocs || !$etapaDocs->estaActiva()) {
            $msj = ($etapaDocs && $etapaDocs->haVencido())
                ? "El periodo de inscripciones cerró el " . $etapaDocs->fecha_fin->format('d/m/Y')
                : "Las inscripciones aún no han iniciado o están deshabilitadas.";

            $this->addError('identificacion', $msj);
            return;
        }

        // Si la etapa está activa, procedemos (independientemente de si la convocatoria dice 'abierta')
        session(['convocatoria_id' => $convocatoria->id]);
        return redirect()->route('inscripcion.etapa1');
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
            return $mensajes[$socio->estado] ?? "Su estado de socio ($socio->estado) no le permite participar en esta convocatoria.";
        }

        return "OK";
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}
