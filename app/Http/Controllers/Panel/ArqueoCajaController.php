<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ArqueoCaja;
use App\Models\ArqueoCajaOperacion;
use App\Models\Venta;
use App\User;
use Barryvdh\Snappy\Facades\SnappyPdf;
use Illuminate\Http\Request;

class ArqueoCajaController extends Controller
{

    public function abrir(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $montoInicialSol   = $request->input('montoInicialSoles');
        $montoInicialDolar = $request->input('montoInicialDolares');
        $cambioMoneda      = $request->input('montoCambio');
        $fecha             = now()->format('Y-m-d');
        $montoInicial      = $montoInicialSol + ($montoInicialDolar*$cambioMoneda);

        $sucursal = auth()->user()->sucursal;


        $arqueoCaja = ArqueoCaja::query()->firstOrNew([ 'fecha' => $fecha ]);

        $arqueoCaja->idusuario                 = auth()->id();
        $arqueoCaja->idsucursal                = $sucursal->idsucursal;
        $arqueoCaja->fecha                     = $fecha;
        $arqueoCaja->monto_cambio_moneda       = number_format($cambioMoneda,4,'.','');

        $arqueoCaja->monto_inicial_sol         = number_format($montoInicialSol,4,'.','');
        $arqueoCaja->monto_inicial_dolar       = number_format($montoInicialDolar,4,'.','');

        $arqueoCaja->save();

        return response()->json([
            'mensaje' => 'Se agrego correctamente.'
        ]);
    }

    public function cerrar()
    {
        $INGRESO_ID = 1;
        $EGRESO_ID = 2;
        $fecha = now()->format('Y-m-d');
        $arqueoCaja = ArqueoCaja::query()->where('fecha', $fecha )->first();

        $ventasHoy = Venta::query()->where('fecha',$fecha)->where('estado',1)->get();
        $operacionesIngreso = $arqueoCaja->operaciones()->where('idtipo_operacion', $INGRESO_ID)->get();
        $operacionesEgreso = $arqueoCaja->operaciones()->where('idtipo_operacion', $EGRESO_ID)->get();

        $usuarios = User::query()
            ->select([
                'idusuario',
                'nombres',
                'apellidos',
                'estado',
            ])
            ->where('estado',1)
            ->get();

        //*Sol
        $EVentasSolEfectivo    = $ventasHoy->sum('monto_sol_efectivo');
        $EVentasSolTransferido = $ventasHoy->sum('monto_sol_transferido');
        $EVentasSolTotal       = $EVentasSolEfectivo + $EVentasSolTransferido;

        $EOperacionesIngresosSolEfectivo    = $operacionesIngreso->sum('monto_sol_efectivo');
        $EOperacionesIngresosSolTransferido = $operacionesIngreso->sum('monto_sol_tranferido');
        $EOperacionesIngresosSolTotal       = $EOperacionesIngresosSolEfectivo + $EOperacionesIngresosSolTransferido;

        $EOperacionesEgresosSolEfectivo     = $operacionesEgreso->sum('monto_sol_efectivo');
        $EOperacionesEgresosSolTransferido  = $operacionesEgreso->sum('monto_sol_tranferido');
        $EOperacionesEgresosSolTotal        = $EOperacionesEgresosSolEfectivo + $EOperacionesEgresosSolTransferido;

        $ingresosSol = $arqueoCaja->monto_inicial_sol + $EVentasSolTotal + $EOperacionesIngresosSolTotal;
        $egresosSol =  $EOperacionesEgresosSolTotal;

        $montoFinalSolEfectivo      = ($arqueoCaja->monto_inicial_sol + $EVentasSolEfectivo + $EOperacionesIngresosSolEfectivo) - $EOperacionesEgresosSolEfectivo;
        $montoFinalSolTransferido   = ($EVentasSolTransferido + $EOperacionesIngresosSolTransferido) - $EOperacionesEgresosSolTransferido;

        //*Dolar
        $EVentasDolarEfectivo    = $ventasHoy->sum('monto_dolar_efectivo');
        $EVentasDolarTransferido = $ventasHoy->sum('monto_dolar_transferido');
        $EVentasDolarTotal       = $EVentasDolarEfectivo + $EVentasDolarTransferido;

        $EOperacionesIngresosDolarEfectivo    = $operacionesIngreso->sum('monto_dolar_efectivo');
        $EOperacionesIngresosDolarTransferido = $operacionesIngreso->sum('monto_dolar_tranferido');
        $EOperacionesIngresosDolarTotal       = $EOperacionesIngresosDolarEfectivo + $EOperacionesIngresosDolarTransferido;

        $EOperacionesEgresosDolarEfectivo     = $operacionesEgreso->sum('monto_dolar_efectivo');
        $EOperacionesEgresosDolarTransferido  = $operacionesEgreso->sum('monto_dolar_tranferido');
        $EOperacionesEgresosDolarTotal        = $EOperacionesEgresosDolarEfectivo + $EOperacionesEgresosDolarTransferido;

        $ingresosDolar = $arqueoCaja->monto_inicial_dolar + $EVentasDolarTotal + $EOperacionesIngresosDolarTotal;
        $egresosDolar =  $EOperacionesEgresosDolarTotal;

        $montoFinalDolarEfectivo      = ($arqueoCaja->monto_inicial_dolar + $EVentasDolarEfectivo + $EOperacionesIngresosDolarEfectivo) - $EOperacionesEgresosDolarEfectivo;
        $montoFinalDolarTransferido   = ($EVentasDolarTransferido + $EOperacionesIngresosDolarTransferido) - $EOperacionesEgresosDolarTransferido;


        return view('panel.arqueoCaja.cerrarCaja')->with(compact(
            'fecha',
            'arqueoCaja',
            'usuarios',
            'ingresosSol',
            'egresosSol',
            'montoFinalSolEfectivo',
            'montoFinalSolTransferido',
            'ingresosDolar',
            'egresosDolar',
            'montoFinalDolarEfectivo',
            'montoFinalDolarTransferido',
        ));
    }

