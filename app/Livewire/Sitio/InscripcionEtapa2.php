<?php

namespace App\Livewire\Sitio;

use App\Models\Proyecto;
use App\Models\Socio;
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
    public $guionFinal, $radicadoGuion, $propuestaCreativa, $presupuesto, $cronograma;
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
        // 1. Validación de Edad
        if ($socio->fecha_nacimiento && Carbon::parse($socio->fecha_nacimiento)->diffInYears(now()) < 18) {
            return "Inhabilidad: El participante debe ser mayor de edad.";
        }

        // 2. Validación de Estado Administrativo
        if ($socio->estado !== 'activo') {
            $mensajes = [
                'moroso' => "Inhabilidad por mora en obligaciones administrativas/financieras.",
                'sancionado' => "Inhabilidad por sanción ética o disciplinaria vigente.",
                'bloqueado_cargo' => "Inhabilidad: Miembros de órganos de administración no pueden participar.",
                'retirado' => "El socio se encuentra en estado de retiro.",
            ];
            return $mensajes[$socio->estado] ?? "Su estado actual ($socio->estado) no le permite participar.";
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

        // 1. Verificar si ya está en la lista actual de este formulario (Duplicado local)
        foreach($this->elenco as $idx => $m) {
            if ($idx !== $index && $m['cedula'] === $cedula) {
                $this->elenco[$index]['nombre'] = 'ESTE SOCIO YA ESTÁ EN TU LISTA';
                $this->elenco[$index]['buscando'] = false;
                return;
            }
        }

        // 2. Regla de exclusividad en otros proyectos (Base de Datos)
        $esProponenteOtro = Proyecto::where('socio_id', function($query) use ($cedula) {
            $query->select('id')->from('socios')->where('identificacion', $cedula);
        })->where('convocatoria_id', $this->proyecto->convocatoria_id)->where('id', '!=', $this->proyecto->id)->exists();

        $yaEsElencoOtro = DB::table('proyecto_socio')
            ->join('proyectos', 'proyectos.id', '=', 'proyecto_socio.proyecto_id')
            ->where('proyecto_socio.socio_id', function($query) use ($cedula) {
                $query->select('id')->from('socios')->where('identificacion', $cedula);
            })->where('proyectos.convocatoria_id', $this->proyecto->convocatoria_id)->where('proyectos.id', '!=', $this->proyecto->id)->exists();

        if ($esProponenteOtro || $yaEsElencoOtro) {
            $this->elenco[$index]['nombre'] = 'YA REGISTRADO EN OTRO PROYECTO DE ESTA CONVOCATORIA';
            $this->elenco[$index]['buscando'] = false;
            return;
        }

        $socioEncontrado = Socio::where('identificacion', $cedula)->first();

        if ($socioEncontrado) {
            // 3. Verificar Inhabilidades (Edad, Estado, etc)
            $resultadoInhabilidad = $this->verificarInhabilidadesSocio($socioEncontrado);
            if ($resultadoInhabilidad !== "OK") {
                $this->elenco[$index]['nombre'] = mb_strtoupper($resultadoInhabilidad);
                $this->elenco[$index]['buscando'] = false;
                return;
            }

            $this->elenco[$index]['nombre'] = $socioEncontrado->nombre;
            $this->elenco[$index]['socio_id'] = $socioEncontrado->id;
            $this->elenco[$index]['encontrado'] = true;
            $parts = explode(' ', mb_strtoupper($socioEncontrado->nombre));
            $this->elenco[$index]['iniciales'] = (count($parts) >= 2) ? mb_substr($parts[0], 0, 1) . mb_substr($parts[1], 0, 1) : mb_substr($parts[0], 0, 1);
            $this->elenco[$index]['foto_url'] = $this->obtenerUrlFoto($cedula);
        } else {
            $this->elenco[$index]['nombre'] = 'SOCIO NO ENCONTRADO EN BASE DE DATOS';
        }
        $this->elenco[$index]['buscando'] = false;
    }

    // (Resto de funciones: mount, agregarMiembro, removerMiembro, guardar, subirDocumento... se mantienen igual)
    public function agregarMiembro() { $this->elenco[] = ['cedula' => '', 'nombre' => '', 'socio_id' => null, 'archivo' => null, 'encontrado' => false, 'foto_url' => null, 'iniciales' => '', 'buscando' => false]; }
    public function removerMiembro($index) { unset($this->elenco[$index]); $this->elenco = array_values($this->elenco); }
    private function obtenerUrlFoto($cedula) { $directory = 'socios/'; $files = Storage::disk('public')->files($directory); $foto = collect($files)->first(fn($p) => str_starts_with(basename($p), $cedula . '.')); return $foto ? asset('storage/' . $foto) . '?v=' . time() : null; }
    public function agregarProponenteComoMiembro() { foreach ($this->elenco as $miembro) { if ($miembro['cedula'] == $this->socio->identificacion) return; } if (count($this->elenco) == 1 && empty($this->elenco[0]['cedula'])) { $index = 0; } else { $this->agregarMiembro(); $index = count($this->elenco) - 1; } $this->elenco[$index]['cedula'] = $this->socio->identificacion; $this->buscarSocio($index); }
    
    public function render() { return view('livewire.sitio.inscripcion-etapa2'); }
}