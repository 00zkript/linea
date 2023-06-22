<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Temporada;

class TemporadaController extends Controller
{

    public function index()
    {

        $registros = Temporada::query()
            ->orderBy('idtemporada','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.temporada.index')->with(compact('registros'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Temporada::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idtemporada','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.temporada.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $fechaDesde  = $request->input('fechaDesde');
        $fechaHasta  = $request->input('fechaHasta');
        $estado     = $request->input('estado');

        try {
            $registro = new Temporada();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->fecha_desde      = $fechaDesde;
            $registro->fecha_hasta      = $fechaHasta;
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

    public function show(Request $request,$idtemporada)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idtemporada = $request->input('idtemporada');
        $registro = Temporada::query()->find($idtemporada);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idtemporada)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idtemporada = $request->input('idtemporada');
        $registro = Temporada::query()->find($idtemporada);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idtemporada)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idtemporada = $request->input('idtemporada');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $fechaDesde  = $request->input('fechaDesdeEditar');
        $fechaHasta  = $request->input('fechaHastaEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Temporada::query()->findOrFail($idtemporada);

            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->fecha_desde      = $fechaDesde;
            $registro->fecha_hasta      = $fechaHasta;
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


    public function habilitar(Request $request,$idtemporada)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idtemporada = $request->input('idtemporada');

        try {
            $registro = Temporada::query()->findOrFail($idtemporada);
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

    public function inhabilitar(Request $request,$idtemporada)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idtemporada = $request->input('idtemporada');

        try {
            $registro = Temporada::query()->findOrFail($idtemporada);
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

    public function destroy(Request $request,$idtemporada)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idtemporada = $request->input('idtemporada');

        try {
            $registro = Temporada::query()->findOrFail($idtemporada);
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
