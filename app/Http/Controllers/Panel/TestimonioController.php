<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Testimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TestimonioController extends Controller
{

    public function index()
    {

        $registros = Testimonio::query()
            ->orderBy('idtestimonio','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.testimonio.index')->with(compact('registros'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Testimonio::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idtestimonio','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.testimonio.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $testimonio  = $request->input('testimonio');
        $estado     = $request->input('estado');

        try {
            $registro = new Testimonio();
            $registro->nombre    = $nombre;
            $registro->testimonio = $testimonio;
            if ($request->hasFile('avatar')){
                $nameFile = Storage::disk('panel')->putFile('testimonio',$request->file('avatar'));
                $registro->avatar = basename($nameFile);
            }
             if ($request->hasFile('imagen')){
                 $nameFile = Storage::disk('panel')->putFile('testimonio',$request->file('imagen'));
                 $registro->imagen = basename($nameFile);
             }
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

    public function show(Request $request,$idtestimonio)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idtestimonio = $request->input('idtestimonio');
        $registro = Testimonio::query()->find($idtestimonio);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idtestimonio)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idtestimonio = $request->input('idtestimonio');
        $registro = Testimonio::query()->find($idtestimonio);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idtestimonio)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idtestimonio = $request->input('idtestimonio');
        $nombre     = $request->input('nombreEditar');
        $testimonio  = $request->input('testimonioEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Testimonio::query()->findOrFail($idtestimonio);

            $registro->nombre    = $nombre ;
            $registro->testimonio = $testimonio ;
            $registro->estado    = $estado ;
            if ($request->hasFile('avatarEditar')){
                $nameFile = Storage::disk('panel')->putFile('testimonio',$request->file('avatarEditar'));
                $registro->avatar = basename($nameFile);
            }
             if ($request->hasFile('imagenEditar')){
                 $nameFile = Storage::disk('panel')->putFile('testimonio',$request->file('imagenEditar'));
                 $registro->imagen = basename($nameFile);
             }

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


    public function habilitar(Request $request,$idtestimonio)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idtestimonio = $request->input('idtestimonio');

        try {
            $registro = Testimonio::query()->findOrFail($idtestimonio);
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

    public function inhabilitar(Request $request,$idtestimonio)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idtestimonio = $request->input('idtestimonio');

        try {
            $registro = Testimonio::query()->findOrFail($idtestimonio);
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

    public function destroy(Request $request,$idtestimonio)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idtestimonio = $request->input('idtestimonio');

        try {
            $registro = Testimonio::query()->findOrFail($idtestimonio);
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
