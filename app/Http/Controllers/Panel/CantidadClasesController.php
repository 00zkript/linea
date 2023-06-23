<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\CantidadClases;
use App\Http\Controllers\Controller;

class CantidadClasesController extends Controller
{


    public function index()
    {

        $registros = CantidadClases::query()
            ->orderBy('idcantidad_clases','DESC')
            ->paginate(10,['*'],'pagina',1);


        return view('panel.cantidadClases.index')->with(compact('registros'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = CantidadClases::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idcantidad_clases','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.cantidadClases.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $cantidad     = $request->input('cantidad');
        $precio     = $request->input('precio');
        $estado     = $request->input('estado');

        try {
            $registro = new CantidadClases();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->cantidad      = $cantidad;
            $registro->precio      = $precio;
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

    public function show(Request $request,$idcantidadClases)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcantidadClases = $request->input('idcantidad_clases');
        $registro = CantidadClases::query()->find($idcantidadClases);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idcantidadClases)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcantidadClases = $request->input('idcantidad_clases');
        $registro = CantidadClases::query()->find($idcantidadClases);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idcantidadClases)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcantidadClases = $request->input('idcantidad_clases');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $cantidad     = $request->input('cantidadEditar');
        $precio     = $request->input('precioEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = CantidadClases::query()->findOrFail($idcantidadClases);

            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->cantidad    = $cantidad;
            $registro->precio    = $precio;
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


    public function habilitar(Request $request,$idcantidadClases)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcantidadClases = $request->input('idcantidad_clases');

        try {
            $registro = CantidadClases::query()->findOrFail($idcantidadClases);
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

    public function inhabilitar(Request $request,$idcantidadClases)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcantidadClases = $request->input('idcantidad_clases');

        try {
            $registro = CantidadClases::query()->findOrFail($idcantidadClases);
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

    public function destroy(Request $request,$idcantidadClases)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcantidadClases = $request->input('idcantidad_clases');

        try {
            $registro = CantidadClases::query()->findOrFail($idcantidadClases);
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
