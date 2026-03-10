<?php

namespace App\Livewire\Sitio;

use Livewire\Component;
use App\Models\Proyecto;
use App\Models\Convocatoria;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class DashboardSocio extends Component
{
    public $proyecto;
    public $convocatoria;
    public $etapaActiva = null;
    public $foto_url = null;
    public $iniciales = '';

    public function mount()
    {
        $user = Auth::user();

        // 1. Buscamos la convocatoria abierta con sus etapas
        $this->convocatoria = Convocatoria::where('estado', 'abierta')->with('etapas')->first();

        // Seguridad: Si no hay convocatoria, cerramos sesión
        if (!$this->convocatoria) {
            return $this->logout();
        }

        $ahora = now();

        // 2. Identificamos si hay una etapa activa
        $this->etapaActiva = $this->convocatoria->etapas
            ->filter(fn($e) => $ahora->between($e->fecha_inicio, $e->fecha_fin))
            ->first();

        // 3. Buscamos el proyecto del socio
        $this->proyecto = Proyecto::with([
                'director', 
                'documentos.tipoDocumento', 
                'estado', 
                'elenco'
            ])
            ->where('user_id', $user->id)
            ->where('convocatoria_id', $this->convocatoria->id)
            ->first();

        // --- VALIDACIÓN OBLIGATORIA: Si tiene proyecto pero NO está publicado, cerrar sesión ---
        if ($this->proyecto && !$this->proyecto->publicado) {
            return $this->logout();
        }

        // --- LÓGICA DE PERFIL ---
        $this->cargarDatosPerfil($user);
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        // VALIDACIÓN EN TIEMPO REAL: Verifica si el admin ocultó el proyecto mientras el socio está en el dashboard
        if ($this->proyecto) {
            $todaviaPublicado = Proyecto::where('id', $this->proyecto->id)->value('publicado');
            if (!$todaviaPublicado) {
                return $this->logout();
            }
        }

        $user = Auth::user();
        $ahora = now();
        $etapas = $this->convocatoria->etapas->sortBy('orden');

        $etapaInscripcion = $etapas->filter(fn($e) => str_contains(strtolower($e->nombre), 'inscripción') || str_contains(strtolower($e->nombre), 'registro'))->first();
        $etapaSubsanacion = $etapas->filter(fn($e) => str_contains(strtolower($e->nombre), 'subsanación'))->first();

        // --- ESCENARIO 1: EL SOCIO NO TIENE PROYECTO PROPIO REGISTRADO ---
        if (!$this->proyecto) {
            $proyectoAjenoDirector = Proyecto::where('convocatoria_id', $this->convocatoria->id)
                ->whereHas('director', function ($q) use ($user) {
                    $q->where('identificacion', $user->identificacion);
                })->first();

            $proyectoAjenoElenco = Proyecto::where('convocatoria_id', $this->convocatoria->id)
                ->whereHas('elenco', function ($q) use ($user) {
                    $q->where('identificacion', $user->identificacion);
                })->first();

            $proyectoVinculado = $proyectoAjenoDirector ?: $proyectoAjenoElenco;

            if ($proyectoVinculado) {
                $rol = $proyectoAjenoDirector ? 'DIRECTOR' : 'MIEMBRO DEL ELENCO';
                return $this->viewFeedback(
                    "Participación Existente",
                    "No puedes iniciar una nueva inscripción porque ya figuras como <span class='text-white font-bold'>{$rol}</span> en el proyecto: <br><br> 
                    <span class='text-[#ff6600] font-black text-lg uppercase'>\"{$proyectoVinculado->titulo}\"</span><br><br>
                    Según las bases, un participante solo puede estar vinculado a una propuesta."
                );
            }

            if ($etapaInscripcion && $ahora->gt($etapaInscripcion->fecha_fin)) {
                return $this->viewFeedback("Inscripciones Finalizadas", "El periodo para registrar nuevos proyectos terminó el " . $etapaInscripcion->fecha_fin->format('d/m/Y') . ".");
            }

            if ($etapaInscripcion && $ahora->lt($etapaInscripcion->fecha_inicio)) {
                return $this->viewFeedback("Próximamente", "La etapa de inscripción iniciará el " . $etapaInscripcion->fecha_inicio->format('d/m/Y \a las H:i') . ".");
            }

            return <<<'HTML'
                <div class="w-full min-h-screen bg-black">
                    <livewire:sitio.inscripcion-etapa1 />
                </div>
            HTML;
        }

        // --- ESCENARIO 2: EL SOCIO TIENE PROYECTO OBSERVADO (Estado 4) ---
        if ($this->proyecto->estado_id == 4) {
            if ($etapaSubsanacion && $ahora->lt($etapaSubsanacion->fecha_inicio)) {
                return $this->viewFeedback("Pendiente de Subsanación", "El sistema habilitará las correcciones a partir del " . $etapaSubsanacion->fecha_inicio->format('d/m/Y') . ".");
            }

            if ($etapaSubsanacion && $ahora->gt($etapaSubsanacion->fecha_fin)) {
                return $this->viewFeedback("Plazo Vencido", "El tiempo para corregir observaciones finalizó el " . $etapaSubsanacion->fecha_fin->format('d/m/Y') . ".");
            }

            return <<<'HTML'
                <div class="w-full min-h-screen bg-black">
                    <livewire:sitio.inscripcion-etapa2 :proyecto="$proyecto" />
                </div>
            HTML;
        }

        // --- ESCENARIO 3: VISTA NORMAL DEL DASHBOARD ---
        return view('livewire.sitio.dashboard-socio', [
            'proyecto' => $this->proyecto,
            'esNuevaInscripcion' => session()->has('success'),
            'documentos' => $this->proyecto->documentos ?? [],
            'foto_url' => $this->foto_url,
            'iniciales' => $this->iniciales,
            'etapaNombre' => $this->etapaActiva->nombre ?? 'Evaluación / Resultados'
        ]);
    }

    private function cargarDatosPerfil($user)
    {
        $nameParts = explode(' ', trim($user->name));
        $this->iniciales = strtoupper(substr($nameParts[0] ?? 'U', 0, 1) . (isset($nameParts[1]) ? substr($nameParts[1], 0, 1) : ''));

        if ($user->identificacion) {
            $extensiones = ['jpg', 'jpeg', 'png', 'webp'];
            foreach ($extensiones as $ext) {
                $ruta = "socios/{$user->identificacion}.{$ext}";
                if (Storage::disk('public')->exists($ruta)) {
                    $this->foto_url = asset("storage/" . $ruta);
                    break;
                }
            }
        }
    }

    private function viewFeedback($titulo, $mensaje)
    {
        return view('livewire.sitio.feedback-dashboard', [
            'titulo' => $titulo,
            'mensaje' => $mensaje
        ]);
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/')->with('message', 'Sesión cerrada por seguridad o cambios en los resultados.');
    }
}