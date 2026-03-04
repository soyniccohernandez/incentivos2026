<?php

namespace App\Mail;

use App\Models\Proyecto;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionUsuarioEtapa2 extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $proyecto;

    /**
     * Recibimos el proyecto completo.
     */
    public function __construct(Proyecto $proyecto)
    {
        // Cargamos la relación del socio para tener su nombre en la vista
        $this->proyecto = $proyecto->relationLoaded('socio') ? $proyecto : $proyecto->load('socio');
    }

    /**
     * Definimos el asunto con el Radicado para que el usuario lo identifique fácil.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ETAPA TÉCNICA COMPLETADA: ' . $this->proyecto->codigo_radicado . ' - ' . mb_strtoupper($this->proyecto->titulo),
        );
    }

    /**
     * Apuntamos a la vista que crearemos a continuación.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.usuario-etapa2',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}