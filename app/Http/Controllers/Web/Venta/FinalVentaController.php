<?php

namespace App\Http\Controllers\Web\Venta;

use App\Http\Controllers\Controller;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use MercadoPago\Payment;
use MercadoPago\SDK;

class FinalVentaController extends Controller
{

    public function index(Request $request)
    {
        if (!session()->has('idventa_flush')){
            return redirect('/');
        }

        $idventa = session()->get('idventa_flush');
        $venta = Venta::query()
            ->with(["costoEnvio",'moneda','puntoVenta'])
            ->find($idventa);

        $ventaDetalle = VentaDetalle::query()
            ->with(['producto'])
            ->where('idventa',$idventa)
            ->get();

        $pago = null;
        if ($venta->idmetodo_pago == 5){
            SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
            $pago = Payment::find_by_id($venta->pago_mercadopago_id);
        }


//        session()->forget('idventa_flsuh');

        return view("web.venta.final.index")->with(compact('venta','ventaDetalle','pago'));

    }

}
