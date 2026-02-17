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
        $this->proyecto = $proyecto->load([
            'etapa',
            'estado',
            'documentos.tipoDocumento',
            'documentos.observaciones'
        ]);
        $this->comentarioCierre = $this->proyecto->observacion_general;
        $this->sincronizarObservaciones();

        if (empty($this->comentarioCierre)) {
            $this->generarResumenAutomatico();
        }
    }

    public function sincronizarObservaciones()
    {
        foreach ($this->proyecto->documentos->groupBy('tipo_documento_id') as $grupo) {
            $ultimoDoc = $grupo->sortByDesc('version')->first();
            $obs = $ultimoDoc->observaciones
                ->where('etapa_id', $this->proyecto->etapa_id)
                ->first();
            $this->observacionesDocs[$ultimoDoc->id] = $obs ? $obs->mensaje : ($this->observacionesDocs[$ultimoDoc->id] ?? '');
        }
    }

    public function generarResumenAutomatico()
    {
        $fallos = [];
        $conteoAprobados = 0;
        $conteoPendientes = 0;

        // Obtenemos los documentos base
        $documentos = $this->proyecto->documentos;

        foreach ($documentos as $doc) {
            // 1. Filtro de Guion Propio
            $nombreSlug = \Illuminate\Support\Str::slug($doc->tipoDocumento->nombre);
            $esTipoGuion = str_contains($nombreSlug, 'guion') || str_contains($nombreSlug, 'autorizacion');
            if ($this->proyecto->guion_propio && $esTipoGuion) continue;

            // 2. Solo la última versión
            $esUltimo = $documentos->where('tipo_documento_id', $doc->tipo_documento_id)->max('id') == $doc->id;

            if ($esUltimo) {
                // 3. Verificación de ESTADO REAL
                if (empty($doc->estado)) {
                    $conteoPendientes++;
                } else {
                    if ($doc->estado === 'aprobado') {
                        $conteoAprobados++;
                    } elseif (in_array($doc->estado, ['subsanar', 'rechazado'])) {
                        $msg = $this->observacionesDocs[$doc->id] ?? '';
                        $prefijo = ($doc->estado === 'subsanar') ? '[SUBSANAR]' : '[NO VÁLIDO]';
                        $fallos[] = "• $prefijo " . strtoupper($doc->tipoDocumento->nombre) . ": " . ($msg ?: 'Sin observación registrada.');
                    }
                }
            }
        }

        // --- LÓGICA DE SALIDA RADICAL ---

        // Si hay documentos pendientes por calificar, EL RESUMEN ES VACÍO.
        if ($conteoPendientes > 0) {
            $this->comentarioCierre = "";
            return;
        }

        // Si no hay pendientes, pero tampoco hay aprobados ni fallos (caso expediente vacío)
        if ($conteoAprobados === 0 && empty($fallos)) {
            $this->comentarioCierre = "";
            return;
        }

        // Solo si TODO está calificado (0 pendientes), decidimos qué mensaje mostrar
        if (empty($fallos)) {
            $this->comentarioCierre = "EL PROYECTO CUMPLE CON TODOS LOS REQUISITOS TÉCNICOS Y AVANZA A LA SIGUIENTE ETAPA DE EVALUACIÓN.";
        } else {
            $header = "SE HAN ENCONTRADO HALLAZGOS QUE REQUIEREN ATENCIÓN:\n\n";
            $this->comentarioCierre = $header . implode("\n", $fallos);
        }
    }

    public function cambiarEstadoDocumento($documentoId, $nuevoEstado)
    {
        $doc = Documento::findOrFail($documentoId);
        $doc->update(['estado' => $nuevoEstado]);

        if ($nuevoEstado === 'aprobado') {
            $doc->observaciones()->where('etapa_id', $this->proyecto->etapa_id)->delete();
            $this->observacionesDocs[$documentoId] = '';
        }

        $this->proyecto->refresh();
        $this->generarResumenAutomatico();
    }

    public function prepararEdicion($documentoId)
    {
        $obs = Observacion::where('documento_id', $documentoId)
            ->where('etapa_id', $this->proyecto->etapa_id)
            ->first();

        if ($obs) {
            $this->observacionesDocs[$documentoId] = $obs->mensaje;
            $obs->delete();
        }

        $this->proyecto->refresh();
        $this->generarResumenAutomatico();
    }

    public function guardarAvanceDocumento($documentoId)
    {
        $this->resetErrorBag('observacionesDocs.' . $documentoId);

        if (empty($this->observacionesDocs[$documentoId])) {
            $this->addError('observacionesDocs.' . $documentoId, 'Es obligatorio detallar el hallazgo.');
            return;
        }

        $doc = Documento::findOrFail($documentoId);
        Observacion::updateOrCreate(
            ['documento_id' => $documentoId, 'etapa_id' => $this->proyecto->etapa_id],
            [
                'proyecto_id' => $this->proyecto->id,
                'usuario_revisor_id' => Auth::id(),
                'mensaje' => $this->observacionesDocs[$documentoId],
                'archivo_error_path' => $doc->ruta_archivo,
                'visible_para_proponente' => false
            ]
        );

        $this->proyecto->refresh();
        $this->generarResumenAutomatico();
    }

    public function finalizarRevision()
    {
        $this->validate(['comentarioCierre' => 'required|min:10']);

        try {
            DB::transaction(function () {
                // 1. Hacer visibles las observaciones para el socio
                Observacion::where('proyecto_id', $this->proyecto->id)
                    ->where('etapa_id', $this->proyecto->etapa_id)
                    ->update(['visible_para_proponente' => true]);

                // 2. Obtener los estados de las versiones MÁS RECIENTES de cada documento
                $documentosRecientes = $this->proyecto->documentos()
                    ->whereIn('id', function ($query) {
                        $query->select(DB::raw('MAX(id)'))
                            ->from('documentos')
                            ->where('proyecto_id', $this->proyecto->id)
                            ->groupBy('tipo_documento_id');
                    })->pluck('estado')->toArray();

                // --- LÓGICA DE ESTADOS SEGÚN TU SEEDER ---

                if (in_array('rechazado', $documentosRecientes)) {
                    // Si hay alguno rechazado tajantemente -> No continúa
                    $nuevoId = 8;
                } elseif (in_array('subsanar', $documentosRecientes)) {
                    // Si hay alguno para corregir -> En Subsanación
                    $nuevoId = 2;
                } else {
                    // Si TODO está aprobado:
                    if ($this->proyecto->etapa_id == 1) {
                        // Pasa de Etapa 1 a "En Etapa 2"
                        $nuevoId = 4;
                    } else {
                        // Si ya estaba en Etapa 2, pasa a "Etapa 3 - Revisión Jurados"
                        $nuevoId = 6;
                    }
                }

                // 3. Actualizar el proyecto
                $this->proyecto->update([
                    'estado_id' => $nuevoId,
                    'observacion_general' => $this->comentarioCierre,
                    'publicado' => false // Se mantiene oculto hasta que el administrador decida publicar
                ]);
            });

            return redirect()->route('convocatoria.gestionar', $this->proyecto->convocatoria_id)
                ->with('message', 'Revisión finalizada correctamente.');
        } catch (\Exception $e) {
            $this->addError('comentarioCierre', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.admin.convocatorias.revisar-proyecto', [
            'documentosAgrupados' => $this->proyecto->documentos->groupBy('tipo_documento_id')
        ]);
    }
}
