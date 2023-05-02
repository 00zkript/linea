<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\Web\SuscripcionMail;
use App\Models\Suscripcion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SuscripcionController extends Controller
{
    public function enviar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $email = $request->input('correoSus');
        try {

            $suscripcion = new Suscripcion();
            $suscripcion->email = $email;
            $suscripcion->estado = 1;
            $suscripcion->save();

            Mail::send(new SuscripcionMail($email));

            return response()->json(['mensaje' => "Se envió correctamente la solicitud de suscripción."]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo enviar tu solicitud, recargue y prueba nuevamente."
            ],400);

        }



    }
}
