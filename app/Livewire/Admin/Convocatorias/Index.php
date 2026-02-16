<?php

namespace App\Livewire\Admin\Convocatorias;

use Livewire\Component;
use App\Models\Convocatoria;
use Carbon\Carbon;

class Index extends Component
{
    public function render()
    {
        $convocatorias = Convocatoria::withCount('proyectos')
            ->orderBy('fecha_fin', 'desc')
            ->get()
            ->map(function($convocatoria) {
                // Calculamos los días restantes dinámicamente
                $hoy = Carbon::now()->startOfDay();
                $fin = Carbon::parse($convocatoria->fecha_fin)->startOfDay();
                
                $convocatoria->dias_restantes = $hoy->diffInDays($fin, false);
                return $convocatoria;
            });

        return view('livewire.admin.convocatorias.index', [
            'convocatorias' => $convocatorias
        ]);
    }
}