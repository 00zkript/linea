<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\TipoDocumentoIdentidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    public function index()
    {

        $empleados = Empleado::query()
            ->orderBy('idempleado','DESC')
            ->paginate(10,['*'],'pagina',1);

        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();


        return view('panel.empleado.index')->with(compact('empleados','tipoDocumentoIdentidad'));


    }


    public function listar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $empleados = Empleado::query()
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query->where('nombres','LIKE','%'.$txtBuscar.'%');
            })
            ->orderBy('idempleado','DESC')
            ->paginate($cantidadRegistros,['*'],'pagina',$paginaActual);



        return view('panel.empleado.listado')->with(compact('empleados'))->render();

    }

    public function store(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $idtipoEmpleado           = $request->input('idtipoEmpleado');
        $nombres                  = $request->input('nombres');
        $apellidos                = $request->input('apellidos');
        $correo                   = $request->input('correo');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidad');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidad');
        $telefono                 = $request->input('telefono');
        $codigo                   = $request->input('codigo');
        $imagen                   = $request->input('imagen');
        $fechaIngreso             = $request->input('fechaIngreso');
        $fechaCulminacion         = $request->input('fechaCulminacion');
        $sexo                     = $request->input('sexo');
        $estado                   = $request->input('estado');


        try {

            // $usuario            = new User();
            // $usuario->idrol     = 2;
            // $usuario->usuario   = $nombres;
            // $usuario->nombres   = $nombres;
            // $usuario->apellidos = $apellidos;
            // $usuario->correo = $correo;
            // $usuario->clave     = encrypt(random_int(10000, 99999));
            // $usuario->estado = $estado;
            // $usuario->save();



            $cliente = new Empleado();
            // $cliente->idusuario = $usuario->idusuario;
            $cliente->idtipo_empleado            = $idtipoEmpleado;
            $cliente->nombres                    = $nombres;
            $cliente->apellidos                  = $apellidos;
            $cliente->correo                     = $correo;
            $cliente->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $cliente->numero_documento_identidad = $numeroDocumentoIdentidad;
            $cliente->telefono                   = $telefono;
            $cliente->codigo                     = $codigo;
            $cliente->imagen                     = $imagen;
            $cliente->fecha_ingreso              = $fechaIngreso;
            $cliente->fecha_culminacion          = $fechaCulminacion;
            $cliente->sexo                       = $sexo;
            $cliente->estado                     = $estado;
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

        $cliente = Empleado::query()->with(['tipoDocumentoIdentidad'])->find($request->input('idempleado'));

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

        $cliente = Empleado::query()->find($request->input('idempleado'));

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

        $idtipoEmpleado           = $request->input('idtipoEmpleadoEditar');
        $nombres                  = $request->input('nombresEditar');
        $apellidos                = $request->input('apellidosEditar');
        $correo                   = $request->input('correoEditar');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidadEditar');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidadEditar');
        $telefono                 = $request->input('telefonoEditar');
        $codigo                   = $request->input('codigoEditar');
        $imagen                   = $request->input('imagenEditar');
        $fechaIngreso             = $request->input('fechaIngresoEditar');
        $fechaCulminacion         = $request->input('fechaCulminacionEditar');
        $sexo                     = $request->input('sexoEditar');
        $estado                   = $request->input('estadoEditar');

        try {
            $cliente = Empleado::query()->findOrFail($request->input('idempleado'));
            $cliente->idtipo_empleado            = $idtipoEmpleado;
            $cliente->nombres                    = $nombres;
            $cliente->apellidos                  = $apellidos;
            $cliente->correo                     = $correo;
            $cliente->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $cliente->numero_documento_identidad = $numeroDocumentoIdentidad;
            $cliente->telefono                   = $telefono;
            $cliente->codigo                     = $codigo;
            $cliente->imagen                     = $imagen;
            $cliente->fecha_ingreso              = $fechaIngreso;
            $cliente->fecha_culminacion          = $fechaCulminacion;
            $cliente->sexo                       = $sexo;
            $cliente->estado                     = $estado;
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
            $cliente = Empleado::query()->findOrFail($request->input('idempleado'));
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
            $cliente = Empleado::query()->findOrFail($request->input('idempleado'));
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
            $cliente = Empleado::query()->findOrFail($request->input('idempleado'));
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
