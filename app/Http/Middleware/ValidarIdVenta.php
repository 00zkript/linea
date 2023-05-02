<?php

namespace App\Http\Middleware;

use App\Http\Traits\VentaHelperTrait;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Closure;
use Gloudemans\Shoppingcart\Facades\Cart;

class ValidarIdVenta
{
    use VentaHelperTrait;
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if (!session()->has('idventa')){
            $this->createVenta();
        }

        $venta = Venta::query()->find(session()->get('idventa'));

        if (!$venta || $venta->estado == 1 || $venta->idestado_pago == 1){
            $this->createVenta();
        }

        return $next($request);
    }





}
