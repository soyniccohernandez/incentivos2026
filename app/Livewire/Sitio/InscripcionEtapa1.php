<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\Socio;
use App\Models\Convocatoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class InscripcionEtapa1 extends Component
{
    use WithFileUploads;

    // Propiedades del Socio y Perfil
    public Socio $socio;
    public $foto_url;
    public $iniciales;

    // Datos del Proyecto
    public $titulo;
    public $autoria = 'si';
    public $guionArchivo;

    // Datos Director
    public $directorPropio = 'si';
    public $directorIdentificacion;
    public $directorNombre;
    public $directorCelular;
    public $directorCorreo;

    // Documentos (Estas deben existir para evitar el error PropertyNotFound)
    public $docDirectorExperiencia;
    public $docDirectorCompromiso;
    public $docDirectorEvidencia1;
    public $docDirectorEvidencia2;
    public $formatoFirmado;

    // Checkboxes
    public $aceptaTerminos = false;
    public $aceptaDatos = false;

    public function mount()
    {
        if (!session()->has('socio_id')) {
            return redirect()->route('validar-socio');
        }
        $this->socio = Socio::findOrFail(session('socio_id'));

        // Carga de Foto y Iniciales (Igual que Etapa 2)
        $this->foto_url = $this->obtenerUrlFoto($this->socio->identificacion);
        
        $parts = explode(' ', mb_strtoupper($this->socio->nombre));
        $this->iniciales = (count($parts) >= 2) 
            ? mb_substr($parts[0], 0, 1) . mb_substr($parts[1], 0, 1) 
            : mb_substr($parts[0], 0, 1);
    }

    private function obtenerUrlFoto($cedula) 
    { 
        $directory = 'socios/'; 
        $files = Storage::disk('public')->files($directory); 
        $foto = collect($files)->first(fn($p) => str_starts_with(basename($p), $cedula . '.')); 
        return $foto ? asset('storage/' . $foto) . '?v=' . time() : null; 
    }

    public function getNombreLimpioProperty()
    {
        return str_replace(',', '', mb_strtoupper($this->socio->nombre));
    }

    protected function reglasValidacion()
    {
        return [
            'titulo' => 'required|string|max:255',
            'autoria' => 'required|in:si,no',
            'guionArchivo' => 'required_if:autoria,no|nullable|file|max:10240|mimes:pdf',
            'directorPropio' => 'required|in:si,no',
            'directorIdentificacion' => 'required_if:directorPropio,no|nullable|string',
            'directorNombre' => 'required_if:directorPropio,no|nullable|string',
            'directorCelular' => 'required_if:directorPropio,no|nullable|string',
            'directorCorreo' => 'required_if:directorPropio,no|nullable|email',
            'docDirectorExperiencia' => 'required|file|max:10240|mimes:pdf',
            'docDirectorCompromiso' => 'required|file|max:10240|mimes:pdf',
            'docDirectorEvidencia1' => 'required|file|max:10240|mimes:pdf',
            'docDirectorEvidencia2' => 'required|file|max:10240|mimes:pdf',
            'formatoFirmado' => 'required|file|max:10240|mimes:pdf',
            'aceptaTerminos' => 'accepted',
            'aceptaDatos' => 'accepted',
        ];
    }

    public function guardar()
    {
        $this->validate($this->reglasValidacion());

        $convocatoria = Convocatoria::where('estado', 'abierta')->first();
        if (!$convocatoria) {
            session()->flash('error', 'La convocatoria no está disponible.');
            return;
        }

        try {
            DB::beginTransaction();

            // 1. Crear el proyecto
            $proyecto = $this->socio->proyectos()->create([
                'convocatoria_id' => $convocatoria->id,
                'titulo' => mb_strtoupper($this->titulo),
                'estado_id' => 1,
                'etapa_id' => 1,
            ]);

            // 2. Crear Director
            $proyecto->director()->create([
                'es_proponente' => $this->directorPropio === 'si',
                'identificacion' => $this->directorPropio === 'si' ? $this->socio->identificacion : $this->directorIdentificacion,
                'nombre' => $this->directorPropio === 'si' ? $this->nombreLimpio : mb_strtoupper($this->directorNombre),
                'celular' => $this->directorPropio === 'si' ? $this->socio->telefono : $this->directorCelular,
                'correo' => $this->directorPropio === 'si' ? mb_strtolower($this->socio->correo) : mb_strtolower($this->directorCorreo),
            ]);

            // 3. Subida de archivos
            $this->subirArchivo($proyecto, $this->guionArchivo, 1, 'AUTORIZACION_GUION');
            $this->subirArchivo($proyecto, $this->docDirectorExperiencia, 2, 'EXPERIENCIA_DIRECTOR');
            $this->subirArchivo($proyecto, $this->docDirectorCompromiso, 3, 'COMPROMISO_DIRECTOR');
            $this->subirArchivo($proyecto, $this->docDirectorEvidencia1, 4, 'EVIDENCIAS_1_DIRECTOR');
            $this->subirArchivo($proyecto, $this->docDirectorEvidencia2, 5, 'EVIDENCIAS_2_DIRECTOR');
            $this->subirArchivo($proyecto, $this->formatoFirmado, 6, 'DECLARACIONES_FINALES');

            // 4. Aceptaciones
            $proyecto->aceptaciones()->createMany([
                ['tipo' => 'terminos', 'aceptado' => true, 'fecha_aceptacion' => now(), 'ip' => request()->ip()],
                ['tipo' => 'datos_personales', 'aceptado' => true, 'fecha_aceptacion' => now(), 'ip' => request()->ip()],
            ]);

            DB::commit();

            $radicadoFinal = $proyecto->codigo_radicado;
            session()->forget('socio_id');

            return redirect('/')->with([
                'success' => 'Su propuesta ha sido registrada correctamente en nuestro sistema.',
                'radicado' => $radicadoFinal
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Inscripción E1: " . $e->getMessage());
            session()->flash('error', 'Error al procesar el registro.');
        }
    }

    private function subirArchivo($proyecto, $archivo, $tipoId, $prefijoNombre)
    {
        if ($archivo && $archivo->isValid()) {
            try {
                $orden = str_pad($tipoId, 2, '0', STR_PAD_LEFT);
                $tituloSlug = Str::slug($this->titulo, '_');
                $socioId = $this->socio->identificacion;
                $radicado = Str::slug($proyecto->codigo_radicado, '_');

                $nombreFinal = "E1_{$orden}_{$prefijoNombre}_{$tituloSlug}_SOCIO_{$socioId}_RAD_{$radicado}.pdf";
                $path = $archivo->storeAs('documentos/' . now()->year, $nombreFinal, 'public');

                $proyecto->documentos()->create([
                    'tipo_documento_id' => $tipoId,
                    'ruta_archivo' => $path,
                    'estado' => 'pendiente',
                    'version' => 1,
                    'fecha_carga' => now(),
                ]);
            } catch (\Exception $e) {
                Log::error("Fallo subida Tipo $tipoId: " . $e->getMessage());
                throw new \Exception("Error en documento $prefijoNombre");
            }
        }
    }

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa1');
    }
}