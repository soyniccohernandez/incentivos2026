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

        // 2. Buscamos si el usuario ya tiene un proyecto en esa convocatoria
        $proyecto = Proyecto::where('user_id', $user->id)
            ->when($convocatoria, function ($query) use ($convocatoria) {
                return $query->where('convocatoria_id', $convocatoria->id);
            })
            ->first();

        // 3. LA CLAVE: Si no hay proyecto, mándalo a la Etapa 1 y DETENTE
        if (!$proyecto) {
            return redirect()->to('/convocatoria/registro-etapa-1');
        }

        // 4. Si hay proyecto, decidimos según el estado
        $ruta = match ((int)$proyecto->estado_id) {
            Proyecto::SUBSANACION_E1 => "/convocatoria/proyecto/{$proyecto->id}/subsanar",
            Proyecto::EN_ETAPA_2     => route('inscripcion.etapa2', ['proyectoId' => $proyecto->id]),
            7, 8, 9                  => "/convocatoria/proyecto/{$proyecto->id}/retroalimentacion",
            default                  => '/convocatoria/registro-etapa-1', // No uses route() aquí por ahora, usa el path
        };

        return redirect()->to($ruta);
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}
