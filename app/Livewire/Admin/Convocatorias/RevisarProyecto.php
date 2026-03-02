<?php

namespace App\Livewire\Admin\Convocatorias;

use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Documento;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Storage;

#[Layout('layouts.app')]
class RevisarProyecto extends Component
{
    use WithFileUploads;

    public Proyecto $proyecto;
    public $comentarioCierre;
    public $nuevoEstadoId;
    public $archivoSustituto = [];
    public $foto_url = null;
    public $iniciales = 'U';


    public function mount(Proyecto $proyecto)
    {
        // Corregido: 'users' cambiado por 'elenco'
        $this->proyecto = $proyecto->load([
            'etapa',
            'estado',
            'director',
            'user',
            'elenco', // Relación correcta según tu modelo
            'documentos.tipoDocumento',
        ]);

        // En el mount() de tu componente de revisión:
        $this->foto_url = null;
        $this->iniciales = 'U';

        if ($proyecto->user) {
            // Generar Iniciales
            $parts = explode(' ', trim($proyecto->user->name));
            $this->iniciales = strtoupper(substr($parts[0] ?? 'U', 0, 1) . (isset($parts[1]) ? substr($parts[1], 0, 1) : ''));

            // Buscar Foto por Identificación
            if ($proyecto->user->identificacion) {
                $archivos = Storage::disk('public')->files('socios');
                $fotoEncontrada = collect($archivos)->first(fn($path) => str_contains(basename($path), (string)$proyecto->user->identificacion));

                if ($fotoEncontrada) {
                    $this->foto_url = asset('storage/' . $fotoEncontrada);
                }
            }
        }

        $this->comentarioCierre = $this->proyecto->observacion_general;
        $this->nuevoEstadoId = $this->proyecto->estado_id;
    }

    public function subirCorreccionAdmin($tipoDocumentoId)
    {
        $this->validate([
            'archivoSustituto.' . $tipoDocumentoId => 'required|mimes:pdf|max:15360',
        ]);

        // Buscamos el documento actual
        $documentoAnterior = Documento::where('proyecto_id', $this->proyecto->id)
            ->where('tipo_documento_id', $tipoDocumentoId)
            ->orderBy('version', 'desc')
            ->first();

        $nuevaVersionNumero = $documentoAnterior ? ($documentoAnterior->version + 1) : 1;

        // Guardar archivo 
        $ruta = $this->archivoSustituto[$tipoDocumentoId]->store('proyectos/correcciones_admin', 'public');

        // Marcamos anteriores como corregidos
        Documento::where('proyecto_id', $this->proyecto->id)
            ->where('tipo_documento_id', $tipoDocumentoId)
            ->update(['estado' => 'corregido']);

        // Crear nueva versión aprobada 
        Documento::create([
            'proyecto_id' => $this->proyecto->id,
            'tipo_documento_id' => $tipoDocumentoId,
            'ruta_archivo' => $ruta,
            'estado' => 'aprobado',
            'version' => $nuevaVersionNumero,
            'fecha_carga' => now(),
        ]);

        unset($this->archivoSustituto[$tipoDocumentoId]);

        // Refrescamos relaciones
        $this->proyecto->load('documentos.tipoDocumento');
        session()->flash('message', 'Documento actualizado a la versión ' . $nuevaVersionNumero);
    }

    public function updatedArchivoSustituto($value, $tipoDocumentoId)
    {
        $this->subirCorreccionAdmin($tipoDocumentoId);
    }

    public function guardarBorrador()
    {
        $this->validate([
            'comentarioCierre' => 'required|min:10',
            'nuevoEstadoId' => 'required|exists:estados,id'
        ]);

        $this->proyecto->update([
            'estado_id' => $this->nuevoEstadoId,
            'observacion_general' => $this->comentarioCierre,
        ]);

        session()->flash('message', 'Borrador guardado correctamente.');
    }

    public function finalizarRevisionManual()
    {
        $this->validate([
            'comentarioCierre' => 'required|min:10',
            'nuevoEstadoId' => 'required|exists:estados,id'
        ]);

        $this->proyecto->update([
            'estado_id' => $this->nuevoEstadoId,
            'observacion_general' => $this->comentarioCierre,
            'publicado' => false // Si finalizas la revisión, normalmente querrás que el socio vea el resultado
        ]);

        return redirect()->route('convocatoria.gestionar', $this->proyecto->convocatoria_id)
            ->with('message', 'Revisión técnica finalizada.');
    }

    public function render()
    {
        // Agrupamos documentos por etapa para la vista
        $documentosPorEtapa = $this->proyecto->documentos
            ->groupBy(fn($doc) => $doc->tipoDocumento->etapa_id)
            ->sortKeys();

        return view('livewire.admin.convocatorias.revisar-proyecto', [
            'documentosPorEtapa' => $documentosPorEtapa,
            'estados' => Estado::all()
        ]);
    }
}
