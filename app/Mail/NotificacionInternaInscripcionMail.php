<?php

namespace App\Mail;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionInternaInscripcionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $proyecto;
    public $socio;
    public $config; // Recibe ['autoria' => '...', 'directorPropio' => '...']

    /**
     * @param Proyecto $proyecto
     * @param User $socio
     * @param array $config
     */
    public function __construct(Proyecto $proyecto, User $socio, array $config)
    {
        $this->proyecto = $proyecto;
        $this->socio = $socio;
        $this->config = $config;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'NUEVA INSCRIPCIÓN: ' . $this->proyecto->codigo_radicado . ' - [' . mb_strtoupper($this->proyecto->titulo) . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.notificacion-interna-proyecto',
            with: [
                'director' => $this->proyecto->director,
                'documentos' => $this->proyecto->documentos,
                'config' => $this->config,
            ],
        );
    }

    /**
     * Adjunta archivos dinámicamente según la lógica del negocio
     */
    public function attachments(): array
    {
        $attachments = [];

        // Cargamos los documentos desde la relación del proyecto
        // Esto es más seguro para ShouldQueue porque recarga la data de la DB
        foreach ($this->proyecto->documentos as $doc) {
            
            // LÓGICA DINÁMICA: 
            // Si el documento es el Guion (ID 1) pero el usuario marcó autoria 'si', 
            // lo ignoramos (aunque el controlador ya previene que se suba, esto es doble seguridad).
            if ($doc->tipo_documento_id == 1 && $this->config['autoria'] === 'si') {
                continue;
            }

            $path = storage_path('app/public/' . $doc->ruta_archivo);

            if (file_exists($path)) {
                // Asignamos un nombre más legible según el tipo de documento
                $nombreLimpio = $this->obtenerNombreDocumento($doc->tipo_documento_id) . '_' . $this->proyecto->codigo_radicado . '.pdf';

                $attachments[] = Attachment::fromPath($path)
                    ->as($nombreLimpio)
                    ->withMime('application/pdf');
            }
        }

        return $attachments;
    }

    /**
     * Helper para que los adjuntos en el correo del staff tengan nombres claros
     */
    private function obtenerNombreDocumento($tipo_id)
    {
        return match($tipo_id) {
            1 => 'AUTORIZACION_GUION',
            2 => 'COMPROMISO_DIRECTOR',
            3 => 'EXPERIENCIA_DIRECTOR',
            4 => 'EVIDENCIA_1',
            5 => 'EVIDENCIA_2',
            6 => 'DECLARACIONES_JURADAS',
            default => 'ANEXO_ADJUNTO',
        };
    }
}