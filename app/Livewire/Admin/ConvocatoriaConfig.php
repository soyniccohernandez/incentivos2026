<?php

namespace App\Livewire\Admin;

use App\Models\Convocatoria;
use App\Models\Etapa;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')] // O tu layout de admin
class ConvocatoriaConfig extends Component
{
    public $convocatoria;
    public $etapas = [];
    public $estadoConvocatoria;

    public function mount($id)
    {
        $this->convocatoria = Convocatoria::with('etapas')->findOrFail($id);
        $this->estadoConvocatoria = $this->convocatoria->estado;
        $this->cargarEtapas();
    }

    public function cargarEtapas()
    {
        $this->etapas = $this->convocatoria->etapas->sortBy('orden')->map(function ($e) {
            return [
                'id' => $e->id,
                'nombre' => $e->nombre,
                'fecha_inicio' => $e->fecha_inicio?->format('Y-m-d\TH:i'),
                'fecha_fin' => $e->fecha_fin?->format('Y-m-d\TH:i'),
                'es_subsanable' => $e->es_subsanable
            ];
        })->toArray();
    }

    public function guardar()
    {
        // 1. Actualizar Estado Global
        $this->convocatoria->update(['estado' => $this->estadoConvocatoria]);

        // 2. Actualizar Etapas
        foreach ($this->etapas as $etapaData) {
            Etapa::where('id', $etapaData['id'])->update([
                'fecha_inicio' => $etapaData['fecha_inicio'],
                'fecha_fin' => $etapaData['fecha_fin'],
                'es_subsanable' => $etapaData['es_subsanable']
            ]);
        }

        session()->flash('mensaje', 'Configuración guardada correctamente.');
        return redirect()->route('convocatoria.gestionar', $this->convocatoria->id);
    }

    public function render()
    {
        return view('livewire.admin.convocatoria-config');
    }
}
