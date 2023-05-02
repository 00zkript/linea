<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\UsuarioRequest;
use App\Mail\Web\ComprobantePagoMail;
use App\Models\Cliente;
use App\Models\TipoDocumentoIdentidad;
use App\Models\Venta;
use App\Models\VentaDetalle;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {

        // if (auth()->user()->idrol == 1){
        //     return redirect()->route('inicio.index');
        // }

        $usuario = auth()->user();
        $cliente = Cliente::query()->where('idusuario',auth()->id())->first();


        $ventas = Venta::query()
            ->with(["estadoEnvio", "estadoControlVenta", "cupon", "metodoEntrega", "facturacion", "metodoPago", "estadoPago",])
            ->where('idcliente',$cliente->idcliente )
            ->orderBy('fecha_venta', 'DESC')
            ->where('estado',1)
            ->paginate(10, ['*'], 'pagina', 1);


        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();


        return view('web.usuario.index')->with(compact('usuario', 'cliente','ventas','tipoDocumentoIdentidad'));
    }

    public function listadoVentas(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $cliente = Cliente::query()->where('idusuario',auth()->id())->first();


        $ventas = Venta::query()
            ->with(["estadoEnvio", "estadoControlVenta", "cupon", "metodoEntrega", "facturacion", "metodoPago", "estadoPago","moneda"])
            ->where('idcliente',$cliente->idcliente )
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->where('idventa', $txtBuscar);
            })
            ->orderBy('fecha_venta', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);


        return response()->json(view('web.usuario.listadoVentas')->with(compact('ventas'))->render());


    }

    public function detalleVenta(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idventa = $request->input('idventa');

        $cliente = Cliente::query()->where('idusuario',auth()->id())->first();

        $venta = Venta::query()
            ->with(["estadoEnvio", "estadoControlVenta", "cupon", "metodoEntrega", "facturacion", "metodoPago", "estadoPago","cliente","tipoDocumentoIdentidad","departamento", "provincia", "distrito","moneda"])
            ->where('idcliente',$cliente->idcliente )
            ->find($idventa);


        if (!$venta) {
            return response()->json(["mensaje" => "Registro no encontrado"], 400);
        }


        $ventaDetalle = VentaDetalle::query()
            ->with(["producto"])
            ->where('idventa', $idventa)
            ->get();

        return response()->json([
            "venta" => $venta,
            "ventaDetalle" => $ventaDetalle
        ]);


    }

    public function modificarDatos(UsuarioRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $usuario = User::query()->find(auth()->id());
            $usuario->usuario = $request->input('nombres');

            if (!empty($request->input('clave'))) {
                $usuario->clave = encrypt($request->input('clave'));
            }

            $usuario->update();



            $cliente = Cliente::query()->where('idusuario',auth()->id())->first();

            $cliente->nombres = $request->input('nombres');
            $cliente->apellidos = $request->input('apellidos');
            $cliente->idtipo_documento_identidad = $request->input('tipoDocumentoIdentidad');
            $cliente->numero_documento_identidad = $request->input('numeroDocumentoIdentidad');
            $cliente->telefono = $request->input('telefono');
            $cliente->correo = $request->input('correo');
            $cliente->update();





            return response()->json([
                "mensaje" => "Datos actualizados con exito."
            ]);

        }catch (\Throwable $th){

            return response()->json([
                "mensaje" => "Los datos no pudieron ser actualizados.",
                "error" => $th->getMessage()
            ],400);
        }


    }


    public function updateComprobante(Request $request)
    {
        if(! $request->ajax() ){
            return abort(404);
        }

        $idventa = $request->input('idventa');

        try{
            $cliente = Cliente::query()->where('idusuario',auth()->id())->first();
            $venta = Venta::query()->where('idcliente',$cliente->idcliente)->find($idventa);

            if(!$venta){
                throw new Exception('No hay este registro de esta venta en nuestro sistema.');
            }

            if( $request->hasFile('comprobante')){
                $nameFile = $request->file('comprobante')->store("comprobante/$idventa",'panel');
                $venta->imagen_comprobante_pago = basename($nameFile);
                $venta->update();

                try{
                    Mail::send(new ComprobantePagoMail($idventa));
                }catch(Throwable $th){ }

            }



            return response()->json([
                "mensaje" => "Comprobante subido correctamente",
            ]);

        }catch( Throwable $t){
            return response()->json([
                "mensaje" => "El Comprobante no pudo ser actualizado, intente nuevamente.",
                "error" => $t->getMessage(),
            ],400);
        }




    }



}
