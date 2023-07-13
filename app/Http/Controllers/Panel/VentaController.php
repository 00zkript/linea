<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Carrito;
use App\Models\CarritoDetalle;
use App\Models\Cliente;
use App\Models\Matricula;
use App\Models\Producto;
use App\Models\TipoFacturacion;
use App\Models\TipoPago;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Mike42\Escpos\CapabilityProfile;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\Printer;

class VentaController extends Controller
{
    public $TIPO_ARTICULO_PRODUCTO_ID = 1;
    public $TIPO_ARTICULO_MATRICULA_ID = 2;


    public function index()
    {

        $registros = Venta::query()
            ->withSucursal()
            ->where('estado',1)
            ->orderBy('idventa','desc')
            ->paginate(15,['*'],'pagina',1);

        return view('panel.venta.index')->with(compact('registros'));
    }

    public function listar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }
        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Venta::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where(DB::raw("LPAD(idventa, 7, 0)"),'LIKE','%'.$txtBuscar.'%')
                    ->orWhere(DB::raw("concat(cliente_nombres, '', cliente_apellidos)"),'LIKE','%'.$txtBuscar.'%');
            })
            ->withSucursal()
            ->where('estado',1)
            ->orderBy('idventa','desc')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);


        return view('panel.venta.listado')->with(compact('registros'))->render();
    }

    public function resources()
    {
        $tipoFacturacion = TipoFacturacion::query()->where('estado',1)->withSucursal()->get();
        $tipoPago = TipoPago::query()->where('estado',1)->get();
        $productos = Producto::query()
            ->selectRaw('*, 1 as cantidad, precio as subtotal')
            ->where('estado',1)
            ->orderBy('idproducto','desc')
            ->paginate(5,['*'],'page',1);

        return [
            'tipoFacturacion' => $tipoFacturacion,
            'tipoPago' => $tipoPago,
            'productos' => $productos,
        ];
    }

    public function create(Request $request, $carritoID = 0)
    {

        $resources = $this->resources();

        return view('panel.venta.crear')->with(compact('carritoID', 'resources'));
    }

    public function store(Request $request)
    {


        $idtipoFacturacion      = $request->input('idtipo_facturacion');
        $tipoFacturaconSerie    = $request->input('serie');
        $tipoFacturacionNumero  = $request->input('numero');
        $idcliente              = $request->input('idcliente');
        $idmoneda               = $request->input('idmoneda');
        $idtipoPago             = $request->input('idtipo_pago');
        $montoEfectivoRecibido  = $request->input('monto_efectivo');
        $montoEfectivoDevuelto  = $request->input('monto_efectivo_devuelto');
        $montoEfectivoPagado    = $montoEfectivoRecibido - $montoEfectivoDevuelto;
        $montoTranferidoPagado  = $request->input('monto_transferido');
        $montoTotalPagado       = $montoEfectivoPagado + $montoTranferidoPagado;
        $montoFaltante          = $request->input('monto_faltante');
        $montoTotal             = $request->input('monto_total');
        $fechaPago              = now()->format('Y-m-d');
        $detalle                = $request->input('detalle', []);
        $idcarrito              = $request->input('idcarrito');
        $idempleado             = auth()->id();
        $sucursal               = auth()->user()->sucursal;
        $TIPO_ARTICULO_PRODUCTO_ID  = $this->TIPO_ARTICULO_PRODUCTO_ID;
        $TIPO_ARTICULO_MATRICULA_ID = $this->TIPO_ARTICULO_MATRICULA_ID;

        $cliente = Cliente::query()->find($idcliente);
        $empleado = auth()->user();


        $venta = new Venta();
        $venta->idsucursal               = $sucursal->idsucursal;
        $venta->idcliente                           = $idcliente;
        $venta->cliente_nombres                     = $cliente->nombres;
        $venta->cliente_apellidos                   = $cliente->apellidos;
        $venta->cliente_idtipo_documento_identidad  = $cliente->idtipo_documento_identidad;
        $venta->cliente_numero_documento_identidad  = $cliente->numero_documento_identidad;
        $venta->idempleado                          = $idempleado;
        $venta->empleado_nombres                    = $empleado->nombres;
        $venta->empleado_apellidos                  = $empleado->apellidos;
        $venta->empleado_idtipo_documento_identidad = $empleado->idtipo_documento_identidad;
        $venta->empleado_numero_documento_identidad = $empleado->numero_documento_identidad;

        $venta->idtipo_facturacion       = $idtipoFacturacion;
        $venta->tipo_facturacion_serie   = $tipoFacturaconSerie;
        $venta->tipo_facturacion_numero  = $tipoFacturacionNumero;

        $venta->idmoneda                 = $idmoneda;
        $venta->idtipo_pago              = $idtipoPago;
        $venta->monto_efectivo_recibido    = number_format($montoEfectivoRecibido,2,'.','');
        $venta->monto_efectivo_devuelto    = number_format($montoEfectivoDevuelto,2,'.','');
        $venta->monto_efectivo_pagado      = number_format($montoEfectivoPagado,2,'.','');
        $venta->monto_transferido_pagado   = number_format($montoTranferidoPagado,2,'.','');
        $venta->monto_pagado               = number_format($montoTotalPagado,2,'.','');
        $venta->monto_faltante             = number_format($montoFaltante,2,'.','');
        $venta->monto_total                = number_format($montoTotal,2,'.','');
        $venta->fecha_pago               = $fechaPago;
        $venta->estado                   = 1;
        $venta->save();

        $tipoFacturacion = TipoFacturacion::query()->find($idtipoFacturacion);
        $tipoFacturacion->numero = str_pad( (int)$tipoFacturacion->numero + 1, 7,0,STR_PAD_LEFT);
        $tipoFacturacion->update();


        foreach ($detalle as $itemDetalle) {
            $ventaDetalle = new VentaDetalle();
            $ventaDetalle->idventa         = $venta->idventa;
            $ventaDetalle->idtipo_articulo = $itemDetalle['idtipo_articulo'];
            $ventaDetalle->idarticulo      = $itemDetalle['idarticulo'];
            $ventaDetalle->nombre          = $itemDetalle['nombre'];
            $ventaDetalle->cantidad        = $itemDetalle['cantidad'];
            $ventaDetalle->precio          = $itemDetalle['precio'];
            $ventaDetalle->subtotal     = $itemDetalle['subtotal'];
            $ventaDetalle->save();


            if( $itemDetalle['idtipo_articulo'] == $TIPO_ARTICULO_PRODUCTO_ID) {
                DB::table('producto')->where('idproducto',$itemDetalle['idarticulo'])->decrement('stock',$itemDetalle['cantidad']);
            }
        }

        if ($idcarrito) {
            $carrito = Carrito::query()->find($idcarrito);
            $carrito->pagado = 1;
            $carrito->idventa = $venta->idventa;
            $carrito->update();
        }

        return response()->json([
            "mensaje" => "La venta se guardó con éxito."
        ]);
    }

    public function show(Request $request,$ventaID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $venta = Venta::query()->with([ 'sucursal', 'tipoFacturacion', 'tipoPago'])->find($ventaID);

        if (!$venta) {
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($venta);
    }

    public function edit(Request $request, $ventaID)
    {
        $TIPO_ARTICULO_PRODUCTO_ID = $this->TIPO_ARTICULO_PRODUCTO_ID;
        $TIPO_ARTICULO_MATRICULA_ID = $this->TIPO_ARTICULO_MATRICULA_ID;

        $venta = Venta::query()->with([
                'detalle' => function ($query) use ($TIPO_ARTICULO_PRODUCTO_ID) {
                    return $query->selectRaw("
                        *,
                        (
                            select producto.stock
                            from producto
                            where producto.idproducto = venta_detalle.idarticulo
                            and venta_detalle.idtipo_articulo = $TIPO_ARTICULO_PRODUCTO_ID
                            limit 1
                        ) as stock
                    ");
                }
            ])
            ->find($ventaID);

        if (!$venta) {
            return abort(400);
        }

        $resources = $this->resources();


        return view('panel.venta.editar')->with(compact('venta', 'resources' ));
    }

    public function update(Request $request, $ventaID)
    {

        $idtipoFacturacion      = $request->input('idtipo_facturacion');
        $tipoFacturaconSerie    = $request->input('serie');
        $tipoFacturacionNumero  = $request->input('numero');
        $idcliente              = $request->input('idcliente');
        $idmoneda               = $request->input('idmoneda');
        $idtipoPago             = $request->input('idtipo_pago');
        $montoEfectivoRecibido  = $request->input('monto_efectivo');
        $montoEfectivoDevuelto  = $request->input('monto_efectivo_devuelto');
        $montoEfectivoPagado    = $montoEfectivoRecibido - $montoEfectivoDevuelto;
        $montoTranferidoPagado  = $request->input('monto_transferido');
        $montoTotalPagado       = $montoEfectivoPagado + $montoTranferidoPagado;
        $montoFaltante          = $request->input('monto_faltante');
        $montoTotal             = $request->input('monto_total');
        $fechaPago              = now()->format('Y-m-d');
        $detalle                = $request->input('detalle', []);
        $idcarrito              = $request->input('idcarrito');
        $idempleado             = auth()->id();
        $sucursal               = auth()->user()->sucursal;
        $TIPO_ARTICULO_PRODUCTO_ID  = $this->TIPO_ARTICULO_PRODUCTO_ID;
        $TIPO_ARTICULO_MATRICULA_ID = $this->TIPO_ARTICULO_MATRICULA_ID;

        $cliente = Cliente::query()->find($idcliente);
        $empleado = auth()->user();


        $venta = Venta::find($ventaID);
        $venta->idsucursal               = $sucursal->idsucursal;
        $venta->idcliente                           = $idcliente;
        $venta->cliente_nombres                     = $cliente->nombres;
        $venta->cliente_apellidos                   = $cliente->apellidos;
        $venta->cliente_idtipo_documento_identidad  = $cliente->idtipo_documento_identidad;
        $venta->cliente_numero_documento_identidad  = $cliente->numero_documento_identidad;
        $venta->idempleado                          = $idempleado;
        $venta->empleado_nombres                    = $empleado->nombres;
        $venta->empleado_apellidos                  = $empleado->apellidos;
        $venta->empleado_idtipo_documento_identidad = $empleado->idtipo_documento_identidad;
        $venta->empleado_numero_documento_identidad = $empleado->numero_documento_identidad;

        $venta->idtipo_facturacion       = $idtipoFacturacion;
        $venta->tipo_facturacion_serie   = $tipoFacturaconSerie;
        $venta->tipo_facturacion_numero  = $tipoFacturacionNumero;

        $venta->idmoneda                 = $idmoneda;
        $venta->idtipo_pago              = $idtipoPago;
        $venta->monto_efectivo_recibido    = number_format($montoEfectivoRecibido,2,'.','');
        $venta->monto_efectivo_devuelto    = number_format($montoEfectivoDevuelto,2,'.','');
        $venta->monto_efectivo_pagado      = number_format($montoEfectivoPagado,2,'.','');
        $venta->monto_transferido_pagado   = number_format($montoTranferidoPagado,2,'.','');
        $venta->monto_pagado               = number_format($montoTotalPagado,2,'.','');
        $venta->monto_faltante             = number_format($montoFaltante,2,'.','');
        $venta->monto_total                = number_format($montoTotal,2,'.','');
        $venta->fecha_pago               = $fechaPago;
        $venta->estado                   = 1;
        $venta->save();


        $tipoFacturacion = TipoFacturacion::query()->find($idtipoFacturacion);
        if($idtipoFacturacion != $venta->idtipo_facturacion || $tipoFacturacionNumero != $venta->tipo_facturacion_numero) {
            $tipoFacturacion->numero = str_pad( (int)$tipoFacturacion->numero + 1, 7,0,STR_PAD_LEFT);
            $tipoFacturacion->update();

        }



        $detalleOld = VentaDetalle::query()->where('idventa',$ventaID)->get();
        foreach ($detalleOld as $d) {
            if( $d->idtipo_articulo == $TIPO_ARTICULO_PRODUCTO_ID) {
                DB::table('producto')->where('idproducto',$d->idarticulo)->increment('stock',$d->cantidad);
            }
        }

        VentaDetalle::query()->where('idventa',$ventaID)->delete();
        foreach ($detalle as $itemDetalle) {
            $ventaDetalle = new VentaDetalle();
            $ventaDetalle->idventa         = $venta->idventa;
            $ventaDetalle->idtipo_articulo = $itemDetalle['idtipo_articulo'];
            $ventaDetalle->idarticulo      = $itemDetalle['idarticulo'];
            $ventaDetalle->nombre          = $itemDetalle['nombre'];
            $ventaDetalle->cantidad        = $itemDetalle['cantidad'];
            $ventaDetalle->precio          = $itemDetalle['precio'];
            $ventaDetalle->subtotal     = $itemDetalle['subtotal'];
            $ventaDetalle->save();


            if( $itemDetalle['idtipo_articulo'] == $TIPO_ARTICULO_PRODUCTO_ID) {
                DB::table('producto')->where('idproducto',$itemDetalle['idarticulo'])->decrement('stock',$itemDetalle['cantidad']);
            }

        }

        if ($idcarrito) {
            $carrito = Carrito::query()->find($idcarrito);
            $carrito->pagado = 1;
            $carrito->idventa = $venta->idventa;
            $carrito->update();
        }

        return response()->json([
            "mensaje" => "La venta se modificó con éxito."
        ]);
    }

    public function destroy(Request $request)
    {
        return ;
    }

    public function anular(Request $request,$ventaID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }
        $TIPO_ARTICULO_PRODUCTO_ID  = $this->TIPO_ARTICULO_PRODUCTO_ID;
        $TIPO_ARTICULO_MATRICULA_ID = $this->TIPO_ARTICULO_MATRICULA_ID;
        $venta = Venta::query()->find($ventaID);

        if (!$venta) {
            return response()->json([ 'mensaje' => 'El registro no existe.'],400);
        }

        if ($venta->anulado) {
            return response()->json([ 'mensaje' => 'La venta se encuentra anulado.'],400);
        }

        $venta->anulado = 1;
        $venta->anulado_at = now()->format('Y-m-d');
        $venta->update();


        $detalleOld = VentaDetalle::query()->where('idventa',$ventaID)->get();
        foreach ($detalleOld as $d) {
            if( $d->idtipo_articulo == $TIPO_ARTICULO_PRODUCTO_ID) {
                DB::table('producto')->where('idproducto',$d->idarticulo)->increment('stock',$d->cantidad);
            }
        }

        return response()->json([ 'mensaje' => 'La venta se anulo con exitó.']);

    }




    public function facturaSerie(Request $request, $tipoFacturacionID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $tipoFacturacion = TipoFacturacion::query()->where('idtipo_facturacion',$tipoFacturacionID)->where('estado',1)->withSucursal()->first();

        return response()->json($tipoFacturacion);
    }

    public function carrito(Request $request, $carritoID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $TIPO_ARTICULO_PRODUCTO_ID = $this->TIPO_ARTICULO_PRODUCTO_ID;
        $TIPO_ARTICULO_MATRICULA_ID = $this->TIPO_ARTICULO_MATRICULA_ID;


        $carrito = Carrito::query()->where('idcarrito',(int)$carritoID)->where('pagado',0)->first();

        if (!$carrito) {
            return response()->json( ['mensaje' => "El código agregado ya ha sido procesado o no existe, intente con otro código."],400);
        }

        $cliente = Cliente:: query()
            ->select([
                'idcliente',
                'nombres',
                'apellidos',
                'numero_documento_identidad',
                'idtipo_documento_identidad',
            ])
            ->where('idcliente',$carrito->idcliente)
            ->first();

        $detalle = CarritoDetalle::query()
            ->selectRaw("
                *,
                (
                    select producto.stock
                    from producto
                    where producto.idproducto = carrito_detalle.idarticulo
                    and carrito_detalle.idtipo_articulo = $TIPO_ARTICULO_PRODUCTO_ID
                    limit 1
                ) as stock
            ")
            ->where('idcarrito',$carrito->idcarrito)
            ->get();


        return response()->json(compact('carrito','cliente','detalle'));
    }

    public function productos(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $cantidadRegistros = $request->input('cantidadRegistros',5);
        $paginaActual = $request->input('paginaActual',1);
        $txtBuscar = $request->input('txtBuscar');

        $productos = Producto::query()
            ->selectRaw('*, 1 as cantidad, precio as subtotal')
            ->where('estado',1)
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where(DB::raw('LPAD(idproducto,7,0)'),'LIKE','%'.$txtBuscar.'%')
                    ->orWhere('nombre','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('descripcion','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idproducto','desc')
            ->paginate($cantidadRegistros,['*'],'page',$paginaActual);

        return response()->json($productos);
    }

    public function matriculas(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $matriculaID = $request->input('idmatricula');
        $txtBuscar = $request->input('txtBuscar');
        $clienteID = $request->input('idcliente');
        $fechaInicio = $request->input('fechaInicio');
        $fechaFin = $request->input('fechaFin');


        $matriculas = Matricula::query()
            ->leftJoin('concepto','concepto.idconcepto','matricula.idconcepto')
            ->leftJoin('carrito','carrito.idcarrito','matricula.idcarrito')
            ->selectRaw("
                matricula.idmatricula,
                matricula.idcliente,
                matricula.monto_total,
                matricula.fecha_inicio,
                matricula.fecha_fin,
                concat(concepto.nombre, ' - ', LPAD(MONTH(matricula.created_at),2,0), '/', YEAR(matricula.created_at)) as descripcion,
                if(carrito.pagado is null,0,carrito.pagado) as pagado
            ")
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('matricula.idmatricula','LIKE','%'.$txtBuscar.'%')
                    ->orWhere(DB::raw("concat(concepto.nombre, ' - ', LPAD(MONTH(matricula.created_at),2,0), '/', YEAR(matricula.created_at)) like '%$txtBuscar%' "));
            })
            ->when($matriculaID,function($query) use($matriculaID){
                return $query->where(DB::raw('LPAD(matricula.idmatricula,7,0)'),'LIKE','%'.$matriculaID.'%');
            })
            ->when($fechaInicio, function ($query) use ($fechaInicio) {
                return $query->whereDate('matricula.created_at', '>=', $fechaInicio);
            })
            ->when($fechaFin, function ($query) use ($fechaFin) {
                return $query->whereDate('matricula.created_at', '<=', $fechaFin);
            })
            ->when($clienteID, function ($query) use ($clienteID) {
                return $query->where('matricula.idcliente', $clienteID);
            })
            // ->where(function ($query) {
            //     return $query->whereNull('matricula.idcarrito')
            //         ->orWhere('carrito.pagado', 0);
            // })
            ->whereNull('matricula.finalizado_at')
            ->where('matricula.estado',1)
            ->orderBy('matricula.idmatricula','desc')
            ->paginate($cantidadRegistros,['*'],'page',$paginaActual);


        return response()->json($matriculas);
    }

    public function clientes(Request $request)
    {
        $txtBuscar = $request->input('txtBuscar');
        $limit = $request->input('limit', 5);

        $clientes = Cliente::query()
            ->select([
                'idcliente',
                'nombres',
                'apellidos',
                'numero_documento_identidad',
                'idtipo_documento_identidad',
            ])
            ->where(function ($query) use ($txtBuscar) {
                return $query->where(DB::raw('LPAD(idcliente,7,0)'),'LIKE','%'.$txtBuscar.'%')
                    ->orWhere('nombres','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('apellidos','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('numero_documento_identidad','LIKE','%'.$txtBuscar.'%');
            })
            ->where('idsucursal', auth()->user()->sucursal->idsucursal)
            ->where('estado',1)
            ->limit($limit)
            ->get();

        return response()->json($clientes);
    }


    public function ticket()
    {

        // $connector = new FilePrintConnector("php://stdout");
        // $printer = new Printer($connector);
        // $printer->text("Hello World!\n");
        // $printer->cut();
        // $printer->close();

        // Ruta del archivo de salida para la impresión
        $archivoSalida = "recibo.txt";

        try {
            // Conector de impresión usando archivo de salida
            $connector = new FilePrintConnector($archivoSalida);

            // Perfil de capacidad de la impresora
            $capabilityProfile = CapabilityProfile::load("default");

            // Crear instancia de la impresora
            $printer = new Printer($connector, $capabilityProfile);

            // Establecer el tamaño de la fuente
            $printer->setTextSize(2, 2);

            // Imprimir texto en el recibo
            $printer->setJustification(Printer::JUSTIFY_CENTER);
            $printer->text("******************************\n");
            $printer->text("         COMPROBANTE DE VENTA         \n");
            $printer->text("******************************\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Fecha: " . date('d/m/Y H:i:s') . "\n");
            $printer->text("Cliente: Juan Pérez\n");
            $printer->text("RUC: 12345678901\n");
            $printer->text("Dirección: Av. Principal 123\n");
            $printer->text("******************************\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("Cant.   Descripción               P.Unit     Importe\n");
            $printer->text("-------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_LEFT);
            $printer->text("2       Producto A                 25.00      50.00\n");
            $printer->text("1       Producto B                 30.00      30.00\n");
            $printer->text("-------------------------------\n");
            $printer->setJustification(Printer::JUSTIFY_RIGHT);
            $printer->text("SUBTOTAL: 80.00\n");
            $printer->text("IGV (18%): 14.40\n");
            $printer->text("TOTAL: 94.40\n");
            $printer->text("******************************\n");
            $printer->text("        GRACIAS POR SU COMPRA        \n");
            $printer->text("******************************\n");


            // Cortar el recibo y liberar recursos
            // $printer->cut();
            $printer->close();

            $contenidoRecibo = file_get_contents($archivoSalida);

            ?>
                <!DOCTYPE html>
                <html>
                <head>
                    <title>Previsualización del recibo</title>
                    <style>
                        /* Estilos CSS para mostrar el contenido del recibo */
                        body {
                            font-family: Arial, sans-serif;
                            margin: 20px;
                            background: #1E1E1E;
                        }

                        .ticket {
                            width: 300px;
                            height: 100%;
                            margin: 0 auto;
                            padding: 20px;
                            border: 1px solid #ccc;
                            background-color: #f9f9f9;
                        }
                        .ticket-content p {
                            margin: 0;
                            padding: 0;
                        }
                        .ticket-content {
                            margin-bottom: 10px;
                        }
                    </style>
                </head>
                <body>

                    <div class="ticket">
                        <div class="ticket-content"><?php echo nl2br($contenidoRecibo) ?></div>
                    </div>
                </body>
                </html>
            <?php

            // return response($contenidoRecibo)->header('Content-Type', 'text/plain');
            // return response()->json(['mensaje' => 'Recibo impreso exitosamente.']);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al imprimir el recibo: ' . $e->getMessage()], 500);
        }

    }




}
