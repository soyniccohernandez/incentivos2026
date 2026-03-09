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
use Illuminate\Queue\SerializesModels;

// ELIMINA EL "implements ShouldQueue" AQUÍ ABAJO:
class ConfirmacionEtapaUnoMail extends Mailable 
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
            subject: 'Inscripción Exitosa: ' . $this->proyecto->codigo_radicado . ' - Incentivos Audiovisuales (Actores S.C.G.)',
            replyTo: [
                new \Illuminate\Mail\Mailables\Address('incentivos@actores.org.co', 'Incentivos Actores S.C.G.'),
            ],
            bcc: [
                new \Illuminate\Mail\Mailables\Address('sistemas@actores.org.co', 'Área de tecnología'),
            ],
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.ConfirmacionEtapaUnoMail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}