<?php

namespace App\Livewire\Admin;

use App\Models\Convocatoria;
use App\Models\Proyecto;
use Livewire\Component;
use Livewire\WithPagination;

class GestionarConvocatoria extends Component
{
    use WithPagination;

    public $convocatoria;
    public $search = '';

    public function mount(Convocatoria $convocatoria)
    {
        $this->convocatoria = $convocatoria;
    }

    public function render()
    {
        $proyectos = Proyecto::where('convocatoria_id', $this->convocatoria->id)
            ->where('titulo', 'like', '%' . $this->search . '%')
            ->with(['socio', 'estado']) // <--- CARGAMOS 'estado' AQUÍ
            ->paginate(10);

        return view('livewire.admin.gestionar-convocatoria', [
            'proyectos' => $proyectos
        ]);
    }
}
