<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\LoginRequest;
use Illuminate\Support\Facades\DB;
use Throwable;


class LoginController extends Controller
{
    public function index()
    {
        if (!auth()->check()) {
            return view('panel.login.index');
        }

        return redirect()->route('inicio.index');

    }


    public function verificar(LoginRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $usuario = $request->usuario;
            $clave = $request->clave;
            $recuerdame = $request->recuerdame;
            $respuesta = [];

            $usuarioExistente = DB::table('usuario')
                ->where('usuario', $usuario)
                ->where('estado', 1)
                ->first();


            if (!empty($usuarioExistente) && decrypt($usuarioExistente->clave) == $clave) {
                $respuesta['error'] = false;
                $respuesta['mensaje'] = 'Usuario autenticado, redirigiendo...';

                auth()->loginUsingId($usuarioExistente->idusuario, $recuerdame);

            } else {
                $respuesta['error'] = true;
                $respuesta['mensaje'] = 'Usuario incorrecto';
            }

            return response()->json($respuesta);

        } catch (Throwable $t) {
            return response()->json($t->getMessage(), 500);
        }


    }

    public function salir()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('panel.login.index');
    }
}
