<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\Socio;
use App\Models\Documento;
use App\Models\TipoDocumento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Livewire\Attributes\Layout;

#[Layout('layouts.guest')]
class InscripcionEtapa2 extends Component
{
    use WithFileUploads;

    public Proyecto $proyecto;
    public $socio;

    // Variables para archivos técnicos
    public $guionFinal, $radicadoGuion, $propuestaCreativa, $presupuesto, $cronograma;

    // Variable para el elenco
    public $elenco = [];

    public function mount($proyectoId)
    {
        $this->proyecto = Proyecto::with(['socio', 'convocatoria'])
            ->where('id', $proyectoId)
            ->where('socio_id', session('socio_id'))
            ->firstOrFail();

        $this->socio = $this->proyecto->socio;
        $this->agregarMiembro();
    }

    private function verificarInhabilidadesSocio(Socio $socio)
    {
        if ($socio->fecha_nacimiento && Carbon::parse($socio->fecha_nacimiento)->diffInYears(now()) < 18) {
            return "Inhabilidad: El participante debe ser mayor de edad.";
        }

        if ($socio->estado !== 'activo') {
            $mensajes = [
                'moroso' => "Inhabilidad por mora en obligaciones administrativas.",
                'sancionado' => "Inhabilidad por sanción ética vigente.",
                'bloqueado_cargo' => "Inhabilidad: Miembros de administración no participan.",
                'retirado' => "El socio se encuentra en estado de retiro.",
            ];
            return $mensajes[$socio->estado] ?? "Estado ($socio->estado) no permitido.";
        }
        return "OK";
    }

    public function buscarSocio($index)
    {
        if (!isset($this->elenco[$index])) return;
        $cedula = trim($this->elenco[$index]['cedula']);
        if (empty($cedula)) return;

        $this->elenco[$index]['buscando'] = true;
        $this->elenco[$index]['encontrado'] = false;
        $this->elenco[$index]['nombre'] = '';

        foreach ($this->elenco as $idx => $m) {
            if ($idx !== $index && $m['cedula'] === $cedula) {
                $this->elenco[$index]['nombre'] = 'ESTE SOCIO YA ESTÁ EN TU LISTA';
                $this->elenco[$index]['buscando'] = false;
                return;
            }
        }

        $socioEncontrado = Socio::where('identificacion', $cedula)->first();

        if ($socioEncontrado) {
            $yaEstaEnOtro = DB::table('proyecto_socio')
                ->join('proyectos', 'proyectos.id', '=', 'proyecto_socio.proyecto_id')
                ->where('proyecto_socio.socio_id', $socioEncontrado->id)
                ->where('proyectos.convocatoria_id', $this->proyecto->convocatoria_id)
                ->where('proyectos.id', '!=', $this->proyecto->id)
                ->exists();

            if ($yaEstaEnOtro) {
                $this->elenco[$index]['nombre'] = 'YA REGISTRADO EN OTRO PROYECTO';
            } else {
                $resultado = $this->verificarInhabilidadesSocio($socioEncontrado);
                if ($resultado !== "OK") {
                    $this->elenco[$index]['nombre'] = mb_strtoupper($resultado);
                } else {
                    $this->elenco[$index]['nombre'] = $socioEncontrado->nombre;
                    $this->elenco[$index]['socio_id'] = $socioEncontrado->id;
                    $this->elenco[$index]['encontrado'] = true;
                    $this->elenco[$index]['foto_url'] = $this->obtenerUrlFoto($cedula);
                    
                    $parts = explode(' ', mb_strtoupper($socioEncontrado->nombre));
                    $this->elenco[$index]['iniciales'] = (count($parts) >= 2) 
                        ? mb_substr($parts[0], 0, 1) . mb_substr($parts[1], 0, 1) 
                        : mb_substr($parts[0], 0, 1);
                }
            }
        } else {
            $this->elenco[$index]['nombre'] = 'SOCIO NO ENCONTRADO';
        }

        $this->elenco[$index]['buscando'] = false;
    }

