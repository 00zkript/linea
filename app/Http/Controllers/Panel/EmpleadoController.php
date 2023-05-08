<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use App\Models\TipoDocumentoIdentidad;
use App\Models\TipoEmpleado;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{
    public function index()
    {

        $empleados = Empleado::query()
            ->with(['tipoDocumentoIdentidad'])
            ->orderBy('idempleado','DESC')
            ->paginate(10,['*'],'pagina',1);

            // dd( $empleados->toArray()  );

        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();

        $tiposDeEmpleados = TipoEmpleado::query()->where('estado',1)->get();


        return view('panel.empleado.index')->with(compact('empleados','tipoDocumentoIdentidad', 'tiposDeEmpleados'));


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
            ->with(['tipoDocumentoIdentidad'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query
                    ->where('nombres','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('apellidos','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('codigo','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('numero_documento_identidad','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('correo','LIKE','%'.$txtBuscar.'%');
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

        $codigo                   = $request->input('codigo');
        $tipoEmpleado             = $request->input('tipoEmpleado');
        $nombres                  = $request->input('nombres');
        $apellidos                = $request->input('apellidos');
        $correo                   = $request->input('correo');
        $telefono                 = $request->input('telefono');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidad');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidad');
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



            $empleado = new Empleado();
            // $empleado->idusuario = $usuario->idusuario;
            $empleado->codigo                     = $codigo;
            $empleado->idtipo_empleado            = $tipoEmpleado;
            $empleado->nombres                    = $nombres;
            $empleado->apellidos                  = $apellidos;
            $empleado->correo                     = $correo;
            $empleado->telefono                   = $telefono;
            $empleado->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $empleado->numero_documento_identidad = $numeroDocumentoIdentidad;
            $empleado->fecha_ingreso              = $fechaIngreso;
            $empleado->fecha_culminacion          = $fechaCulminacion;
            $empleado->sexo                       = $sexo;
            if ( $request->hasFile('imagen') ) {
                // $filename = $request->file('imagen')->store( 'empleado', 'panel');
                $filename = Storage::disk('panel')->putFile( 'empleado', $request->file('imagen') );
                $empleado->imagen = $filename;
            }
            $empleado->estado                     = $estado;
            $empleado->save();

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

        $empleado = Empleado::query()->with(['tipoDocumentoIdentidad'])->find($request->input('idempleado'));

        if(!$empleado){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($empleado);

    }

    public function edit(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $empleado = Empleado::query()->find($request->input('idempleado'));

        if(!$empleado){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($empleado);

    }

    public function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $codigo                   = $request->input('codigoEditar');
        $tipoEmpleado             = $request->input('tipoEmpleadoEditar');
        $nombres                  = $request->input('nombresEditar');
        $apellidos                = $request->input('apellidosEditar');
        $correo                   = $request->input('correoEditar');
        $telefono                 = $request->input('telefonoEditar');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidadEditar');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidadEditar');
        $fechaIngreso             = $request->input('fechaIngresoEditar');
        $fechaCulminacion         = $request->input('fechaCulminacionEditar');
        $sexo                     = $request->input('sexoEditar');
        $estado                   = $request->input('estadoEditar');

        try {
            $empleado = Empleado::query()->findOrFail($request->input('idempleado'));
            $empleado->codigo                     = $codigo;
            $empleado->idtipo_empleado            = $tipoEmpleado;
            $empleado->nombres                    = $nombres;
            $empleado->apellidos                  = $apellidos;
            $empleado->correo                     = $correo;
            $empleado->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $empleado->numero_documento_identidad = $numeroDocumentoIdentidad;
            $empleado->telefono                   = $telefono;
            $empleado->codigo                     = $codigo;
            $empleado->fecha_ingreso              = $fechaIngreso;
            $empleado->fecha_culminacion          = $fechaCulminacion;
            $empleado->sexo                       = $sexo;
            if ( $request->hasFile('imagenEditar') ) {
                if ($empleado->imagen) {
                    Storage::disk('panel')->delete($empleado->imagen);
                }

                $filename = $request->file('imagenEditar')->store( 'empleado', 'panel');
                $empleado->imagen = $filename;
            }
            $empleado->estado                     = $estado;
            $empleado->update();



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
            $empleado = Empleado::query()->findOrFail($request->input('idempleado'));
            $empleado->estado    = 1;
            $empleado->update();

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
            $empleado = Empleado::query()->findOrFail($request->input('idempleado'));
            $empleado->estado    = 0;

            $empleado->update();

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
            $empleado = Empleado::query()->findOrFail($request->input('idempleado'));
            $empleado->delete();

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
