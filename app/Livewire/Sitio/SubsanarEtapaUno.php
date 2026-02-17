<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\Documento;
use App\Models\Observacion;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class SubsanarEtapaUno extends Component
{
    use WithFileUploads;

    public $proyecto;
    public $archivosNuevos = [];
    public $observaciones = [];

    public function mount(Proyecto $proyecto)
    {
        if (session('socio_id') != $proyecto->socio_id) {
            return redirect()->route('inscritos.publico')->with('error', 'Acceso denegado.');
        }

        $this->proyecto = $proyecto->load(['documentos.tipoDocumento', 'estado', 'socio']);

        // AJUSTE: Solo permitir si el proyecto está en estado 2 (En Subsanación)
        // Según tu nuevo Seeder, el 2 es donde el socio tiene el permiso de editar.
        if ($this->proyecto->estado_id != 2) {
            return redirect()->route('inscritos.publico');
        }

        // Cargar observaciones
        foreach ($this->proyecto->documentos as $doc) {
            $obs = Observacion::where('documento_id', $doc->id)->latest()->first();
            if ($obs) {
                $this->observaciones[$doc->id] = $obs->mensaje;
            }
        }
    }

    public function guardarSubsanacion($documentoId)
    {
        $this->validate([
            "archivosNuevos.$documentoId" => 'required|mimes:pdf|max:15360',
        ]);

        $docAnterior = Documento::findOrFail($documentoId);
        $ruta = $this->archivosNuevos[$documentoId]->store('proyectos/subsanaciones', 'public');

        // La nueva versión nace como 'pendiente' (el auditor la verá azul en su panel)
        Documento::create([
            'proyecto_id' => $docAnterior->proyecto_id,
            'tipo_documento_id' => $docAnterior->tipo_documento_id,
            'ruta_archivo' => $ruta,
            'estado' => 'pendiente',
            'version' => $docAnterior->version + 1,
            'fecha_carga' => now(),
        ]);

        // Marcamos el anterior como corregido para que el auditor sepa que ya no es el actual
        $docAnterior->update(['estado' => 'corregido']);

        unset($this->archivosNuevos[$documentoId]);
        $this->proyecto->refresh();
    }

    public function finalizar()
    {
        // AJUSTE CLAVE: Cambiar el proyecto a estado 3 (En revisión de subsanación)
        // Esto le quita el permiso de edición al socio y le avisa al auditor.
        $this->proyecto->update(['estado_id' => 3]);

        return redirect()->route('inscritos.publico')->with('message', 'Subsanación enviada exitosamente. El equipo técnico revisará tus cambios.');
    }

    public function render()
    {
        return view('livewire.sitio.subsanar-etapa-uno');
    }
}
