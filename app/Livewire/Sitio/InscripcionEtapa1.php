<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\User;
use App\Models\Convocatoria;
use App\Livewire\Actions\Logout;
use App\Mail\CodigoVerificacionMail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class InscripcionEtapa1 extends Component
{
    use WithFileUploads;

    public User $socio;
    public $foto_url, $iniciales;

    // --- VARIABLES DE VERIFICACIÓN (PASO 0) ---
    public $mostrarPasoCero = true;
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

    /**
     * REGLAS DE VALIDACIÓN DINÁMICAS
     */
    public function rules()
    {
        return [
            'titulo' => 'required|string|min:5',
            'aceptaTerminos' => 'accepted',
            'aceptaDatos' => 'accepted',

            // Validación condicional para Guion (Anexo 3)
            'guionArchivo' => $this->autoria === 'no' ? 'required|file|mimes:pdf|max:12288' : 'nullable',

            // Validación condicional para Director Externo
            'directorIdentificacion' => $this->directorPropio === 'no' ? 'required|min:5' : 'nullable',
            'directorNombre'         => $this->directorPropio === 'no' ? 'required|min:3' : 'nullable',
            'directorCelular'        => $this->directorPropio === 'no' ? 'required|numeric|digits_between:7,15' : 'nullable',
            'directorCorreo'         => $this->directorPropio === 'no' ? 'required|email' : 'nullable',

            // Documentos obligatorios del Director
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

        // Seguridad: Inscripción activa
        $convocatoriaActiva = Convocatoria::where('estado', 'abierta')->first();
        if ($convocatoriaActiva) {
            $proyectoExistente = Proyecto::where('user_id', $this->socio->id)
                ->where('convocatoria_id', $convocatoriaActiva->id)
                ->first();

            if ($proyectoExistente) {
                return redirect()->to('/')->with('info', 'Usted ya cuenta con una inscripción activa.');
            }
        }

        // Iniciales Avatar
        $parts = explode(' ', trim($this->socio->name));
        $this->iniciales = strtoupper(substr($parts[0] ?? 'U', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

        // Cargar foto
        if ($this->socio->identificacion) {
            $archivos = Storage::disk('public')->files('socios');
            $fotoEncontrada = collect($archivos)->first(fn($path) => str_contains(basename($path), (string)$this->socio->identificacion));
            if ($fotoEncontrada) $this->foto_url = asset('storage/' . $fotoEncontrada);
        }

        // OTP Persistencia
        if ($this->socio->otp_code && $this->socio->otp_expires_at && now()->isBefore($this->socio->otp_expires_at)) {
            $this->otpEnviado = true;
        }
    }

    /**
     * HOOKS DE ACTUALIZACIÓN (Reacción inmediata)
     */
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedDirectorPropio($value)
    {
        if ($value === 'si') {
            // Limpiamos datos y errores de los campos de director externo
            $this->reset(['directorIdentificacion', 'directorNombre', 'directorCelular', 'directorCorreo']);
            $this->resetErrorBag(['directorIdentificacion', 'directorNombre', 'directorCelular', 'directorCorreo']);
        }
    }

    public function updatedAutoria($value)
    {
        if ($value === 'si') {
            $this->reset('guionArchivo');
            $this->resetErrorBag('guionArchivo');
        }
    }

    // --- MÉTODOS DE APOYO (OTP) ---
    public function maskEmail($email)
    {
        if (!$email) return '';
        $partes = explode("@", $email);
        $name = $partes[0];
        $domain = $partes[1];
        $nombreMask = substr($name, 0, 2) . str_repeat('*', max(0, strlen($name) - 4)) . substr($name, -2);
        $domainPartes = explode(".", $domain);
        $dominioMask = substr($domainPartes[0], 0, 2) . str_repeat('*', 3) . (isset($domainPartes[1]) ? '.' . $domainPartes[1] : '');
        return $nombreMask . '@' . $dominioMask;
    }

    public function maskPhone($phone)
    {
        if (!$phone) return 'NO REGISTRADO';
        return substr($phone, 0, 3) . '***' . substr($phone, -3);
    }

    public function enviarCodigo()
    {
        $this->resetErrorBag();
        if ($this->socio->otp_last_sent_at) {
            $segundosDiferencia = abs(now()->diffInSeconds($this->socio->otp_last_sent_at));
            if ($segundosDiferencia < 60) {
                $restante = 60 - $segundosDiferencia;
                $this->addError('codigoUsuario', "ESPERA " . ceil($restante) . " SEGUNDOS PARA REINTENTAR.");
                return;
            }
        }

        $nuevoCodigo = (string)rand(100000, 999999);
        try {
            $this->socio->update([
                'otp_code' => $nuevoCodigo,
                'otp_expires_at' => now()->addMinutes(10),
                'otp_last_sent_at' => now(),
            ]);
            $this->intentosFallidos = 0;
            $this->otpEnviado = true;
            $this->codigoUsuario = '';
            Mail::to($this->socio->email)->send(new CodigoVerificacionMail($nuevoCodigo, $this->socio));
        } catch (\Exception $e) {
            Log::error("Error OTP: " . $e->getMessage());
            $this->otpEnviado = false;
            $this->addError('codigoUsuario', 'ERROR AL ENVIAR EL CORREO.');
        }
    }

    public function validarCodigo()
    {
        $this->resetErrorBag();
        if (!$this->socio->otp_code || !$this->socio->otp_expires_at || now()->isAfter($this->socio->otp_expires_at)) {
            $this->addError('codigoUsuario', 'CÓDIGO EXPIRADO.');
            $this->otpEnviado = false;
            return;
        }

        if ($this->codigoUsuario !== $this->socio->otp_code) {
            $this->intentosFallidos++;
            if ($this->intentosFallidos >= 3) {
                $this->socio->update(['otp_code' => null, 'otp_expires_at' => null]);
                $this->otpEnviado = false;
                $this->addError('codigoUsuario', 'INTENTOS AGOTADOS.');
            } else {
                $this->addError('codigoUsuario', "CÓDIGO INCORRECTO.");
            }
            return;
        }

        $this->socio->update(['otp_code' => null, 'otp_expires_at' => null]);
        $this->mostrarPasoCero = false;
    }

    // --- ACCIONES FINALES ---
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
            $this->addError('error', 'No hay convocatoria abierta.');
            return;
        }

        try {
            DB::beginTransaction();

            // 1. Creación del proyecto
            $proyecto = $this->socio->proyectos()->create([
                'convocatoria_id'   => $convocatoria->id,
                'titulo'            => strtoupper($this->titulo),
                'guion_propio'      => ($this->autoria === 'si') ? 1 : 0,
                'estado_id'         => 1,
                'etapa_id'          => 1,
                'fecha_postulacion' => now(),
            ]);

            // 2. Creación del registro del Director
            $proyecto->director()->create([
                'es_proponente'   => ($this->directorPropio === 'si') ? 1 : 0,
                'identificacion' => $this->directorPropio === 'si' ? $this->socio->identificacion : $this->directorIdentificacion,
                'nombre'         => $this->directorPropio === 'si' ? strtoupper($this->socio->name) : strtoupper($this->directorNombre),
                'celular'        => $this->directorPropio === 'si' ? $this->socio->telefono : $this->directorCelular,
                'correo'         => $this->directorPropio === 'si' ? strtolower($this->socio->email) : strtolower($this->directorCorreo),
            ]);

            // 3. Carga masiva de documentos
            $this->upload($proyecto, $this->docDirectorCompromiso, 2, 'COMPROMISO');
            $this->upload($proyecto, $this->docDirectorExperiencia, 3, 'EXPERIENCIA');
            $this->upload($proyecto, $this->docDirectorEvidencia1, 4, 'EVIDENCIA1');
            $this->upload($proyecto, $this->docDirectorEvidencia2, 5, 'EVIDENCIA2');
            $this->upload($proyecto, $this->formatoFirmado, 6, 'DECLARACIONES');

            if ($this->autoria === 'no' && $this->guionArchivo) {
                $this->upload($proyecto, $this->guionArchivo, 1, 'GUION');
            }

            DB::commit();

            // --- ENVÍO DE CORREOS (Usando rutas completas para evitar errores de importación) ---

            // A. Al SOCIO
            try {
                Mail::to($this->socio->email)->send(new \App\Mail\InscripcionConfirmadaMail($proyecto, $this->socio));
            } catch (\Exception $e) {
                Log::error("Error Mail Socio: " . $e->getMessage());
            }

            // B. AL EQUIPO TÉCNICO (Respaldo con adjuntos)
            try {
                $emailRevision = 'nhernandez@actores.org.co'; // <--- Cambia esto por el correo real
                Mail::to($emailRevision)
                    ->later(now()->addSeconds(15), new \App\Mail\NotificacionInternaInscripcionMail($proyecto, $this->socio));

                
            } catch (\Exception $e) {
                Log::error("Error Mail Respaldo: " . $e->getMessage());
            }

            // --- REDIRECCIÓN ---
            return redirect()->route('dashboard')->with([
                'success' => 'Inscripción exitosa.',
                'radicado' => $proyecto->codigo_radicado
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Crítico Inscripción: " . $e->getMessage());
            $this->addError('error', 'Error al procesar el registro.');
        }
    }

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
