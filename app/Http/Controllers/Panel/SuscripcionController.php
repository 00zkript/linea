<?php

namespace App\Http\Controllers\Panel;

use App\Exports\Panel\SuscripcionExport;
use App\Http\Controllers\Controller;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class SuscripcionController extends Controller
{
    public function index()
    {

        $suscripciones = Suscripcion::query()
            ->orderBy('idsuscripcion','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.suscripcion.index')->with(compact('suscripciones'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $suscripciones = Suscripcion::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('email','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('idsuscripcion','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idsuscripcion','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.suscripcion.listado')->with(compact('suscripciones'))->render());

    }

    public function downloadExcel(Request $request)
    {
        if (!$request->ajax()) {
            return response()->json("Contenido no disponible", 404);
        }

        // factory(Suscripcion::class,10)->create();

        return Excel::download(new SuscripcionExport(), "reporte_ventas_generado.xlsx");
    }


}
