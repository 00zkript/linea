<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class InicioController extends Controller
{

    public function index()
    {
        return view("panel.inicio.index");
    }

    public function getproductMostSelled(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $product = DB::table('venta')
            ->select([
                'venta_detalle.idproducto',
                'producto.nombre',
                DB::raw('SUM(venta_detalle.cantidad) as cantidad'),
            ])
            ->leftJoin('venta_detalle', 'venta_detalle.idventa', '=', 'venta.idventa')
            ->leftJoin('producto', 'producto.idproducto', '=', 'venta_detalle.idproducto')
            ->where('venta.estado',  1)
            ->where('venta.pago_idestado_pago',  1)
            ->where('venta_detalle.cantidad', '>', 0)
            ->whereBetween('venta.fecha_venta', [now()->subMonths(3)->day(1)->format('Y-m-d')  , now()->format('Y-m-d')])
            ->groupBy('idproducto')
            ->orderByDesc(DB::raw('SUM(venta_detalle.cantidad)'))
            ->take(10)
            ->get();


        return response()->json($product);
    }


    public function getSalesForYearVsYearOld(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $thisYear           = now()->year;
        $lastYear           = $thisYear - 1;
        $thisMonth          = now()->month;
        $lastMonth          = $thisMonth - 1 ;
        $salesThisYear      = [];
        $salesLastYear      = [];
        $rateMax            = 0;
        $rateMin            = 0;
        $totalSalesThisYear = 0;

        for ($month = 1; $month <= 12; $month++){

            $totalOld = $this->_getSales($lastYear,$month);
            $salesLastYear[] = $totalOld;


            $totalCurrent = $this->_getSales($thisYear,$month);
            $salesThisYear[] =  $totalCurrent;
            $totalSalesThisYear += $totalCurrent;

            if ($month == $lastMonth){
                $rateMin = $totalCurrent;
            }

            if  ($month == $thisMonth ){
                $rateMax = $totalCurrent;
            }


        }




        $rate = 0;
        if ($rateMax > 0 && $rateMin > 0) {
            $rate = $rateMax / $rateMin;
        }


        return response()->json([
            "salesThisYear" => $salesThisYear,
            "salesLastYear" => $salesLastYear,
            "totalSalesThisYear" => $totalSalesThisYear,
            "rate" => number_format($rate, 2, '.', ',')
        ]);

    }

    private function _getSales( $year, $month = null, $day = null)
    {
        return DB::table('venta')
            ->where('venta.estado',  1)
            ->where('venta.pago_idestado_pago',  1)
            ->whereYear('venta.fecha_venta', $year)
            ->when(!empty($month),function ($query) use ($month){
                $query->whereMonth('venta.fecha_venta', $month);
            })
            ->when(!empty($day),function ($query) use ($day){
                $query->whereDay('venta.fecha_venta', $day);
            })
            ->sum('venta.total');
    }


    public function salesForMonth(Request $request)
    {

        if (!$request->ajax()){
            return abort(404);
        }


        $year = now()->year;
        $month = now()->month;
        $days = [];
        $sales = [];

        $maxDay = now()->day;

        for ($day = 1; $day <= $maxDay ; $day++){

            $days[] = $day;
            $sales[] = $this->_getSales($year, $month, $day);

        }

        return response()->json([
            "year" => $year,
            "month" => now()->monthName,
            "days" => $days,
            "sales" => $sales
        ]);
    }

}
