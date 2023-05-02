<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExampleController extends Controller
{

    public function index()
    {

        $registros = Example::query()
            ->orderBy('idregistro','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.example.index')->with(compact('registros'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Example::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idregistro','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.example.listado')->with(compact('registros'))->render());

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
            $registro = new Example();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->contenido = $contenido;
            //  if ($request->hasFile('imagen')){
                //  $nameFile = Storage::disk('panel')->putFile('registro',$request->file('imagen'));
                //  $registro->imagen = basename($nameFile);
            //  }
            $registro->estado    = $estado;

            $registro->save();

            foreach ($request->file("imagen",[]) as $key => $img) {
                if ($request->hasFile('imagen.'.$key)){
                    $nameFile = Storage::disk('panel')->putFile('registro',$img);

                    $file             = new ExampleFile();
                    $file->idregistro = $registro->idregistro ;
                    $file->nombre     = basename($nameFile);
                    $file->posicion      = $key+1;
                    $file->save();
                }
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

    public function show(Request $request,$idregistro)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idregistro = $request->input('idregistro');
        $registro = Example::query()->with(["imagenes"])->find($idregistro);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idregistro)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idregistro = $request->input('idregistro');
        $registro = Example::query()->with(["imagenes"])->find($idregistro);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idregistro)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idregistro = $request->input('idregistro');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $contenido  = $request->input('contenidoEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Example::query()->findOrFail($idregistro);

            $registro->nombre    = $nombre ;
            $registro->slug      = $slug ;
            $registro->contenido = $contenido ;
            $registro->estado    = $estado ;
            //  if ($request->hasFile('imagenEditar')){
                //  $nameFile = Storage::disk('panel')->putFile('registro',$request->file('imagenEditar'));
                //  $registro->imagen = basename($nameFile);
            //  }

            $registro->update();


            $maximaPosicion = ExampleFile::query()
                ->where('idregistro',$registro->idregistro)
                ->orderBy('posicion','desc')
                ->max('posicion');

            $maximaPosicion = $maximaPosicion ?: 0;


            foreach ($request->file("imagenEditar",[]) as $key => $img) {
                if ($request->hasFile('imagenEditar.'.$key)){

                    $nameFile = Storage::disk('panel')->putFile('registro',$img);

                    $file             = new ExampleFile();
                    $file->idregistro = $registro->idregistro ;
                    $file->nombre     = basename($nameFile);
                    $file->posicion   = $maximaPosicion + $key + 1;;
                    $file->save();
                }
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


    public function habilitar(Request $request,$idregistro)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idregistro = $request->input('idregistro');

        try {
            $registro = Example::query()->findOrFail($idregistro);
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

    public function inhabilitar(Request $request,$idregistro)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idregistro = $request->input('idregistro');

        try {
            $registro = Example::query()->findOrFail($idregistro);
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

    public function destroy(Request $request,$idregistro)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idregistro = $request->input('idregistro');

        try {
            $registro = Example::query()->findOrFail($idregistro);
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

        $idregistro = Example::query()->max('idregistro');


        foreach ($request->file('imagen', []) as $key => $file) {
            if ($request->hasFile('imagen.' . $key)) {
                $nameFile = Storage::disk('panel')->putFile('example', $file);
                $fileExample = new ExampleFile;
                $fileExample->idregistro = $idregistro;
                $fileExample->nombre = basename($nameFile);
                $fileExample->posicion = $key + 1;
                $fileExample->save();

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

        $idregistro = $request->input('idregistro');
        $registro = Example::query()->find($idregistro);

        if (!$registro){
            return abort(404);
        }

        $maximaPosicion = ExampleFile::query()
            ->where('idregistro',$registro->idregistro)
            ->orderBy('posicion','desc')
            ->max('posicion');

        $maximaPosicion = $maximaPosicion ?: 0;


        foreach ($request->file('imagenEditar',[]) as $key => $img) {
            if ($request->hasFile('imagenEditar.'.$key)){

                $nameFile = Storage::disk('panel')->putFile('example',$img);

                $file             = new ExampleFile();
                $file->idregistro = $registro->idregistro ;
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

            foreach (json_decode($request->stack) as $key => $item) {
                $file = ExampleFile::query()->find($item->key);
                $file->posicion = $key+1;
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

            $file = ExampleFile::query()->findOrFail($request->input('key'));
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
