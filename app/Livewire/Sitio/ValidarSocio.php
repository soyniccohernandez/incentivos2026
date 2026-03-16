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

        if (!$user) {
            $this->addError('identificacion', 'Esta identificación no corresponde a un socio registrado.');
            return;
        }

        // --- ADMIN: Siempre entra ---
        if ($user->tipo_socio === 'Administrador') {
            $this->nombreSocio = $user->name;
            $this->paso = empty($user->password) ? 'verificar' : 'login';
            return;
        }

        if (strtolower($user->estado ?? '') !== 'activo') {
            $this->addError('identificacion', "Tu cuenta no está activa.");
            return;
        }

        // 3. Obtener Convocatoria y Etapa Actual
        $convocatoria = Convocatoria::where('estado', 'abierta')->with('etapas')->first();
        if (!$convocatoria) {
            $this->addError('identificacion', "No hay convocatorias abiertas actualmente.");
            return;
        }

        $ahora = now();
        $etapaActiva = $convocatoria->etapas->first(fn($e) => $ahora->between($e->fecha_inicio, $e->fecha_fin));

        if (!$etapaActiva) {
            $this->addError('identificacion', "Actualmente no hay una etapa activa. Consulta el cronograma.");
            return;
        }

        // 4. Buscar Proyecto
        $proyecto = Proyecto::where('user_id', $user->id)
            ->where('convocatoria_id', $convocatoria->id)
            ->first();

        // --- LÓGICA BASADA EN ESTADOS DEL PROYECTO ---

        if ($proyecto) {
            // REGLA DE ORO: Si el estado es 2 (Debe subsanar), entra directo.
            // (Verifica si tu columna se llama 'estado_id' o solo 'estado')
            if ($proyecto->estado_id == 2) {
                $this->nombreSocio = $user->name;
                $this->paso = empty($user->password) ? 'verificar' : 'login';
                return;
            }

            // Si está en la Etapa 1 del calendario y ya tiene proyecto (pero NO está para subsanar)
            if ($etapaActiva->orden == 1) {
                $this->addError('identificacion', "Ya completaste tu inscripción. Tu documentación se encuentra en revisión.");
                return;
            }

            // Si está en Etapas posteriores y el proyecto está en revisión (Estado 1, 3 o 5)
            $estadosEnRevision = [1, 3, 5];
            if ($etapaActiva->orden > 1 && in_array($proyecto->estado_id, $estadosEnRevision)) {
                $this->addError('identificacion', "Tu proyecto está en revisión técnica. Por favor espera los resultados.");
                return;
            }
        }

        // REGLA PARA NUEVOS: Si no tiene proyecto y la etapa 1 ya pasó
        if (!$proyecto && $etapaActiva->orden > 1) {
            $this->addError('identificacion', "El periodo de inscripciones ha finalizado y no registraste ningún proyecto.");
            return;
        }

        // Si pasó los filtros, definir el siguiente paso
        $this->nombreSocio = $user->name;
        $this->paso = empty($user->password) ? 'verificar' : 'login';
    }

    private function verificarAnio()
    {
        $key = 'verificar-anio:' . $this->identificacion . request()->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            $seconds = RateLimiter::availableIn($key);
            $this->addError('anio_nacimiento', "Demasiados intentos. Intenta en {$seconds} segundos.");
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
        $user = User::where('identificacion', $this->identificacion)->first();

        if ($user && $user->tipo_socio !== 'Administrador') {
            if (strtolower($user->estado ?? '') !== 'activo') {
                $this->addError('identificacion', 'Tu cuenta ya no se encuentra activa.');
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
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.sitio.validar-socio');
    }
}
