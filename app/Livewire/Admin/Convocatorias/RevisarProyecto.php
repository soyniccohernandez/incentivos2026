<?php

namespace App\Admin\Convocatorias;

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
            'director',
            'documentos.tipoDocumento',
            'documentos.observaciones',
            'socios' => function ($query) {
                $query->withPivot('archivo_autorizacion_path');
            }
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
            $ultimoDoc = $grupo->sortByDesc('id')->first();
            $obs = $ultimoDoc->observaciones
                ->where('etapa_id', $this->proyecto->etapa_id)
                ->first();
            $this->observacionesDocs[$ultimoDoc->id] = $obs ? $obs->mensaje : ($this->observacionesDocs[$ultimoDoc->id] ?? '');
        }
    }

    public function generarResumenAutomatico()
    {
        $fallos = [];
        $conteoPendientes = 0;
        $documentos = $this->proyecto->documentos;
        $documentosPorTipo = $documentos->groupBy('tipo_documento_id');

        foreach ($documentosPorTipo as $tipoId => $grupo) {
            $doc = $grupo->sortByDesc('id')->first();

            if ($doc->tipoDocumento->etapa_id != $this->proyecto->etapa_id) continue;

            $nombreSlug = \Illuminate\Support\Str::slug($doc->tipoDocumento->nombre);
            $esTipoGuion = str_contains($nombreSlug, 'guion') || str_contains($nombreSlug, 'autorizacion');

            if ($this->proyecto->etapa_id == 1 && $this->proyecto->guion_propio && $esTipoGuion) continue;

            if (empty($doc->estado)) {
                $conteoPendientes++;
            } elseif (in_array($doc->estado, ['subsanar', 'rechazado'])) {
                $msg = $this->observacionesDocs[$doc->id] ?? '';
                $prefijo = ($doc->estado === 'subsanar') ? '[SUBSANAR]' : '[NO VÁLIDO]';
                $fallos[] = "• $prefijo " . strtoupper($doc->tipoDocumento->nombre) . ": " . ($msg ?: 'Sin observación.');
            }
        }

        if ($conteoPendientes > 0) {
            $this->comentarioCierre = "";
            return;
        }

        if (empty($fallos)) {
            $this->comentarioCierre = "EL PROYECTO CUMPLE CON TODOS LOS REQUISITOS DE LA " . strtoupper($this->proyecto->etapa->nombre) . " Y AVANZA EN EL PROCESO.";
        } else {
            $header = "SE HAN ENCONTRADO HALLAZGOS EN LA " . strtoupper($this->proyecto->etapa->nombre) . ":\n\n";
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

    public function guardarAvanceDocumento($documentoId)
    {
        if (empty($this->observacionesDocs[$documentoId])) {
            $this->addError('observacionesDocs.' . $documentoId, 'Es obligatorio agregar una justificación.');
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

        // Filtrar documentos de la etapa actual
        $documentosEtapa = $this->proyecto->documentos->filter(function ($doc) {
            return $doc->tipoDocumento->etapa_id == $this->proyecto->etapa_id;
        });

        foreach ($documentosEtapa as $doc) {
            $nombreSlug = \Illuminate\Support\Str::slug($doc->tipoDocumento->nombre);
            $esTipoGuion = str_contains($nombreSlug, 'guion') || str_contains($nombreSlug, 'autorizacion');
            if ($this->proyecto->etapa_id == 1 && $this->proyecto->guion_propio && $esTipoGuion) continue;

            if (empty($doc->estado)) {
                $this->addError('comentarioCierre', "Falta calificar: " . $doc->tipoDocumento->nombre);
                return;
            }
        }

        try {
            DB::transaction(function () use ($documentosEtapa) {
                $estados = $documentosEtapa->pluck('estado')->toArray();

                if (in_array('rechazado', $estados)) {
                    // El proyecto muere definitivamente
                    $nuevoEstadoId = 8; // "No continúa / Eliminado"
                } elseif (in_array('subsanar', $estados)) {
                    // Se le devuelve al socio para que corrija (Estado 2)
                    // Asegúrate que Proyecto::SUBSANACION_E1 sea igual a 2
                    $nuevoEstadoId = 2;
                } else {
                    // Si todo está aprobado...
                    if ($this->proyecto->etapa_id == 1) {
                        $nuevoEstadoId = 4; // "En Etapa 2" (Formulario Técnico)
                        $this->proyecto->etapa_id = 2;
                    } else {
                        $nuevoEstadoId = 5; // "Etapa 2 - En Revisión" o el que siga en tu flujo
                    }
                }

                $this->proyecto->update([
                    'estado_id' => $nuevoEstadoId,
                    'etapa_id' => $this->proyecto->etapa_id,
                    'observacion_general' => $this->comentarioCierre,
                    'publicado' => false
                ]);
            });

            return redirect()->route('convocatoria.gestionar', $this->proyecto->convocatoria_id)
                ->with('message', 'Veredicto guardado exitosamente.');
        } catch (\Exception $e) {
            $this->addError('comentarioCierre', 'Error: ' . $e->getMessage());
        }
    }

    public function render()
    {
        // CARGA FORZADA EN RENDER: Esto evita que el pivot se pierda en la rehidratación de Livewire
        $this->proyecto->load(['socios' => function ($query) {
            $query->withPivot('archivo_autorizacion_path');
        }]);

        return view('livewire.admin.convocatorias.revisar-proyecto', [
            'documentosAgrupados' => $this->proyecto->documentos->groupBy('tipo_documento_id'),
            'elencoActual' => $this->proyecto->socios
        ]);
    }
}
