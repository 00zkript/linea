<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Mail\Panel\EstadoEnvioMail;
use App\Mail\Web\ComprobantePagoMail;
use App\Models\EstadoControlVenta;
use App\Models\EstadoEnvio;
use App\Models\EstadoPago;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Throwable;

class VentaController extends Controller
{
    public function index()
    {

        $ventas = Venta::query()
            ->with(["estadoEnvio", "estadoControlVenta", "cupon", "metodoEntrega", "facturacion", "metodoPago", "estadoPago","moneda"])
            ->orderBy('fecha_venta', 'DESC')
            ->where('estado',1)
            ->paginate(10, ['*'], 'pagina', 1);

        $estadosEnvio = EstadoEnvio::query()
            ->where('estado', 1)
            ->get();

        $estadosPago = EstadoPago::query()
            ->where('estado', 1)
            ->get();

        $estadosControlVenta = EstadoControlVenta::query()
            ->where('estado', 1)
            ->get();


        return view('panel.venta.index')->with(compact('ventas', 'estadosEnvio', 'estadosPago','estadosControlVenta'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $ventas = Venta::query()
            ->with(["estadoEnvio", "estadoControlVenta", "cupon", "metodoEntrega", "facturacion", "metodoPago", "estadoPago","moneda"])
            ->where('estado',1)
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('LPAD(v.idventa,7,"0000000") LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('fecha_venta', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.venta.listado')->with(compact('ventas'))->render());


    }


    public function detalleVenta(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idventa = $request->input('idventa');

        $venta = Venta::query()
            ->with([
                "estadoEnvio",
                "estadoControlVenta",
                "cupon",
                "metodoEntrega",
                "facturacion",
                "metodoPago",
                "estadoPago",
                "cliente",
                "tipoDocumentoIdentidad",
                "departamento",
                "provincia",
                "distrito",
                "moneda",
                "puntoVenta"
            ])
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

    public function detalleVoucher(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idventa = $request->input('idventa');

        $voucherVenta = DB::table('voucher_venta AS vv')
            ->selectRaw('vv.*,DATE_FORMAT(CONCAT(vv.fecha," ",vv.hora),"%d/%m/%Y || %h:%i %p") AS fechaHora')
            ->where('vv.idventa', $idventa)
            ->first();

        if (!$voucherVenta){
            return response()->json(["mensaje" => "Registro no encontrado"], 400);
        }

        return response()->json( $voucherVenta );

    }

    public function modificarEstadoEnvio(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {
            $venta = Venta::query()->findOrFail($request->input('idventa'));

            if ($venta->idestado_control_venta == 3){
                return response()->json(["mensaje" => "La venta se encuentra anualda.",],400);
            }

            $venta->idestado_envio = $request->input('idestado_envio');
            $venta->update();

            Mail::send(new EstadoEnvioMail($venta->idventa));

            return response()->json([
                "mensaje" => "El estado de envió se ha modificado satisfactoriamente."
            ]);

        }catch (\Throwable $th){

            return response()->json([
                "mensaje" => "No sé a podido modificar el estado de envío.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine()

            ],400);
        }


    }

    public function modificarEstadoPago(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $venta = Venta::query()->findOrFail($request->input('idventa'));

            if ($venta->idestado_control_venta == 3){
                return response()->json(["mensaje" => "La venta se encuentra anualda.",],400);
            }

            $venta->pago_idestado_pago = $request->input('idestado_pago');
            $venta->update();

            return response()->json(["mensaje" => "El estado de pago se ha modificado satisfactoriamente.",]);

        }catch (\Throwable $th){

            return response()->json([
                "mensaje" => "No sé a podido modificar el estado de pago.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine()

            ],400);
        }


    }

    public function modificarEstadoControlVenta(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();
        try {

            $venta = Venta::query()->findOrFail($request->input('idventa'));

            if ($venta->idestado_control_venta == 3){
                return response()->json(["mensaje" => "La venta se encuentra anualda.",],400);
            }

            $venta->idestado_control_venta = $request->input('idestado_control_venta');
            $venta->update();


            DB::commit();
            return response()->json([
                "mensaje" => "El estado de la venta se ha modificado satisfactoriamente.",
            ]);

        } catch (Throwable $th) {

            DB::rollBack();
            return response()->json([
                "mensaje" => "No sé a podido modificar el estado de la venta.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine()

            ],400);
        }


    }


    public function anularVenta(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();
        try {

            $venta = Venta::query()->findOrFail($request->input('idventa'));

            if ($venta->idestado_control_venta == 3){
                return response()->json(["mensaje" => "La venta se encuentra anualda.",],400);
            }

            $venta->idestado_control_venta = 3;
            $venta->update();

            $ventaDetalle = VentaDetalle::query()
                ->where('idventa', $venta->idventa)
                ->get();

            foreach ($ventaDetalle as $vd) {

                $producto = Producto::query()->find($vd->idproducto);

                if (!empty($producto)) {
                    $producto->stock = $producto->stock + $vd->cantidad;
                    $producto->update();
                }

            }



            DB::commit();
            return response()->json([
                "mensaje" => "La venta ha sido anulada satisfactoriamente."
            ]);

        } catch (Throwable $th) {

            DB::rollBack();
            return response()->json([
                "mensaje" => "No sé a podido anular la venta.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine()

            ],400);
        }


    }


    public function pdf(Request $request,$idventa)
    {

        $venta = Venta::query()
            ->with(["estadoEnvio", "estadoControlVenta", "cupon", "metodoEntrega", "facturacion", "metodoPago", "estadoPago","cliente","tipoDocumentoIdentidad","departamento", "provincia", "distrito","moneda"])
            ->find($idventa);


        if (!$venta) {
            return response()->json(["mensaje" => "Registro no encontrado"], 400);
        }


        $ventaDetalle = VentaDetalle::query()
            ->with(["producto"])
            ->where('idventa', $idventa)
            ->get();

        $pdf = \PDF::loadView('panel.venta.pdf.cuerpo', compact('venta','ventaDetalle'));

        $pdf->setOptions([
            'margin-top' => 0,
            'margin-left' => 0,
            'margin-right' => 0,
            // 'header-html' => view('reportePdfSection.cabecera'),
            'footer-center' => '[page]/[toPage]',
            // 'orientation' => 'Landscape'
        ]);

        // return $pdf->download("reporte_ventas_generado_" . now()->format('d/m/Y') . '.pdf');
        return $pdf->inline();
    }

    public function updateComprobante(Request $request)
    {
        if(! $request->ajax() ){
            return abort(404);
        }

        $idventa = $request->input('idventa');

        try{
            $venta = Venta::query()->find($idventa);

            if(!$venta){
                throw new Exception('No hay este registro de esta venta en nuestro sistema.');
            }

            if( $request->hasFile('comprobante')){
                $nameFile = $request->file('comprobante')->store("comprobante/$idventa",'panel');
                $venta->imagen_comprobante_pago = basename($nameFile);
                $venta->update();

                // try{
                //     Mail::send(new ComprobantePagoMail($idventa));
                // }catch(Throwable $th){ }

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
