<?php

namespace App\Mail;

use App\Models\Solicitud;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SolicitudAceptada extends Mailable
{
    use Queueable, SerializesModels;

    public $solicitud;

    /**
     * Create a new message instance.
     */
    public function __construct(Solicitud $solicitud)
    {
        $this->solicitud = $solicitud;
    }


    public function build()
    {
        return $this->view('emails.solicitud_aceptada')
            ->subject('Tu solicitud de adopción ha sido aceptada');
    }


    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.solicitud_aceptada',
            with: [
                'solicitud' => $this->solicitud,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     */
    public function attachments(): array
    {
        return [];
    }
}
