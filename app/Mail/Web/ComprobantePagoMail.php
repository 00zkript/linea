<?php

namespace App\Mail\Web;

use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ComprobantePagoMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $idventa;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($idventa)
    {
        $this->idventa = $idventa;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $idventa = $this->idventa;

        $venta = Venta::query()->find($idventa);



        return $this
            ->from($venta->correo)
            ->to(env('MAIL_TO_ADDRESS'))
            ->subject("Actualizo su comprobante pago")
            ->view('mail.web.comprobantePago.index')
            ->with(compact('venta'));
    }
}
