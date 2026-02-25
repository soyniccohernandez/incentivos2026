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
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;

#[Layout('layouts.guest')]
class ValidarSocio extends Component
{
    public $identificacion = '';
    public $password = '';
    public $password_confirmation = '';
    public $paso = 'identificar';
    public $nombreSocio = '';
    public $anio_nacimiento = '';

    public function mount()
    {
        if (Auth::check()) {
            return $this->redireccionar();
        }
    }

    public function validar()
    {
        if ($this->paso === 'identificar') {
            $this->validarIdentificacion();
        } elseif ($this->paso === 'verificar') {
            $this->verificarAnio();
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
            // Mensaje genérico para no confirmar si la cédula existe o no
            $this->addError('identificacion', 'No se puede continuar con la identificación proporcionada.');
            return;
        }

        if (strtolower($user->estado) !== 'activo') {
            $this->addError('identificacion', "Su estado actual no le permite participar en esta convocatoria.");
            return;
        }

        $this->nombreSocio = $user->name;

        if (empty($user->password)) {
            $this->paso = 'verificar';
        } else {
            $this->paso = 'login';
        }
    }

    private function verificarAnio()
    {
        $key = 'verificar-anio:' . $this->identificacion . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('anio_nacimiento', "Demasiados intentos. Intente en {$seconds} segundos.");
            return;
        }

        $this->validate([
            'anio_nacimiento' => 'required|numeric|digits:4'
        ]);

        $user = User::where('identificacion', $this->identificacion)->first();

        // Si no hay fecha de nacimiento o no coincide, lanzamos el MISMO error
        $anioCorrecto = $user->fecha_nacimiento ? Carbon::parse($user->fecha_nacimiento)->year : null;

        if ($anioCorrecto && (int)$this->anio_nacimiento === (int)$anioCorrecto) {
            RateLimiter::clear($key);
            $this->paso = 'registrar';
            $this->resetErrorBag();
        } else {
            RateLimiter::hit($key, 60);
            // Mensaje ambiguo por seguridad
            $this->addError('anio_nacimiento', 'La información no coincide con nuestros registros. Por favor, verifique o contacte a soporte.');
        }
    }

    private function crearPassword()
    {
        $this->validate(['password' => 'required|min:6|confirmed']);
        $user = User::where('identificacion', $this->identificacion)->first();

        $user->update(['password' => Hash::make($this->password)]);

        Auth::login($user, true);
        session()->regenerate();
        session()->save();
        return $this->redireccionar();
    }

    private function acceder()
    {
        $this->validate(['password' => 'required']);

        if (Auth::attempt(['identificacion' => $this->identificacion, 'password' => $this->password], true)) {
            session()->regenerate();
            session()->save();
            return $this->redireccionar();
        }
        $this->addError('password', 'Credenciales incorrectas.');
    }

    private function redireccionar()
    {
        session()->save();
        $user = Auth::user();

        if ($user->tipo_socio === 'Administrador') {
            return redirect()->route('admin.dashboard');
        }

        $convocatoria = Convocatoria::where('estado', 'abierta')->first();

        if (!$convocatoria) {
            return redirect()->to('/');
        }

        $proyecto = Proyecto::where('user_id', $user->id)
            ->where('convocatoria_id', $convocatoria->id)
            ->first();

        if (!$proyecto) {
            return redirect()->route('dashboard');
        }

        return match ((int)$proyecto->estado_id) {
            1, 3, 7, 8, 9 => redirect()->route('dashboard'),
            2 => redirect()->route('subsanar-etapa-1', ['proyecto' => $proyecto->id]),
            4 => redirect()->route('inscripcion.etapa2', ['proyectoId' => $proyecto->id]),
            default => redirect()->route('dashboard'),
        };
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}
