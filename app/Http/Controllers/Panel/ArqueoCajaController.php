<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ArqueoCaja;
use App\Models\ArqueoCajaOperacion;
use App\Models\TipoOperacion;
use App\Models\Venta;
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
        $arqueoCaja->monto_inicial             = number_format($montoInicial,4,'.','');

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

        $sumatoriaMontoTotal = Venta::query()->where('fecha',$fecha)->where('estado',1)->sum('monto_total');
        $sumatoriaOperacionesIngresos = $arqueoCaja->operaciones()->where('idtipo_operacion', $INGRESO_ID)->sum('monto');
        $sumatoriaOperacionesEgresos = $arqueoCaja->operaciones()->where('idtipo_operacion', $EGRESO_ID)->sum('monto');

        $ingresos =  number_format( $arqueoCaja->monto_inicial + $sumatoriaMontoTotal + $sumatoriaOperacionesIngresos, 4, '.', '' );
        $egresos =  number_format( $sumatoriaOperacionesEgresos, 4, '.', '' );

        $montoFinalSolEfectivo      = $arqueoCaja->monto_actual_sol_efectivo + $ingresos;
        $montoFinalSolTransferido   = $arqueoCaja->monto_actual_sol_transferido;
        $montoFinalDolarEfectivo    = $arqueoCaja->monto_actual_dolar_efectivo;
        $montoFinalDolarTransferido = $arqueoCaja->monto_actual_dolar_transferido;


        return view('panel.arqueoCaja.cerrarCaja')->with(compact( 'fecha', 'arqueoCaja', 'ingresos', 'egresos'));
    }

    public function saveCerrar(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $montoFinal = $request->input('montoFinal');
        $fecha      = now()->format('Y-m-d');

        $arqueoCaja = ArqueoCaja::query()->where('fecha', $fecha )->first();
        $arqueoCaja->monto_final = number_format($montoFinal,4,'.','');
        $arqueoCaja->fecha       = $fecha;
        $arqueoCaja->save();

        return response()->json([
            'mensaje' => 'Se agrego el monto final correctamente.'
        ]);
    }

    public function operaciones()
    {
        $tiposDeOperaciones = TipoOperacion::query()->where('estado',1)->get();

        return view('panel.arqueoCaja.operaciones')->with(compact('tiposDeOperaciones'));
    }

    public function saveOperacion(Request $request)
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


        $fecha      = now()->format('Y-m-d');
        $arqueoCaja = ArqueoCaja::query()->where('fecha', $fecha )->first();
        $cambio     = $arqueoCaja->monto_cambio_moneda ?: 1;
        $final      = $montoSolEfectivo + $montoSolTransferido + (($montoDolarEfectivo + $montoDolarTransferido) * $cambio);


        $operacion = new ArqueoCajaOperacion();
        $operacion->idarqueo_caja           = $arqueoCaja->idarqueo_caja;
        $operacion->idusuario               = auth()->id();
        $operacion->idtipo_operacion        = $tipoOperacion;
        $operacion->fecha                   = $fecha;
        $operacion->descripcion             = $descripcion;
        $operacion->monto_sol_efectivo      = number_format($montoSolEfectivo,4,'.','');
        $operacion->monto_sol_transferido   = number_format($montoSolTransferido,4,'.','');
        $operacion->monto_dolar_efectivo    = number_format($montoDolarEfectivo,4,'.','');
        $operacion->monto_dolar_transferido = number_format($montoDolarTransferido,4,'.','');
        $operacion->monto                   = number_format($final,4,'.','');
        $operacion->save();


        return response()->json([
            'mensaje' => 'La operación se guardó con éxito'
        ]);
    }


}
