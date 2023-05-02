<?php

namespace App\Mail\Panel;

use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class EstadoEnvioMail extends Mailable
{
    use Queueable, SerializesModels;

    private $idventa;

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
        $venta = Venta::query()
            ->with(['estadoEnvio','moneda'])
            ->find($this->idventa);

        $ventaDetalle = VentaDetalle::query()
            ->with(['producto'])
            ->where('idventa', $venta->idventa)
            ->get();


        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
            ->to($venta->correo)
            ->bcc(env('MAIL_TO_ADDRESS'))
            ->subject('ESTADO DE PEDIDO - ' . $venta->estadoEnvio->nombre)
            ->view('mail.panel.estadoEnvio.index')->with(compact('venta', 'ventaDetalle'));

    }
}
