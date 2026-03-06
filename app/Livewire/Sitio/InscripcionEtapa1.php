<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\User;
use App\Models\Convocatoria;
use App\Models\Director;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Str;

#[Layout('layouts.guest')]
class InscripcionEtapa1 extends Component
{
    use WithFileUploads;

    public User $socio;
    public $foto_url, $iniciales;

    // --- VARIABLES DE CONTROL ---
    public $mostrarPasoCero = false;
    public $otpEnviado = false;
    public $codigoUsuario;
    public $intentosFallidos = 0;

    // --- CAMPOS FORMULARIO ---
    public $titulo;
    public $autoria = 'si';
    public $guionArchivo;
    public $directorPropio = 'si';
    public $directorIdentificacion, $directorNombre, $directorCelular, $directorCorreo;

    // --- DOCUMENTOS ---
    public $docDirectorCompromiso, $docDirectorExperiencia, $docDirectorEvidencia1, $docDirectorEvidencia2, $formatoFirmado;
    public $aceptaTerminos = false, $aceptaDatos = false;

    // --- CONFIGURACIÓN ---
    public $segundosEntreIntentos = 10;
    public $maxIntentos = 3;

    public function rules()
    {
        return [
            'titulo' => 'required|string|min:2',
            'aceptaTerminos' => 'accepted',
            'aceptaDatos' => 'accepted',
            'guionArchivo' => $this->autoria === 'no' ? 'required|file|mimes:pdf|max:12288' : 'nullable',
            'directorIdentificacion' => $this->directorPropio === 'no' ? 'required|min:5' : 'nullable',
            'directorNombre'         => $this->directorPropio === 'no' ? 'required|min:3' : 'nullable',
            'directorCelular'        => $this->directorPropio === 'no' ? 'required|numeric|digits_between:7,15' : 'nullable',
            'directorCorreo'         => $this->directorPropio === 'no' ? 'required|email' : 'nullable',
            'docDirectorCompromiso'  => 'required|file|mimes:pdf|max:12288',
            'docDirectorExperiencia' => 'required|file|mimes:pdf|max:12288',
            'docDirectorEvidencia1'  => 'required|file|mimes:pdf|max:12288',
            'docDirectorEvidencia2'  => 'required|file|mimes:pdf|max:12288',
            'formatoFirmado'         => 'required|file|mimes:pdf|max:12288',
        ];
    }

