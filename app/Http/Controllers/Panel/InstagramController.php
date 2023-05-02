<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Instagram;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstagramController extends Controller
{

    public function index()
    {

        $registros = Instagram::query()
            ->orderBy('idinstagram','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.instagram.index')->with(compact('registros'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Instagram::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idinstagram','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.instagram.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre     = $request->input('nombre');
        $link  = $request->input('link');
        $estado     = $request->input('estado');

        try {
            $instagram = new Instagram();
            $instagram->nombre    = $nombre;
            $instagram->link = $link;
            if ($request->hasFile('imagen')){
                $nameFile = Storage::disk('panel')->putFile('instagram',$request->file('imagen'));
                $instagram->imagen = basename($nameFile);
            }
            $instagram->estado    = $estado;

            $instagram->save();


            return response()->json([
                'mensaje'=> "Registro creado exitosamente.",
            ]);


        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo crear el instagram.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }



    }

    public function show(Request $request,$idinstagram)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idinstagram = $request->input('idinstagram');
        $instagram = Instagram::query()->find($idinstagram);

        if(!$instagram){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($instagram);

    }

    public function edit(Request $request,$idinstagram)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idinstagram = $request->input('idinstagram');
        $instagram = Instagram::query()->find($idinstagram);

        if(!$instagram){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($instagram);

    }

    public function update(Request $request,$idinstagram)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idinstagram = $request->input('idinstagram');
        $nombre     = $request->input('nombreEditar');
        $link     = $request->input('linkEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $instagram = Instagram::query()->findOrFail($idinstagram);

            $instagram->nombre    = $nombre ;
            $instagram->link    = $link ;
            $instagram->estado    = $estado ;
            if ($request->hasFile('imagenEditar')){
                $nameFile = Storage::disk('panel')->putFile('instagram',$request->file('imagenEditar'));
                $instagram->imagen = basename($nameFile);
            }

            $instagram->update();

            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo actualizar el instagram.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }



    }


    public function habilitar(Request $request,$idinstagram)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idinstagram = $request->input('idinstagram');

        try {
            $instagram = Instagram::query()->findOrFail($idinstagram);
            $instagram->estado    = 1;
            $instagram->update();

            return response()->json([
                'mensaje'=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo habilitar el instagram.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }

    public function inhabilitar(Request $request,$idinstagram)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idinstagram = $request->input('idinstagram');

        try {
            $instagram = Instagram::query()->findOrFail($idinstagram);
            $instagram->estado    = 0;

            $instagram->update();

            return response()->json([
                'mensaje'=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo inhabilitar el instagram.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }

    public function destroy(Request $request,$idinstagram)
    {
        if (!$request->ajax()){
            return abort(404);
        }

//        $idinstagram = $request->input('idinstagram');

        try {
            $instagram = Instagram::query()->findOrFail($idinstagram);
            $instagram->delete();

            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar el instagram.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }





}