    public function guardar()
    {
        try {
            $this->validate([
                'elenco.*.cedula' => 'required',
                'elenco.*.archivo_autorizacion_path' => 'required',
                'guionFinal' => 'required|mimes:pdf|max:20480',
                'radicadoGuion' => 'required|mimes:pdf|max:10240',
                'propuestaCreativa' => 'required|mimes:pdf|max:30720',
                'presupuesto' => 'required|mimes:xlsx,xls|max:10240',
                'cronograma' => 'required|mimes:xlsx,xls|max:10240',
            ]);

            DB::transaction(function () {
                // 1. Guardar Elenco
                $this->proyecto->socios()->detach();
                foreach ($this->elenco as $miembro) {
                    if ($miembro['encontrado'] && $miembro['archivo_autorizacion_path']) {
                        $path = (is_object($miembro['archivo_autorizacion_path'])) 
                            ? $miembro['archivo_autorizacion_path']->store("proyectos/{$this->proyecto->id}/elenco", 'public')
                            : $miembro['archivo_autorizacion_path'];

                        $this->proyecto->socios()->attach($miembro['socio_id'], [
                            'archivo_autorizacion_path' => $path,
                        ]);
                    }
                }

                // 2. Guardar Documentos Técnicos
                $mapeo = [
                    'Guion' => $this->guionFinal,
                    'Radicado guion DNDA' => $this->radicadoGuion,
                    'Propuesta creativa' => $this->propuestaCreativa,
                    'Presupuesto' => $this->presupuesto,
                    'Cronograma' => $this->cronograma,
                ];

                foreach ($mapeo as $nombreTipo => $archivo) {
                    $tipo = TipoDocumento::where('nombre', 'LIKE', "%{$nombreTipo}%")
                        ->where('etapa_id', 2)
                        ->first();

                    if ($tipo && $archivo) {
                        Documento::create([
                            'proyecto_id' => $this->proyecto->id,
                            'tipo_documento_id' => $tipo->id,
                            'ruta_archivo' => $archivo->store("proyectos/{$this->proyecto->id}/etapa2", 'public'),
                            'estado' => 'pendiente',
                            'version' => 1,
                            'fecha_carga' => now(),
                        ]);
                    }
                }

                // 3. Actualizar estado del proyecto
                $this->proyecto->update([
                    'estado_id' => Proyecto::REVISION_E2,
                    'etapa_id' => 2,
                    'publicado' => false
                ]);
            });

            // REDIRECCIÓN A LA RAÍZ CON MENSAJE
            return redirect('/')->with('message', '¡Inscripción completada! Tu proyecto ha sido enviado a revisión técnica.');

        } catch (\Illuminate\Validation\ValidationException $e) {
            throw $e; 
        } catch (\Exception $e) {
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }

    public function agregarMiembro()
    {
        $this->elenco[] = [
            'cedula' => '', 'nombre' => '', 'socio_id' => null, 
            'archivo_autorizacion_path' => null, 'encontrado' => false, 
            'foto_url' => null, 'iniciales' => '', 'buscando' => false
        ];
    }

    public function removerMiembro($index)
    {
        if (count($this->elenco) > 1) {
            unset($this->elenco[$index]);
            $this->elenco = array_values($this->elenco);
        }
    }

    public function agregarProponenteComoMiembro()
    {
        foreach ($this->elenco as $miembro) {
            if ($miembro['cedula'] == $this->socio->identificacion) return;
        }
        if (count($this->elenco) == 1 && empty($this->elenco[0]['cedula'])) {
            $index = 0;
        } else {
            $this->agregarMiembro();
            $index = count($this->elenco) - 1;
        }
        $this->elenco[$index]['cedula'] = $this->socio->identificacion;
        $this->buscarSocio($index);
    }

    private function obtenerUrlFoto($cedula)
    {
        $directory = 'socios/';
        $files = Storage::disk('public')->files($directory);
        $foto = collect($files)->first(fn($p) => str_starts_with(basename($p), $cedula . '.'));
        return $foto ? asset('storage/' . $foto) . '?v=' . time() : null;
    }

    public function render()
    {
        return view('livewire.sitio.inscripcion-etapa2');
    }
}