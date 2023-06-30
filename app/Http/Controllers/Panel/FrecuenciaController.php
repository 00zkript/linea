<?php

namespace App\Http\Controllers\Panel;

use App\Models\Frecuencia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Carril;
use App\Models\CarrilHasFrecuencia;

class FrecuenciaController extends Controller
{


    public function index()
    {

        $carriles = Carril::query()->where('estado',1)->get();

        $registros = Frecuencia::query()
            ->orderBy('idfrecuencia','DESC')
            ->paginate(10,['*'],'pagina',1);


        return view('panel.frecuencia.index')->with(compact('registros', 'carriles'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Frecuencia::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idfrecuencia','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.frecuencia.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $carriles  = $request->input('idcarril',[]);
        $dias  = $request->input('dias',[]);
        $estado     = $request->input('estado');

        try {
            $registro = new Frecuencia();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->dias      = implode('-',$dias);
            $registro->estado    = $estado;
            $registro->save();

            foreach ($carriles as $idcarril) {
                $pivot = new CarrilHasFrecuencia();
                $pivot->idcarril = $idcarril;
                $pivot->idfrecuencia = $registro->idfrecuencia;
                $pivot->save();
            }


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

    public function show(Request $request,$idfrecuencia)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idfrecuencia = $request->input('idfrecuencia');
        $registro = Frecuencia::query()->with(['carriles.nivel.programa'])->find($idfrecuencia);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idfrecuencia)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idfrecuencia = $request->input('idfrecuencia');
        $registro = Frecuencia::query()->with(['carrilesPivot'])->find($idfrecuencia);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idfrecuencia)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idfrecuencia = $request->input('idfrecuencia');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $carriles  = $request->input('idcarrilEditar',[]);
        $dias  = $request->input('diasEditar',[]);
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Frecuencia::query()->findOrFail($idfrecuencia);

            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->dias      = implode('-',$dias);
            $registro->estado    = $estado;
            $registro->update();

            CarrilHasFrecuencia::query()->where('idfrecuencia',$registro->idfrecuencia)->delete();
            foreach ($carriles as $idcarril) {
                $pivot = new CarrilHasFrecuencia();
                $pivot->idcarril = $idcarril;
                $pivot->idfrecuencia = $registro->idfrecuencia;
                $pivot->save();
            }

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


    public function habilitar(Request $request,$idfrecuencia)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idfrecuencia = $request->input('idfrecuencia');

        try {
            $registro = Frecuencia::query()->findOrFail($idfrecuencia);
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

    public function inhabilitar(Request $request,$idfrecuencia)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idfrecuencia = $request->input('idfrecuencia');

        try {
            $registro = Frecuencia::query()->findOrFail($idfrecuencia);
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

    public function destroy(Request $request,$idfrecuencia)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idfrecuencia = $request->input('idfrecuencia');

        try {
            $registro = Frecuencia::query()->findOrFail($idfrecuencia);
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
