<?php

namespace App\Http\Controllers\Web\Venta;

use App\Http\Controllers\Controller;
use App\Http\Traits\VentaHelperTrait;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;

class ResumenPedidoController extends Controller
{
    use VentaHelperTrait;

    public function index(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $idventa = session()->get('idventa');

        $venta = Venta::query()->find($idventa);

        $ventaDetalle = VentaDetalle::query()
            ->with(['producto'])
            ->where('idventa',$idventa)
            ->get();

        return view('web.venta.resumenPedido.index')->with(compact('venta','ventaDetalle'))->render();
    }



}
