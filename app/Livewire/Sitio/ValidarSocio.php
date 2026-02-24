<?php

namespace App\Livewire\Sitio;

use App\Models\User;
use App\Models\Proyecto;
use App\Models\Convocatoria;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

#[Layout('layouts.guest')]
class ValidarSocio extends Component
{
    public $identificacion = '';
    public $password = '';
    public $password_confirmation = '';

    public $paso = 'identificar';
    public $nombreSocio = '';


    public function mount()
    {
        // Si el usuario ya está logueado, no lo dejes ver el formulario, mándalo a su etapa
        if (Auth::check()) {
            return $this->redireccionar();
        }
    }

    public function validar()
    {
        if ($this->paso === 'identificar') {
            $this->validarIdentificacion();
        } elseif ($this->paso === 'registrar') {
            $this->crearPassword();
        } elseif ($this->paso === 'login') {
            $this->acceder();
        }
    }

    private function validarIdentificacion()
    {
        $this->validate(['identificacion' => 'required|numeric']);
        $user = User::where('identificacion', $this->identificacion)->first();

        if (!$user) {
            $this->addError('identificacion', 'La identificación no se encuentra registrada como socio.');
            return;
        }

        if (strtolower($user->estado) !== 'activo') {
            $this->addError('identificacion', "Su estado actual ({$user->estado}) no le permite participar.");
            return;
        }

        $this->nombreSocio = $user->name;
        $this->paso = empty($user->password) ? 'registrar' : 'login';
    }

    private function crearPassword()
    {
        $this->validate(['password' => 'required|min:6|confirmed']);

        $user = User::where('identificacion', $this->identificacion)->first();
        $user->update(['password' => Hash::make($this->password)]);

        // --- SOLUCIÓN AL BUCLE ---
        Auth::login($user, true); // true activa la cookie 'remember'
        session()->regenerate();
        session()->save();

        return $this->redireccionar();
    }

    private function acceder()
    {
        $this->validate(['password' => 'required']);

        // --- SOLUCIÓN AL BUCLE ---
        if (Auth::attempt(['identificacion' => $this->identificacion, 'password' => $this->password], true)) {
            session()->regenerate();
            session()->save();

            return $this->redireccionar();
        }

        $this->addError('password', 'La contraseña ingresada es incorrecta.');
    }

    private function redireccionar()
    {
        session()->save();
        $user = Auth::user();

        // 1. Buscamos la convocatoria abierta
        $convocatoria = Convocatoria::where('estado', 'abierta')->first();

        if (!$convocatoria) {
            return redirect()->to('/');
        }

        // 2. Buscamos si el socio ya tiene un proyecto
        $proyecto = Proyecto::where('user_id', $user->id)
            ->where('convocatoria_id', $convocatoria->id)
            ->first();

        // 3. SI NO TIENE PROYECTO:
        // Lo mandamos a la ruta 'dashboard' (que es /mi-panel). 
        // Como DashboardSocio verá que no hay proyecto, cargará automáticamente la Etapa 1.
        if (!$proyecto) {
            return redirect()->route('dashboard');
        }

        // 4. SI YA TIENE PROYECTO:
        // También lo mandamos a 'dashboard'. 
        // El DashboardSocio mirará el estado_id y mostrará la vista de "Revisión", "Subsanar", etc.

        // Nota: Solo usamos rutas específicas si el flujo de la Etapa 2 o Subsanación 
        // vive en componentes totalmente aparte que no quieras meter en el Dashboard.

        return match ((int)$proyecto->estado_id) {
            // Para estados de revisión o finales, que el Dashboard decida la vista
            1, 3, 7, 8, 9 => redirect()->route('dashboard'),

            // Si tienes rutas específicas para estos procesos, las mantenemos:
            2 => redirect()->route('subsanar-etapa-1', ['proyecto' => $proyecto->id]),
            4 => redirect()->route('inscripcion.etapa2', ['proyectoId' => $proyecto->id]),

            // Por defecto, siempre al panel central
            default => redirect()->route('dashboard'),
        };
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}
