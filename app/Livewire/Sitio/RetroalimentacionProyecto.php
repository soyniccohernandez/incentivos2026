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
        // Seguridad: Verificar que el socio de la sesión sea el dueño del proyecto
        if (session('socio_id') != $proyecto->socio_id) {
            return redirect()->route('inscritos.publico');
        }

        // Solo permitir si el estado es 8 (Eliminado) o 9 (No Seleccionado)
        if (!in_array($proyecto->estado_id, [8, 9])) {
            return redirect()->route('inscritos.publico');
        }

        $this->proyecto = $proyecto->load(['documentos.tipoDocumento', 'documentos.observaciones', 'estado']);
    }

    public function render()
    {
        return view('livewire.sitio.retroalimentacion-proyecto');
    }
}