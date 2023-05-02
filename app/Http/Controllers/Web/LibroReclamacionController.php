<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\LibroReclamacionRequest;
use App\Mail\Web\ReclamoMail;
use App\Models\LibroReclamacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class LibroReclamacionController extends Controller
{
    public function index(Request $request)
    {
        return view('web.libroReclamacion.index');
    }

    public function guardarDatos(LibroReclamacionRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $libroReclamacion = new LibroReclamacion();
            $libroReclamacion->nombres_apellidos = $request->input('nombres_apellidos');
            $libroReclamacion->tipo_documento = $request->input('tipo_documento');
            $libroReclamacion->num_documento = $request->input('num_documento');
            $libroReclamacion->direccion = $request->input('direccion');
            $libroReclamacion->correo = $request->input('correo');
            $libroReclamacion->telefono = $request->input('telefono');
            $libroReclamacion->nombre_apoderado = $request->input('nombre_apoderado');
            $libroReclamacion->tipo_bien = $request->input('tipo_bien');
            $libroReclamacion->descripcion_bien = $request->input('descripcion_bien');
            $libroReclamacion->tipo_reclamo = $request->input('tipo_reclamo');
            $libroReclamacion->detalle_reclamo = $request->input('detalle_reclamo');
            $libroReclamacion->fecha_ingreso = now()->format('Y-m-d H:i:s');
            $libroReclamacion->estado = 'Aceptado';
            $libroReclamacion->save();

            Mail::send(new ReclamoMail($libroReclamacion->idlibro_reclamacion));

            return response()->json('Su reclamo ha sido enviado con éxito, revisaremos su caso y nos pondremos con usted lo más pronto posible.');
        }catch (\Throwable $th){
            return response()->json('Su reclamo no ha sido procesado correctamente, intente nuevamente.');

        }


    }


}
