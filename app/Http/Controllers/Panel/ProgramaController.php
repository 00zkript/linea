<?php

namespace App\Http\Controllers\Panel;

use App\Models\Programa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Temporada;

class ProgramaController extends Controller
{


    public function index()
    {


        $registros = Programa::query()
            ->orderBy('idprograma','DESC')
            ->paginate(10,['*'],'pagina',1);



        return view('panel.programa.index')->with(compact('registros'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Programa::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idprograma','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.programa.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $posicion     = $request->input('posicion');
        $estado     = $request->input('estado');

        try {
            $registro = new Programa();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->posicion      = $posicion;
            $registro->estado    = $estado;
            $registro->save();


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

    public function show(Request $request,$idprograma)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idprograma = $request->input('idprograma');
        $registro = Programa::query()->find($idprograma);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idprograma)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idprograma = $request->input('idprograma');
        $registro = Programa::query()->find($idprograma);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idprograma)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idprograma = $request->input('idprograma');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $posicion     = $request->input('posicionEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Programa::query()->findOrFail($idprograma);

            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->posicion      = $posicion;
            $registro->estado    = $estado;
            $registro->update();

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


    public function habilitar(Request $request,$idprograma)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idprograma = $request->input('idprograma');

        try {
            $registro = Programa::query()->findOrFail($idprograma);
            $registro->estado    = 1;
            $registro->update();

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

    public function inhabilitar(Request $request,$idprograma)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idprograma = $request->input('idprograma');

        try {
            $registro = Programa::query()->findOrFail($idprograma);
            $registro->estado    = 0;

            $registro->update();

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

    public function destroy(Request $request,$idprograma)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idprograma = $request->input('idprograma');

        try {
            $registro = Programa::query()->findOrFail($idprograma);
            $registro->delete();

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

    public function posicionMaxima(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $posicionMaxima = Programa::query()->count('idprograma');

        return response()->json([
            "posicion_maxima" => $posicionMaxima +1
        ]);
    }




}
