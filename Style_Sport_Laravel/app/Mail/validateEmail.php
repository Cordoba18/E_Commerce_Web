<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class validateEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $cod;
    public $nombre;
    /**
     * Create a new message instance.
     */
    public function __construct($cod, $nombre)
    {
        $this->cod = $cod;
        $this->nombre=$nombre;
    }

    /**
     * Get the message envelope.
     */
    /**
     * Get the message content definition.
     */
    public function build()
    {
        $cod = $this->cod;
        $nombre = $this->nombre;
        return $this->subject('CREACION DE CUENTA')
                    ->view('mails.sendValidationEmail', compact('cod', 'nombre'));
    }
    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
