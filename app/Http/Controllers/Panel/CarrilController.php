<?php

namespace App\Http\Controllers\Panel;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Carril;
use App\Models\Nivel;

class CarrilController extends Controller
{


    public function index()
    {

        $niveles = Nivel::query()->with(['programa'])->where('estado',1)->get();

        $registros = Carril::query()
            ->with(['nivel.programa'])
            ->orderBy('idcarril','DESC')
            ->paginate(10,['*'],'pagina',1);


        return view('panel.carril.index')->with(compact('registros', 'niveles'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Carril::query()
            ->with(['nivel.programa'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idcarril','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return response()->json(view('panel.carril.listado')->with(compact('registros'))->render());

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $validator = $request->validate([
            'nombre' => 'required|unique:carril,nombre',
        ]);


        $nombre     = $request->input('nombre');
        $slug       = Str::slug($nombre);
        $idnivel  = $request->input('idnivel');
        $estado     = $request->input('estado');

        try {
            $registro = new Carril();
            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->idnivel      = $idnivel;
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

    public function show(Request $request,$idcarril)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcarril = $request->input('idcarril');
        $registro = Carril::query()->with(['nivel.programa'])->find($idcarril);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idcarril)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcarril = $request->input('idcarril');
        $registro = Carril::query()->find($idcarril);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idcarril)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $validator = $request->validate(
            [ 'nombreEditar' => 'required|unique:carril,nombre,'.$idcarril.',idcarril', ],
            [],
            [ 'nombreEditar' => 'nombre' ]
        );

        // $idcarril = $request->input('idcarril');
        $nombre     = $request->input('nombreEditar');
        $slug       = Str::slug($request->input('nombreEditar'));
        $idnivel  = $request->input('idnivelEditar');
        $estado     = $request->input('estadoEditar');

        try {
            $registro = Carril::query()->findOrFail($idcarril);

            $registro->nombre    = $nombre;
            $registro->slug      = $slug;
            $registro->idnivel      = $idnivel;
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


    public function habilitar(Request $request,$idcarril)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcarril = $request->input('idcarril');

        try {
            $registro = Carril::query()->findOrFail($idcarril);
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

    public function inhabilitar(Request $request,$idcarril)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcarril = $request->input('idcarril');

        try {
            $registro = Carril::query()->findOrFail($idcarril);
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

    public function destroy(Request $request,$idcarril)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        // $idcarril = $request->input('idcarril');

        try {
            $registro = Carril::query()->findOrFail($idcarril);
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
