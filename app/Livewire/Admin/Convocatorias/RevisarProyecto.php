<?php

namespace App\Livewire\Admin\Convocatorias;

use App\Models\Proyecto;
use App\Models\Estado;
use App\Models\Documento;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class RevisarProyecto extends Component
{
    use WithFileUploads;

    public Proyecto $proyecto;
    public $comentarioCierre;
    public $nuevoEstadoId;
    public $archivoSustituto = [];

    public function mount(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto->load([
            'etapa',
            'estado',
            'director',
            'user',
            'users',
            'documentos.tipoDocumento',
        ]);

        $this->comentarioCierre = $this->proyecto->observacion_general;
        $this->nuevoEstadoId = $this->proyecto->estado_id;
    }

    public function subirCorreccionAdmin($tipoDocumentoId)
    {
        $this->validate([
            'archivoSustituto.' . $tipoDocumentoId => 'required|mimes:pdf|max:15360',
        ]);

        // Buscamos el documento actual (el de mayor versión)
        $documentoAnterior = Documento::where('proyecto_id', $this->proyecto->id)
            ->where('tipo_documento_id', $tipoDocumentoId)
            ->orderBy('version', 'desc')
            ->first();

        $nuevaVersionNumero = $documentoAnterior ? ($documentoAnterior->version + 1) : 1;

        // Guardar archivo
        $ruta = $this->archivoSustituto[$tipoDocumentoId]->store('proyectos/correcciones_admin', 'public');

        // IMPORTANTE: Marcamos TODOS los anteriores como corregidos para que no se dupliquen en la vista
        Documento::where('proyecto_id', $this->proyecto->id)
            ->where('tipo_documento_id', $tipoDocumentoId)
            ->update(['estado' => 'corregido']);

        // Crear la nueva versión aprobada
        Documento::create([
            'proyecto_id' => $this->proyecto->id,
            'tipo_documento_id' => $tipoDocumentoId,
            'ruta_archivo' => $ruta,
            'estado' => 'aprobado',
            'version' => $nuevaVersionNumero,
            'fecha_carga' => now(),
        ]);

        // Limpiar el input y refrescar la relación
        unset($this->archivoSustituto[$tipoDocumentoId]);

        // Forzamos la recarga completa de documentos para el render
        $this->proyecto->load('documentos.tipoDocumento');

        session()->flash('message', 'Documento actualizado a la versión ' . $nuevaVersionNumero);
    }

    public function updatedArchivoSustituto($value, $tipoDocumentoId)
    {
        // Esto se ejecuta apenas el archivo termina de subir al temporal
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
            'publicado' => false // Asumo que al finalizar quieres que sea visible
        ]);

        return redirect()->route('convocatoria.gestionar', $this->proyecto->convocatoria_id)
            ->with('message', 'Revisión técnica finalizada y publicada.');
    }

    public function render()
    {
        // Solo tomamos los documentos que NO están marcados como "corregidos" 
        // o agrupamos y tomamos solo el de mayor versión por tipo.
        $documentosPorEtapa = $this->proyecto->documentos
            ->groupBy(fn($doc) => $doc->tipoDocumento->etapa_id)
            ->sortKeys();

        return view('livewire.admin.convocatorias.revisar-proyecto', [
            'documentosPorEtapa' => $documentosPorEtapa,
            'estados' => Estado::all()
        ]);
    }
}
