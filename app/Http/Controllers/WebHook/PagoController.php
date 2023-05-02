<?php

namespace App\Http\Controllers\WebHook;

use App\Http\Controllers\Controller;
use App\Mail\Web\OrdenDeVentaMail;
use App\Mail\Web\ReservaMedidaVistaMail;
use App\Mail\Web\VentaConfirmacionMail;
use App\Models\Comprobante;
use App\Models\Producto;
use App\Models\ReservaMedidaVista;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Payment;
use MercadoPago\SDK;

class PagoController extends Controller
{
    public function verificarPago(Request $request)
    {
        try {

            if (empty($request->input('data'))){
                return false;
            }

            $payment_id = $request->input('data.id');

            SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
            $pago = Payment::find_by_id($payment_id);

            if (empty($payment_id) || empty($pago)){
                return false;
            }



            $idventa = $pago->external_reference;

            $venta = Venta::query()->find($idventa);

            if ($pago->payment_method_id == 'pagoefectivo_atm' && $venta->estado != 1) {
                $venta->pago_idmetodo_pago = 4;
                $venta->pago_cip = $pago->transaction_details->payment_method_reference_id;
                $venta->pago_expira_cip = now()->parse($pago->date_of_expiration)->format("Y-m-d H:i:s");

                $ventaDetalle = VentaDetalle::query()->where('idventa',$venta->idventa)->get();

                foreach($ventaDetalle as $vd){
                    $producto = Producto::query()->find($vd->idproducto);
                    $producto->stock = $producto->stock - $vd->cantidad;
                    $producto->update();
                }

                try {
                    Mail::send(new VentaConfirmacionMail($venta->idventa));
                }catch (\Throwable $th){

                }
            }

            if ($pago->status == 'pending' ){
                $venta->pago_idestado_pago = 2;
                $venta->estado = 1;
            }

            if ($pago->status == 'approved' && $venta->pago_idestado_pago != 1) {
                $venta->pago_idestado_pago = 1;
                $venta->fecha_pago = now()->format("Y-m-d H:i:s");
                $venta->estado = 1;
            }

            if (!$venta->facturacion_nro_comprobante){
                $comprobante  = Comprobante::query()->find($venta->facturacion_idcomprobante);
                $venta->facturacion_nro_comprobante = $comprobante->nro_correlativo .'-'. str_pad($comprobante->nro_serie,6,0,STR_PAD_LEFT);
                $comprobante->nro_serie  = $comprobante->nro_serie +1 ;
                $comprobante->update();

            }

            $venta->update();

        }catch (\Throwable $e){
            return  false;
        }


    }





}
