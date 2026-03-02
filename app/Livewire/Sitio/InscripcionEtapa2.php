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
        $this->elenco[] = [
            'cedula' => '',
            'nombre' => '',
            'user_id' => null,
            'archivo_autorizacion' => null,
            'encontrado' => false,
            'buscando' => false,
            'foto_url' => null,      // LLAVE AGREGADA
            'iniciales' => '?'       // LLAVE AGREGADA
        ];
    }

    public function agregarProponenteComoMiembro()
    {
        $this->elenco[] = [
            'cedula' => $this->socio->identificacion,
            'nombre' => strtoupper($this->socio->name),
            'user_id' => $this->socio->id,
            'archivo_autorizacion' => null,
            'encontrado' => true,
            'buscando' => false,
            'foto_url' => $this->foto_url, // LLAVE AGREGADA
            'iniciales' => $this->iniciales // LLAVE AGREGADA
        ];
    }

    public function removerMiembro($index)
    {
        unset($this->elenco[$index]);
        $this->elenco = array_values($this->elenco);
    }

    public function buscarSocio($index)
    {
        $cedula = trim($this->elenco[$index]['cedula']);
        if (empty($cedula)) return;

        $this->elenco[$index]['buscando'] = true;
        $user = User::where('identificacion', $cedula)->first();

        if ($user) {
            $this->elenco[$index]['nombre'] = strtoupper($user->name);
            $this->elenco[$index]['user_id'] = $user->id;
            $this->elenco[$index]['encontrado'] = true;

            // Lógica para buscar foto del socio encontrado
            $archivos = Storage::disk('public')->files('socios');
            $foto = collect($archivos)->first(fn($path) => str_contains(basename($path), (string)$user->identificacion));
            $this->elenco[$index]['foto_url'] = $foto ? asset('storage/' . $foto) : null;

            // Iniciales del socio encontrado
            $p = explode(' ', trim($user->name));
            $this->elenco[$index]['iniciales'] = strtoupper(substr($p[0] ?? 'U', 0, 1) . (isset($p[1]) ? substr($p[1], 0, 1) : ''));
        } else {
            $this->elenco[$index]['nombre'] = 'NO ENCONTRADO';
            $this->elenco[$index]['encontrado'] = false;
            $this->elenco[$index]['foto_url'] = null;
            $this->elenco[$index]['iniciales'] = '?';
        }
        $this->elenco[$index]['buscando'] = false;
    }

    public function guardar()
    {
        $this->validate([
            'guionFinal' => 'required|mimes:pdf|max:20480',
            'radicadoGuion' => 'required|mimes:pdf|max:10240',
            'propuestaCreativa' => 'required|mimes:pdf|max:20480',
            'presupuesto' => 'required|mimes:xlsx,xls|max:10240',
            'cronograma' => 'required|mimes:xlsx,xls|max:10240',
            'elenco.*.archivo_autorizacion' => 'required|mimes:pdf|max:5120',
        ]);

        try {
            DB::beginTransaction();

            $this->upload($this->proyecto, $this->guionFinal, 7, 'GUION_FINAL');
            $this->upload($this->proyecto, $this->radicadoGuion, 8, 'DNDA_RADICADO');
            $this->upload($this->proyecto, $this->propuestaCreativa, 9, 'PROPUESTA_CREATIVA');
            $this->upload($this->proyecto, $this->presupuesto, 10, 'PRESUPUESTO');
            $this->upload($this->proyecto, $this->cronograma, 11, 'CRONOGRAMA');

            foreach ($this->elenco as $miembro) {
                if ($miembro['encontrado'] && $miembro['archivo_autorizacion']) {
                    $path = $miembro['archivo_autorizacion']->store('elenco/' . now()->year, 'public');
                    // IMPORTANTE: Asegúrate que la relación en el modelo Proyecto se llame 'elenco'
                    $this->proyecto->elenco()->attach($miembro['user_id'], [
                        'archivo_autorizacion_path' => $path,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }

            $this->proyecto->update(['estado_id' => 5, 'etapa_id' => 2]);

            DB::commit();
            return redirect()->route('dashboard')->with('success', 'Inscripción completada.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Error Etapa 2: " . $e->getMessage());
            $this->addError('error', 'Error: ' . $e->getMessage());
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

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa2');
    }

    // En InscripcionEtapa2.php

    public function limpiarDocumento($propiedad, $index = null)
    {
        if ($index !== null && $propiedad === 'elenco') {
            // Lógica para el array de elenco
            if (isset($this->elenco[$index]['archivo_autorizacion'])) {
                $this->elenco[$index]['archivo_autorizacion'] = null;
            }
            // Limpiamos la validación específica del índice
            $this->resetValidation("elenco.$index.archivo_autorizacion");
        } else {
            // Lógica igual a la Etapa 1 para variables simples
            // (guionFinal, presupuesto, cronograma, etc.)
            $this->$propiedad = null;
            $this->resetValidation($propiedad);
        }
    }
}
