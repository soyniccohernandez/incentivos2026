<?php

namespace App\Livewire\Admin\Convocatorias;

use App\Models\Convocatoria;
use App\Models\Proyecto;
use App\Models\Estado; // <--- Nombre correcto del modelo
use Livewire\Component;
use Livewire\WithPagination;

class Gestionar extends Component
{
    use WithPagination;

    public $convocatoria;
    public $search = '';
    public $estadoSelected = '';

    public function mount(Convocatoria $convocatoria)
    {
        $this->convocatoria = $convocatoria;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
    public function updatingEstadoSelected()
    {
        $this->resetPage();
    }

    public function render()
    {
        $proyectos = Proyecto::where('convocatoria_id', $this->convocatoria->id)
            ->with(['socio', 'estado'])
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo_radicado', 'like', '%' . $this->search . '%');
            })
            ->when($this->estadoSelected, function ($query) {
                // Asegúrate que en la tabla 'proyectos' la columna sea 'estado_id'
                $query->where('estado_id', $this->estadoSelected);
            })
            ->paginate(10);

        // Traemos los estados con el conteo de proyectos de ESTA convocatoria
        $estados = Estado::orderBy('nombre', 'asc')
            ->withCount(['proyectos' => function ($query) {
                $query->where('convocatoria_id', $this->convocatoria->id);
            }])
            ->get();

        return view('livewire.admin.convocatorias.gestionar', [
            'proyectos' => $proyectos,
            'estados' => $estados
        ]);
    }

    public function publicarResultados()
    {
        // 1. Identificamos qué proyectos deben publicarse: 
        // Los que están en la convocatoria y NO están publicados aún.
        $proyectosAPublicar = Proyecto::where('convocatoria_id', $this->convocatoria->id)
            ->where('publicado', false);

        if ($proyectosAPublicar->count() === 0) {
            $this->dispatch('notify', 'No hay resultados nuevos pendientes por publicar.');
            return;
        }

        // 2. Publicamos
        $proyectosAPublicar->update(['publicado' => true]);

        $this->dispatch('notify', '¡Resultados publicados oficialmente!');

        // Forzamos el refresco del conteo para el botón en la vista
        $this->convocatoria->refresh();
    }
}
