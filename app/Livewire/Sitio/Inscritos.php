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

        // 2. Consulta de proyectos con relaciones necesarias
        $proyectos = Proyecto::query()
            ->when($convocatoriaMostrable, function ($q) use ($convocatoriaMostrable) {
                $q->where('convocatoria_id', $convocatoriaMostrable->id);
            })
            ->where(function ($query) {
                $query->where('titulo', 'like', '%' . $this->search . '%')
                    ->orWhere('codigo_radicado', 'like', '%' . $this->search . '%')
                    ->orWhereHas('user', function ($q) {
                        $q->where('name', 'like', '%' . $this->search . '%');
                    });
            })
            ->with(['estado', 'user', 'etapa']) // Eager loading fundamental
            ->orderBy('created_at', 'asc')
            ->paginate(12);

        // 3. APLICACIÓN DE LA LÓGICA DE VISIBILIDAD REAL
        // 3. APLICACIÓN DE LA LÓGICA DE VISIBILIDAD REAL
        $proyectos->getCollection()->transform(function ($proyecto) {
            // Solo necesitamos el nombre del estado (SELECCIONADO, RECIBIDO, etc.)
            $nombreEstadoActual = $proyecto->estado->nombre ?? 'RECIBIDO';

            if (!$proyecto->publicado) {
                // MODO PRIVADO
                $proyecto->estado_final = "EN REVISIÓN";
                $proyecto->color_clase = 'text-white/40';
            } else {
                // MODO PÚBLICO: Solo el nombre del estado en mayúsculas
                $proyecto->estado_final = strtoupper($nombreEstadoActual);

                // Lógica de color: Naranja si es seleccionado, opaco si es cualquier otro
                $proyecto->color_clase = (strtoupper($nombreEstadoActual) == 'SELECCIONADO')
                    ? 'text-brand-orange drop-shadow-[0_0_15px_rgba(255,114,0,0.5)]'
                    : 'text-white/20';
            }

            return $proyecto;
        });

        return view('livewire.sitio.inscritos', [
            'proyectos' => $proyectos,
            'total' => $proyectos->total(),
            'nombreConvocatoria' => $convocatoriaMostrable?->nombre ?? 'Sin convocatoria activa',
            'convocatoriaActual' => $convocatoriaMostrable,
            'ahora' => now(),
        ]);
    }
}
