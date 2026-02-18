<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\Socio;
use App\Models\Convocatoria;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class InscripcionEtapa1 extends Component
{
    use WithFileUploads;

    public Socio $socio;
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
        if (!session()->has('socio_id')) return redirect()->route('validar-socio');

        $this->socio = Socio::findOrFail(session('socio_id'));

        // Iniciales seguras
        $parts = explode(' ', trim($this->socio->nombre));
        $this->iniciales = strtoupper(substr($parts[0], 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

        // Foto segura
        $files = Storage::disk('public')->files('socios/');
        $foto = collect($files)->first(fn($p) => str_contains($p, $this->socio->identificacion));
        $this->foto_url = $foto ? asset('storage/' . $foto) : null;
    }

    public function guardar()
    {
        $this->validate();

        $convocatoria = Convocatoria::where('estado', 'abierta')->first();
        if (!$convocatoria) {
            $this->addError('error', 'No hay convocatoria abierta.');
            return;
        }

        try {
            DB::beginTransaction();

            // 1. Crear Proyecto
            $proyecto = $this->socio->proyectos()->create([
                'convocatoria_id' => $convocatoria->id,
                'titulo' => strtoupper($this->titulo),
                'guion_propio' => ($this->autoria === 'si') ? 1 : 0,
                'estado_id' => 1,
                'etapa_id' => 1,
                'fecha_postulacion' => now(),
            ]);

            // 2. Crear Director
            $proyecto->director()->create([
                'es_proponente' => ($this->directorPropio === 'si') ? 1 : 0,
                'identificacion' => $this->directorPropio === 'si' ? $this->socio->identificacion : $this->directorIdentificacion,
                'nombre' => $this->directorPropio === 'si' ? strtoupper($this->socio->nombre) : strtoupper($this->directorNombre),
                'celular' => $this->directorPropio === 'si' ? $this->socio->telefono : $this->directorCelular,
                'correo' => $this->directorPropio === 'si' ? strtolower($this->socio->correo) : strtolower($this->directorCorreo),
            ]);

            // 3. Subir Archivos (Función reutilizable)
            $this->upload($proyecto, $this->docDirectorCompromiso, 2, 'COMPROMISO');
            $this->upload($proyecto, $this->docDirectorExperiencia, 3, 'EXPERIENCIA');
            $this->upload($proyecto, $this->docDirectorEvidencia1, 4, 'EVIDENCIA1');
            $this->upload($proyecto, $this->docDirectorEvidencia2, 5, 'EVIDENCIA2');
            $this->upload($proyecto, $this->formatoFirmado, 6, 'DECLARACIONES');
            if ($this->autoria === 'no') $this->upload($proyecto, $this->guionArchivo, 1, 'GUION');

            DB::commit();
            session()->forget('socio_id');
            return redirect('/')->with([
                'success' => 'Tu proceso de inscripción ha finalizado correctamente.',
                'radicado' => $proyecto->codigo_radicado // Así creas la variable 'radicado' en la sesión
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Inscripción: " . $e->getMessage());
            $this->addError('error', 'Ocurrió un error al procesar el registro.');
        }
    }

    private function upload($proyecto, $file, $tipoId, $prefix)
    {
        if ($file) {
            $name = "E1_{$tipoId}_{$prefix}_" . time() . ".pdf";
            $path = $file->storeAs('documentos/' . now()->year, $name, 'public');
            $proyecto->documentos()->create([
                'tipo_documento_id' => $tipoId,
                'ruta_archivo' => $path,
                'fecha_carga' => now(),
            ]);
        }
    }

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa1');
    }
}
