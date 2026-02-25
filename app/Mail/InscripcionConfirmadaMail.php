<?php

namespace App\Mail;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue; // Para enviarlo en segundo plano
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InscripcionConfirmadaMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $proyecto;
    public $socio;

    /**
     * Recibimos el proyecto y el socio
     */
    public function __construct(Proyecto $proyecto, User $socio)
    {
        $this->proyecto = $proyecto;
        $this->socio = $socio;
    }

    /**
     * Definimos el asunto
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de Inscripción - Radicado: ' . $this->proyecto->codigo_radicado,
        );
    }

    /**
     * Definimos la vista
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.inscripcion-confirmada', // Asegúrate de crear esta vista
        );
    }

    public function attachments(): array
    {
        return [];
    }
}