<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class InscripcionEtapa2 extends Component
{
    use WithFileUploads;

    public Proyecto $proyecto;
    public User $socio;
    public $foto_url, $iniciales;

    // --- VARIABLES DE ETAPA 2 ---
    public $guionFinal, $radicadoGuion, $propuestaCreativa, $presupuesto, $cronograma;
    public $elenco = [];

    public function mount(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto;
        $this->socio = Auth::user();

        // Iniciales Avatar Proponente
        $parts = explode(' ', trim($this->socio->name));
        $this->iniciales = strtoupper(substr($parts[0] ?? 'U', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

        // Cargar foto proponente
        if ($this->socio->identificacion) {
            $archivos = Storage::disk('public')->files('socios');
            $fotoEncontrada = collect($archivos)->first(fn($path) => str_contains(basename($path), (string)$this->socio->identificacion));
            if ($fotoEncontrada) $this->foto_url = asset('storage/' . $fotoEncontrada);
        }

        // Inicializar elenco con un registro vacío
        $this->agregarMiembro();
    }

    public function updated($propertyName)
    {
        $rules = [
            'guionFinal'        => 'mimes:pdf|max:20480',
            'radicadoGuion'     => 'mimes:pdf|max:10240',
            'propuestaCreativa' => 'mimes:pdf|max:20480',
            'presupuesto'       => 'mimes:xlsx,xls|max:10240',
            'cronograma'        => 'mimes:xlsx,xls|max:10240',
            'elenco.*.archivo_autorizacion' => 'mimes:pdf|max:5120',
        ];

        try {
            if (isset($rules[$propertyName]) || str_contains($propertyName, 'elenco.')) {
                $this->validateOnly($propertyName, $rules);
            }
        } catch (\Illuminate\Validation\ValidationException $e) {
            if (str_contains($propertyName, 'elenco.')) {
                $parts = explode('.', $propertyName);
                $index = $parts[1];
                $this->elenco[$index]['archivo_autorizacion'] = null;
            } else {
                $this->$propertyName = null;
            }
            throw $e;
        }

        if (str_contains($propertyName, 'elenco.')) {
            $this->resetValidation('elenco_incompleto');
        }
    }

    /**
     * Valida que las filas actuales del elenco estén completas antes de permitir agregar más.
     */
    private function puedeProcederConElenco(): bool
    {
        $this->resetValidation('elenco_incompleto');

        foreach ($this->elenco as $index => $miembro) {
            if (empty($miembro['identificacion']) || !($miembro['archivo_autorizacion'] ?? false) || !($miembro['encontrado'] ?? false)) {

                if (empty($miembro['identificacion'])) {
                    $this->addError("elenco.$index.identificacion", 'Requerido.');
                }

                if (!($miembro['archivo_autorizacion'] ?? false)) {
                    $this->addError("elenco.$index.archivo_autorizacion", 'Suba el archivo.');
                }

                if (!empty($miembro['identificacion']) && !($miembro['encontrado'] ?? false)) {
                    $this->addError("elenco.$index.identificacion", 'Debe validar este socio.');
                }

                return false;
            }
        }
        return true;
    }

    public function agregarMiembro()
    {
        if (!$this->puedeProcederConElenco()) return;

        $this->elenco[] = [
            'identificacion' => '',
            'nombre' => '',
            'user_id' => null,
            'archivo_autorizacion' => null,
            'encontrado' => false,
            'buscando' => false,
            'foto_url' => null,
            'iniciales' => '?'
        ];
    }

    public function agregarProponenteComoMiembro()
    {
        $this->resetErrorBag();

        // 1. Evitar duplicados: Si el proponente ya está en el elenco, no hacer nada.
        if (collect($this->elenco)->contains('identificacion', $this->socio->identificacion)) {
            return;
        }

        // 2. Validar Estado del Proponente
        if (strtolower($this->socio->estado ?? '') !== 'activo') {
            $this->addError('elenco_incompleto', 'Su cuenta no está activa para participar.');
            return;
        }

        // 3. Validar Edad del Proponente
        if ($this->socio->fecha_nacimiento && \Carbon\Carbon::parse($this->socio->fecha_nacimiento)->age < 18) {
            $this->addError('elenco_incompleto', 'Debe ser mayor de edad.');
            return;
        }

        // 4. Preparar datos del proponente (Usuario logueado)
        $datosProponente = [
            'identificacion'       => $this->socio->identificacion,
            'nombre'               => strtoupper($this->socio->name),
            'user_id'              => $this->socio->id,
            'archivo_autorizacion' => null, // El archivo siempre debe subirlo manualmente
            'encontrado'           => true,
            'buscando'             => false,
            'foto_url'             => $this->foto_url,
            'iniciales'            => $this->iniciales
        ];

        // 5. Lógica de inserción:
        // Buscamos si hay alguna fila que esté totalmente vacía (sin identificación)
        $indexVacio = collect($this->elenco)->search(fn($m) => empty($m['identificacion']));

        if ($indexVacio !== false) {
            // Si hay una fila vacía (como la que se crea en el mount), la rellenamos
            $this->elenco[$indexVacio] = $datosProponente;
        } else {
            // Si todas las filas actuales ya tienen datos de alguien más, creamos una nueva
            $this->elenco[] = $datosProponente;
        }

        // 6. Limpiar cualquier error de validación previo para que la interfaz se vea limpia
        $this->resetValidation();
    }

    public function buscarSocio($index)
    {
        $identificacion = trim($this->elenco[$index]['identificacion'] ?? '');
        $this->resetValidation("elenco.$index.identificacion");

        if (empty($identificacion)) {
            $this->addError("elenco.$index.identificacion", 'Ingrese cédula.');
            return;
        }

        if (collect($this->elenco)->forget($index)->contains('identificacion', $identificacion)) {
            $this->addError("elenco.$index.identificacion", 'Ya agregado.');
            return;
        }

        $this->elenco[$index]['buscando'] = true;

        try {
            $user = User::where('identificacion', $identificacion)->first();

            if ($user) {
                // 1. Validar Estado
                if (strtolower($user->estado ?? '') !== 'activo') {
                    $this->addError("elenco.$index.identificacion", "Esta persona no está activa para participar.");
                    $this->limpiarDatosMiembro($index);
                    return;
                }

                // 2. Validar Mayoría de Edad
                if ($user->fecha_nacimiento && Carbon::parse($user->fecha_nacimiento)->age < 18) {
                    $this->addError("elenco.$index.identificacion", "Solo se permiten personas mayores de edad.");
                    $this->limpiarDatosMiembro($index);
                    return;
                }

                // 3. Validar Exclusividad
                if ($this->socioYaEstaOcupado($user)) {
                    $this->addError("elenco.$index.identificacion", 'Esta persona ya pertenece a otro proyecto.');
                    $this->limpiarDatosMiembro($index);
                    return;
                }

                $this->elenco[$index]['nombre'] = strtoupper($user->name);
                $this->elenco[$index]['user_id'] = $user->id;
                $this->elenco[$index]['encontrado'] = true;

                $archivos = Storage::disk('public')->files('socios');
                $foto = collect($archivos)->first(fn($path) => str_contains(basename($path), (string)$user->identificacion));
                $this->elenco[$index]['foto_url'] = $foto ? asset('storage/' . $foto) : null;

                $p = explode(' ', trim($user->name));
                $this->elenco[$index]['iniciales'] = strtoupper(substr($p[0] ?? 'U', 0, 1) . (isset($p[1]) ? substr($p[1], 0, 1) : ''));
            } else {
                $this->addError("elenco.$index.identificacion", 'Socio no registrado.');
                $this->limpiarDatosMiembro($index);
            }
        } catch (\Exception $e) {
            $this->addError("elenco.$index.identificacion", 'Error de consulta.');
        } finally {
            $this->elenco[$index]['buscando'] = false;
        }
    }

    private function socioYaEstaOcupado($user): bool
    {
        $idActual = $this->proyecto->id;

        $esProponente = DB::table('proyectos')
            ->where('user_id', $user->id)
            ->where('id', '!=', $idActual)
            ->exists();
        if ($esProponente) return true;

        $esElenco = DB::table('proyecto_socio')
            ->where('user_id', $user->id)
            ->where('proyecto_id', '!=', $idActual)
            ->exists();
        if ($esElenco) return true;

        $esDirector = DB::table('directores')
            ->where('identificacion', $user->identificacion)
            ->where('proyecto_id', '!=', $idActual)
            ->exists();

        return $esDirector;
    }

    public function guardar()
    {
        $this->validate([
            'guionFinal'         => 'required|mimes:pdf|max:20480',
            'radicadoGuion'      => 'required|mimes:pdf|max:10240',
            'propuestaCreativa'  => 'required|mimes:pdf|max:20480',
            'presupuesto'        => 'required|mimes:xlsx,xls|max:10240',
            'cronograma'         => 'required|mimes:xlsx,xls|max:10240',
            'elenco.*.identificacion'       => 'required',
            'elenco.*.encontrado'           => 'accepted',
            'elenco.*.archivo_autorizacion' => 'required|mimes:pdf|max:5120',
        ], [
            'elenco.*.encontrado.accepted' => 'Debe validar la cédula.',
            'required' => 'Obligatorio.',
        ]);

        try {
            DB::beginTransaction();

            $this->upload($this->proyecto, $this->guionFinal, 8, 'GUION');
            $this->upload($this->proyecto, $this->radicadoGuion, 9, 'DNDA');
            $this->upload($this->proyecto, $this->propuestaCreativa, 10, 'CREATIVA');
            $this->upload($this->proyecto, $this->presupuesto, 11, 'PRESUPUESTO');
            $this->upload($this->proyecto, $this->cronograma, 12, 'CRONOGRAMA');

            $idCartaIntencion = 7;
            $this->proyecto->elenco()->detach();
            $this->proyecto->documentos()->where('tipo_documento_id', $idCartaIntencion)->delete();

            foreach ($this->elenco as $miembro) {
                $filename = "CARTA_INTENCION_" . $miembro['identificacion'] . "_" . time() . ".pdf";
                $path = $miembro['archivo_autorizacion']->storeAs('elenco/' . now()->year, $filename, 'public');

                $this->proyecto->documentos()->create([
                    'tipo_documento_id' => $idCartaIntencion,
                    'ruta_archivo'      => $path,
                    'fecha_carga'       => now(),
                    'version'           => 1,
                    'estado'            => 'pendiente',
                ]);

                $this->proyecto->elenco()->attach($miembro['user_id'], [
                    'archivo_autorizacion_path' => $path,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->proyecto->update([
                'estado_id'           => 5,
                'etapa_id'            => 2,
                'publicado'           => false,
                'observacion_general' => "Su solicitud se encuentra en etapa de revisión por el comité técnico de incentivos."
            ]);

            DB::commit();

            // --- INICIO LÓGICA DE CORREOS ETAPA 2 ---
            try {
                // 1. Notificación al Usuario
                // Mail::to($this->proyecto->socio->email)
                //     ->send(new \App\Mail\ConfirmacionEtapaDosMail($this->proyecto));

                // 2. Notificación al Equipo Interno (Santiago / Auditoría)
                // Se recomienda usar el correo de Santiago o el de auditoría técnica
                // Mail::to('incentivos@actores.org.co')
                //     ->send(new \App\Mail\InternoEtapaDosMail($this->proyecto));
            } catch (\Exception $e) {
                // Logueamos el error pero no interrumpimos la experiencia del usuario
                Log::error("Error enviando correos Etapa 2 [" . $this->proyecto->codigo_radicado . "]: " . $e->getMessage());
            }
            // --- FIN LÓGICA DE CORREOS ETAPA 2 ---
            // Guardamos el mensaje antes de destruir la sesión
            $mensaje = 'Tu proyecto "' . strtoupper($this->proyecto->titulo) . '" ha sido radicado correctamente en Etapa 2. Revisa tu correo electrónico.';

            // 1. Cerrar la sesión del usuario
            Auth::logout();

            // 2. Invalidar la sesión actual y regenerar el token (Buenas prácticas de seguridad)
            session()->invalidate();
            session()->regenerateToken();

            // 3. Redirigir al home (o la ruta welcome) con el mensaje de éxito
            return redirect()->to('/proyectos-inscritos')->with('success', $mensaje);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Crítico en Guardado Etapa 2: " . $e->getMessage());
            $this->addError('error', 'Hubo un problema al guardar: ' . $e->getMessage());
        }
    }

    private function upload($proyecto, $file, $tipoId, $prefix)
    {
        if ($file) {
            $name = "E2_{$tipoId}_{$prefix}_" . time() . "." . $file->getClientOriginalExtension();
            $path = $file->storeAs('documentos/' . now()->year, $name, 'public');
            $proyecto->documentos()->create([
                'tipo_documento_id' => $tipoId,
                'ruta_archivo' => $path,
                'fecha_carga' => now(),
            ]);
        }
    }

    public function limpiarSocio($index)
    {
        $this->limpiarDatosMiembro($index);
        $this->elenco[$index]['identificacion'] = '';
        $this->resetErrorBag("elenco.$index.identificacion");
    }

    private function limpiarDatosMiembro($index)
    {
        $this->elenco[$index]['nombre'] = '';
        $this->elenco[$index]['encontrado'] = false;
        $this->elenco[$index]['user_id'] = null;
        $this->elenco[$index]['foto_url'] = null;
        $this->elenco[$index]['iniciales'] = '?';
    }

    public function removerMiembro($index)
    {
        if (count($this->elenco) > 1) {
            unset($this->elenco[$index]);
            $this->elenco = array_values($this->elenco);
        }
    }

    public function limpiarDocumento($propiedad, $index = null)
    {
        if ($index !== null && $propiedad === 'elenco') {
            $this->elenco[$index]['archivo_autorizacion'] = null;
            $this->resetValidation("elenco.$index.archivo_autorizacion");
        } else {
            $this->$propiedad = null;
            $this->resetValidation($propiedad);
        }
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa2');
    }
}
