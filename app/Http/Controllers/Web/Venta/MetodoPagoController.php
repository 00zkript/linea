<?php

namespace App\Http\Controllers\Web\Venta;

use App\Http\Controllers\Controller;
use App\Mail\Web\VentaConfirmacionMail;
use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\Cupon;
use App\Models\Empresa;
use App\Models\Moneda;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Payer;
use MercadoPago\Payment;
use MercadoPago\SDK;

class MetodoPagoController extends Controller
{

    public function index()
    {
        $idventa = session()->get('idventa');
        $venta        = Venta::query()->find($idventa);

        if (!$venta->idcliente){
            return redirect()->route('web.venta.usuario.index');
        }

        if (!$venta->idmetodo_entrega){
            return redirect()->route('web.venta.entrega.index');
        }

        $empresaGeneral = Empresa::query()->first();
        $monedaGeneral = Moneda::query()->find($empresaGeneral->idmoneda);
        venta::query()->where('idventa', $idventa)->update([
            'idmoneda' => $monedaGeneral->idmoneda,
            'precio_cambio' => $monedaGeneral->cambio
        ]);

        $soles = Moneda::query()->find(2);
        $total_final = number_format((float) $venta->total_final * $soles->cambio,2,".","");

        return view("web.venta.metodoPago.index")->with(compact('venta','total_final'));
    }


    public function verificarPedido(Request $request)
    {

        if (!$request->ajax()){
            return abort(404);
        }


        $idventa = session()->get('idventa');
        $diaActual = now()->format('Y-m-d');

        $ventaDetalle = VentaDetalle::query()->with(['producto'])->where('idventa', $idventa)->get();

        $venta = Venta::query()->with(["moneda"])->find($idventa);



        $errores = [];
        foreach ($ventaDetalle as $item) {

            if($item->producto->stock <= 0 || $item->cantidad <= 0 || $item->cantidad > $item->producto->stock){
                array_push($errores,'la cantidad unidades para el producto '.$item->producto->nombre." excede el stock.");
            }

        }


        if (count($errores) > 0){
            return response()->json([
                "codigp" => "F0001",
                "error" => $errores
            ],400);
        }




        if ($venta->idcupon){

            $cupon = Cupon::query()
                ->where('cantidad', '>=', 1)
                ->where('estado', 1)
                ->whereDate('fechaInicio', '<=', $diaActual)
                ->whereDate('fechaExpiracion', '>=', $diaActual)
                ->find($venta->idcupon);

            if (!$cupon){

                $this->validarQuitarCuponVenta();

                return response()->json([
                    "codigp" => "F0002",
                    "error" => 'Este cupón no esta disponible'
                ],400);

            }


            if ($venta->total_final < $cupon->montoMinimo) {
                $this->validarQuitarCuponVenta();

                return response()->json([
                    "codigp" => "F0002",
                    "error" => 'El monto minimo para este cupón es: '.$venta->moneda->simbolo.' '.number_format($cupon->montoMinimo * $venta->precio_cambio,2,".","")
                ],400);
            }




        }



        return response()->json([
            "mensaje" => "Se valido correctamente el pedido."
        ]);

    }

    private function validarQuitarCuponVenta()
    {
        $idventa = session()->get('idventa');
        session()->forget('cupon');

        $venta = Venta::query()->find($idventa);
        $venta->idcupon = null;
        $venta->descuento = '0.00';
        $venta->total_final = $venta->total + (float) $venta->precio_envio ;
        $venta->update();

    }


