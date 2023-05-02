<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PreguntasFrecuentes;
use Illuminate\Http\Request;

class PreguntaFrecuenteController extends Controller
{

    public function index()
    {

        $preguntas = PreguntasFrecuentes::query()
            ->orderBy('idpregunta_frecuente','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.preguntaFrecuente.index')->with(compact('preguntas'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $preguntas = PreguntasFrecuentes::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('pregunta','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idpregunta_frecuente','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.preguntaFrecuente.listado')->with(compact('preguntas'))->render();

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $pregunta = new PreguntasFrecuentes();
            $pregunta->pregunta    = $request->input('pregunta');
            $pregunta->respuesta = $request->input('respuesta');
            $pregunta->estado    = $request->input('estado');

            $pregunta->save();

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

    public function show(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = PreguntasFrecuentes::query()->find($request->input('idpregunta_frecuente'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        return response()->json($registro);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = PreguntasFrecuentes::query()->find($request->input('idpregunta_frecuente'));

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $pregunta = PreguntasFrecuentes::query()->findOrFail($request->input('idpregunta_frecuente'));

            $pregunta->pregunta    = $request->input('preguntaEditar');
            $pregunta->respuesta = $request->input('respuestaEditar');
            $pregunta->estado    = $request->input('estadoEditar');

            $pregunta->update();

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
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $pregunta = PreguntasFrecuentes::query()->findOrFail($request->input('idpregunta_frecuente'));
            $pregunta->estado    = 1;
            $pregunta->update();

            return response()->json([
                'mensaje'=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo habilitado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $pregunta = PreguntasFrecuentes::query()->findOrFail($request->input('idpregunta_frecuente'));
            $pregunta->estado    = 0;

            $pregunta->update();

            return response()->json([
                'mensaje'=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo inhabilitado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }


    public function destroy(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $pregunta = PreguntasFrecuentes::query()->findOrFail($request->input('idpregunta_frecuente'));
            $pregunta->delete();

            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminado el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }
    }
}
