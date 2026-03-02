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

    public function agregarMiembro()
    {
        $hayErrores = false;
        $this->resetValidation('elenco_incompleto');

        foreach ($this->elenco as $index => $miembro) {
            if (empty($miembro['identificacion']) || !($miembro['archivo_autorizacion'] ?? false)) {
                if (empty($miembro['identificacion'])) {
                    $this->addError("elenco.$index.identificacion", 'Debe ingresar y validar una cédula.');
                }
                if (!($miembro['archivo_autorizacion'] ?? false)) {
                    $this->addError("elenco.$index.archivo_autorizacion", 'Debe cargar el documento de autorización para este miembro.');
                }
                $hayErrores = true;
            }
        }

        if ($hayErrores) {
            $this->addError('elenco_incompleto', 'Faltan documentos por cargar en el elenco.');
            return;
        }

        $this->resetValidation('elenco.*');

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
        if (collect($this->elenco)->contains('identificacion', $this->socio->identificacion)) {
            return;
        }

        $incompletos = collect($this->elenco)->filter(function ($miembro) {
            return !empty($miembro['identificacion']) && !($miembro['archivo_autorizacion'] ?? false);
        });

        if ($incompletos->isNotEmpty()) {
            $this->addError('elenco_incompleto', 'Debes completar los documentos de los miembros actuales antes de agregarte.');
            return;
        }

        $datosProponente = [
            'identificacion' => $this->socio->identificacion,
            'nombre' => strtoupper($this->socio->name),
            'user_id' => $this->socio->id,
            'archivo_autorizacion' => null,
            'encontrado' => true,
            'buscando' => false,
            'foto_url' => $this->foto_url,
            'iniciales' => $this->iniciales
        ];

        $indexVacio = collect($this->elenco)->search(function ($miembro) {
            return empty($miembro['identificacion']) && !($miembro['encontrado'] ?? false);
        });

        if ($indexVacio !== false) {
            $this->resetValidation("elenco.$indexVacio.identificacion");
            $this->resetValidation("elenco.$indexVacio.archivo_autorizacion");
            $this->elenco[$indexVacio] = $datosProponente;
        } else {
            $this->resetValidation('elenco.*');
            $this->elenco[] = $datosProponente;
        }

        $this->resetValidation('elenco_incompleto');
    }

    public function removerMiembro($index)
    {
        unset($this->elenco[$index]);
        $this->elenco = array_values($this->elenco);
    }

    public function limpiarSocio($index)
    {
        $this->elenco[$index]['identificacion'] = '';
        $this->elenco[$index]['nombre'] = '';
        $this->elenco[$index]['encontrado'] = false;
        $this->elenco[$index]['user_id'] = null;
        $this->elenco[$index]['foto_url'] = null;
        $this->elenco[$index]['iniciales'] = '';

        // Opcional: limpiar los errores específicos de este campo
        $this->resetErrorBag("elenco.$index.identificacion");
        $this->resetErrorBag("elenco.$index.encontrado");
    }

    public function buscarSocio($index)
    {
        $identificacion = trim($this->elenco[$index]['identificacion'] ?? '');

        // 1. Limpiar errores previos de este campo
        $this->resetValidation("elenco.$index.identificacion");

        if (empty($identificacion)) {
            $this->addError("elenco.$index.identificacion", 'Debe ingresar y validar una cédula.');
            $this->limpiarDatosMiembro($index);
            return;
        }

        // --- AJUSTE: VALIDACIÓN DE DUPLICADOS EN EL MISMO FORMULARIO ---
        $duplicadoLocal = collect($this->elenco)
            ->forget($index) // No compararse consigo mismo
            ->contains('identificacion', $identificacion);

        if ($duplicadoLocal) {
            $this->addError("elenco.$index.identificacion", 'Este socio ya ha sido agregado en otra tarjeta de este elenco.');
            $this->limpiarDatosMiembro($index);
            return;
        }

        $this->elenco[$index]['buscando'] = true;

        try {
            $user = User::where('identificacion', $identificacion)->first();

            if ($user) {
                // --- VALIDACIONES DE REGLAS DE NEGOCIO ---

                // A. ESTADO ACTIVO
                if (isset($user->estado) && strtolower($user->estado) !== 'activo') {
                    $this->addError("elenco.$index.identificacion", "El socio no está activo para participar en este proceso.");
                    $this->limpiarDatosMiembro($index);
                    return;
                }

                // B. MAYORÍA DE EDAD (18 años)
                if (!$user->fecha_nacimiento || \Carbon\Carbon::parse($user->fecha_nacimiento)->age < 18) {
                    $this->addError("elenco.$index.identificacion", "El socio debe ser mayor de edad para ser parte del elenco.");
                    $this->limpiarDatosMiembro($index);
                    return;
                }

                // C. EXCLUSIVIDAD (No estar en otro proyecto)
                // 1. Verificar si es el Director de otro proyecto
                $esDirectorOtro = Proyecto::where('user_id', $user->id)
                    ->where('id', '!=', $this->proyecto->id)
                    ->exists();

                // 2. Verificar si es Elenco de otro proyecto (Tabla 'proyecto_socio')
                $esElencoOtro = DB::table('proyecto_socio')
                    ->where('user_id', $user->id)
                    ->where('proyecto_id', '!=', $this->proyecto->id)
                    ->exists();

                if ($esDirectorOtro || $esElencoOtro) {
                    $this->addError("elenco.$index.identificacion", "Este socio ya está vinculado a otro proyecto (como director o elenco).");
                    $this->limpiarDatosMiembro($index);
                    return;
                }

                // --- CARGA DE DATOS EXITOSA ---
                $this->elenco[$index]['nombre'] = strtoupper($user->name);
                $this->elenco[$index]['user_id'] = $user->id;
                $this->elenco[$index]['encontrado'] = true;

                // Buscar foto
                $archivos = Storage::disk('public')->files('socios');
                $foto = collect($archivos)->first(fn($path) => str_contains(basename($path), (string)$user->identificacion));
                $this->elenco[$index]['foto_url'] = $foto ? asset('storage/' . $foto) : null;

                // Iniciales
                $p = explode(' ', trim($user->name));
                $this->elenco[$index]['iniciales'] = strtoupper(substr($p[0] ?? 'U', 0, 1) . (isset($p[1]) ? substr($p[1], 0, 1) : ''));

                $this->resetValidation("elenco.$index.identificacion");
            } else {
                $this->addError("elenco.$index.identificacion", 'El número de identificación no corresponde a un socio registrado.');
                $this->limpiarDatosMiembro($index);
            }
        } catch (\Exception $e) {
            Log::error("Error buscando socio: " . $e->getMessage());
            $this->addError("elenco.$index.identificacion", 'Ocurrió un error al consultar el socio. Intente de nuevo.');
        } finally {
            $this->elenco[$index]['buscando'] = false;
        }
    }



    private function limpiarDatosMiembro($index)
    {
        $this->elenco[$index]['nombre'] = '';
        $this->elenco[$index]['encontrado'] = false;
        $this->elenco[$index]['user_id'] = null;
        $this->elenco[$index]['foto_url'] = null;
        $this->elenco[$index]['iniciales'] = '?';
    }

    public function guardar()
    {
        $this->validate([
            'guionFinal' => 'required|mimes:pdf|max:20480',
            'radicadoGuion' => 'required|mimes:pdf|max:10240',
            'propuestaCreativa' => 'required|mimes:pdf|max:20480',
            'presupuesto' => 'required|mimes:xlsx,xls|max:10240',
            'cronograma' => 'required|mimes:xlsx,xls|max:10240',

            // VALIDACIÓN DEL ELENCO
            'elenco.*.identificacion' => 'required', // Valida que el input no esté vacío
            'elenco.*.encontrado' => 'accepted',     // Valida que se haya presionado "Validar" y el socio exista
            'elenco.*.archivo_autorizacion' => 'required|mimes:pdf|max:5120',
        ], [
            // MENSAJES PERSONALIZADOS
            'elenco.*.identificacion.required' => 'Debe ingresar y validar una cédula.',
            'elenco.*.encontrado.accepted' => 'Debe validar la cédula antes de finalizar.',
            'elenco.*.archivo_autorizacion.required' => 'La autorización es obligatoria.',
        ]);

        try {
            DB::beginTransaction();

            $this->upload($this->proyecto, $this->guionFinal, 7, 'GUION_FINAL');
            $this->upload($this->proyecto, $this->radicadoGuion, 8, 'DNDA_RADICADO');
            $this->upload($this->proyecto, $this->propuestaCreativa, 9, 'PROPUESTA_CREATIVA');
            $this->upload($this->proyecto, $this->presupuesto, 10, 'PRESUPUESTO');
            $this->upload($this->proyecto, $this->cronograma, 11, 'CRONOGRAMA');

            foreach ($this->elenco as $miembro) {
                // Ya no necesitas el if aquí porque el validate de arriba asegura que esto se cumpla
                $path = $miembro['archivo_autorizacion']->store('elenco/' . now()->year, 'public');
                $this->proyecto->elenco()->attach($miembro['user_id'], [
                    'archivo_autorizacion_path' => $path,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $this->proyecto->update(['estado_id' => 5, 'etapa_id' => 2]);

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Inscripción completada.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Etapa 2: " . $e->getMessage());
            $this->addError('error', 'Ocurrió un error al guardar: ' . $e->getMessage());
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

    public function updated($propertyName)
    {
        if (str_contains($propertyName, 'elenco.') && str_contains($propertyName, '.archivo_autorizacion')) {
            $this->resetValidation($propertyName);
            $this->resetValidation('elenco_incompleto');
        }

        if (in_array($propertyName, ['guionFinal', 'radicadoGuion', 'propuestaCreativa', 'presupuesto', 'cronograma'])) {
            $this->resetValidation($propertyName);
        }
    }

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa2');
    }

    public function limpiarDocumento($propiedad, $index = null)
    {
        if ($index !== null && $propiedad === 'elenco') {
            if (isset($this->elenco[$index]['archivo_autorizacion'])) {
                $this->elenco[$index]['archivo_autorizacion'] = null;
            }
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
}