    public function pagarConTarjeta(Request $request)
    {

        $idventa                       = session()->get('idventa');
        $monto                         = $request->input("amount");
        $metodoPagoId                  = $request->input("paymentMethodId");
        $tokenPago                     = $request->input("token");
        $bancoEmisorId                 = (int) $request->input("issuerId");
        $cuotas                        = (int) $request->input("installments");
        $documentoIdentificacionTipo   = $request->input("identificationType");
        $documentoIdentificacionNumber = $request->input("identificationNumber");
        $processingMode                = $request->input("processingMode");
        $merchantAccountId             = $request->input("merchantAccountId");
        $email                         = $request->input("cardholderEmail");
        $venta = Venta::query()->find($idventa);




        SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        $payer = new Payer();
        $payer->email = app()->isLocal() ? env('MERCADOPAGO_CORREO_TEST') : $email;


        $payer->identification = [
            "type" => $documentoIdentificacionTipo,
            "number" => $documentoIdentificacionNumber
        ];


        $payment = new Payment();
        $payment->transaction_amount = $monto;
        $payment->token = $tokenPago;
        $payment->installments = $cuotas;
        $payment->payment_method_id = $metodoPagoId;
        $payment->issuer_id = $bancoEmisorId;
        $payment->payer = $payer;
        $payment->statement_descriptor = env('MERCADOPAGO_NOMBRE_EMPRESA');
        $payment->external_reference = $idventa;
        $payment->save();



        if ($payment->status == "approved" && $payment->status_detail == "accredited"){
            $this->updateStockProductos($idventa);
            $comprobante = $this->createNroComprobate($venta->facturacion_idcomprobante);

            $venta->pago_mercadopago_id = $payment->id;
            $venta->pago_idmetodo_pago = 5;
            $venta->pago_idestado_pago = 1;
            $venta->pago_cuotas = $cuotas;
            $venta->pago_email = $email;
            $venta->fecha_venta = now()->format("Y-m-d H:i:s");;
            $venta->fecha_pago = now()->format("Y-m-d H:i:s");
            $venta->facturacion_nro_comprobante = $comprobante;
            $venta->estado = 1;
            $venta->update();

            try {
                Mail::send(new VentaConfirmacionMail($venta->idventa));
            }catch (\Throwable $th){

            }

            session()->put('idventa_flush',$venta->idventa);

            Cart::instance("productos")->destroy();
            session()->forget('cupon');
            session()->forget('envio');
            session()->forget('idventa');


            return response()->json(["mensaje" => "venta realizada con exito."]);

        }

        return response()->json([
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'error' => $payment->error,
            'mensaje' => "No pudimos procesar tu pago.",
        ],400);

    }

