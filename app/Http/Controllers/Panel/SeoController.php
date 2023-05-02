<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Seo;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index()
    {
        $seo = DB::table('seo')
            ->first();

        return view('panel.seo.index')->with(compact('seo'));
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
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $seo = Seo::query()->findOrFail($request->input('idseo'));
            $seo->titulo_general = $request->input('titulo_general');
            $seo->autor = $request->input('autor');
            $seo->descripcion = $request->input('descripcion');
            $seo->keywords = $request->input('keywords');
            $seo->googleAnalytics = $request->input('googleAnalytics');
            $seo->googleTagManager = $request->input('googleTagManager');
            $seo->facebookPixel = $request->input('facebookPixel');


            if ($request->hasFile('imagenCompartir')) {
                // $nombreImagen = Storage::disk('panel')->putFile("seo", $request->file('imagen'));
                $nombreImagen = $request->file('imagenCompartir')->store("seo","panel");
                $seo->imagen_compartir = basename($nombreImagen);
            }


            $seo->update();

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
