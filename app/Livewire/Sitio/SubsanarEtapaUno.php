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
        // SEGURIDAD: Verificar que el socio_id en sesión coincida
        if (session('socio_id') != $proyecto->socio_id) {
            return redirect()->route('inscritos.publico')->with('error', 'Acceso denegado.');
        }

        $this->proyecto = $proyecto->load(['documentos.tipoDocumento', 'estado', 'socio']);
        
        // Solo permitir si el proyecto está en estado 3 (Subsanación)
        if ($this->proyecto->estado_id != 3) {
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

        $doc = Documento::findOrFail($documentoId);
        $ruta = $this->archivosNuevos[$documentoId]->store('proyectos/subsanaciones', 'public');

        $doc->update([
            'ruta_archivo' => $ruta,
            'estado' => 'pendiente', // Cambia a pendiente para que desaparezca la alerta de corregir
            'version' => $doc->version + 1
        ]);

        unset($this->observaciones[$documentoId]);
        unset($this->archivosNuevos[$documentoId]);
        
        $this->proyecto->refresh();
    }

    public function finalizar()
    {
        // Cambiar el proyecto completo a estado 2 (En Revisión Etapa 1)
        $this->proyecto->update(['estado_id' => 2]);
        
        // Limpiamos sesión del socio si lo deseas, o lo dejamos para la etapa 2
        // session()->forget('socio_id'); 

        return redirect()->route('inscritos.publico')->with('message', 'Subsanación enviada exitosamente.');
    }

    public function render()
    {
        return view('livewire.sitio.subsanar-etapa-uno');
    }
}