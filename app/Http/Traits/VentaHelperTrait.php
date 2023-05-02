<?php


namespace App\Http\Traits;

use App\Models\Promocion;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

trait VentaHelperTrait
{

    private function createVenta()
    {
        $cart = Cart::instance("productos");

        list($idcostoEnvio, $costoEnvio, $departamento, $provincia, $distrito) = $this->validateShippingMethod();
        $idcupon = session()->has('cupon') ? session()->get('cupon')->idcupon : null ;
        $descuento = $this->getDescuento();


        $totalNeto = ($cart->total() - $descuento) + $costoEnvio;


        $venta = new Venta();
        $venta->idestado_envio = 1;
        $venta->idestado_control_venta = 1;
        $venta->idcosto_envio = $idcostoEnvio ;
        $venta->iddepartamento = $departamento ;
        $venta->idprovincia = $provincia ;
        $venta->iddistrito = $distrito ;
        $venta->idcupon = $idcupon;
        $venta->total = $cart->total();
        $venta->precio_envio = $costoEnvio;
        $venta->descuento = $descuento;
        $venta->total_final = $totalNeto;
        $venta->pago_idestado_pago = 2;
        $venta->estado = 0 ;
        $venta->save();


        $this->moveCartToDetailSales($cart,$venta->idventa);


        session()->put('idventa',$venta->idventa);

    }

    private function updateVenta()
    {
        $cart = Cart::instance("productos");
        $idventa = session()->get('idventa');

        list($idcostoEnvio, $costoEnvio, $departamento, $provincia, $distrito) = $this->validateShippingMethod();
        $idcupon = session()->has('cupon') ? session()->get('cupon')->idcupon : null ;
        $descuento = $this->getDescuento();

        $totalNeto = ($cart->total() - $descuento) + $costoEnvio;


        $venta = Venta::query()->find($idventa);
        $venta->idestado_envio = 1;
        $venta->idcosto_envio = $idcostoEnvio ;
        $venta->iddepartamento = $departamento ;
        $venta->idprovincia = $provincia ;
        $venta->iddistrito = $distrito ;
        $venta->idcupon = $idcupon;
        $venta->total = $cart->total();
        $venta->precio_envio = $costoEnvio;
        $venta->descuento = $descuento;
        $venta->total_final = $totalNeto;
//        $venta->fecha_venta = now()->format('Y-m-d H:i:s');
        $venta->update();


        VentaDetalle::query()->where('idventa',$idventa)->delete();
        $this->moveCartToDetailSales($cart,$idventa);


        session()->put('idventa',$venta->idventa);

    }

    public function getDescuento()
    {
        $cart = Cart::instance("productos");
        $descuento = 0;

        if ( session()->has('cupon') ) {


            if (session()->get('cupon')->tipoDescuento == "monto") {
                $descuento = session()->get('cupon')->descuentoMonto;
            }

            if (session()->get('cupon')->tipoDescuento == "porcentaje") {
                $descuento = $cart->total() * (session()->get('cupon')->descuentoPorcentaje / 100);
            }

            return $descuento;
        }



        // $produtsQty = array_reduce(array_first((array)$cart->content()),function ($acumulador,$current){
        //     return $acumulador += $current->qty;
        // },0);

        // if($produtsQty <= 1) {
        //     return $descuento;
        // }

        // $promocion  = Promocion::query()->where('cantidad',$produtsQty)->where('estado',1)->first();
        // $total = $cart->total();
        // $promocionPrecio = $promocion->precio ?? 0;

        // $descuento = $total > $promocionPrecio ? $total - $promocionPrecio : 0;

        return $descuento;
    }


    private function calcularTotal(): string
    {
        $cart = Cart::instance("productos");
        $descuento = $this->getDescuento();
        $costoEnvio = 0;


        if (session()->has('envio.costoSeleccionado')) {
            $costoEnvio = session()->get('envio.costoSeleccionado')->precio;
        }


        $totalNeto = ($cart->total() - $descuento) + $costoEnvio;

        return number_format($totalNeto, 2, ".", "");
    }

    /**
     * Función que mueve el contenido del carrito a la tabla venta_detalle
     * @param $cart
     * @param $idventa
     * @return void
     */
    private function moveCartToDetailSales($cart,$idventa)
    {
        foreach ($cart->content() as $item)
        {
            $detalle = new VentaDetalle();
            $detalle->idventa            = $idventa;
            $detalle->idproducto         = $item->id;
            $detalle->precio_producto    = $item->price;
            $detalle->cantidad           = $item->qty;
            $detalle->subtotal           = $item->subtotal();
            $detalle->idtalla            = $item->options->talla->idtalla;
            $detalle->talla_nombre       = $item->options->talla->nombre;
            $detalle->talla_equivalencia = $item->options->talla->equivalencia;
            $detalle->estado             = 1;
            $detalle->save();
        }
    }

    /**
     * Función que retornara datos del envia en session en caso de que exista
     * @return array
     */
    private function validateShippingMethod(): array
    {
        $idcostoEnvio = null;
        $costoEnvio = 0;
        $departamento = null;
        $provincia = null;
        $distrito = null;
        if (session()->has('envio.costoSeleccionado')) {
            $idcostoEnvio = session()->get('envio.costoSeleccionado')->idcosto_envio;
            $costoEnvio = session()->get('envio.costoSeleccionado')->precio;
            $departamento = session()->get('envio.iddepartamento');
            $provincia = session()->get('envio.idprovincia');
            $distrito = session()->get('envio.iddistrito');
        }
        return array($idcostoEnvio, $costoEnvio, $departamento, $provincia, $distrito);
    }



}
