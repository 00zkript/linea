<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Matricula;
use App\Models\PagoCliente;
use App\Models\Producto;
use App\Models\TipoFacturacion;
use App\Models\TipoPago;
use App\Models\Venta;
use App\Models\VentaDetalle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    public function index()
    {
        return view('panel.venta.index');
    }

    public function listar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }
        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');

        $registros = PagoCliente::query()
            ->where('estado',1)
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);


        return view('panel.venta.listado')->with(compact('registros'))->render();
    }

    public function create(Request $request)
    {
        return view('panel.venta.create');
    }

    public function store(Request $request)
    {


        $idtipoFacturacion      = $request->input('idtipo_facturacion');
        $tipoFacturaconSerie    = $request->input('serie');
        $tipoFacturacionNumero  = $request->input('numero');
        $idcliente              = $request->input('idcliente');
        $idmoneda               = $request->input('idmoneda');
        $idtipoPago             = $request->input('idtipo_pago');
        $montoPagadoEfectivo    = $request->input('monto_efectivo');
        $montoPagadoTransferido = $request->input('monto_transferido');
        $montoPagado            = $montoPagadoEfectivo + $montoPagadoTransferido;
        $montoVuelto            = $request->input('monto_vuelto');
        $montoDeuda             = $request->input('monto_deuda');
        $montoTotal             = $request->input('monto_total');
        $fechaPago              = now()->format('Y-m-d');
        $detalle                = $request->input('detalle', []);
        $idempleado             = auth()->id();
        $sucursal               = auth()->user()->sucursal;



        $venta = new Venta();
        $venta->idsucrusal               = $sucursal->idsucrusal;
        $venta->idempleado               = $idempleado;
        $venta->idtipo_facturacion       = $idtipoFacturacion;
        $venta->tipo_facturacion_serie   = $tipoFacturaconSerie;
        $venta->tipo_facturacion_numero  = $tipoFacturacionNumero;
        $venta->idcliente                = $idcliente;
        $venta->idmoneda                 = $idmoneda;
        $venta->idtipo_pago              = $idtipoPago;
        $venta->monto_pagado_efectivo    = $montoPagadoEfectivo;
        $venta->monto_pagado_transferido = $montoPagadoTransferido;
        $venta->monto_pagado             = $montoPagado;
        $venta->monto_vuelto             = $montoVuelto;
        $venta->monto_deuda              = $montoDeuda;
        $venta->monto_total              = $montoTotal;
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
            $ventaDetalle->monto_total     = $itemDetalle['monto_total'];
            $ventaDetalle->save();
        }

        return response()->json([
            "mensaje" => "La venta se guardó con éxito."
        ]);
    }

    public function edit(Request $request)
    {
        return ;
    }

    public function update(Request $request)
    {
        return ;
    }

    public function destroy(Request $request)
    {
        return ;
    }




    public function resources(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $tipoFacturacion = TipoFacturacion::query()->where('estado',1)->withSucursal()->get();
        $tipoPago = TipoPago::query()->where('estado',1)->get();

        return response()->json([
            'tipo_facturacion' => $tipoFacturacion,
            'tipo_pago' => $tipoPago,
        ]);
    }

    public function facturaSerie(Request $request, $tipoFacturacionID)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $tipoFacturacion = TipoFacturacion::query()->where('idtipo_facturacion',$tipoFacturacionID)->where('estado',1)->withSucursal()->first();

        return response()->json($tipoFacturacion);
    }

    public function carrito(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $carritoID = $request->input('idcarrito');

        $carrito = Matricula::query()
            ->where(DB::raw('LPAD(idmatricula,7,0)'),$carritoID)
            ->where('estado',1)
            ->first();

        return response()->json($carrito);
    }

    public function productos(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $productos = Producto::query()
            ->selectRaw('*, 1 as cantidad, precio as monto_total')
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
            ->selectRaw("
                matricula.idmatricula,
                matricula.idcliente,
                matricula.monto_total,
                matricula.fecha_inicio,
                matricula.fecha_fin,
                concat(concepto.nombre, ' - ', LPAD(MONTH(matricula.created_at),2,0), '/', YEAR(matricula.created_at)) as descripcion
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
                return $query->where('idcliente', $clienteID);
            })
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





}
