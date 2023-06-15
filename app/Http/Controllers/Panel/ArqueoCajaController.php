<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ArqueoCaja;
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

        $sucursal = auth()->user()->sucursal;


        $arqueoCaja = ArqueoCaja::firstOrNew([ 'fecha' => $fecha ]);

        $arqueoCaja->idsucursal          = $sucursal->idsucursal;
        $arqueoCaja->monto_inicial_sol   = number_format($montoInicialSol,4,'.','');
        $arqueoCaja->monto_inicial_dolar = number_format($montoInicialDolar,4,'.','');
        $arqueoCaja->monto_cambio_moneda = number_format($cambioMoneda,4,'.','');
        $arqueoCaja->monto_inicial       = number_format($montoInicialSol + $montoInicialDolar,4,'.','');
        $arqueoCaja->fecha               = $fecha;
        $arqueoCaja->save();

        return response()->json([
            'mensaje' => 'Se agrego correctamente.'
        ]);
    }

}
