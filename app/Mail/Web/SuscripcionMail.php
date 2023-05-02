<?php

namespace App\Mail\Web;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuscripcionMail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;

    public function __construct($email)
    {
        $this->email = $email;
    }


    public function build()
    {
        $email = $this->email ;


        return $this
            ->from($email)
            ->to(env('MAIL_TO_ADDRESS'))
            ->subject('Deseo suscribirme')
            ->view('mail.web.suscripcion.index')->with(compact('email'));
    }
}
