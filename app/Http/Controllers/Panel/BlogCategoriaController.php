<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\BlogCategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BlogCategoriaController extends Controller
{
    public function index()
    {

        $blogCategoria = DB::table('blog_categoria AS b')
            ->selectRaw('b.*')
            ->orderBy('b.idblog_categoria', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.blogCategoria.index')->with(compact('blogCategoria'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->cantidadRegistros;
        $paginaActual = $request->paginaActual;
        $txtBuscar = trim($request->txtBuscar);

        $blogCategoria = DB::table('blog_categoria AS b')
            ->selectRaw('b.*')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('b.nombre LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('b.idblog_categoria', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.blogCategoria.listado')->with(compact('blogCategoria'))->render());


    }


    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try{

            $blogCategoria = new BlogCategoria();
            $blogCategoria->nombre = $request->input('nombre');
            $blogCategoria->slug = Str::slug($request->input('nombre'));

            $blogCategoria->descripcion = $request->input('descripcion');
            $blogCategoria->estado = $request->input('estado');
            $blogCategoria->save();


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


    public function show(Request $request, $id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = BlogCategoria::query()->find($request->input('idblog_categoria'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }


    public function edit(Request $request, $id)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = BlogCategoria::query()->find($request->input('idblog_categoria'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }


    public function update(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try{

            $blogCategoria = BlogCategoria::query()->findOrFail($request->input('idblog_categoria'));
            $blogCategoria->nombre = $request->input('nombreEditar');
            $blogCategoria->slug = Str::slug($request->input('nombreEditar'));

            $blogCategoria->descripcion = $request->input('descripcionEditar');
            $blogCategoria->estado = $request->input('estadoEditar');
            $blogCategoria->update();


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


    public function habilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {
            $registro = BlogCategoria::query()->findOrFail($request->input('idblog_categoria'));
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

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {
            $registro = BlogCategoria::query()->findOrFail($request->input('idblog_categoria'));
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

    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $registro = BlogCategoria::query()->findOrFail($request->input('idblog_categoria'));
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
