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

        // Seguridad: Si no hay convocatoria, cerramos sesión por integridad de datos
        if (!$this->convocatoria) {
            Auth::logout();
            return redirect()->to('/');
        }

        $ahora = now();

        // 2. Identificamos si hay una etapa activa en este momento
        $this->etapaActiva = $this->convocatoria->etapas
            ->filter(fn($e) => $ahora->between($e->fecha_inicio, $e->fecha_fin))
            ->first();

        // 3. Buscamos el proyecto del socio incluyendo TODAS las relaciones para el Dashboard
        $this->proyecto = Proyecto::with([
                'director', 
                'documentos.tipoDocumento', 
                'estado', 
                'elenco' // Cargamos el elenco para las nuevas tarjetas
            ])
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
        $user = Auth::user();
        $ahora = now();
        $etapas = $this->convocatoria->etapas->sortBy('orden');

        // Identificamos las etapas clave para validaciones de flujo
        $etapaInscripcion = $etapas->filter(fn($e) => str_contains(strtolower($e->nombre), 'inscripción') || str_contains(strtolower($e->nombre), 'registro'))->first();
        $etapaSubsanacion = $etapas->filter(fn($e) => str_contains(strtolower($e->nombre), 'subsanación'))->first();

        // --- ESCENARIO 1: EL SOCIO NO TIENE PROYECTO PROPIO REGISTRADO ---
        if (!$this->proyecto) {

            // VALIDACIÓN DE EXCLUSIVIDAD: ¿Ya es director o elenco en otro proyecto?
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

            // Validaciones de fechas para nuevos registros
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

    private function viewFeedback($titulo, $mensaje)
    {
        $html = <<<HTML
        <div class="flex items-center justify-center min-h-screen bg-slate-950 text-white p-10 font-sans">
            <div class="max-w-md w-full bg-slate-900 p-8 rounded-[2.5rem] border border-slate-800 text-center shadow-2xl">
                <div class="w-20 h-20 bg-orange-500/10 text-orange-500 rounded-3xl flex items-center justify-center mx-auto mb-6">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-black uppercase tracking-tight mb-4">{$titulo}</h1>
                <div class="text-slate-400 text-sm leading-relaxed mb-8">{$mensaje}</div>
                <button wire:click="logout" class="w-full py-4 bg-white text-black rounded-2xl font-black uppercase text-[11px] tracking-[2px] hover:bg-[#ff6600] hover:text-white transition-all">
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