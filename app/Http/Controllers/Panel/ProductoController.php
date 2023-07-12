<?php

namespace App\Http\Controllers\Panel;

use App\Models\Producto;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductoImagen;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{

    public function index()
    {

        $registros = Producto::query()
            ->orderBy('idproducto','DESC')
            ->paginate(10,['*'],'pagina',1);

        return view('panel.producto.index')->with(compact('registros'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Producto::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idproducto','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.producto.listado')->with(compact('registros'))->render();

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $descripcion  = $request->input('descripcion');
        $stock  = $request->input('stock');
        $precio  = $request->input('precio');
        $estado     = $request->input('estado');

        try {
            $registro = new Producto();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->descripcion = $descripcion;
            $registro->stock = $stock;
            $registro->precio = $precio;
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

    public function show(Request $request,$idproducto)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = Producto::query()->with(["imagenes"])->find($idproducto);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idproducto)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = Producto::query()->with(["imagenes"])->find($idproducto);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idproducto)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $descripcion  = $request->input('descripcionEditar');
        $stock  = $request->input('stockEditar');
        $precio  = $request->input('precioEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Producto::query()->findOrFail($idproducto);

            $registro->nombre    = $nombre ;
            $registro->slug      = $slug ;
            $registro->descripcion = $descripcion ;
            $registro->stock = $stock ;
            $registro->precio = $precio ;
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


    public function habilitar(Request $request,$idproducto)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        try {
            $registro = Producto::query()->findOrFail($idproducto);
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

    public function inhabilitar(Request $request,$idproducto)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        try {
            $registro = Producto::query()->findOrFail($idproducto);
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

    public function destroy(Request $request,$idproducto)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        try {
            $registro = Producto::query()->findOrFail($idproducto);
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



    public function fileStore(Request $request)
    {
        if(!$request->ajax()){
            return abort(404);
        }

        $idproducto = Producto::query()->max('idproducto');


        foreach ($request->file('imagen', []) as $key => $file) {
            if ($request->hasFile('imagen.' . $key)) {
                $nameFile = Storage::disk('panel')->putFile('producto', $file);
                $fileProducto = new ProductoImagen();
                $fileProducto->idproducto = $idproducto;
                $fileProducto->nombre = basename($nameFile);
                $fileProducto->posicion = $key + 1;
                $fileProducto->save();

            }
        }


        return response()->json([
            "mensaje" => "imagen agregados",
        ]);
    }

    public function fileUpdate(Request $request)
    {
        if(!$request->ajax()){
            return abort(404);
        }

        $idproducto = $request->input('idproducto');
        $registro = Producto::query()->find($idproducto);

        if (!$registro){
            return abort(404);
        }

        $maximaPosicion = ProductoImagen::query()
            ->where('idproducto',$registro->idproducto)
            ->orderBy('posicion','desc')
            ->max('posicion');

        $maximaPosicion = $maximaPosicion ?: 0;


        foreach ($request->file('imagenEditar',[]) as $key => $img) {
            if ($request->hasFile('imagenEditar.'.$key)){

                $nameFile = Storage::disk('panel')->putFile('producto',$img);

                $file             = new ProductoImagen();
                $file->idproducto = $registro->idproducto ;
                $file->nombre     = basename($nameFile);
                $file->posicion   = $maximaPosicion + $key + 1;;
                $file->save();
            }
        }

        return response()->json([
            "mensaje" => "imagen agregados",
        ]);

    }

    public function fileSort(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $filesIDS = $request->input('files_ids', []);

            foreach ($filesIDS as $i => $fileID) {
                $file = ProductoImagen::query()->find($fileID);
                $file->posicion = $i+1;
                $file->update();
            }

            return response()->json([
                'mensaje'=> "Orden modificado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo modificar el orden.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }

    public function fileDestroy(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {

            $file = ProductoImagen::query()->findOrFail($request->input('key'));
            $file->delete();

            return response()->json([
                'mensaje'=> "Archivo eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar el archivo.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }



}
