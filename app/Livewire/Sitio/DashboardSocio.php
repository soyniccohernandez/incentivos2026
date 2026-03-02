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

        // 1. Buscamos la convocatoria abierta
        $this->convocatoria = Convocatoria::where('estado', 'abierta')->with('etapas')->first();

        // Seguridad: Si no hay convocatoria, fuera.
        if (!$this->convocatoria) {
            Auth::logout();
            return redirect()->to('/');
        }

        $ahora = now();
        
        // 2. Identificamos si hay una etapa corriendo justo ahora
        $this->etapaActiva = $this->convocatoria->etapas
            ->filter(fn($e) => $ahora->between($e->fecha_inicio, $e->fecha_fin))
            ->first();

        // 3. Buscamos el proyecto del socio para esta convocatoria
        $this->proyecto = Proyecto::with(['director', 'documentos.tipoDocumento', 'estado'])
            ->where('user_id', $user->id)
            ->where('convocatoria_id', $this->convocatoria->id)
            ->first();

        // --- LÓGICA DE PERFIL (FOTO E INICIALES) ---
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

    #[Layout('layouts.guest')]
    public function render()
    {
        $ahora = now();
        $etapas = $this->convocatoria->etapas->sortBy('orden');
        
        // Identificamos las etapas clave por su nombre
        $etapaInscripcion = $etapas->filter(fn($e) => str_contains(strtolower($e->nombre), 'inscripción') || str_contains(strtolower($e->nombre), 'registro'))->first();
        $etapaSubsanacion = $etapas->filter(fn($e) => str_contains(strtolower($e->nombre), 'subsanación'))->first();

        // --- ESCENARIO 1: EL SOCIO NO TIENE PROYECTO REGISTRADO ---
        if (!$this->proyecto) {
            // Si la etapa de inscripción ya terminó
            if ($etapaInscripcion && $ahora->gt($etapaInscripcion->fecha_fin)) {
                return $this->viewFeedback(
                    "Inscripciones Finalizadas", 
                    "El periodo para registrar nuevos proyectos terminó el " . $etapaInscripcion->fecha_fin->format('d/m/Y') . ". No es posible iniciar nuevas solicitudes."
                );
            }

            // Si la etapa de inscripción aún no empieza
            if ($etapaInscripcion && $ahora->lt($etapaInscripcion->fecha_inicio)) {
                return $this->viewFeedback(
                    "Próximamente", 
                    "La etapa de inscripción de proyectos iniciará el " . $etapaInscripcion->fecha_inicio->format('d/m/Y \a las H:i') . "."
                );
            }

            // Si estamos en tiempo de inscripción (Cargar Formulario Etapa 1)
            return <<<'HTML'
                <div class="w-full min-h-screen bg-black">
                    <livewire:sitio.inscripcion-etapa1 />
                </div>
            HTML;
        }

        // --- ESCENARIO 2: EL SOCIO YA TIENE PROYECTO Y ESTÁ OBSERVADO (Estado 4) ---
        if ($this->proyecto->estado_id == 4) {
            // Si aún no empieza el tiempo de subsanar
            if ($etapaSubsanacion && $ahora->lt($etapaSubsanacion->fecha_inicio)) {
                return $this->viewFeedback(
                    "Pendiente de Subsanación", 
                    "Su proyecto tiene observaciones registradas, pero el sistema habilitará las correcciones a partir del " . $etapaSubsanacion->fecha_inicio->format('d/m/Y') . "."
                );
            }

            // Si ya se pasó la fecha de subsanar
            if ($etapaSubsanacion && $ahora->gt($etapaSubsanacion->fecha_fin)) {
                return $this->viewFeedback(
                    "Plazo de Subsanación Vencido", 
                    "El tiempo para corregir las observaciones de su proyecto finalizó el " . $etapaSubsanacion->fecha_fin->format('d/m/Y') . "."
                );
            }

            // Si es el tiempo de subsanar (Cargar Formulario Etapa 2)
            return <<<'HTML'
                <div class="w-full min-h-screen bg-black">
                    <livewire:sitio.inscripcion-etapa2 :proyecto="$proyecto" />
                </div>
            HTML;
        }

        // --- ESCENARIO 3: EL SOCIO YA TIENE PROYECTO (Aprobado, Pendiente o en Evaluación) ---
        // Se muestra el Dashboard normal con el resumen de sus datos
        return view('livewire.sitio.dashboard-socio', [
            'esNuevaInscripcion' => session()->has('success'),
            'documentos' => $this->proyecto->documentos ?? [],
            'foto_url' => $this->foto_url,
            'iniciales' => $this->iniciales,
            'etapaNombre' => $this->etapaActiva->nombre ?? 'Evaluación / Resultados'
        ]);
    }

    /**
     * Renderiza una vista de mensaje con diseño Tailwind elegante
     */
    private function viewFeedback($titulo, $mensaje)
    {
        // Usamos una sintaxis de heredoc para inyectar las variables
        $html = <<<HTML
        <div class="flex items-center justify-center min-h-screen bg-slate-950 text-white p-10 font-sans">
            <div class="max-w-md w-full bg-slate-900 p-8 rounded-[2.5rem] border border-slate-800 text-center shadow-2xl">
                <div class="w-20 h-20 bg-orange-500/10 text-orange-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-black uppercase tracking-tight mb-2">{$titulo}</h1>
                <p class="text-slate-400 text-sm leading-relaxed mb-8">{$mensaje}</p>
                <button wire:click="logout" class="w-full py-4 bg-white text-black rounded-2xl font-black uppercase text-[11px] tracking-[2px] hover:bg-orange-500 hover:text-white transition-all">
                    Cerrar Sesión
                </button>
            </div>
        </div>
HTML;
        return $html;
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect()->to('/');
    }
}