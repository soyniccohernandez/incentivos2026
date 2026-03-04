<?php

namespace App\Mail;

use App\Models\Proyecto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionInternaEtapa2 extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $proyecto;

    /**
     * Recibimos el proyecto y cargamos relaciones clave para auditoría.
     */
    public function __construct(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto->load(['documentos', 'elenco', 'socio']);
    }

    /**
     * El asunto incluye el título de la obra para rápida identificación.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'AUDITORÍA ETAPA 2: ' . $this->proyecto->codigo_radicado . ' - [' . mb_strtoupper($this->proyecto->titulo) . ']',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.interno-etapa2',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}