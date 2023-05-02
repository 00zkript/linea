<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Moneda;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MonedaController extends Controller
{

    public function index()
    {

        $monedas = Moneda::query()
            ->orderBy('idmoneda','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.moneda.index')->with(compact('monedas'));


    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $monedas = Moneda::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idmoneda','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.moneda.listado')->with(compact('monedas'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $nombre  = $request->input('nombre');
        $moneda  = $request->input('moneda');
        $simbolo = $request->input('simbolo');
        $posicion = $request->input('posicion');
        $cambio = $request->input('cambio');
        $estado  = $request->input('estado');


        try {
            $money = new Moneda();
            $money->nombre      = $nombre;
            $money->moneda      = $moneda;
            $money->simbolo    = $simbolo;
            $money->simbolo_posicion    = $posicion;
            $money->cambio    = $cambio;
            $money->estado      = $estado;
            $money->save();

            return response()->json([
                'mensaje'=> "Registro creado exitosamente.",
            ]);


        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo crear el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }



    }

    public function show(Request $request,$idmoneda)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $money = Moneda::query()->find($idmoneda);

        if(!$money){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($money);

    }

    public function edit(Request $request,$idmoneda)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $money = Moneda::query()->find($idmoneda);

        if(!$money){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($money);

    }

    public function update(Request $request,$idmoneda)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $nombre   = $request->input('nombreEditar');
        $moneda   = $request->input('monedaEditar');
        $simbolo  = $request->input('simboloEditar');
        $posicion  = $request->input('posicionEditar');
        $cambio = $request->input('cambioEditar');
        $estado   = $request->input('estadoEditar');


        try {
            $money = Moneda::query()->findOrFail($idmoneda);
            $money->nombre      = $nombre;
            $money->moneda      = $moneda;
            $money->simbolo    = $simbolo;
            $money->simbolo_posicion    = $posicion;
            $money->cambio     = $cambio;
            $money->estado      = $estado;
            $money->update();



            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo actualizar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }



    }


    public function habilitar(Request $request,$idmoneda)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $money = Moneda::query()->findOrFail($idmoneda);
            $money->estado    = 1;
            $money->update();

            return response()->json([
                'mensaje'=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo habilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }

    public function inhabilitar(Request $request,$idmoneda)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        try {
            $money = Moneda::query()->findOrFail($idmoneda);
            $money->estado    = 0;

            $money->update();

            return response()->json([
                'mensaje'=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo inhabilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }

    public function destroy(Request $request,$idmoneda)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        if (in_array($idmoneda,[1,2])){
            return response()->json([
                'mensaje'=> "No se puede eliminar este registro.",
            ],400);
        }

        try {
            $money = Moneda::query()->findOrFail($idmoneda);
            $money->delete();

            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }


}
