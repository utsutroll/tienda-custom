<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendContactForm extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $email;
    public string $textSubject;
    public string $mensaje;

    public function __construct(string $name, string $email, string $subject, string $mensaje)
    {
        $this->name = $name;
        $this->email = $email;
        $this->textSubject = $subject;
        $this->mensaje = $mensaje;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
        ->subject("Contacto - " . config("app.name"))
        ->markdown('emails.contact');
    }
}
