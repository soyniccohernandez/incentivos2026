<?php

namespace App\Livewire\Admin;

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
    public $proyecto;
    public $observacionesDocs = [];
    public $comentarioCierre;

    public function mount(Proyecto $proyecto)
    {
        // Carga relacional optimizada
        $this->proyecto = $proyecto->load(['socio', 'documentos.tipoDocumento', 'estado', 'etapa']);
        $this->comentarioCierre = $this->proyecto->observacion_general;

        // Inicializar observaciones de documentos
        foreach ($this->proyecto->documentos as $doc) {
            $ultimaObs = Observacion::where('documento_id', $doc->id)->latest()->first();
            $this->observacionesDocs[$doc->id] = $ultimaObs ? $ultimaObs->mensaje : '';
        }
    }

    /**
     * Cambia el estado de un documento de forma atómica.
     * Blindado con DB::transaction para evitar datos huérfanos.
     */
    public function cambiarEstadoDocumento($documentoId, $nuevoEstado)
    {
        $doc = Documento::findOrFail($documentoId);

        // 1. Si intenta pasar de APROBADO a algo negativo, 
        // y el campo de texto está vacío, lanzamos el error para que se muestre el textarea
        if ($nuevoEstado !== 'aprobado' && empty(trim($this->observacionesDocs[$documentoId] ?? ''))) {
            $this->addError('obs.' . $documentoId, 'Para cambiar a este estado, primero debe escribir un motivo.');

            // Forzamos el cambio de estado visual del documento para que el Blade muestre el textarea
            // pero NO lo guardamos en DB todavía (por eso no usamos update)
            $doc->estado = $nuevoEstado;
            return;
        }

        try {
            DB::transaction(function () use ($doc, $nuevoEstado, $documentoId) {
                // Actualizamos en la base de datos
                $doc->update(['estado' => $nuevoEstado]);

                if ($nuevoEstado === 'aprobado') {
                    Observacion::where('documento_id', $documentoId)->delete();
                    $this->observacionesDocs[$documentoId] = '';
                } else {
                    Observacion::updateOrCreate(
                        ['proyecto_id' => $this->proyecto->id, 'documento_id' => $documentoId],
                        [
                            'etapa_id' => $this->proyecto->etapa_id,
                            'usuario_revisor_id' => Auth::id(),
                            'mensaje' => trim($this->observacionesDocs[$documentoId]),
                            'visible_para_proponente' => true
                        ]
                    );
                }
                $this->recalcularEstadoProyecto();
            });

            $this->resetErrorBag('obs.' . $documentoId);
            $this->proyecto->refresh();
        } catch (\Exception $e) {
            $this->addError('obs.' . $documentoId, 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Define la lógica de estados basada en la jerarquía de los documentos.
     */
    public function recalcularEstadoProyecto()
    {
        // Pluck directamente de la base de datos para evitar caché de la colección
        $estadosDocs = $this->proyecto->documentos()->pluck('estado')->toArray();

        // Jerarquía de estados (IDs según tu volcado SQL)
        if (in_array('rechazado', $estadosDocs)) {
            $nuevoId = 8; // Estado: Eliminado
        } elseif (in_array('subsanar', $estadosDocs)) {
            $nuevoId = 3; // Estado: Subsanación etapa 1
        } elseif (in_array('pendiente', $estadosDocs) || empty($estadosDocs)) {
            $nuevoId = 2; // Estado: En revisión etapa 1
        } else {
            // Todos los documentos están aprobados
            $nuevoId = 4; // Estado: En etapa 2 (Aprobado fase 1)
        }

        $this->proyecto->update(['estado_id' => $nuevoId]);
    }

    /**
     * Finaliza la auditoría guardando el comentario general.
     */
    public function finalizarRevision()
    {
        $this->validate([
            'comentarioCierre' => 'required|min:5'
        ], [
            'comentarioCierre.required' => 'La conclusión final es obligatoria para cerrar la auditoría.',
            'comentarioCierre.min' => 'La conclusión debe ser más descriptiva (mín. 5 caracteres).'
        ]);

        $this->proyecto->update([
            'observacion_general' => $this->comentarioCierre
        ]);

        session()->flash('message', 'Auditoría guardada correctamente.');

        return redirect()->route('convocatoria.gestionar', $this->proyecto->convocatoria_id);
    }

    public function render()
    {
        return view('livewire.admin.revisar-proyecto');
    }
}
