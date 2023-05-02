<?php

namespace App\Http\Controllers\Panel;

use App\Models\Nosotros;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NosotrosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nosotros = DB::table('nosotros')
            ->first();



        return view('panel.nosotros.index')->with(compact('nosotros'));
    }

   function update(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $nosotros = Nosotros::query()->findOrFail($request->input('idnosotros'));
            $nosotros->vision = $request->input('vision');
            $nosotros->mision = $request->input('mision');
            $nosotros->quienes_somos = $request->input('quienes_somos');
            $nosotros->update();


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


}
