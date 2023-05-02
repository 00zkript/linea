<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Contacto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ContactoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $contacto = DB::table('contacto')
            ->first();

        return view('panel.contacto.index')->with(compact('contacto'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }



        try{

            $contacto = Contacto::find($request->input('idcontacto'));
            $contacto->telefono = $request->input('telefono');
            $contacto->celular = $request->input('celular');
            $contacto->correo = $request->input('correo');
            $contacto->facebook = $request->input('facebook');
            $contacto->whatsapp = $request->input('whatsapp');
            $contacto->instagram = $request->input('instagram');
            $contacto->twitter = $request->input('twitter');
            $contacto->youtube = $request->input('youtube');
            $contacto->linkendin = $request->input('linkendin');
            $contacto->direccion = $request->input('direccion');
            $contacto->google_maps = $request->input('google_maps');
            $contacto->horario = $request->input('horario');
            $contacto->update();

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

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }
}
