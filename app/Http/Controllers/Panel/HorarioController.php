<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frecuencia;
use App\Models\Horario;

class HorarioController extends Controller
{


    public function index()
    {

        $frecuencias = Frecuencia::query()->where('estado',1)->get();

        $registros = Horario::query()
            ->with(['frecuencia'])
            ->orderBy('idhorario','DESC')
            ->paginate(10,['*'],'pagina',1);


        return view('panel.horario.index')->with(compact('registros', 'frecuencias'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Horario::query()
            ->with(['frecuencia'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idhorario','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.horario.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $idfrecuencia  = $request->input('idfrecuencia');
        $estado     = $request->input('estado');

        try {
            $registro = new Horario();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->idfrecuencia      = $idfrecuencia;
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

    public function show(Request $request,$idhorario)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idhorario = $request->input('idhorario');
        $registro = Horario::query()->with(['frecuencia'])->find($idhorario);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idhorario)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idhorario = $request->input('idhorario');
        $registro = Horario::query()->find($idhorario);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idhorario)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idhorario = $request->input('idhorario');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $idfrecuencia  = $request->input('idfrecuenciaEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Horario::query()->findOrFail($idhorario);

            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->idfrecuencia      = $idfrecuencia;
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


    public function habilitar(Request $request,$idhorario)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idhorario = $request->input('idhorario');

        try {
            $registro = Horario::query()->findOrFail($idhorario);
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

    public function inhabilitar(Request $request,$idhorario)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idhorario = $request->input('idhorario');

        try {
            $registro = Horario::query()->findOrFail($idhorario);
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

    public function destroy(Request $request,$idhorario)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idhorario = $request->input('idhorario');

        try {
            $registro = Horario::query()->findOrFail($idhorario);
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
