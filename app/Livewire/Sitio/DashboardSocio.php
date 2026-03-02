<?php

namespace App\Livewire\Sitio;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Convocatoria;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class DashboardSocio extends Component
{
    public $proyecto;
    public $convocatoria;

    public function mount()
    {
        $user = Auth::user();

        // 1. Buscamos la convocatoria activa
        $this->convocatoria = Convocatoria::where('estado', 'abierta')->first();

        // 2. Buscamos el proyecto con todas sus relaciones para que la vista no falle
        if ($this->convocatoria) {
            $this->proyecto = Proyecto::with([
                'director',             // Para traer el nombre del director
                'documentos.tipoDocumento', // Para listar los archivos con sus nombres reales
                'estado'                // Para mostrar el nombre del estado (Revisión, etc)
            ])
                ->where('user_id', $user->id)
                ->where('convocatoria_id', $this->convocatoria->id)
                ->first();
        }
    }

    public function render()
    {
        // 1. Verificamos si existe una convocatoria activa
        if (!$this->convocatoria) {
            return view('livewire.sitio.dashboard.sin-convocatoria');
        }

        // 2. Si el socio NO ha iniciado ningún proyecto, cargamos Etapa 1
        if (!$this->proyecto) {
            return <<<'HTML'
            <div class="w-full min-h-screen bg-black">
                <livewire:sitio.inscripcion-etapa1 />
            </div>
            HTML;
        }

        // 3. Si el proyecto requiere SUBSANACIÓN (Estado ID 2)
        // Puedes decidir si mandarlo directo a un formulario de corrección
        // o dejarlo en el dashboard (ahora mismo lo dejo pasar al dashboard 
        // porque allí ya pusimos el botón de "Subsanar").

        // 4. Si el proyecto está habilitado para ETAPA 2 (Estado ID 4)
        if ($this->proyecto->estado_id == 4) {
            return <<<'HTML'
            <div class="w-full min-h-screen bg-black">
                <livewire:sitio.inscripcion-etapa2 :proyecto="$proyecto" />
            </div>
            HTML;
        }

        // 5. En cualquier otro estado (Revisión, Seleccionado, No seleccionado, etc.)
        // mostramos el Dashboard informativo con el estatus lateral.
        return view('livewire.sitio.dashboard-socio', [
            'esNuevaInscripcion' => session()->has('success') && session()->has('radicado'),
            'documentos' => $this->proyecto->documentos
        ]);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/');
    }
}
