<?php

namespace App\Livewire\Admin;

use App\Models\Convocatoria;
use App\Models\Proyecto;
use App\Models\Socio;
use App\Models\User;
use App\Models\Estado;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        // 1. Convocatorias Abiertas (Las que reciben registros hoy)
        $convocatoriasAbiertas = Convocatoria::where('estado', 'abierta')
            ->where('fecha_fin', '>=', now()->format('Y-m-d'))
            ->count();

        // 2. Participación Total (Suma de todos los proyectos en todas las convocatorias)
        // Esto indica el volumen de documentos que el sistema está gestionando.
        $totalParticipantes = Proyecto::count();

        return view('livewire.admin.admin-dashboard', [
            'totalSocios' => Socio::count(),
            'sociosActivos' => Socio::where('estado', 'activo')->count(),
            'totalAdmins' => User::count(),

            'convocatoriasAbiertas' => $convocatoriasAbiertas,
            'totalParticipantes' => $totalParticipantes,
        ]);
    }
    public function irASocios()
    {
        return $this->redirect(route('admin.socios.index'), navigate: true);
    }
    public function irAUsuarios()
    {
        return $this->redirect(route('admin.users.index'), navigate: true);
    }
}