    public function cerrarStore(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $montoFinalSolEfectivo      = $request->input('montoFinalSolEfectivo',0);
        $montoFinalSolTransferido   = $request->input('montoFinalSolTransferido',0);
        $montoFinalSolFaltante      = $request->input('montoFinalSolFaltante',0);
        $montoFinalSolSobrante      = $request->input('montoFinalSolSobrante',0);
        $montoFinalDolarEfectivo    = $request->input('montoFinalDolarEfectivo',0);
        $montoFinalDolarTransferido = $request->input('montoFinalDolarTransferido',0);
        $montoFinalDolarFaltante    = $request->input('montoFinalDolarFaltante',0);
        $montoFinalDolarSobrante    = $request->input('montoFinalDolarSobrante',0);
        $idsupervisor    = $request->input('idsupervisor',0);

        $montoFinalSol              = $montoFinalSolEfectivo + $montoFinalSolTransferido;
        $montoFinalDolar            = $montoFinalDolarEfectivo + $montoFinalDolarTransferido;
        $fecha                      = now()->format('Y-m-d');

        $arqueoCaja = ArqueoCaja::query()->where('fecha', $fecha )->first();
        $arqueoCaja->monto_final_sol_efectivo      = $montoFinalSolEfectivo;
        $arqueoCaja->monto_final_sol_transferido   = $montoFinalSolTransferido;
        $arqueoCaja->monto_final_sol               = $montoFinalSol;
        $arqueoCaja->monto_final_sol_faltante      = $montoFinalSolFaltante;
        $arqueoCaja->monto_final_sol_sobrante      = $montoFinalSolSobrante;
        $arqueoCaja->monto_final_dolar_efectivo    = $montoFinalDolarEfectivo;
        $arqueoCaja->monto_final_dolar_transferido = $montoFinalDolarTransferido;
        $arqueoCaja->monto_final_dolar             = $montoFinalDolar;
        $arqueoCaja->monto_final_dolar_faltante    = $montoFinalDolarFaltante;
        $arqueoCaja->monto_final_dolar_sobrante    = $montoFinalDolarSobrante;
        $arqueoCaja->idsupervisor                  = $idsupervisor;
        $arqueoCaja->fecha_cierre                  = now()->format('Y-m-d H:i:s');
        $arqueoCaja->update();

        return response()->json([
            'mensaje' => 'La caja se cerro correctamente.'
        ]);
    }

