<?php

namespace App\Mail\Web;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class RecuperarClaveMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $idusuario;

    public function __construct($idusuario)
    {
        $this->idusuario = $idusuario;
    }


    public function build()
    {
        $usuario = User::query()->find($this->idusuario);

        return $this
            ->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
            ->to($usuario->correo)
            ->subject('RECUPERAR CONTRASEÑA')
            ->view('mail.web.recuperarClave.index')
            ->with(compact('usuario'));
    }
}
