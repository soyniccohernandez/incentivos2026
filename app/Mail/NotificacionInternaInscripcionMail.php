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

    public function __construct(Proyecto $proyecto, User $socio)
    {
        $this->proyecto = $proyecto;
        $this->socio = $socio;
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
                'documentos' => $this->proyecto->documentos
            ],
        );
    }

    public function attachments(): array
    {
        $attachments = [];
        foreach ($this->proyecto->documentos as $doc) {
            $path = storage_path('app/public/' . $doc->ruta_archivo);
            if (file_exists($path)) {
                $attachments[] = Attachment::fromPath($path)
                    ->as(basename($doc->ruta_archivo))
                    ->withMime('application/pdf');
            }
        }
        return $attachments;
    }
}