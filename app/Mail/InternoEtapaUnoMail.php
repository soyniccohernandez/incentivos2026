<?php

namespace App\Mail;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Bus\Queueable;
// COMENTA O ELIMINA ESTA LÍNEA:
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

// ELIMINA EL "implements ShouldQueue" AQUÍ ABAJO:
class InternoEtapaUnoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $proyecto;
    public $socio;
    public $config;
    public $director;

    /**
     * @param Proyecto $proyecto
     * @param User $socio
     * @param array $config
     * @param mixed $director
     */
    public function __construct(Proyecto $proyecto, User $socio, array $config, $director = null)
    {
        // Al ser síncrono, ya no hay riesgo de pérdida por serialización de cola,
        // pero mantenemos la carga de relaciones por seguridad.
        $this->proyecto = $proyecto->relationLoaded('documentos') ? $proyecto : $proyecto->load('documentos');
        $this->socio = $socio;
        $this->config = $config;

        if ($director) {
            $this->director = is_array($director) ? (object)$director : $director;
        } else {
            $this->director = $proyecto->director ?: $proyecto->director()->first();
        }
    }

    /**
     * Define el asunto, dirección de respuesta y copia oculta.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Nueva postulación ' . $this->proyecto->codigo_radicado . ' ' . mb_strtoupper($this->proyecto->titulo),
            replyTo: [
                new Address('incentivos@actores.org.co', 'Incentivos Actores S.C.G.'),
            ],
            bcc: [
                new Address('sistemas@actores.org.co', 'Área de tecnología'),
            ],
        );
    }

    /**
     * Define la vista del correo.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.InternoEtapaUnoMail',
        );
    }

    /**
     * Adjunta los archivos del expediente automáticamente.
     */
    public function attachments(): array
    {
        $attachments = [];
        $documentos = $this->proyecto->documentos;

        foreach ($documentos as $doc) {
            if (!($doc->tipo_documento_id == 3 && ($this->config['autoria'] ?? '') === 'si')) {
                if (Storage::disk('public')->exists($doc->ruta_archivo)) {
                    $nombreParaAdjunto = basename($doc->ruta_archivo);

                    $attachments[] = Attachment::fromStorageDisk('public', $doc->ruta_archivo)
                        ->as($nombreParaAdjunto);
                }
            }
        }

        return $attachments;
    }
}