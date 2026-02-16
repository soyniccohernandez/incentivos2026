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
        $convocatoriaMostrable = Convocatoria::where('estado', 'abierta')->first()
            ?? Convocatoria::where('estado', 'cerrada')->latest()->first();

        $proyectos = Proyecto::query()
            ->when($convocatoriaMostrable, function ($q) use ($convocatoriaMostrable) {
                $q->where('convocatoria_id', $convocatoriaMostrable->id);
            })
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo_radicado', 'like', '%' . $this->search . '%');
            })
            ->with('estado') 
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('livewire.sitio.inscritos', [
            'proyectos' => $proyectos,
            'total' => $proyectos->total(),
            'nombreConvocatoria' => $convocatoriaMostrable?->nombre ?? 'Sin convocatoria activa'
        ]);
    }
}