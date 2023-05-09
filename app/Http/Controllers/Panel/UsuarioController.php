<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\UsuarioRequest;
use App\Models\Cliente;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class UsuarioController extends Controller
{

    public function index()
    {
        // $roles = DB::table('rol')
        //     ->where('estado', 1)
        //     //->where('idrol',1)
        //     ->get();

        $roles = [];

        $usuarios = DB::table('usuario AS u')
            // ->join('rol AS r', 'u.idrol', '=', 'r.idrol')
            // ->selectRaw('u.*,r.cargo AS cargo')
            ->orderBy('u.idusuario', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.usuario.index')->with(compact('roles', 'usuarios'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $usuarios = DB::table('usuario AS u')
            // ->join('rol AS r', 'u.idrol', '=', 'r.idrol')
            // ->selectRaw('u.*,r.cargo AS cargo')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('CONCAT(u.usuario,u.nombres,u.apellidos) LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('u.idusuario', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.usuario.listado')->with(compact('usuarios'))->render());


    }

    public function create()
    {
        //
    }

    public function store(UsuarioRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $usuario            = new User;
            $usuario->idrol     = $request->input('rol');
            $usuario->usuario   = $request->input('usuario');
            $usuario->nombres                    = $request->input('nombres');
            $usuario->apellidos                  = $request->input('apellidos');
            $usuario->clave     = encrypt($request->input('clave'));
            if ($request->hasFile('foto')) {
                $foto = Storage::disk('panel')->putFile('usuarios', $request->file('foto'));
                $usuario->foto = basename($foto);
            }

            $usuario->estado = $request->input('estado');
            $usuario->save();


            $cliente = new Cliente();
            $cliente->idusuario                  = $usuario->idusuario;
            $cliente->nombres                    = $request->input('nombres');
            $cliente->apellidos                  = $request->input('apellidos');
            $cliente->correo                     = $request->input('correo');
            $cliente->estado                     = 1;
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

    public function show(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }
        $idusuario = $request->input('idusuario');

        $usuario = DB::table('usuario AS u')
            ->join('rol AS r', 'u.idrol', '=', 'r.idrol')
            ->selectRaw('u.*,r.cargo AS cargo')
            ->where('idusuario', $idusuario)
            ->first();

        $usuario->cliente = Cliente::query()->where('idusuario',$idusuario)->first();


        if(!$usuario){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($usuario);

    }

    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }
        $idusuario = $request->input('idusuario');

        $usuario = User::query()->find($idusuario);

        $usuario->cliente = Cliente::query()->where('idusuario',$idusuario)->first();

        if(!$usuario){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($usuario);


    }

    public function update(UsuarioRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $usuario            = User::query()->findOrFail($request->input('idusuario'));
            $usuario->idrol     = $request->input('rolEditar');
            $usuario->usuario   = $request->input('usuarioEditar');
            if (!empty($request->input('claveEditar'))) {
                $usuario->clave = encrypt($request->input('claveEditar'));
            }

            if ($request->hasFile('fotoEditar')) {

                if (Storage::disk('panel')->exists('usuarios/' . $usuario->foto)) {
                    Storage::disk('panel')->delete('usuarios/' . $usuario->foto);
                }

                $foto = Storage::disk('panel')->putFile('usuarios', $request->file('fotoEditar'));
                $usuario->foto = basename($foto);
            }

            $usuario->nombres    = $request->input('nombresEditar');
            $usuario->apellidos  = $request->input('apellidosEditar');
            $usuario->estado = $request->input('estadoEditar');
            $usuario->update();


            /*$cliente = Cliente::query()->where('idusuario',$usuario->idusuario)->first();
            $cliente->nombres    = $request->input('nombresEditar');
            $cliente->apellidos  = $request->input('apellidosEditar');
            $cliente->correo     = $request->input('correoEditar');
            $cliente->estado     = 1;
            $cliente->update();*/


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
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $usuario = User::query()->findOrFail($request->input('idusuario'));
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

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {
            $usuario = User::query()->findOrFail($request->input('idusuario'));
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

    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {
            $usuario = User::query()->findOrFail($request->input('idusuario'));

            if ( $usuario->idusuario == auth()->user()->idusuario) {
                return response()->json([
                    'mensaje'=> "No se pudo eliminar el registro. Debido a que el usuario que desea eliminar tiene la sessión activa.",
                ]);
            }


            if (Storage::disk('panel')->exists('usuarios/' . $usuario->foto)) {
                Storage::disk('panel')->delete('usuarios/' . $usuario->foto);
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
