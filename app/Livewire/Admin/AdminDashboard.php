<?php

namespace App\Livewire\Admin;

use App\Models\Convocatoria;
use App\Models\Proyecto;
use App\Models\User; // Solo usamos User
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class AdminDashboard extends Component
{
    public function render()
    {
        $convocatoriasAbiertas = Convocatoria::where('estado', 'abierta')
            ->where('fecha_fin', '>=', now())
            ->count();

        $totalParticipantes = Proyecto::count();

        return view('livewire.admin.admin-dashboard', [
            // Contamos a todos los que NO son Administradores como socios
            'totalSocios'   => User::where('tipo_socio', '!=', 'Administrador')->count(),

            // Filtramos específicamente al Administrador
            'totalAdmins'   => User::where('tipo_socio', 'Administrador')->count(),

            // Socios activos (excluyendo admins)
            'sociosActivos' => User::where('tipo_socio', '!=', 'Administrador')
                ->where('estado', 'Activo')
                ->count(),

            'convocatoriasAbiertas' => $convocatoriasAbiertas,
            'totalParticipantes'    => $totalParticipantes,
        ]);
    }

    public function irASocios()
    {
        // El nombre 'admin.socios.index' debe ser el mismo que pusiste en web.php
        return $this->redirect(route('admin.socios.index'), navigate: true);
    }

    public function irAUsuarios()
    {
        // Esta ruta suele ser para gestionar administradores u otros roles
        return $this->redirect(route('admin.users.index'), navigate: true);
    }
}
