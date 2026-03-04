<?php

namespace App\Mail;

use App\Models\Proyecto;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NotificacionInternaInscripcionMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $proyecto;
    public $socio;
    public $config;
    public $director; // <-- Agregamos esta propiedad

    public function __construct(Proyecto $proyecto, User $socio, array $config, $director = null)
    {
        // Cargamos la relación de documentos para evitar consultas extra en la vista
        $this->proyecto = $proyecto->relationLoaded('documentos') ? $proyecto : $proyecto->load('documentos');
        $this->socio = $socio;
        $this->config = $config;
        $this->director = $director; // <-- Asignamos el director
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
        );
    }

    public function attachments(): array
    {
        return [];
    }
}