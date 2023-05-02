<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SectionController extends Controller
{

    public function index()
    {

        $sections = Section::query()
            ->orderBy('idsection','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.section.index')->with(compact('sections'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $sections = Section::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idsection','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.section.listado')->with(compact('sections'))->render();

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
            $registro = new Section();
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

    public function show(Request $request,$idsection)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection = $request->input('idsection');
        $registro = Section::query()->find($idsection);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idsection)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection = $request->input('idsection');
        $registro = Section::query()->find($idsection);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idsection)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection = $request->input('idsection');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $contenido  = $request->input('contenidoEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Section::query()->findOrFail($idsection);

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


    public function habilitar(Request $request,$idsection)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection = $request->input('idsection');

        try {
            $registro = Section::query()->findOrFail($idsection);
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

    public function inhabilitar(Request $request,$idsection)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection = $request->input('idsection');

        try {
            $registro = Section::query()->findOrFail($idsection);
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

    public function destroy(Request $request,$idsection)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idsection = $request->input('idsection');

        try {
            $registro = Section::query()->findOrFail($idsection);
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


    public function getCountSection(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $count = Section::query()->where('estado',1)->count();
        return response()->json([
            'count' => $count+1,
        ]);
    }



}
