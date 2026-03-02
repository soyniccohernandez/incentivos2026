<?php

namespace App\Livewire\Admin;

use App\Models\Convocatoria;
use App\Models\Etapa;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class ConvocatoriaConfig extends Component
{
    public $convocatoriaId;
    public $nombreConvocatoria;
    public $estadoConvocatoria;
    public $etapas = [];

    public function mount($id)
    {
        $convocatoria = Convocatoria::with('etapas')->findOrFail($id);
        
        $this->convocatoriaId = $convocatoria->id;
        $this->nombreConvocatoria = $convocatoria->nombre;
        $this->estadoConvocatoria = $convocatoria->estado; 
        
        $this->etapas = $convocatoria->etapas->sortBy('orden')->map(function ($e) {
            return [
                'id' => $e->id,
                'nombre' => $e->nombre,
                'fecha_inicio' => $e->fecha_inicio ? $e->fecha_inicio->format('Y-m-d\TH:i') : null,
                'fecha_fin' => $e->fecha_fin ? $e->fecha_fin->format('Y-m-d\TH:i') : null,
            ];
        })->toArray();
    }

    public function guardar()
    {
        $this->validate([
            'estadoConvocatoria' => 'required|in:borrador,abierta,cerrada',
            'etapas.*.fecha_inicio' => 'nullable|date',
            'etapas.*.fecha_fin' => 'nullable|date',
        ]);

        // 1. Actualización Atómica de la Convocatoria
        $convocatoria = Convocatoria::findOrFail($this->convocatoriaId);
        $convocatoria->update([
            'estado' => $this->estadoConvocatoria
        ]);

        // 2. Actualización de Etapas
        foreach ($this->etapas as $etapaData) {
            Etapa::where('id', $etapaData['id'])->update([
                'fecha_inicio' => $etapaData['fecha_inicio'] ? date('Y-m-d H:i:s', strtotime($etapaData['fecha_inicio'])) : null,
                'fecha_fin' => $etapaData['fecha_fin'] ? date('Y-m-d H:i:s', strtotime($etapaData['fecha_fin'])) : null,
            ]);
        }

        session()->flash('mensaje', 'Configuración actualizada correctamente.');

        return redirect()->route('convocatoria.gestionar', $this->convocatoriaId);
    }

    public function render()
    {
        return view('livewire.admin.convocatoria-config');
    }
}