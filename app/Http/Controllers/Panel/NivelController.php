<?php

namespace App\Http\Controllers\Panel;

use App\Models\Nivel;
use App\Models\Programa;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NivelController extends Controller
{


    public function index()
    {

        $registros = Nivel::query()
            ->orderBy('idnivel','DESC')
            ->paginate(10,['*'],'pagina',1);


        return view('panel.nivel.index')->with(compact('registros'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Nivel::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idnivel','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.nivel.listado')->with(compact('registros'))->render());

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
            $registro = new Nivel();
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

    public function show(Request $request,$idnivel)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idnivel = $request->input('idnivel');
        $registro = Nivel::query()->find($idnivel);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idnivel)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idnivel = $request->input('idnivel');
        $registro = Nivel::query()->find($idnivel);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idnivel)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idnivel = $request->input('idnivel');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Nivel::query()->findOrFail($idnivel);

            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
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


    public function habilitar(Request $request,$idnivel)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idnivel = $request->input('idnivel');

        try {
            $registro = Nivel::query()->findOrFail($idnivel);
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

    public function inhabilitar(Request $request,$idnivel)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idnivel = $request->input('idnivel');

        try {
            $registro = Nivel::query()->findOrFail($idnivel);
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

    public function destroy(Request $request,$idnivel)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idnivel = $request->input('idnivel');

        try {
            $registro = Nivel::query()->findOrFail($idnivel);
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
