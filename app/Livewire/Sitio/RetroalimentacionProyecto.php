<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class RetroalimentacionProyecto extends Component
{
    public Proyecto $proyecto;

    public function mount(Proyecto $proyecto)
    {
        // 1. Seguridad: Verificar dueño
        if (session('socio_id') != $proyecto->socio_id) {
            return redirect()->route('inscritos.publico');
        }

        // 2. CORRECCIÓN: Ahora incluimos el estado 7 (Ganador) en los permitidos
        // Permitir: 7 (Seleccionado/Ganador), 8 (Eliminado), 9 (No Seleccionado)
        if (!in_array($proyecto->estado_id, [7, 8, 9])) {
            return redirect()->route('inscritos.publico');
        }

        $this->proyecto = $proyecto->load(['documentos.tipoDocumento', 'documentos.observaciones', 'estado']);
    }

    public function render()
    {
        return view('livewire.sitio.retroalimentacion-proyecto');
    }
}