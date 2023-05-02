<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\CuponRequest;
use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CuponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $cupones = DB::table('cupon AS c')
            ->selectRaw('c.*')
            ->orderBy('c.idcupon', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.cupon.index')->with(compact('cupones'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = trim($request->input('txtBuscar'));

        $cupones = DB::table('cupon AS c')
            ->selectRaw('c.*')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('CONCAT(c.codigo,c.nombre) LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('c.idcupon', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.cupon.listado')->with(compact('cupones'))->render());


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
    public function store(CuponRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {
            $cupon = new Cupon;
            $cupon->codigo = $request->input('codigo');
            $cupon->nombre = $request->input('nombre');
            $cupon->tipoDescuento = $request->input('tipoDescuento');
            $cupon->descuentoMonto = $request->input('descuentoMonto');
            $cupon->descuentoPorcentaje = $request->input('descuentoPorcentaje');
            $cupon->montoMinimo = $request->input('montoMinimo');
            $cupon->cantidad = $request->input('cantidad');
            $cupon->fechaInicio = now()->createFromFormat("d/m/Y", $request->input('fechaInicio'))->format("Y-m-d");
            $cupon->fechaExpiracion = now()->createFromFormat("d/m/Y", $request->input('fechaExpiracion'))->format("Y-m-d");
            $cupon->estado = $request->input('estado');
            $cupon->save();


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

        $idcupon = $request->input('idcupon');

        $cupon = DB::table('cupon AS c')
            ->selectRaw('DATE_FORMAT(c.fechaInicio,"%d/%m/%Y") AS fechaInicioFormat,DATE_FORMAT(c.fechaExpiracion,"%d/%m/%Y") AS fechaExpiracionFormat,c.*')
            ->where('c.idcupon', $idcupon)
            ->first();


        if(!$cupon){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($cupon);

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

        $idcupon = $request->input('idcupon');

        $cupon = DB::table('cupon AS c')
            ->selectRaw('DATE_FORMAT(c.fechaInicio,"%d/%m/%Y") AS fechaInicioFormat,DATE_FORMAT(c.fechaExpiracion,"%d/%m/%Y") AS fechaExpiracionFormat,c.*')
            ->where('c.idcupon', $idcupon)
            ->first();

        if(!$cupon){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($cupon);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CuponRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try{

            $cupon = Cupon::query()->findOrFail($request->input('idcupon'));
            $cupon->codigo = $request->input('codigoEditar');
            $cupon->nombre = $request->input('nombreEditar');
            $cupon->tipoDescuento = $request->input('tipoDescuentoEditar');
            $cupon->descuentoMonto = $request->input('descuentoMontoEditar');
            $cupon->descuentoPorcentaje = $request->input('descuentoPorcentajeEditar');
            $cupon->montoMinimo = $request->input('montoMinimoEditar');
            $cupon->cantidad = $request->input('cantidadEditar');
            $cupon->fechaInicio = now()->createFromFormat("d/m/Y", $request->input('fechaInicioEditar'))->format("Y-m-d");
            $cupon->fechaExpiracion = now()->createFromFormat("d/m/Y", $request->input('fechaExpiracionEditar'))->format("Y-m-d");
            $cupon->estado = $request->input('estadoEditar');
            $cupon->update();

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
            $registro = Cupon::query()->findOrFail($request->input('idcupon'));
            $registro->estado    = 1;
            $registro->update();

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
            $registro = Cupon::query()->findOrFail($request->input('idcupon'));
            $registro->estado    = 0;

            $registro->update();

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
            $registro = Cupon::query()->findOrFail($request->input('idcupon'));
            $registro->delete();

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
