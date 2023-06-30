<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Matricula;
use App\Models\PagoCliente;
use App\Models\Producto;
use App\Models\TipoFacturacion;
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

    public function resources(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $tipoFacturacion = TipoFacturacion::query()->where('estado',1)->withSucursal()->get();

        return response()->json([
            'tipoFacturacion' => $tipoFacturacion,
        ]);
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
            ->selectRaw('*, 1 as cantidad, precio as precio_total')
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
                return $query->where('idcliente','LIKE','%'.$txtBuscar.'%')
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



    public function create(Request $request, $idmatricula = null)
    {
        $matricula = Matricula::query()->where('idmatricula',$idmatricula)->where('estado',1)->first();


        return view('panel.venta.create')->with(compact('matricula', 'idmatricula'));
    }


    public function store(Request $request)
    {
        return ;
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

}
