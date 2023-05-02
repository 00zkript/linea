<?php

namespace App\Http\Controllers\Web\Venta;

use App\Http\Controllers\Controller;
use App\Http\Traits\VentaHelperTrait;
use App\Models\Cliente;
use App\Models\Comprobante;
use App\Models\TipoDocumentoIdentidad;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatosClienteController extends Controller
{
    use VentaHelperTrait;

    public function index(Request $request)
    {
        if (Cart::instance("productos")->count() <= 0) {
            return redirect()->route('web.productos');
        }

        $this->updateVenta();


        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();

        if (!auth()->check()){
            $terminosCondiciones = DB::table('terminos_condiciones')->first();
            return view('web.venta.datosCliente.index')->with(compact('terminosCondiciones','tipoDocumentoIdentidad' ));
        }


        $cliente = Cliente::query()->where('idusuario',auth()->id())->first();
        $venta = Venta::query()->find(session()->get('idventa'));

        $data = (object) [
            "nombres" => $venta->nombres ?: $cliente->nombres,
            "apellidos" => $venta->apellidos ?: $cliente->apellidos,
            "telefono" => $venta->telefono ?: $cliente->telefono,
            "correo" => $venta->correo ?: $cliente->correo,
            "idtipo_documento_identidad" => $venta->idtipo_documento_identidad ?: $cliente->idtipo_documento_identidad ?: 1,
            "numero_documento_identidad" => $venta->numero_documento_identidad ?: $cliente->numero_documento_identidad,
            "facturacion_idcomprobante" => $venta->facturacion_idcomprobante ?: 1,
            "facturacion_ruc" => $venta->facturacion_ruc ?: '',
            "facturacion_razon_social" => $venta->facturacion_razon_social ?: '',

        ];

        return view('web.venta.datosCliente.informacionCliente')->with(compact('tipoDocumentoIdentidad', 'data'));

    }


    public function guardar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        DB::beginTransaction();
        try {
            $cliente = Cliente::query()->where('idusuario',auth()->id())->first();
            $cliente->nombres                     = $cliente->nombres ?: $request->input('nombres');
            $cliente->apellidos                   = $cliente->apellidos ?: $request->input('apellidos');
            $cliente->telefono                    = $cliente->telefono ?: $request->input('telefono');
            $cliente->correo                      = $cliente->correo ?: $request->input('correo');
            $cliente->idtipo_documento_identidad  = $cliente->idtipo_documento_identidad ?: $request->input('tipoDocumentoIdentidad');
            $cliente->numero_documento_identidad  = $cliente->numero_documento_identidad ?: $request->input('numeroDocumentoIdentidad');
            $cliente->update();

            $venta = Venta::query()->find(session()->get('idventa'));
            $venta->idcliente                   = $cliente->idcliente;
            $venta->nombres                     = $request->input('nombres');
            $venta->apellidos                   = $request->input('apellidos');
            $venta->telefono                    = $request->input('telefono');
            $venta->correo                      = $request->input('correo');
            $venta->idtipo_documento_identidad  = $request->input('tipoDocumentoIdentidad');
            $venta->numero_documento_identidad  = $request->input('numeroDocumentoIdentidad');
            $venta->facturacion_idcomprobante   = $request->input('tipoComprobante');

            if ($request->input('tipoComprobante') == 2){
                // $venta->facturacion_nro_comprobante = $request->input('facturacion_nro_comprobante');
                $venta->facturacion_ruc             = $request->input('ruc');
                $venta->facturacion_razon_social    = $request->input('razonSocial');

            }
            $venta->update();

            DB::commit();

            return response()->json([
                "mensaje" => "datos guardados correctamente."
            ]);


        }catch (\Throwable $th){
            DB::rollBack();

            return response()->json([
                "mensaje" => "No se pudo guardar los datos correctamente.",
                "error" => $th->getMessage()
            ],400);
        }



    }







}
