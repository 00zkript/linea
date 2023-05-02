<?php

namespace App\Mail\Web;

use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class VentaConfirmacionMail extends Mailable
{
    use Queueable, SerializesModels;

    private $idventa;

    public function __construct($idventa)
    {
        $this->idventa = $idventa;
    }

    public function build()
    {

        $venta = Venta::query()
            ->with(['moneda'])
            ->find($this->idventa);

        $ventaDetalle = VentaDetalle::query()
            ->with(['producto'])
            ->where('idventa',$this->idventa)
            ->get();


        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
            ->to($venta->correo)
            ->bcc(env('MAIL_BCC'))
//            ->to(env('MAIL_TO_ADDRESS'))
            ->subject('CONFIRMACIÓN DE COMPRA')
            ->view('mail.web.venta.confirmacion')->with(compact('venta','ventaDetalle'));
    }
}
