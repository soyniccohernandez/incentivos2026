<?php

namespace App\Mail;

use App\Models\Proyecto;
use Illuminate\Bus\Queueable;
// COMENTA O ELIMINA ESTA LÍNEA:
// use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

// ELIMINA EL "implements ShouldQueue":
class ConfirmacionEtapaDosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $proyecto;

    /**
     * Recibimos el proyecto completo.
     */
    public function __construct(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto;
        
        // Al ser síncrono, cargamos la relación directamente para la vista.
        // Asegúrate de que la relación en el modelo Proyecto sea 'user' o 'socio' según tu BD.
        $this->proyecto->loadMissing(['user']); 
    }

    /**
     * Definimos el sobre con replyTo y bcc para control técnico.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'ETAPA TÉCNICA COMPLETADA: ' . $this->proyecto->codigo_radicado . ' - ' . mb_strtoupper($this->proyecto->titulo),
            
            replyTo: [
                new Address('incentivos@actores.org.co', 'Incentivos Actores S.C.G.'),
            ],

            bcc: [
                new Address('nhernandez@actores.org.co', 'Erick Hernández'),
            ],
        );
    }

    /**
     * Apuntamos a la vista.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.ConfirmacionEtapaDosMail',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}