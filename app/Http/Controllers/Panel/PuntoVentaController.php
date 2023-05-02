<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\PuntoVenta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PuntoVentaController extends Controller
{
    public function index()
    {

        $puntoVentas = PuntoVenta::query()
            ->orderBy('idpunto_venta', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.puntoVenta.index')->with(compact('puntoVentas'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $puntoVentas = PuntoVenta::query()
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->where('nombre', 'like', "%$txtBuscar%" );
            })
            ->orderBy('idpunto_venta', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.puntoVenta.listado')->with(compact('puntoVentas'))->render());


    }


    public function store(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {

            $puntoVenta = new PuntoVenta();
            $puntoVenta->nombre = $request->input('nombre');
            $puntoVenta->direccion = $request->input('direccion');
            $puntoVenta->telefono = $request->input('telefono');
            $puntoVenta->whatsapp = $request->input('whatsapp');
            $puntoVenta->correo = $request->input('correo');
            $puntoVenta->horario_atencion = $request->input('horarioAtencion');
            $puntoVenta->estado = $request->input('estado');
            $puntoVenta->save();


            return response()->json([
                'mensaje'=> "Registro creado exitosamente.",
            ]);


        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo crear el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }


    }


    public function show(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        $puntoVenta = PuntoVenta::query()->find($request->input('idpunto_venta'));

        if(!$puntoVenta){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($puntoVenta);

    }


    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $puntoVenta = PuntoVenta::query()->find($request->input('idpunto_venta'));

        if(!$puntoVenta){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($puntoVenta);

    }


    public function update(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $puntoVenta = PuntoVenta::query()->findOrFail($request->input('idpunto_venta'));
            $puntoVenta->nombre = $request->input('nombreEditar');
            $puntoVenta->direccion = $request->input('direccionEditar');
            $puntoVenta->telefono = $request->input('telefonoEditar');
            $puntoVenta->whatsapp = $request->input('whatsappEditar');
            $puntoVenta->correo = $request->input('correoEditar');
            $puntoVenta->horario_atencion = $request->input('horarioAtencionEditar');
            $puntoVenta->estado = $request->input('estadoEditar');
            $puntoVenta->update();

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


    public function habilitar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $puntoVenta = PuntoVenta::query()->findOrFail($request->input('idpunto_venta'));
            $puntoVenta->estado = 1;
            $puntoVenta->update();

            return response()->json([
                'mensaje'=> "Registro habilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo habilitar el registro.",
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

            $puntoVenta = PuntoVenta::query()->findOrFail($request->input('idpunto_venta'));
            $puntoVenta->estado = 0;
            $puntoVenta->update();

            return response()->json([
                'mensaje'=> "Registro inhabilitado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo inhabilitar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }



    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $puntoVenta = PuntoVenta::query()->findOrFail($request->input('idpunto_venta'));
            $puntoVenta->delete();

            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'mensaje'=> "No se pudo eliminar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }

    }




}
