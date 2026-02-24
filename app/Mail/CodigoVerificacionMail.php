<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CodigoVerificacionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $codigo;
    public $user;

    /**
     * Recibimos el código y el usuario desde el componente
     */
    public function __construct($codigo, $user)
    {
        $this->codigo = $codigo;
        $this->user = $user; // IMPORTANTE: Sin esta línea, la vista no verá al usuario
    }

    /**
     * Asunto del correo
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Tu Código de Acceso - Convocatoria 2026',
        );
    }

    /**
     * Vista del correo
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.codigo-verificacion',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}