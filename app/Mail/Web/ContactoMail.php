<?php

namespace App\Mail\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactoMail extends Mailable
{
    use Queueable, SerializesModels;

    private $datos;

    public function __construct($datos)
    {
        $this->datos = $datos;
    }


    public function build()
    {
        $contacto = (Object) $this->datos;

        return $this
            ->from($contacto->correo)
            ->to(env('MAIL_TO_ADDRESS'))
            ->subject("CONTACTO")
            ->view('mail.web.contacto.index')
            ->with(compact('contacto'));
    }
}
