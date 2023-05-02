<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Atributo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AtributoController extends Controller
{

    public function index()
    {

        $registros = Atributo::query()
            ->orderBy('idatributo','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.atributo.index')->with(compact('registros'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Atributo::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idatributo','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.atributo.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $estado     = $request->input('estado');

        try {
            $registro = new Atributo();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
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

    public function show(Request $request,$idatributo)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idatributo = $request->input('idatributo');
        $registro = Atributo::query()->find($idatributo);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idatributo)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idatributo = $request->input('idatributo');
        $registro = Atributo::query()->find($idatributo);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idatributo)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idatributo = $request->input('idatributo');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $contenido  = $request->input('contenidoEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Atributo::query()->findOrFail($idatributo);

            $registro->nombre    = $nombre ;
            $registro->slug      = $slug ;
            $registro->estado    = $estado ;
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


    public function habilitar(Request $request,$idatributo)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idatributo = $request->input('idatributo');

        try {
            $registro = Atributo::query()->findOrFail($idatributo);
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

    public function inhabilitar(Request $request,$idatributo)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idatributo = $request->input('idatributo');

        try {
            $registro = Atributo::query()->findOrFail($idatributo);
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

    public function destroy(Request $request,$idatributo)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idatributo = $request->input('idatributo');

        try {
            $registro = Atributo::query()->findOrFail($idatributo);
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




}
