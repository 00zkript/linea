<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ArqueoCaja;
use App\Models\ArqueoCajaOperacion;
use App\Models\TipoOperacion;
use App\User;
use Illuminate\Http\Request;

class ArqueoCajaOperacionesController extends Controller
{
    public function index(Request $request)
    {

        $registros = ArqueoCajaOperacion::query()
            ->with([
                'tipoOperacion'
            ])
            ->orderBy('idarqueo_caja_operaciones','desc')
            ->paginate(10,['*'],'pagina',1);



        return view('panel.arqueoCajaOperaciones.index')->with(compact('registros'));
    }

    public function listar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');

        $registros = ArqueoCajaOperacion::query()
            ->with([
                'tipoOperacion'
            ])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('idarqueo_caja_operaciones','LIKE','%'.$txtBuscar.'%');
            })
            ->when($fechaDesde, function ($query) use($fechaDesde){
                return $query->whereDate('fecha', '>=', now()->parse($fechaDesde)->format('Y-m-d'));
            })
            ->when($fechaHasta, function ($query) use ($fechaHasta) {
                return $query->whereDate('fecha','<=', now()->parse($fechaHasta)->format('Y-m-d'));
            })
            ->orderBy('idarqueo_caja_operaciones','desc')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.arqueoCajaOperaciones.listado')->with(compact('registros'))->render();
    }

    public function create()
    {
        $tiposDeOperaciones = TipoOperacion::query()->where('estado',1)->get();
        $usuarios = User::query()
            ->select([
                'idusuario',
                'nombres',
                'apellidos',
                'estado',
            ])
            ->where('estado',1)
            ->get();

        return view('panel.arqueoCajaOperaciones.create')->with(compact('tiposDeOperaciones', 'usuarios'));
    }

    public function store(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $tipoOperacion         = $request->input('tipoOperacion');
        $montoSolEfectivo      = $request->input('montoSolEfectivo');
        $montoSolTransferido   = $request->input('montoSolTransferido');
        $montoDolarEfectivo    = $request->input('montoDolarEfectivo');
        $montoDolarTransferido = $request->input('montoDolarTransferido');
        $descripcion           = $request->input('descripcion');
        $idsupervisor          = $request->input('idsupervisor');


        $fecha      = now()->format('Y-m-d');
        $arqueoCaja = ArqueoCaja::query(    )->where('fecha', $fecha )->first();
        $montoSol   = $montoSolEfectivo + $montoSolTransferido;
        $montoDolar = $montoDolarEfectivo + $montoDolarTransferido;


        $operacion = new ArqueoCajaOperacion();
        $operacion->idarqueo_caja           = $arqueoCaja->idarqueo_caja;
        $operacion->idusuario               = auth()->id();
        $operacion->idsupervisor            = $idsupervisor;
        $operacion->idtipo_operacion        = $tipoOperacion;
        $operacion->fecha                   = $fecha;
        $operacion->descripcion             = $descripcion;
        $operacion->monto_sol_efectivo      = number_format($montoSolEfectivo,4,'.','');
        $operacion->monto_sol_transferido   = number_format($montoSolTransferido,4,'.','');
        $operacion->monto_sol               = number_format($montoSol,4,'.','');
        $operacion->monto_dolar_efectivo    = number_format($montoDolarEfectivo,4,'.','');
        $operacion->monto_dolar_transferido = number_format($montoDolarTransferido,4,'.','');
        $operacion->monto_dolar             = number_format($montoDolar,4,'.','');
        $operacion->estado                  = 1;
        $operacion->save();


        return response()->json([
            'mensaje' => 'La operación se guardó con éxito'
        ]);
    }

    public function show(Request $request,$id)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $registro = ArqueoCajaOperacion::query()->with(['tipoOperacion','usuario', 'supervisor'])->find($id);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);
    }

}