    public function pagarConEfectivo(Request $request)
    {

        $idventa = session()->get('idventa');
        $venta = Venta::query()->find($idventa);
        $cliente   = Cliente::query()->find($venta->cliente_idcliente);
        $soles = Moneda::query()->find(2);

        SDK::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));

        $payer = new Payer();
        $payer->email = app()->isLocal() ? env('MERCADOPAGO_CORREO_TEST') :  $cliente->correo;

        $payment = new Payment();
        $payment->transaction_amount = number_format($venta->total_final * $soles->cambio,2,".","");
        $payment->description = "Venta : ".str_pad($venta->idventa,7,0,STR_PAD_LEFT);
        $payment->payment_method_id = "pagoefectivo_atm";
        $payment->payer = $payer;
        $payment->statement_descriptor = env('MERCADOPAGO_NOMBRE_EMPRESA');
        $payment->external_reference = $idventa;
        $payment->save();



        if ($payment->error){

            return response()->json([
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'error' => $payment->error,
                'mensaje' => "No pudimos procesar tu pago.",
            ],400);

        }

        $this->updateStockProductos($idventa);
        $comprobante = $this->createNroComprobate($venta->facturacion_idcomprobante);

        $venta->pago_mercadopago_id = $payment->id;
        $venta->pago_idmetodo_pago = 4;
        $venta->pago_idestado_pago = 2;
        $venta->estado = 1;
        $venta->pago_cip = $payment->transaction_details->payment_method_reference_id;
        $venta->pago_expira_cip = now()->parse($payment->date_of_expiration)->format("Y-m-d H:i:s");
        $venta->facturacion_nro_comprobante = $comprobante;
        $venta->fecha_venta = now()->format("Y-m-d H:i:s");;
        $venta->update();

        try {
            Mail::send(new VentaConfirmacionMail($venta->idventa));
        }catch (\Throwable $th){

        }

        session()->put('idventa_flush',$venta->idventa);

        Cart::instance("productos")->destroy();
        session()->forget('cupon');
        session()->forget('envio');
        session()->forget('idventa');

        return response()->json(["mensaje" => "venta realizada con exito."]);




    }

    public function pagarConDepositoBancario(Request $request)
    {

        $idventa = session()->get('idventa');
        $venta = Venta::query()->find($idventa);


        // $this->updateStockProductos($idventa);
        $comprobante = $this->createNroComprobate($venta->facturacion_idcomprobante);
        $venta->pago_idmetodo_pago = 3;
        $venta->pago_idestado_pago = 2;
        $venta->estado = 1;
        $venta->facturacion_nro_comprobante = $comprobante;
        $venta->fecha_venta = now()->format("Y-m-d H:i:s");
        $venta->update();

        try {
            Mail::send(new VentaConfirmacionMail($venta->idventa));
        }catch (\Throwable $th){

        }

        session()->put('idventa_flush',$venta->idventa);

        Cart::instance("productos")->destroy();
        session()->forget('cupon');
        session()->forget('envio');
        session()->forget('idventa');

        return response()->json(["mensaje" => "venta realizada con exito."]);




    }


    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ///  Necesario para izipay
    /// TODO Agregar "lyracom/rest-php-sdk": "4.0.*", en composer.json si se usa la libreria de izipay
    private $izipay;
    private function configIzipay()
    {
        Lyra\Client::setDefaultUsername(env("IZIPAY_USERNAME"));
        Lyra\Client::setDefaultPassword(env("IZIPAY_PASSWORD"));
        Lyra\Client::setDefaultEndpoint(env("IZIPAY_ENDPOINT"));

        /* publicKey and used by the javascript client */
        Lyra\Client::setDefaultPublicKey(env("IZIPAY_PUBLIC_KEY"));

        /* SHA256 key */
        Lyra\Client::setDefaultSHA256Key(env("IZIPAY_SHA256_KEY"));

        $this->izipay = new Lyra\Client();
    }

    /**
     * Función que se encargara de crear el token de pago en izipay
     * NOTA: Como la cuenta es en soles se debe de convertir a soles con el tipo de cambio del modulo moneda
     */
    public function createToken()
    {

        $izipay = $this->izipay;
        $idventa = session()->get('idventa');
        $soles = Moneda::query()->find(2);
        $venta = Venta::query()->find($idventa);

        $total_final = number_format((float) $venta->total_final * $soles->cambio,2,".","");

        $store = array(
            "amount" => (int) ($total_final * 100),
            "currency" => $soles->moneda,
            "orderId" => uniqid('venta_'.$idventa.'_'),
        );

        $response = $izipay->post("V4/Charge/CreatePayment", $store);


        /* I check if there are some errors */
        if ($response['status'] != 'SUCCESS') {

            return response()->json([
                "mensaje" => "No se pudo crear el token",
                "error" => [
                    "web_service" => $response["webService"],
                    "code" => $response["answer"]["errorCode"],
                    "message" => $response["answer"]["errorMessage"],
                    "error_code_details" => $response["answer"]["detailedErrorCode"],
                    "error_message_details" => $response["answer"]["detailedErrorMessage"],
                ],
            ],400);

        }

        /* everything is fine, I extract the formToken */
        $formToken = $response["answer"]["formToken"];

        return response()->json([
            "token" => $formToken,
            "endpoint" => $this->izipay->getClientEndpoint(),
            "public_key" => $this->izipay->getPublicKey(),
            "redirect_url" => route('web.venta.pago.confirmarPago'),
        ]);
    }


    public function confirmarPago(Request $request)
    {

        /* No POST data ? paid page in not called after a payment form */
        if ( count($request->except(['_token'])) == 0)
        {
            return redirect()->route('web.venta.pago.index');
        }

        $izipay = $this->izipay;
        $formAnswer = $izipay->getParsedFormAnswer();

        if ( !$izipay->checkHash() || $formAnswer['kr-answer']['orderStatus'] != 'PAID'){
            session()->put('error.venta.pago', 'El pago no se pudo realizar, intente nuevamente.');
            return redirect()->route('web.venta.pago.index');
        }

        $idventa = session()->get('idventa');
        $venta = Venta::query()->find($idventa);

        $ventaDetalle = VentaDetalle::query()->where('idventa', $idventa)->get();

        if ( count($ventaDetalle) == 0 ){
            return redirect('/');
        }


        $this->updateStockProductos($idventa);
        $comprobante = $this->createNroComprobate($venta->facturacion_idcomprobante);

        // $venta->pago_mercadopago_id = $payment->id;
        $venta->pago_idmetodo_pago = 6;
        $venta->pago_idestado_pago = 1;
        $venta->pago_cuotas = 1;
        $venta->pago_email = $venta->correo;
        $venta->fecha_venta = now()->format("Y-m-d H:i:s");
        $venta->fecha_pago = now()->format("Y-m-d H:i:s");
        $venta->facturacion_nro_comprobante = $comprobante;
        $venta->estado = 1;
        $venta->update();

        try {
            Mail::send(new VentaConfirmacionMail($venta->idventa));
        }catch (\Throwable $th){

        }

        session()->put('idventa_flush',$venta->idventa);

        Cart::instance("productos")->destroy();
        session()->forget('cupon');
        session()->forget('envio');
        session()->forget('idventa');

        return redirect()->route('web.venta.finalVenta');

    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////






    private function updateStockProductos($idventa)
    {
        $ventaDetalle = VentaDetalle::query()->where('idventa', $idventa)->get();

        foreach ($ventaDetalle as $vd) {
            $producto = Producto::query()->find($vd->idproducto);
            $producto->stock = $producto->stock - $vd->cantidad;
            $producto->update();
        }
    }

    private function createNroComprobate($idcomprobante)
    {
        $comprobante = Comprobante::query()->find($idcomprobante);

        $nro_comprobante =  $comprobante->nro_correlativo . '-' . str_pad($comprobante->nro_serie, 6, 0, STR_PAD_LEFT);

        $comprobante->nro_serie = $comprobante->nro_serie + 1;
        $comprobante->update();

        return $nro_comprobante;
    }



}
