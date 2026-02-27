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
        if (!$this->convocatoria) {
            return view('livewire.sitio.dashboard.sin-convocatoria');
        }

        if (!$this->proyecto) {
            // Si no hay proyecto, mostramos el formulario de inscripción
            return <<<'HTML'
            <div class="w-full min-h-screen bg-black">
                <livewire:sitio.inscripcion-etapa1 />
            </div>
            HTML;
        }

        // Si hay proyecto, pasamos los datos necesarios a la vista
        return view('livewire.sitio.dashboard-socio', [
            'esNuevaInscripcion' => session()->has('success') && session()->has('radicado'),
            'documentos' => $this->proyecto->documentos // Pasamos la colección de documentos
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