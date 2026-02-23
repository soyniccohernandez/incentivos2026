<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\User;
use App\Models\Convocatoria;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class InscripcionEtapa1 extends Component
{
    use WithFileUploads;

    /**
     * @var User $socio  
     * Representa al usuario autenticado (que ahora contiene todos los datos de socio)
     */
    public User $socio;
    public $foto_url, $iniciales;

    // Campos Formulario
    public $titulo;
    public $autoria = 'si';
    public $guionArchivo;
    public $directorPropio = 'si';
    public $directorIdentificacion, $directorNombre, $directorCelular, $directorCorreo;

    // Documentos
    public $docDirectorCompromiso, $docDirectorExperiencia, $docDirectorEvidencia1, $docDirectorEvidencia2, $formatoFirmado;
    public $aceptaTerminos = false, $aceptaDatos = false;

    public function rules()
    {
        return [
            'titulo' => 'required|string|min:5',
            'docDirectorCompromiso' => 'required|file|mimes:pdf|max:12288',
            'docDirectorExperiencia' => 'required|file|mimes:pdf|max:12288',
            'docDirectorEvidencia1' => 'required|file|mimes:pdf|max:12288',
            'docDirectorEvidencia2' => 'required|file|mimes:pdf|max:12288',
            'formatoFirmado' => 'required|file|mimes:pdf|max:12288',
            'aceptaTerminos' => 'accepted',
            'aceptaDatos' => 'accepted',
            'guionArchivo' => 'required_if:autoria,no',
        ];
    }

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('validar-socio');
        }

        // Asignamos el usuario autenticado (Tabla 'users')
        $this->socio = Auth::user();

        // 1. Generar iniciales seguras desde el nombre del User
        $nombreCompuesto = trim($this->socio->name);
        $parts = explode(' ', $nombreCompuesto);
        $this->iniciales = strtoupper(
            substr($parts[0] ?? 'U', 0, 1) .
            (isset($parts[1]) ? substr($parts[1], 0, 1) : '')
        );

        // 2. Búsqueda de Foto usando el campo 'identificacion' unificado en 'users'
        if ($this->socio->identificacion) {
            $directorio = 'socios'; 
            $archivos = Storage::disk('public')->files($directorio);

            // Buscamos cualquier archivo que contenga el número de identificación en su nombre
            $fotoEncontrada = collect($archivos)->first(function ($path) {
                return str_contains(basename($path), (string)$this->socio->identificacion);
            });

            if ($fotoEncontrada) {
                $this->foto_url = asset('storage/' . $fotoEncontrada);
            } else {
                Log::info("Foto no encontrada en storage/public/socios para ID: " . $this->socio->identificacion);
                $this->foto_url = null;
            }
        }
    }

    /**
     * Cerrar sesión del usuario
     */
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function guardar()
    {
        $this->validate();

        $convocatoria = Convocatoria::where('estado', 'abierta')->first();
        if (!$convocatoria) {
            $this->addError('error', 'No hay convocatoria abierta en este momento.');
            return;
        }

        try {
            DB::beginTransaction();

            // Creamos el proyecto amarrado al ID del User
            $proyecto = $this->socio->proyectos()->create([
                'convocatoria_id' => $convocatoria->id,
                'titulo' => strtoupper($this->titulo),
                'guion_propio' => ($this->autoria === 'si') ? 1 : 0,
                'estado_id' => 1,
                'etapa_id' => 1,
                'fecha_postulacion' => now(),
            ]);

            // Creamos el director tomando datos de la misma tabla 'users' si es directorPropio
            $proyecto->director()->create([
                'es_proponente'  => ($this->directorPropio === 'si') ? 1 : 0,
                'identificacion' => $this->directorPropio === 'si' ? $this->socio->identificacion : $this->directorIdentificacion,
                'nombre'         => $this->directorPropio === 'si' ? strtoupper($this->socio->name) : strtoupper($this->directorNombre),
                'celular'        => $this->directorPropio === 'si' ? $this->socio->telefono : $this->directorCelular,
                'correo'         => $this->directorPropio === 'si' ? strtolower($this->socio->email) : strtolower($this->directorCorreo),
            ]);

            // Carga de documentos
            $this->upload($proyecto, $this->docDirectorCompromiso, 2, 'COMPROMISO');
            $this->upload($proyecto, $this->docDirectorExperiencia, 3, 'EXPERIENCIA');
            $this->upload($proyecto, $this->docDirectorEvidencia1, 4, 'EVIDENCIA1');
            $this->upload($proyecto, $this->docDirectorEvidencia2, 5, 'EVIDENCIA2');
            $this->upload($proyecto, $this->formatoFirmado, 6, 'DECLARACIONES');
            
            if ($this->autoria === 'no' && $this->guionArchivo) {
                $this->upload($proyecto, $this->guionArchivo, 1, 'GUION');
            }

            DB::commit();

            return redirect('/')->with([
                'success' => 'Tu proceso de inscripción ha finalizado correctamente.',
                'radicado' => $proyecto->codigo_radicado
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Crítico en Inscripción: " . $e->getMessage());
            $this->addError('error', 'Ocurrió un error al procesar el registro. Por favor intente de nuevo.');
        }
    }

    /**
     * Manejador de subida de archivos PDF
     */
    private function upload($proyecto, $file, $tipoId, $prefix)
    {
        if ($file) {
            $name = "E1_{$tipoId}_{$prefix}_" . time() . ".pdf";
            $path = $file->storeAs('documentos/' . now()->year, $name, 'public');
            $proyecto->documentos()->create([
                'tipo_documento_id' => $tipoId,
                'ruta_archivo'      => $path,
                'fecha_carga'       => now(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa1');
    }
}