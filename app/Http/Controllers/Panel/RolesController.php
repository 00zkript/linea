<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function index()
    {

        $registros = Role::query()->orderBy('id','desc')->paginate(10);

        return view('panel.roles.index')->with(compact('registros'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Role::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('id','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.roles.listado')->with(compact('registros'))->render();

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $contenido  = $request->input('contenido');
        $estado     = $request->input('estado');

        try {
            $registro = new Role();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->contenido = $contenido;
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

    public function show(Request $request,$id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $id = $request->input('id');
        $registro = Role::query()->with(["imagenes"])->find($id);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $id = $request->input('id');
        $registro = Role::query()->with(["imagenes"])->find($id);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $id = $request->input('id');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $contenido  = $request->input('contenidoEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Role::query()->findOrFail($id);

            $registro->nombre    = $nombre ;
            $registro->slug      = $slug ;
            $registro->contenido = $contenido ;
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


    public function habilitar(Request $request,$id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $id = $request->input('id');

        try {
            $registro = Role::query()->findOrFail($id);
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

    public function inhabilitar(Request $request,$id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $id = $request->input('id');

        try {
            $registro = Role::query()->findOrFail($id);
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

    public function destroy(Request $request,$id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $id = $request->input('id');

        try {
            $registro = Role::query()->findOrFail($id);
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
