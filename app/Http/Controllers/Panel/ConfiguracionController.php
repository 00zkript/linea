<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\ConfirguracionRequest;
use App\Http\Traits\ImageHelperTrait;
use App\Models\Cliente;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConfiguracionController extends Controller
{


    public function edit(Request $request)
    {

//        $usuario = User::query()->find(auth()->id());
        $usuario = auth()->user();


        return view('panel.configuracion.index')->with(compact('usuario'));


    }



    public function update(ConfirguracionRequest $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try{
            $usuario =  User::query()->findOrFail($request->input('idusuario'));
            $usuario->usuario = $request->input('usuarioEditar');

            if (!empty($request->input('claveEditar'))){
                $usuario->clave = encrypt($request->input('claveEditar'));
            }

            $usuario->nombres   = $request->input('nombresEditar');
            $usuario->apellidos = $request->input('apellidosEditar');
            $usuario->correo    = $request->input('correoEditar');

            if ($request->hasFile('imagenEditar')){

                $nombreImagen  = Storage::disk('panel')->putFile('usuarios',$request->file('imagenEditar'));
                $usuario->foto = basename($nombreImagen);
            }

            $usuario->update();

            /*$cliente = Cliente::query()->where('idusuario',$usuario->idusuario)->first();
            $cliente->nombres    = $request->input('nombresEditar');
            $cliente->apellidos  = $request->input('apellidosEditar');
            $cliente->correo     = $request->input('correoEditar');
            $cliente->estado     = 1;
            $cliente->update();*/

            return response()->json(['mensaje' => 'Usuario modificado satisfactoriamente']);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo actualizar el Usuario.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }
}
