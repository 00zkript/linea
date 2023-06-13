<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use App\Models\TipoDocumentoIdentidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function index()
    {

        $clientes = Cliente::query()
            ->with(['tipoDocumentoIdentidad'])
            ->orderBy('idcliente','DESC')
            ->paginate(10,['*'],'pagina',1);

        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();

        $departamentos = Departamento::query()->where('estado',1)->get();



        return view('panel.cliente.index')->with(compact('clientes','tipoDocumentoIdentidad','departamentos'));


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
            ->with(['tipoDocumentoIdentidad'])
            ->when($txtBuscar,function($query) use($txtBuscar){
                return $query
                    ->where('nombres','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('apellidos','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('correo','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('telefono','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('numero_documento_identidad','LIKE','%'.$txtBuscar.'%')
                    ->orWhere('idcliente','LIKE','%'.$txtBuscar.'%');
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

        $codigo                   = $request->input('codigo');
        $nombres                  = $request->input('nombres');
        $apellidos                = $request->input('apellidos');
        $correo                   = $request->input('correo');
        $telefono                 = $request->input('telefono');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidad');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidad');
        $sexo                     = $request->input('sexo');
        $fechaNacimiento          = $request->input('fechaNacimiento');
        $departamento             = $request->input('departamento');
        $provincia                = $request->input('provincia');
        $distrito                 = $request->input('distrito');
        $direccion                = $request->input('direccion');
        $apoderadoNombres         = $request->input('apoderadoNombres');
        $apoderadoApellidos       = $request->input('apoderadoApellidos');
        $apoderadoCorreo          = $request->input('apoderadoCorreo');
        $apoderadoTelefono        = $request->input('apoderadoTelefono');
        // $referencia               = $request->input('referencia');
        $nota                     = $request->input('nota');
        $estado                   = $request->input('estado');


        try {

            $cliente = new Cliente();
            $cliente->nombres                    = $nombres;
            $cliente->apellidos                  = $apellidos;
            $cliente->correo                     = $correo;
            $cliente->telefono                   = $telefono;
            $cliente->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $cliente->numero_documento_identidad = $numeroDocumentoIdentidad;
            $cliente->sexo                       = $sexo;
            $cliente->fecha_nacimiento           = $fechaNacimiento;
            $cliente->iddepartamento             = $departamento;
            $cliente->idprovincia                = $provincia;
            $cliente->iddistrito                 = $distrito;
            $cliente->direccion                  = $direccion;
            $cliente->apoderado_nombres          = $apoderadoNombres;
            $cliente->apoderado_apellidos        = $apoderadoApellidos;
            $cliente->apoderado_correo           = $apoderadoCorreo;
            $cliente->apoderado_telefono         = $apoderadoTelefono;
            // $cliente->referencia                 = $referencia;
            $cliente->nota                       = $nota;
            $cliente->estado                     = $estado;

            if ( $request->hasFile('imagen') ) {
                $filename = Storage::disk('panel')->put('cliente', $request->file('imagen'));
                $cliente->imagen = $filename;
            }

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

        $cliente = Cliente::query()
            ->with([
                'tipoDocumentoIdentidad',
                'departamento',
                'provincia',
                'distrito'
            ])
            ->find($request->input('idcliente'));

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

        $codigo                   = $request->input('codigoEditar');
        $nombres                  = $request->input('nombresEditar');
        $apellidos                = $request->input('apellidosEditar');
        $correo                   = $request->input('correoEditar');
        $telefono                 = $request->input('telefonoEditar');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidadEditar');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidadEditar');
        $sexo                     = $request->input('sexoEditar');
        $fechaNacimiento          = $request->input('fechaNacimientoEditar');
        $departamento             = $request->input('departamentoEditar');
        $provincia                = $request->input('provinciaEditar');
        $distrito                 = $request->input('distritoEditar');
        $direccion                = $request->input('direccionEditar');
        $apoderadoNombres         = $request->input('apoderadoNombresEditar');
        $apoderadoApellidos       = $request->input('apoderadoApellidosEditar');
        $apoderadoCorreo          = $request->input('apoderadoCorreoEditar');
        $apoderadoTelefono        = $request->input('apoderadoTelefonoEditar');
        // $referencia               = $request->input('referenciaEditar');
        $nota                     = $request->input('notaEditar');
        $estado                   = $request->input('estadoEditar');


        try {
            $cliente = Cliente::query()->findOrFail($request->input('idcliente'));
            // $cliente->codigo                     = $codigo;
            $cliente->nombres                    = $nombres;
            $cliente->apellidos                  = $apellidos;
            $cliente->correo                     = $correo;
            $cliente->telefono                   = $telefono;
            $cliente->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $cliente->numero_documento_identidad = $numeroDocumentoIdentidad;
            $cliente->sexo                       = $sexo;
            $cliente->fecha_nacimiento           = $fechaNacimiento;
            $cliente->iddepartamento             = $departamento;
            $cliente->idprovincia                = $provincia;
            $cliente->iddistrito                 = $distrito;
            $cliente->direccion                  = $direccion;
            $cliente->apoderado_nombres          = $apoderadoNombres;
            $cliente->apoderado_apellidos        = $apoderadoApellidos;
            $cliente->apoderado_correo           = $apoderadoCorreo;
            $cliente->apoderado_telefono         = $apoderadoTelefono;
            // $cliente->referencia                 = $referencia;
            $cliente->nota                       = $nota;
            $cliente->estado                     = $estado;

            if ( $request->hasFile('imagenEditar') ) {

                if ($cliente->imagen) {
                    Storage::disk('panel')->delete($cliente->imagen);
                }

                $filename = Storage::disk('panel')->put('cliente', $request->file('imagenEditar'));
                $cliente->imagen = $filename;
            }

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

    public function provincias(Request $request, $iddepartamento)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $provincias = Provincia::where('iddepartamento', $iddepartamento)->where('estado',1)->get();

        return response()->json($provincias);
    }

    public function distritos(Request $request, $idprovincia)
    {
        if ( !$request->ajax() ) {
            return abort(400);
        }

        $distritos = Distrito::where('idprovincia', $idprovincia)->where('estado',1)->get();

        return response()->json($distritos);
    }



}
