<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\Convocatoria;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class Inscritos extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        // 1. Buscamos la convocatoria mostrable
        $convocatoriaMostrable = Convocatoria::where('estado', 'abierta')->first() 
            ?? Convocatoria::where('estado', 'cerrada')->latest()->first();

        // 2. Cargamos las etapas si existe la convocatoria
        if ($convocatoriaMostrable) {
            $convocatoriaMostrable->load(['etapas' => function ($q) {
                $q->orderBy('orden', 'asc');
            }]);
        }

        $proyectos = Proyecto::query()
            ->when($convocatoriaMostrable, function ($q) use ($convocatoriaMostrable) {
                $q->where('convocatoria_id', $convocatoriaMostrable->id);
            })
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                      ->orWhere('codigo_radicado', 'like', '%' . $this->search . '%')
                      // Asumimos que el proponente es el nombre del usuario relacionado
                      ->orWhereHas('user', function($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->with(['estado', 'user']) // Importante cargar el proponente
            ->orderBy('created_at', 'asc')
            ->paginate(12); // Bajamos a 12 para que el Grid de 3 columnas sea simétrico

        return view('livewire.sitio.inscritos', [
            'proyectos' => $proyectos,
            'total' => $proyectos->total(),
            'nombreConvocatoria' => $convocatoriaMostrable?->nombre ?? 'Sin convocatoria activa',
            'convocatoriaActual' => $convocatoriaMostrable,
            'ahora' => now(),
        ]);
    }
}