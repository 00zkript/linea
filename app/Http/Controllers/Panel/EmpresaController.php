<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class EmpresaController extends Controller
{

    public function index()
    {
        $empresa = DB::table('empresa')->first();
        $monedas = DB::table('moneda')->where('estado',1)->orWhere('idmoneda',1)->get();

        return view('panel.empresa.index')->with(compact('empresa','monedas'));
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {

            $empresa = Empresa::query()->findOrFail($request->input('idempresa'));
            $empresa->nombre = $request->input('nombre');
            $empresa->ruc = $request->input('ruc');
            $empresa->igv = (float)$request->input('igv');
            $empresa->idmoneda = $request->input('idmoneda',1);
            $empresa->cuenta_bancaria = $request->input('cuentaBancaria',1);
            $empresa->informacion_adicional = $request->input('informacionAdicional',1);

            if ($request->hasFile('logo')) {
                if (Storage::disk('panel')->exists('empresa/' . $empresa->logo)) {
                    Storage::disk('panel')->delete('empresa/' . $empresa->logo);
                }

                $logo = Storage::disk('panel')->putFile("empresa", $request->file('logo'));
                $empresa->logo = basename($logo);
            }

            if ($request->hasFile('favicon')) {
                if (Storage::disk('panel')->exists('empresa/' . $empresa->favicon)) {
                    Storage::disk('panel')->delete('empresa/' . $empresa->favicon);
                }

                $favicon = Storage::disk('panel')->putFile("empresa", $request->file('favicon'));
                $empresa->favicon = basename($favicon);
            }

            $empresa->update();



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
