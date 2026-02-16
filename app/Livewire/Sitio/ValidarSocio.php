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
    public $proyectoId = null; // Se mantiene público para persistir en el ciclo de vida de Livewire

    protected $rules = [
        'identificacion' => 'required|numeric',
    ];

    public function mount()
    {
        // Captura el ID si viene por URL: ?proyecto=XX
        $this->proyectoId = request('proyecto');
    }

    public function validar()
    {
        $this->resetErrorBag();
        $this->validate();

        // 1. Validaciones base (Convocatoria y Socio)
        $convocatoria = Convocatoria::where('estado', 'abierta')->first();
        if (!$convocatoria) {
            $this->addError('identificacion', 'No hay convocatorias abiertas.');
            return;
        }

        $socio = Socio::where('identificacion', $this->identificacion)->first();
        if (!$socio) {
            $this->addError('identificacion', 'Socio no encontrado.');
            return;
        }

        $inhabilidad = $this->verificarInhabilidadesSocio($socio);
        if ($inhabilidad !== "OK") {
            $this->addError('identificacion', $inhabilidad);
            return;
        }

        // 2. BUSCAR PROYECTO ACTUAL DEL SOCIO
        $proyecto = Proyecto::where('socio_id', $socio->id)
            ->where('convocatoria_id', $convocatoria->id)
            ->first();

        // 3. MAPEO DE FLUJO POR ESTADO (El sistema decide el destino)
        if ($proyecto) {
            session(['socio_id' => $socio->id]);

            switch ($proyecto->estado_id) {
                case 1: // BORRADOR ETAPA 1
                    return redirect()->route('inscripcion.etapa1');

                case 3: // SUBSANACIÓN ETAPA 1
                    return redirect()->route('inscripcion.etapa1', ['subsanar' => true]);

                case 4: // APROBADO ETAPA 1 -> PASA A ETAPA 2 (Técnica)
                    return redirect()->route('inscripcion.etapa2', $proyecto->id);

                case 6: // SUBSANACIÓN ETAPA 2
                    return redirect()->route('inscripcion.etapa2', ['id' => $proyecto->id, 'subsanar' => true]);

                case 2: // ENVIADO ETAPA 1 (Esperando revisión)
                case 7: // ENVIADO ETAPA 2 (Esperando revisión)
                    $this->addError('identificacion', "Tu proyecto '{$proyecto->titulo}' está en revisión. No puedes realizar cambios ahora.");
                    return;

                case 5: // RECHAZADO DEFINITIVAMENTE
                    $this->addError('identificacion', "Tu postulación ha sido rechazada y no admite más cambios.");
                    return;

                default:
                    $this->addError('identificacion', "Estado del proyecto no reconocido. Contacta a soporte.");
                    return;
            }
        }

        // 4. SI NO TIENE PROYECTO -> FLUJO INICIAL (Etapa 1)
        session([
            'socio_id' => $socio->id,
            'convocatoria_id' => $convocatoria->id,
        ]);
        return redirect()->route('inscripcion.etapa1');
    }

    private function verificarInhabilidadesSocio(Socio $socio)
    {
        // Validación de Edad
        if ($socio->fecha_nacimiento && Carbon::parse($socio->fecha_nacimiento)->diffInYears(now()) < 18) {
            return "Inhabilidad: El participante debe ser mayor de edad.";
        }

        // Validación de Estado Administrativo
        if ($socio->estado !== 'activo') {
            $mensajes = [
                'moroso' => "Inhabilidad por mora en obligaciones administrativas/financieras.",
                'sancionado' => "Inhabilidad por sanción ética o disciplinaria vigente.",
                'bloqueado_cargo' => "Inhabilidad: Los miembros de órganos de administración no pueden participar.",
                'retirado' => "El socio se encuentra en estado de retiro.",
            ];
            return $mensajes[$socio->estado] ?? "Su estado actual ($socio->estado) no le permite participar en esta convocatoria.";
        }

        return "OK";
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}
