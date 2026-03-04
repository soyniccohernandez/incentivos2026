<?php

namespace App\Livewire\Sitio;

use App\Models\User;
use App\Models\Proyecto;
use App\Models\Convocatoria;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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

        // 1. Verificación básica de existencia
        if (!$user) {
            $this->addError('identificacion', 'Esta identificación no corresponde a un socio registrado.');
            return;
        }

        // --- ACCESO VIP PARA ADMINISTRADORES ---
        if ($user->tipo_socio === 'Administrador') {
            $this->nombreSocio = $user->name;
            $this->paso = empty($user->password) ? 'verificar' : 'login';
            return; 
        }

        // 2. Verificación de estado para socios normales
        if (strtolower($user->estado ?? '') !== 'activo') {
            $this->addError('identificacion', "Su cuenta no está activa para participar.");
            return;
        }

        // --- NUEVA VALIDACIÓN: MAYORÍA DE EDAD ---
        if (!$user->fecha_nacimiento || Carbon::parse($user->fecha_nacimiento)->age < 18) {
            $this->addError('identificacion', "Debe ser mayor de edad para participar en la convocatoria.");
            return;
        }

        // 3. Validación de Convocatoria para socios
        $convocatoria = Convocatoria::where('estado', 'abierta')->with('etapas')->first();

        if (!$convocatoria) {
            $this->addError('identificacion', "No hay convocatorias abiertas actualmente.");
            return;
        }

        $ahora = now();
        $etapaActiva = $convocatoria->etapas->first(function ($etapa) use ($ahora) {
            return $ahora->between($etapa->fecha_inicio, $etapa->fecha_fin);
        });

        // --- VALIDACIÓN DE ETAPA ACTIVA ---
        if (!$etapaActiva) {
            $this->addError('identificacion', "El sistema no se encuentra en una etapa activa de la convocatoria.");
            return;
        }

        // 4. Validación de Subsanación para socios
        if ($etapaActiva && str_contains(strtolower($etapaActiva->nombre), 'subsanación')) {
            $tieneProyecto = Proyecto::where('user_id', $user->id)
                ->where('convocatoria_id', $convocatoria->id)
                ->exists();
            if (!$tieneProyecto) {
                $this->addError('identificacion', "Fase de Subsanación: Solo para socios con proyectos registrados.");
                return;
            }
        }

        // 5. Preparar siguiente paso
        $this->nombreSocio = $user->name;
        $this->paso = empty($user->password) ? 'verificar' : 'login';
    }

    private function verificarAnio()
    {
        $key = 'verificar-anio:' . $this->identificacion . request()->ip();

        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('anio_nacimiento', "Demasiados intentos. Intente en {$seconds} segundos.");
            return;
        }

        $this->validate(['anio_nacimiento' => 'required|numeric|digits:4']);

        $user = User::where('identificacion', $this->identificacion)->first();
        $anioCorrecto = $user->fecha_nacimiento ? Carbon::parse($user->fecha_nacimiento)->year : null;

        if ($anioCorrecto && (int)$this->anio_nacimiento === (int)$anioCorrecto) {
            RateLimiter::clear($key);
            $this->paso = 'registrar';
            $this->resetErrorBag();
        } else {
            RateLimiter::hit($key, 60);
            $this->addError('anio_nacimiento', 'La información no coincide con nuestros registros.');
        }
    }

    private function crearPassword()
    {
        $this->validate(['password' => 'required|min:6|confirmed']);
        $user = User::where('identificacion', $this->identificacion)->first();

        $user->update(['password' => Hash::make($this->password)]);

        Auth::login($user, true);
        session()->regenerate();
        return $this->redireccionar();
    }

    private function acceder()
    {
        $this->validate(['password' => 'required']);

        // Refuerzo de seguridad: solo permitir login si el usuario sigue activo
        $user = User::where('identificacion', $this->identificacion)->first();
        
        if ($user && $user->tipo_socio !== 'Administrador') {
            // Validar estado
            if (strtolower($user->estado ?? '') !== 'activo') {
                $this->addError('identificacion', 'Su cuenta ya no se encuentra activa.');
                return;
            }

            // Validar si la etapa sigue abierta al momento de intentar el login
            $convocatoria = Convocatoria::where('estado', 'abierta')->with('etapas')->first();
            $ahora = now();
            $etapaActiva = $convocatoria ? $convocatoria->etapas->first(fn($e) => $ahora->between($e->fecha_inicio, $e->fecha_fin)) : null;

            if (!$etapaActiva) {
                $this->addError('identificacion', 'La convocatoria o etapa actual ha finalizado.');
                return;
            }
        }

        if (Auth::attempt(['identificacion' => $this->identificacion, 'password' => $this->password], true)) {
            session()->regenerate();
            return $this->redireccionar();
        }
        $this->addError('password', 'Credenciales incorrectas.');
    }

    private function redireccionar()
    {
        $user = Auth::user();

        if ($user->tipo_socio === 'Administrador') {
            return redirect()->route('admin.dashboard');
        }

        $convocatoria = Convocatoria::where('estado', 'abierta')->first();
        if (!$convocatoria) {
            Auth::logout();
            return redirect()->to('/')->with('error', 'No hay convocatorias activas.');
        }

        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}