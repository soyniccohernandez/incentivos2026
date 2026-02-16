<?php

namespace App\Livewire\Admin\Convocatorias;

use App\Models\Proyecto;
use App\Models\Documento;
use App\Models\Observacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('layouts.app')]
class RevisarProyecto extends Component
{
    public Proyecto $proyecto;
    public $observacionesDocs = [];
    public $comentarioCierre;

    public function mount(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto->load(['socio', 'documentos.tipoDocumento', 'estado', 'etapa']);
        $this->comentarioCierre = $this->proyecto->observacion_general;

        foreach ($this->proyecto->documentos as $doc) {
            // Buscamos la observación actual de esta revisión (etapa actual)
            $ultimaObs = Observacion::where('documento_id', $doc->id)
                ->where('etapa_id', $this->proyecto->etapa_id)
                ->latest()
                ->first();
            
            $this->observacionesDocs[$doc->id] = $ultimaObs ? $ultimaObs->mensaje : '';
        }
    }

    public function cambiarEstadoDocumento($documentoId, $nuevoEstado)
    {
        $doc = Documento::findOrFail($documentoId);
        $mensaje = trim($this->observacionesDocs[$documentoId] ?? '');

        // Validación: Si no es aprobado, DEBE tener observación
        if ($nuevoEstado !== 'aprobado' && empty($mensaje)) {
            $this->addError('obs.' . $documentoId, 'Para cambiar a este estado, primero debe escribir un motivo.');
            return;
        }

        try {
            DB::transaction(function () use ($doc, $nuevoEstado, $documentoId, $mensaje) {
                // 1. Actualizamos el estado del documento
                $doc->update(['estado' => $nuevoEstado]);

                if ($nuevoEstado === 'aprobado') {
                    // Si aprueba, eliminamos observaciones de esta etapa para limpiar
                    Observacion::where('documento_id', $documentoId)
                        ->where('etapa_id', $this->proyecto->etapa_id)
                        ->delete();
                    $this->observacionesDocs[$documentoId] = '';
                } else {
                    // 2. Creamos/Actualizamos observación (Invisible para el socio aún)
                    Observacion::updateOrCreate(
                        [
                            'proyecto_id' => $this->proyecto->id, 
                            'documento_id' => $documentoId,
                            'etapa_id' => $this->proyecto->etapa_id
                        ],
                        [
                            'usuario_revisor_id' => Auth::id(),
                            'mensaje' => $mensaje,
                            'archivo_error_path' => $doc->ruta_archivo,
                            'visible_para_proponente' => false // Se activa al finalizar
                        ]
                    );
                }
            });

            $this->resetErrorBag('obs.' . $documentoId);
            $this->proyecto->refresh();
        } catch (\Exception $e) {
            $this->addError('obs.' . $documentoId, 'Error al guardar: ' . $e->getMessage());
        }
    }

    public function finalizarRevision()
    {
        $this->validate([
            'comentarioCierre' => 'required|min:5'
        ]);

        try {
            DB::transaction(function () {
                $estadosDocs = $this->proyecto->documentos()->pluck('estado')->toArray();

                // 1. Lógica de estados del Proyecto
                if (in_array('rechazado', $estadosDocs)) {
                    $nuevoId = 8; // No cumple / Rechazado
                } elseif (in_array('subsanar', $estadosDocs)) {
                    $nuevoId = 3; // En Subsanación
                } elseif (in_array('pendiente', $estadosDocs)) {
                    $nuevoId = 2; // Pendiente (si el auditor olvidó marcar alguno)
                } else {
                    $nuevoId = ($this->proyecto->etapa_id == 1) ? 4 : 6;
                }

                // 2. Hacer visibles todas las observaciones de esta revisión
                Observacion::where('proyecto_id', $this->proyecto->id)
                    ->where('etapa_id', $this->proyecto->etapa_id)
                    ->update(['visible_para_proponente' => true]);

                // 3. Actualizar proyecto
                $this->proyecto->update([
                    'estado_id' => $nuevoId,
                    'observacion_general' => $this->comentarioCierre,
                    'publicado' => false // Sigue requiriendo la acción de "Publicar" en el índice
                ]);
            });

            session()->flash('message', 'Auditoría guardada. Ahora puede publicar los resultados.');
            return redirect()->route('convocatoria.gestionar', $this->proyecto->convocatoria_id);

        } catch (\Exception $e) {
            $this->addError('comentarioCierre', 'Error crítico: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.convocatorias.revisar-proyecto');
    }
}