<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\AsesorRequest;
use App\Models\Asesor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AsesorController extends Controller
{

    public function index()
    {
        $asesores = DB::table('asesor AS a')
            ->orderBy('a.idasesor', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.asesor.index')->with(compact('asesores'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $asesores = DB::table('asesor AS a')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->where('nombres', 'LIKE', '%' . $txtBuscar . '%');
            })
            ->orderBy('a.idasesor', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.asesor.listado')->with(compact('asesores'))->render());


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
    public function store(AsesorRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try{
            $asesor = new Asesor();
            $asesor->nombres = $request->input('nombres');
            $asesor->celular = $request->input('celular');
            $asesor->whatsapp = $request->input('whatsapp');
            $asesor->telegram = $request->input('telegram');
            $asesor->correo = $request->input('correo');
            $asesor->contacto_rapido = $request->input('contactoRapido');

            if ($request->hasFile('foto')) {
                $foto = Storage::disk('panel')->putFile('asesores', $request->file('foto'));
                $asesor->foto = basename($foto);
            }

            $asesor->estado = $request->input('estado');
            $asesor->save();


            return response()->json([
                "mensaje" => "Registro creado exitosamente."
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo crear el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }


    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $asesor = Asesor::query()->find($request->input('idasesor'));

        if (!$asesor) {
            return response()->json(["mensaje" => "Registro no encontrado"], 400);
        }

        return response()->json( $asesor );


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        $asesor = Asesor::query()->find($request->input('idasesor'));

        if (!$asesor) {
            return response()->json(["mensaje" => "Registro no encontrado"], 400);
        }

        return response()->json( $asesor );


    }


    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(AsesorRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try{

            $asesor           = Asesor::query()->find($request->input('idasesor'));
            $asesor->nombres  = $request->input('nombresEditar');
            $asesor->celular  = $request->input('celularEditar');
            $asesor->whatsapp = $request->input('whatsappEditar');
            $asesor->telegram = $request->input('telegramEditar');
            $asesor->correo   = $request->input('correoEditar');
            $asesor->contacto_rapido = $request->input('contactoRapidoEditar');

            if ($request->hasFile('fotoEditar')) {

                if (Storage::disk('panel')->exists('asesores/' . $asesor->foto)) {
                    Storage::disk('panel')->delete('asesores/' . $asesor->foto);
                }

                $foto = Storage::disk('panel')->putFile('asesores', $request->file('fotoEditar'));
                $asesor->foto = basename($foto);
            }

            $asesor->estado = $request->input('estadoEditar');
            $asesor->update();


            return response()->json([
                "mensaje"=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo actualizar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }

    public function habilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $asesor = Asesor::query()->findOrFail($request->input('idasesor'));
            $asesor->estado    = 1;
            $asesor->update();

            return response()->json([
                "mensaje"=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo habilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }

    public function inhabilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $asesor = Asesor::query()->findOrFail($request->input('idasesor'));
            $asesor->estado    = 0;

            $asesor->update();

            return response()->json([
                "mensaje"=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo inhabilitar el registro.",
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
    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {

            $asesor = Asesor::query()->findOrFail($request->input('idasesor'));

            if (Storage::disk('panel')->exists('asesores/' . $asesor->foto)) {
                Storage::disk('panel')->delete('asesores/' . $asesor->foto);
            }

            $asesor->delete();

            return response()->json([
                "mensaje"=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                "mensaje"=> "No se pudo eliminar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }


}
