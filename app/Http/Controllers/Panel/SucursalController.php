<?php

namespace App\Http\Controllers\Panel;

use App\Models\Sucursal;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;

class SucursalController extends Controller
{

    public function index()
    {

        $departamentos = Departamento::query()->get();

        $registros = Sucursal::query()
            ->orderBy('idsucursal','DESC')
            ->paginate(10,['*'],'pagina',1);




        return view('panel.sucursal.index')->with(compact('registros','departamentos'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Sucursal::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombre','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idsucursal','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.sucursal.listado')->with(compact('registros'))->render();

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        $nombre          = $request->input('nombre');
        $descripcion     = $request->input('descripcion');
        $contenido       = $request->input('contenido');
        $departamento    = $request->input('departamento');
        $provincia       = $request->input('provincia');
        $distrito        = $request->input('distrito');
        $direccion       = $request->input('direccion');
        $horarioAtencion = $request->input('horarioAtencion');
        $estado          = $request->input('estado');

        try {
            $registro = new Sucursal();
            $registro->nombre           = $nombre;
            $registro->descripcion      = $descripcion;
            $registro->contenido        = $contenido;
            $registro->iddepartamento   = $departamento;
            $registro->idprovincia      = $provincia;
            $registro->iddistrito       = $distrito;
            $registro->direccion        = $direccion;
            $registro->horario_atencion = $horarioAtencion;
            $registro->estado           = $estado;
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

    public function show(Request $request,$idsucursal)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = Sucursal::query()->with(['departamento','provincia','distrito'])->find($idsucursal);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function edit(Request $request,$idsucursal)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $registro = Sucursal::query()->find($idsucursal);

        if(!$registro){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($registro);

    }

    public function update(Request $request,$idsucursal)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $nombre          = $request->input('nombreEditar');
        $descripcion     = $request->input('descripcionEditar');
        $contenido       = $request->input('contenidoEditar');
        $departamento    = $request->input('departamentoEditar');
        $provincia       = $request->input('provinciaEditar');
        $distrito        = $request->input('distritoEditar');
        $direccion       = $request->input('direccionEditar');
        $horarioAtencion = $request->input('horarioAtencionEditar');
        $estado          = $request->input('estadoEditar');

        try {
            $registro = Sucursal::query()->findOrFail($idsucursal);
            $registro->nombre           = $nombre;
            $registro->descripcion      = $descripcion;
            $registro->contenido        = $contenido;
            $registro->iddepartamento   = $departamento;
            $registro->idprovincia      = $provincia;
            $registro->iddistrito       = $distrito;
            $registro->direccion        = $direccion;
            $registro->horario_atencion = $horarioAtencion;
            $registro->estado           = $estado;
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


    public function habilitar(Request $request,$idsucursal)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        try {
            $registro = Sucursal::query()->findOrFail($idsucursal);
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

    public function inhabilitar(Request $request,$idsucursal)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        try {
            $registro = Sucursal::query()->findOrFail($idsucursal);
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

    public function destroy(Request $request,$idsucursal)
    {
        if (!$request->ajax()){
            return abort(404);
        }


        try {
            $registro = Sucursal::query()->findOrFail($idsucursal);
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

    public function ubigeo(Request $request)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $case = $request->input('case','departamentos');
        $iddepartamento = $request->input('iddepartamento');
        $idprovincia = $request->input('idprovincia');
        $data = [];

        if ($case === 'provincias' ) {
            $data = Provincia::query()->where('iddepartamento',$iddepartamento)->get();
        }

        if ($case === 'distritos' ) {
            $data = Distrito::query()->where('idprovincia',$idprovincia)->get();
        }

        return response()->json($data);
    }


}
