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

        // 1. Buscamos la convocatoria abierta
        $this->convocatoria = Convocatoria::where('estado', 'abierta')->first();

        // 2. Si hay convocatoria, buscamos si el socio ya tiene un proyecto ahí
        if ($this->convocatoria) {
            $this->proyecto = Proyecto::where('user_id', $user->id)
                ->where('convocatoria_id', $this->convocatoria->id)
                ->first();
        }
    }

    public function render()
    {
        // CASO 1: No hay convocatoria abierta
        if (!$this->convocatoria) {
            return view('livewire.sitio.dashboard.sin-convocatoria');
        }

        // CASO 2: El socio NO ha iniciado su inscripción
        // Cargamos dinámicamente tu componente de Etapa 1
        if (!$this->proyecto) {
            return <<<'HTML'
                <div>
                    <livewire:sitio.inscripcion-etapa1 />
                </div>
            HTML;
        }

        // CASO 3: El socio YA TIENE un proyecto (Inscripción iniciada o terminada)
        // Decidimos qué vista mostrar según el estado (los IDs que me pasaste)
        return match ((int)$this->proyecto->estado_id) {
            1, 3 => view('livewire.sitio.dashboard.revision'),    // Inscrito o Subsanación enviada
            2    => view('livewire.sitio.dashboard.subsanacion'), // Pendiente por corregir
            4, 5 => view('livewire.sitio.dashboard.etapa2'),      // Habilitado para Etapa 2
            7, 8, 9 => view('livewire.sitio.dashboard.finalizado'), // Resultados finales
            default => view('livewire.sitio.dashboard.revision'),
        };
    }

    // app/Livewire/Sitio/DashboardSocio.php

    public function logout()
    {
        Auth::logout();

        session()->invalidate();
        session()->regenerateToken();

        // Cambiamos la redirección a la raíz del sitio
        return redirect()->to('/');
    }
}
