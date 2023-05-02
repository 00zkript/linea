<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\Web\ContactoMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index()
    {
        Return view('web.contacto.index');
    }


    public function enviar( Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {

            Mail::send(new ContactoMail($request->all()));

            return response()->json(['mensaje' => "Se envió correctamente la solicitud de contacto."]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo enviar tu solicitud, recargue y prueba nuevamente."
            ],400);

        }



    }



}
