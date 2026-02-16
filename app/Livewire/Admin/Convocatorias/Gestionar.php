<?php

namespace App\Livewire\Admin\Convocatorias;

use App\Models\Convocatoria;
use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Observacion;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Carbon\Carbon;

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

    public function updatingSearch() { $this->resetPage(); }
    public function updatingEstadoSelected() { $this->resetPage(); }

    public function render()
    {
        // 1. Consulta de proyectos con búsqueda y filtro de estado
        $proyectos = Proyecto::where('convocatoria_id', $this->convocatoria->id)
            ->with(['socio', 'estado'])
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo_radicado', 'like', '%' . $this->search . '%');
            })
            ->when($this->estadoSelected, function ($query) {
                $query->where('estado_id', $this->estadoSelected);
            })
            ->paginate(10);

        // 2. Conteo de estados para el filtro superior
        $estados = Estado::orderBy('id', 'asc')
            ->withCount(['proyectos' => function ($query) {
                $query->where('convocatoria_id', $this->convocatoria->id);
            }])
            ->get();

        // 3. Lógica de Etapa Actual basada en fechas (Buena Práctica)
        $hoy = Carbon::now();
        $etapaActual = $this->convocatoria->etapas()
            ->where('fecha_inicio', '<=', $hoy)
            ->where('fecha_fin', '>=', $hoy)
            ->first();

        return view('livewire.admin.convocatorias.gestionar', [
            'proyectos' => $proyectos,
            'estados' => $estados,
            'nombreEtapaActual' => $etapaActual ? $etapaActual->nombre : 'Sin etapa activa'
        ]);
    }

    public function publicarResultados()
    {
        DB::transaction(function () {
            $query = Proyecto::where('convocatoria_id', $this->convocatoria->id)
                ->where('publicado', false);

            if ($this->estadoSelected) {
                $query->where('estado_id', $this->estadoSelected);
            }

            $proyectosAPublicar = $query->get();

            if ($proyectosAPublicar->isEmpty()) return;

            foreach ($proyectosAPublicar as $proyecto) {
                $proyecto->update(['publicado' => true]);
                
                // Liberar observaciones para que el proponente las vea
                Observacion::where('proyecto_id', $proyecto->id)
                    ->update(['visible_para_proponente' => true]);
            }
        });

        $this->dispatch('notify', 'Resultados publicados exitosamente.');
        $this->convocatoria->refresh();
    }
}