    public function index()
    {

        $registros = ArqueoCaja::query()
            ->orderBy('idarqueo_caja','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.arqueoCaja.index')->with(compact('registros'));

    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');
        $fechaDesde = $request->input('fechaDesde');
        $fechaHasta = $request->input('fechaHasta');

        $registros = ArqueoCaja::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('idarqueo_caja','LIKE','%'.$txtBuscar.'%');
            })
            ->when($fechaDesde, function ($query) use($fechaDesde){
                return $query->whereDate('fecha', '>=', now()->parse($fechaDesde)->format('Y-m-d'));
            })
            ->when($fechaHasta, function ($query) use ($fechaHasta) {
                return $query->whereDate('fecha','<=', now()->parse($fechaHasta)->format('Y-m-d'));
            })
            ->orderBy('idarqueo_caja','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);


        return view('panel.arqueoCaja.listado')->with(compact('registros'))->render();

    }

    public function show(Request $request,$idregistro)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = ArqueoCaja::query()->with(['supervisor'])->find($idregistro);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($registro);

    }

    public function reportePdf(Request $request)
    {
        $txtBuscar = $request->input('txtBuscar');
        $fechaDesde = $request->input('fechaDesde') ?: now()->months(1)->days(1)->format('Y-m-d');
        $fechaHasta = $request->input('fechaHasta') ?: now()->format('Y-m-d');


        $INGRESO_ID = 1;
        $EGRESO_ID = 2;
        $fecha = now()->format('Y-m-d');

        $months = [
            "Enero",
            "Febrero",
            "Marzo",
            "Abril",
            "Mayo",
            "Junio",
            "Julio",
            "Agosto",
            "Septiembre",
            "Octubre",
            "Noviembre",
            "Diciembre",
        ];


        $registros = ArqueoCaja::query()
            ->with([
                'ventas' => function ($query) {
                    return $query->where('estado',1);
                },
                'supervisor'
            ])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('idarqueo_caja','LIKE','%'.$txtBuscar.'%');
            })
            ->whereDate('fecha', '>=', now()->parse($fechaDesde)->format('Y-m-d'))
            ->whereDate('fecha','<=', now()->parse($fechaHasta)->format('Y-m-d'))
            ->orderBy('idarqueo_caja','DESC')
            ->get();

        $operacionesIngresos = ArqueoCajaOperacion::query()
            ->whereDate('fecha', '>=', now()->parse($fechaDesde)->format('Y-m-d'))
            ->whereDate('fecha','<=', now()->parse($fechaHasta)->format('Y-m-d'))
            ->where('idtipo_operacion',$INGRESO_ID)
            ->where('estado',1)
            ->get();

        $operacionesEgresos = ArqueoCajaOperacion::query()
            ->whereDate('fecha', '>=', now()->parse($fechaDesde)->format('Y-m-d'))
            ->whereDate('fecha','<=', now()->parse($fechaHasta)->format('Y-m-d'))
            ->where('idtipo_operacion',$EGRESO_ID)
            ->where('estado',1)
            ->get();


        $pdf = SnappyPdf::loadView('reporte.pdf.arqueoCaja.index', compact( 'fechaDesde', 'fechaHasta', 'registros', 'operacionesIngresos', 'operacionesEgresos'));


        $pdf->setOptions([
            'margin-top' => 5,
            'margin-left' => 5,
            'margin-right' => 5,
            // 'header-html' => view('reporte.pdf.template.cabecera'),
            'footer-center' => '[page]/[toPage]',
            // 'orientation' => 'Landscape'
        ]);

        return $pdf->inline();
    }

}
