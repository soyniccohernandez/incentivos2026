<?php

namespace App\Livewire\Admin;

use App\Models\Convocatoria;
use Livewire\Component;

class ListadoConvocatorias extends Component
{
    public function render()
    {
        // Añadimos proyectos para que withCount funcione eficientemente
        $convocatorias = Convocatoria::with(['proyectos', 'etapas'])
            ->withCount('proyectos')
            ->orderBy('fecha_fin', 'desc')
            ->get();

        return view('livewire.admin.listado-convocatorias', [
            'convocatorias' => $convocatorias
        ]);
    }
}
