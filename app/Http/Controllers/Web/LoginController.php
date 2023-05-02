<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LoginRequest;
use App\Http\Requests\Web\RegistroRequest;
use App\Mail\Web\RecuperarClaveMail;
use App\Mail\Web\RegistroUsuarioMail;
use App\Models\Cliente;
use App\Models\Favorito;
use App\Models\TipoDocumentoIdentidad;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;
use Throwable;

class LoginController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('web.usuario.index');
        }

        return view('web.login.index');
    }

    public function verificar(LoginRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $correo = $request->input('correo');
            $clave = $request->input('clave');
            $recuerdame = $request->input('recuerdame');


            $usuarioExistente = DB::table('usuario')
                // ->where('idrol', 2)
                ->where('correo', $correo)
                ->where('estado', 1)
                ->first();



            if (empty($usuarioExistente)) {
                return response()->json([
                    "mensaje" => 'Este usuario no existe en nuestro sistema.',
                ],400);
            }

            if (decrypt($usuarioExistente->clave) !== $clave) {
                return response()->json([
                    "mensaje" => 'El usuario y/o la contraseña son incorrectas.',
                ],400);
            }


            auth()->loginUsingId($usuarioExistente->idusuario, $recuerdame);
            Favorito::guardarFavoritos();

            return response()->json([
                "mensaje" => 'Usuario autenticado, redirigiendo...',
            ]);

        } catch (Throwable $t) {
            return response()->json([
                "mensaje" => "No se ha podido autenticar el usuario.",
                "error" => $t->getMessage()
            ], 400);
        }


    }


    public function registrase()
    {
        if (auth()->check()) {
            return redirect()->route('web.usuario.index');
        }
        $tipoDocumentoIdentidad = TipoDocumentoIdentidad::query()->where('estado',1)->get();


        return view('web.login.registrar')->with(compact('tipoDocumentoIdentidad'));

    }

    public function guardarUsuario(RegistroRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();
        try {
            $usuario = new User();
            $usuario->idrol = 2;
            $usuario->correo = $request->input('correo');
            $usuario->clave = encrypt($request->input('clave'));
            $usuario->usuario = $request->input('nombres');
            $usuario->nombres      = $request->input('nombres');
            $usuario->apellidos    = $request->input('apellidos');
            $usuario->estado = 1;
            $usuario->save();


            $cliente = new Cliente();
            $cliente->idusuario                  = $usuario->idusuario;
            $cliente->nombres                    = $request->input('nombres');
            $cliente->apellidos                  = $request->input('apellidos');
            $cliente->correo                     = $request->input('correo');
            $cliente->idtipo_documento_identidad = $request->input('tipoDocumentoIdentidad');
            $cliente->numero_documento_identidad = $request->input('numeroDocumentoIdentidad');
            $cliente->telefono                   = $request->input('telefono');

            // $cliente->iddepartamento             = $request->input('iddepartamento');
            // $cliente->idprovincia                = $request->input('idprovincia');
            // $cliente->iddistrito                 = $request->input('iddistrito');
            // $cliente->direccion                  = $request->input('direccion');
            // $cliente->referencia                 = $request->input('referencia');
            $cliente->fecha_creacion             = now()->format('Y-m-d H:i:s');
            $cliente->estado                     = 1;
            $cliente->save();



            Mail::send(new RegistroUsuarioMail($usuario->idusuario));

            DB::commit();

            auth()->loginUsingId($usuario->idusuario);
            Favorito::guardarFavoritos();

            return response()->json([
                "mensaje" => "Registrado con exito."
            ]);

        }catch (\Throwable $th){
            DB::rollBack();

            return response()->json([
                "mensaje" => "No se pudo registrar el usuario.",
                "error" => $th->getMessage(),
            ],400);
        }

    }


    public function recuperarClave()
    {
        if (auth()->check()) {
            return redirect()->route('web.usuario.index');
        }


        return view('web.login.recuperarClave');
    }

    public function enviarClave(Request $request)
    {

        if (!$request->ajax()) {
            return abort(404);
        }

        $correo = $request->input('correo');
        $respuesta = [];

        $usuario = DB::table('usuario')
            ->where('correo', $correo)
            ->where('estado', 1)
            ->first();

        if (!empty($usuario)) {
            $respuesta["error"] = false;
            $respuesta["mensaje"] = "Su contraseña ha sido enviada a su correo, verifique su bandeja de entrada.";

            Mail::send(new RecuperarClaveMail($usuario->idusuario));

        } else {
            $respuesta["error"] = true;
            $respuesta["mensaje"] = "Este usuario no esta registrado en nuestro sistema, vuelva a intentar.";
        }

        return response()->json($respuesta);


    }


    public function loginAuth(Request $request,$servicio)
    {
        $urlAnterior = url()->previous();
        $redirect = $urlAnterior == route('web.venta.usuario.index') ? route('web.venta.usuario.index') : route('web.login');

        session()->put('redictLoginSocial',$redirect);

        return Socialite::driver($servicio)->stateless()->redirect();
    }

    public function responseLoginFacebook(Request $request)
    {

        try {

            $respuesta = Socialite::driver('facebook')->stateless()->user();

            $facebook = (object)$respuesta->user;

            $buscarUsuario = User::query()->where('correo', $facebook->email)->first();

            if (empty($buscarUsuario)) {
                $usuario = new User();
                $usuario->idrol = 2;
                $usuario->correo = $facebook->email;
                $usuario->clave = encrypt(random_int(10000, 99999));
                $usuario->usuario    = $facebook->name;
                $usuario->nombres    = $facebook->name;
                $usuario->apellidos  = $facebook->name;
                $usuario->estado = 1;
                $usuario->save();

                $cliente = new Cliente();
                $cliente->idusuario  = $usuario->idusuario;
                $cliente->nombres    = $facebook->name;
                $cliente->apellidos  = $facebook->name;
                $cliente->correo     = $facebook->email;
                $cliente->estado     = 1;
                $cliente->fecha_creacion             = now()->format('Y-m-d H:i:s');
                $cliente->save();




                try {
                    Mail::send(new RegistroUsuarioMail($usuario->idusuario));
                }catch (Throwable $th){}

                $buscarUsuario = $usuario;

            }


            if( !$buscarUsuario->estado ){

                return redirect(session()->get('redictLoginSocial',route('web.login')))->withErrors([
                    "login" => 'Este usuario no existe en nuestro sistema.'
                ]);

            }

            auth()->loginUsingId($buscarUsuario->idusuario);
            Favorito::guardarFavoritos();


            return redirect(session()->get('redictLoginSocial',route('web.login')));


        }catch (\Throwable $th){

            return redirect(session()->get('redictLoginSocial',route('web.login')))->withErrors([
                "login" => "Hubo un errror al intentar loguearte."
            ]);
        }


    }

    public function responseLoginGoogle(Request $request)
    {

        try{

            $respuesta = Socialite::driver('google')->stateless()->user();

            $google = (object)$respuesta->user;

            $buscarUsuario = DB::table('usuario')
                ->where('correo', $google->email)
                ->first();

            if (empty($buscarUsuario)) {
                $usuario = new User();
                $usuario->idrol = 2;
                $usuario->correo = $google->email;
                $usuario->clave = encrypt(random_int(10000, 99999));
                $usuario->usuario    = $google->given_name;
                $usuario->nombres    = $google->given_name;
                $usuario->apellidos  = $google->family_name;
                $usuario->estado = 1;
                $usuario->save();


                $cliente = new Cliente();
                $cliente->idusuario  = $usuario->idusuario;
                $cliente->nombres    = $google->given_name;
                $cliente->apellidos  = $google->family_name;
                $cliente->correo     = $google->email;
                $cliente->estado     = 1;
                $cliente->fecha_creacion             = now()->format('Y-m-d H:i:s');
                $cliente->save();

                try {
                    Mail::send(new RegistroUsuarioMail($usuario->idusuario));
                }catch (Throwable $th){}

                $buscarUsuario = $usuario;
            }

            if (!$buscarUsuario->estado) {
                return redirect(session()->get('redictLoginSocial',route('web.login')))->withErrors([
                    "login" => 'Este usuario no existe en nuestro sistema.'
                ]);
            }

            auth()->loginUsingId($buscarUsuario->idusuario);
            Favorito::guardarFavoritos();

        }catch (\Throwable $th){

            return redirect(session()->get('redictLoginSocial',route('web.login')))->withErrors([
                "login" => "Hubo un errror al intentar loguearte."
            ]);
        }

    }





    public function salir()
    {
        session()->flush();
        auth()->logout();
        return redirect()->route('web.inicio');
    }
}
