<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\TipoDocumentoIdentidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::query()
            ->orderBy('idcliente','DESC')
            ->paginate(10,['*'],'pagina',1);

        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();


        return view('panel.cliente.index')->with(compact('clientes','tipoDocumentoIdentidad'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $clientes = Cliente::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombres','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idcliente','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.cliente.listado')->with(compact('clientes'))->render();

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {

            // $usuario            = new User();
            // $usuario->idrol     = 2;
            // $usuario->usuario   = $request->input('nombres');
            // $usuario->nombres   = $request->input('nombres');
            // $usuario->apellidos = $request->input('apellidos');
            // $usuario->correo = $request->input('correo');
            // $usuario->clave     = encrypt(random_int(10000, 99999));
            // $usuario->estado = $request->input('estado');
            // $usuario->save();



            $cliente = new Cliente();
            // $cliente->idusuario = $usuario->idusuario;
            $cliente->nombres   = $request->input('nombres');
            $cliente->apellidos = $request->input('apellidos');
            $cliente->correo    = $request->input('correo');
            $cliente->idtipo_documento_identidad    = $request->input('tipoDocumentoIdentidad');
            $cliente->numero_documento_identidad    = $request->input('numeroDocumentoIdentidad');
            $cliente->telefono    = $request->input('telefono');
            $cliente->fecha_creacion = now()->format('Y-m-d H:i:s');
            $cliente->estado    = $request->input('estado');
            $cliente->save();

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

        $cliente = Cliente::query()->with(['tipoDocumentoIdentidad'])->find($request->input('idcliente'));

        if(!$cliente){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($cliente);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cliente = Cliente::query()->find($request->input('idcliente'));

        if(!$cliente){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($cliente);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $cliente = Cliente::query()->findOrFail($request->input('idcliente'));

            $cliente->nombres   = $request->input('nombresEditar');
            $cliente->apellidos = $request->input('apellidosEditar');
            $cliente->correo    = $request->input('correoEditar');
            $cliente->idtipo_documento_identidad    = $request->input('tipoDocumentoIdentidadEditar');
            $cliente->numero_documento_identidad    = $request->input('numeroDocumentoIdentidadEditar');
            $cliente->telefono    = $request->input('telefonoEditar');
            $cliente->estado    = $request->input('estadoEditar');
            $cliente->update();



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
            $cliente = Cliente::query()->findOrFail($request->input('idcliente'));
            $cliente->estado    = 1;
            $cliente->update();

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
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $cliente = Cliente::query()->findOrFail($request->input('idcliente'));
            $cliente->estado    = 0;

            $cliente->update();

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

    public function destroy(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $cliente = Cliente::query()->findOrFail($request->input('idcliente'));
            $cliente->delete();

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
