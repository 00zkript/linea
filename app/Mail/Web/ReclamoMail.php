<?php

namespace App\Mail\Web;

use App\Models\LibroReclamacion;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReclamoMail extends Mailable
{
    use Queueable, SerializesModels;

    private $idlibro_reclamacion;

    public function __construct($idlibro_reclamacion)
    {
        $this->idlibro_reclamacion = $idlibro_reclamacion;
    }


    public function build()
    {
        $reclamo = LibroReclamacion::query()
            ->find($this->idlibro_reclamacion);

        return $this
            ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
            ->to($reclamo->correo)
//            ->bcc(env('MAIL_TO_ADDRESS'))
//            ->to(env('MAIL_TO_ADDRESS'))
            ->subject("RECLAMO")
            ->view('mail.web.libroReclamacion.index')
            ->with(compact('reclamo'));
    }
}
