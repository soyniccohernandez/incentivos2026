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

    protected $queryString = [
        'search' => ['except' => ''],
        'estadoSelected' => ['except' => ''],
    ];

    public function mount(Convocatoria $convocatoria)
    {
        $this->convocatoria = $convocatoria;
    }

    public function updatingSearch() { $this->resetPage(); }
    public function updatingEstadoSelected() { $this->resetPage(); }

    public function render()
    {
        // 1. Consulta apuntando a la relación 'user' (antes socio)
        $proyectos = Proyecto::where('convocatoria_id', $this->convocatoria->id)
            ->with(['user', 'estado']) // CAMBIO: 'socio' -> 'user'
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo_radicado', 'like', '%' . $this->search . '%')
                    // Búsqueda por nombre del usuario/postulante
                    ->orWhereHas('user', function($q) {
                        $q->where('name', 'like', '%' . $this->search . '%')
                          ->orWhere('identificacion', 'like', '%' . $this->search . '%');
                    });
            })
            ->when($this->estadoSelected, function ($query) {
                $query->where('estado_id', $this->estadoSelected);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $estados = Estado::orderBy('id', 'asc')
            ->withCount(['proyectos' => function ($query) {
                $query->where('convocatoria_id', $this->convocatoria->id);
            }])
            ->get();

        $hoy = Carbon::now();
        $etapaActual = $this->convocatoria->etapas()
            ->where('fecha_inicio', '<=', $hoy)
            ->where('fecha_fin', '>=', $hoy)
            ->first();

        return view('livewire.admin.convocatorias.gestionar', [
            'proyectos' => $proyectos,
            'estados' => $estados,
            'nombreEtapaActual' => $etapaActual ? $etapaActual->nombre : 'SIN ETAPA ACTIVA'
        ]);
    }

    public function publicarResultados()
    {
        $totalProcesados = DB::transaction(function () {
            $baseQuery = Proyecto::where('convocatoria_id', $this->convocatoria->id)
                ->where('publicado', false);

            if ($this->estadoSelected) {
                $baseQuery->where('estado_id', $this->estadoSelected);
            }

            $ids = $baseQuery->pluck('id');

            if ($ids->isEmpty()) return 0;

            Proyecto::whereIn('id', $ids)->update(['publicado' => true]);
            Observacion::whereIn('proyecto_id', $ids)->update(['visible_para_proponente' => true]);

            return $ids->count();
        });

        $this->dispatch('notify', [
            'type' => $totalProcesados > 0 ? 'success' : 'info',
            'message' => $totalProcesados > 0 
                ? "Se han publicado $totalProcesados resultados exitosamente." 
                : "No hay resultados pendientes por publicar."
        ]);

        $this->convocatoria->refresh();
    }
}