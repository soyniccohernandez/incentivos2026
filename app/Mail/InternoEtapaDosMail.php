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
class InternoEtapaDosMail extends Mailable
{
    use Queueable, SerializesModels;

    public $proyecto;

    /**
     * Recibimos el proyecto.
     */
    public function __construct(Proyecto $proyecto)
    {
        $this->proyecto = $proyecto;
        
        // Cargamos las relaciones; al ser síncrono, esto se pasa directo a la vista
        $this->proyecto->loadMissing(['documentos', 'elenco', 'user']); 
    }

    /**
     * Configuramos el sobre del correo.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'AUDITORÍA ETAPA 2: ' . $this->proyecto->codigo_radicado . ' - [' . mb_strtoupper($this->proyecto->titulo) . ']',
            replyTo: [
                new Address('incentivos@actores.org.co', 'Incentivos Actores S.C.G.'),
            ],
            bcc: [
                new Address('sistemas@actores.org.co', 'Área de tecnología'),
            ],
        );
    }

    /**
     * Define la vista.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.InternoEtapaDosMail',
        );
    }

    /**
     * Sin adjuntos físicos para evitar saturación.
     */
    public function attachments(): array
    {
        return [];
    }
}