    public function mount()
    {
        if (!Auth::check()) {
            return redirect()->route('validar-socio');
        }

        $this->socio = Auth::user();
        $this->mostrarPasoCero = false;

        $convocatoriaActiva = Convocatoria::where('estado', 'abierta')->first();
        if ($convocatoriaActiva) {
            $proyectoExistente = Proyecto::where('user_id', $this->socio->id)
                ->where('convocatoria_id', $convocatoriaActiva->id)
                ->exists();

            if ($proyectoExistente) {
                return redirect()->to('/')->with('info', 'Usted ya cuenta con una inscripción activa.');
            }
        }

        // Avatar e iniciales
        $parts = explode(' ', trim($this->socio->name));
        $this->iniciales = strtoupper(substr($parts[0] ?? 'U', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

        if ($this->socio->identificacion) {
            $archivos = Storage::disk('public')->files('socios');
            $fotoEncontrada = collect($archivos)->first(fn($path) => str_contains(basename($path), (string)$this->socio->identificacion));
            if ($fotoEncontrada) {
                $this->foto_url = asset('storage/' . $fotoEncontrada);
            }
        }
    }

    // --- MÉTODOS DE APOYO PARA LA VISTA ---
    public function maskEmail($email)
    {
        if (!$email) return '';
        $partes = explode("@", $email);
        if (count($partes) < 2) return $email;
        $name = $partes[0];
        $domain = $partes[1];
        $nombreMask = substr($name, 0, 2) . str_repeat('*', max(0, strlen($name) - 4)) . substr($name, -2);
        return $nombreMask . '@' . $domain;
    }

    public function maskPhone($phone)
    {
        if (!$phone) return 'N/A';
        return substr($phone, 0, 3) . '***' . substr($phone, -3);
    }
    public $mostrarOnboarding = true;

    public function completarOnboarding()
    {
        // Aquí puedes guardar en la DB que el socio ya vio el onboarding para no mostrarlo más
        // $this->socio->update(['onboarding_completado' => true]);
        $this->mostrarOnboarding = false;
    }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function updatedDirectorPropio($value)
    {
        if ($value === 'si') {
            $this->reset(['directorIdentificacion', 'directorNombre', 'directorCelular', 'directorCorreo']);
        }
    }

    public function updatedAutoria($value)
    {
        if ($value === 'si') {
            $this->reset('guionArchivo');
        }
    }

    public function guardar()
    {
        $this->validate();

        $convocatoria = Convocatoria::where('estado', 'abierta')->first();
        if (!$convocatoria) {
            $this->addError('error', 'No hay convocatoria abierta.');
            return;
        }

        // 1. Validación de Exclusividad
        $idDirectorValidar = ($this->directorPropio === 'si') ? $this->socio->identificacion : $this->directorIdentificacion;

        $existeComoProponente = Proyecto::where('convocatoria_id', $convocatoria->id)
            ->whereHas('user', fn($q) => $q->where('identificacion', $idDirectorValidar))->exists();

        $existeComoDirector = Director::whereHas('proyecto', fn($q) => $q->where('convocatoria_id', $convocatoria->id))
            ->where('identificacion', $idDirectorValidar)->exists();

        $existeComoParticipante = Proyecto::where('convocatoria_id', $convocatoria->id)
            ->whereHas('elenco', fn($q) => $q->where('identificacion', $idDirectorValidar))->exists();

        if ($existeComoProponente || $existeComoDirector || $existeComoParticipante) {
            $this->addError('directorIdentificacion', "Esta persona ($idDirectorValidar) ya participa en un proyecto de esta convocatoria.");
            return;
        }

        // 2. Transacción y Guardado
        try {
            $tiposDoc = DB::table('tipos_documento')->pluck('id', 'nombre');

            DB::beginTransaction();

            $proyecto = $this->socio->proyectos()->create([
                'convocatoria_id'   => $convocatoria->id,
                'titulo'            => strtoupper($this->titulo),
                'guion_propio'      => ($this->autoria === 'si') ? 1 : 0,
                'estado_id'         => 1,
                'etapa_id'          => 1,
                'fecha_postulacion' => now(),
            ]);

            $proyecto->director()->create([
                'es_proponente'  => ($this->directorPropio === 'si') ? 1 : 0,
                'identificacion' => $this->directorPropio === 'si' ? $this->socio->identificacion : $this->directorIdentificacion,
                'nombre'         => $this->directorPropio === 'si' ? strtoupper($this->socio->name) : strtoupper($this->directorNombre),
                'celular'        => $this->directorPropio === 'si' ? $this->socio->telefono : $this->directorCelular,
                'correo'         => $this->directorPropio === 'si' ? strtolower($this->socio->email) : strtolower($this->directorCorreo),
            ]);

            // --- LÓGICA DE NOMBRES DE ARCHIVOS ---
            // Creamos un slug del nombre del socio para que el archivo no tenga espacios ni caracteres raros
            $nombreSocioSaneado = Str::slug($this->socio->name, '_');

            $mapeoDocs = [
                ['file' => $this->docDirectorCompromiso,  'tipo' => 'ANEXO 1: MANIFESTACIÓN DEL DIRECTOR', 'pfx' => 'ANEXO_1_MANIFESTACION'],
                ['file' => $this->docDirectorExperiencia, 'tipo' => 'ANEXO 2: EXPERIENCIA COMO DIRECTOR GENERAL', 'pfx' => 'ANEXO_2_EXPERIENCIA'],
                ['file' => $this->docDirectorEvidencia1,  'tipo' => 'CERTIFICADO Y EVIDENCIAS 1', 'pfx' => 'EVIDENCIA_1'],
                ['file' => $this->docDirectorEvidencia2,  'tipo' => 'CERTIFICADO Y EVIDENCIAS 2', 'pfx' => 'EVIDENCIA_2'],
                ['file' => $this->formatoFirmado,         'tipo' => 'ANEXO 4: CONSIDERACIONES Y DECLARACIONES GENERALES', 'pfx' => 'ANEXO_4_DECLARACIONES'],
            ];

            foreach ($mapeoDocs as $doc) {
                if ($doc['file'] && isset($tiposDoc[$doc['tipo']])) {
                    // Nombre resultante: RAD-2026-001_ANEXO_1_MANIFESTACION_erick_hernandez.pdf
                    $nombreFinal = $proyecto->codigo_radicado . '_' . $doc['pfx'] . '_' . $nombreSocioSaneado;
                    $this->upload($proyecto, $doc['file'], $tiposDoc[$doc['tipo']], $nombreFinal);
                }
            }

            if ($this->autoria === 'no' && $this->guionArchivo) {
                $tipoGuionId = $tiposDoc['ANEXO 3: AUTORIZACIÓN USO DEL GUION'] ?? null;
                if ($tipoGuionId) {
                    $nombreGuion = $proyecto->codigo_radicado . '_ANEXO_3_AUTORIZACION_GUION_' . $nombreSocioSaneado;
                    $this->upload($proyecto, $this->guionArchivo, $tipoGuionId, $nombreGuion);
                }
            }

            DB::commit();

            // 3. Email
            try {
                Mail::to($this->socio->email)->send(new \App\Mail\ConfirmacionEtapaUnoMail($proyecto, $this->socio));

                Mail::to('sistemas@actores.org.co')->send(
                    new \App\Mail\InternoEtapaUnoMail(
                        $proyecto,
                        $this->socio,
                        [
                            'autoria'        => $this->autoria,
                            'directorPropio' => $this->directorPropio
                        ]
                    )
                );
            } catch (\Exception $e) {
                Log::error("Error Mail: " . $e->getMessage());
            }

            return redirect()->route('dashboard')->with(['success' => 'Inscripción exitosa.']);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("ERROR INSCRIPCION: " . $e->getMessage());
            $this->addError('error', 'Ocurrió un problema técnico: ' . $e->getMessage());
        }
    }

    private function upload($proyecto, $file, $tipoId, $nombreDiciente)
    {
        if ($file) {
            // Obtenemos la extensión original (pdf, png, jpg, etc.)
            $extension = $file->getClientOriginalExtension();

            // Construimos el nombre final usando el que viene de 'guardar'
            $name = "{$nombreDiciente}.{$extension}";

            // Guardamos en la carpeta del año actual (como lo tenías)
            $path = $file->storeAs('documentos/' . now()->year, $name, 'public');

            $proyecto->documentos()->create([
                'tipo_documento_id' => $tipoId,
                'ruta_archivo'      => $path,
                'fecha_carga'       => now(),
            ]);
        }
    }

    public function limpiarDocumento($propiedad)
    {
        $this->$propiedad = null;
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa1');
    }
}
