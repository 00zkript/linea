<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\UsuarioRequest;
use App\Models\TipoDocumentoIdentidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Role;

class UsuarioController extends Controller
{

    public function index()
    {
        $roles = Role::query()
            ->where('status', 1)
            // ->where('id', '!=', 1)
            ->get();

        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();

        $usuarios = User::query()
            ->orderBy('idusuario', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.usuario.index')->with(compact('roles', 'usuarios', 'tipoDocumentoIdentidad'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $usuarios = User::query()
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('CONCAT(usuario,nombres,apellidos) LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('idusuario', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.usuario.listado')->with(compact('usuarios'))->render());


    }

    public function create()
    {
    }

    public function store(UsuarioRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $rol       = $request->input('rol');
        $usuario   = $request->input('usuario');
        $clave     = $request->input('clave');
        $nombres   = $request->input('nombres');
        $apellidos = $request->input('apellidos');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidad');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidad');
        $cargo     = $request->input('cargo');
        $estado    = $request->input('estado');

        try {

            $usuario            = new User;
            $usuario->idrol     = $rol;
            $usuario->usuario   = $usuario;
            $usuario->clave     = encrypt($clave);
            $usuario->nombres   = $nombres;
            $usuario->apellidos = $apellidos;
            $usuario->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $usuario->numero_documento_identidad = $numeroDocumentoIdentidad;
            $usuario->cargo     = $cargo;
            $usuario->estado    = $estado;

            if ($request->hasFile('imagen')) {
                $imagen = Storage::disk('panel')->putFile('usuarios', $request->file('imagen'));
                $usuario->imagen = basename($imagen);
            }

            $usuario->save();

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

    public function show(Request $request, $usuarioID)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $usuario = User::query()->find($usuarioID);

        if(!$usuario){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($usuario);

    }

    public function edit(Request $request, $usuarioID)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $usuario = User::query()->find($usuarioID);

        if(!$usuario){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($usuario);


    }

    public function update(UsuarioRequest $request, $usuarioID)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $rol       = $request->input('rolEditar');
        $usuario   = $request->input('usuarioEditar');
        $clave     = $request->input('claveEditar');
        $nombres   = $request->input('nombresEditar');
        $apellidos = $request->input('apellidosEditar');
        $tipoDocumentoIdentidad   = $request->input('tipoDocumentoIdentidadEditar');
        $numeroDocumentoIdentidad = $request->input('numeroDocumentoIdentidadEditar');
        $cargo     = $request->input('cargoEditar');
        $estado    = $request->input('estadoEditar');

        try {

            $usuario            = User::query()->findOrFail($usuarioID);
            $usuario->idrol     = $rol;
            $usuario->usuario   = $usuario;
            if (!empty($clave)) {
                $usuario->clave = encrypt($clave);
            }
            $usuario->nombres    = $nombres;
            $usuario->apellidos  = $apellidos;
            $usuario->idtipo_documento_identidad = $tipoDocumentoIdentidad;
            $usuario->numero_documento_identidad = $numeroDocumentoIdentidad;
            $usuario->cargo     = $cargo;
            $usuario->estado    = $estado;

            if ($request->hasFile('imagenEditar')) {

                if (Storage::disk('panel')->exists('usuarios/' . $usuario->imagen)) {
                    Storage::disk('panel')->delete('usuarios/' . $usuario->imagen);
                }

                $imagen = Storage::disk('panel')->putFile('usuarios', $request->file('imagenEditar'));
                $usuario->imagen = basename($imagen);
            }
            $usuario->update();



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

    public function habilitar(Request $request,$usuarioID)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $usuario = User::query()->findOrFail($usuarioID);
            $usuario->estado = 1;
            $usuario->update();

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

    public function inhabilitar(Request $request, $usuarioID)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        if ( $usuarioID == auth()->id()) {
            return response()->json([
                'mensaje'=> "No se pudo inhabilitar el registro. Debido a que el usuario que desea inhabilitar tiene la sessión activa.",
            ]);
        }


        try {
            $usuario = User::query()->findOrFail($usuarioID);
            $usuario->estado = 0;
            $usuario->update();

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

    public function destroy(Request $request, $usuarioID)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        if ( $usuarioID == auth()->id()) {
            return response()->json([
                'mensaje'=> "No se pudo eliminar el registro. Debido a que el usuario que desea eliminar tiene la sessión activa.",
            ]);
        }

        try {
            $usuario = User::query()->findOrFail($usuarioID);



            if (Storage::disk('panel')->exists('usuarios/' . $usuario->imagen)) {
                Storage::disk('panel')->delete('usuarios/' . $usuario->imagen);
            }

            $usuario->delete();

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
