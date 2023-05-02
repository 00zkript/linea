<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\panel\CostoEnvioRequest;
use App\Models\CostoEnvio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CostoEnvioController extends Controller
{

    public function index()
    {
        $departamentos = DB::table('ubigeo_departamento')->get();

        $costoEnvios = DB::table('costo_envio AS c')
            ->leftJoin('ubigeo_departamento AS ud', 'ud.iddepartamento', '=', 'c.iddepartamento')
            ->leftJoin('ubigeo_provincia AS up', 'up.idprovincia', '=', 'c.idprovincia')
            ->leftJoin('ubigeo_distrito AS udis', 'udis.iddistrito', '=', 'c.iddistrito')
            ->selectRaw('c.*,ud.nombre AS departamento,up.nombre AS provincia,udis.nombre AS distrito')
            ->orderBy('c.idcosto_envio', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.costoEnvio.index')->with(compact('costoEnvios', 'departamentos'));
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->cantidadRegistros;
        $paginaActual = $request->paginaActual;
        $txtBuscar = trim($request->txtBuscar);

        $costoEnvios = DB::table('costo_envio AS c')
            ->leftJoin('ubigeo_departamento AS ud', 'ud.iddepartamento', '=', 'c.iddepartamento')
            ->leftJoin('ubigeo_provincia AS up', 'up.idprovincia', '=', 'c.idprovincia')
            ->leftJoin('ubigeo_distrito AS udis', 'udis.iddistrito', '=', 'c.iddistrito')
            ->selectRaw('c.*,ud.nombre AS departamento,up.nombre AS provincia,udis.nombre AS distrito')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('c.descripcion LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('c.idcosto_envio', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.costoEnvio.listado')->with(compact('costoEnvios'))->render());


    }


    public function create()
    {
        //
    }

    public function store(CostoEnvioRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try{

            $costoEnvio = new CostoEnvio;
            $costoEnvio->iddepartamento = $request->input('iddepartamento');
            $costoEnvio->idprovincia = $request->input('idprovincia');
            $costoEnvio->iddistrito = $request->input('iddistrito');
            $costoEnvio->precio = $request->input('precio');
            $costoEnvio->descripcion = $request->input('descripcion');
            $costoEnvio->restriccion = $request->input('restriccion');
            $costoEnvio->estado = $request->input('estado');
            $costoEnvio->save();



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

        $idcosto_envio = $request->input('idcosto_envio');

        $costoEnvio = DB::table('costo_envio AS c')
            ->leftJoin('ubigeo_departamento AS ud', 'ud.iddepartamento', '=', 'c.iddepartamento')
            ->leftJoin('ubigeo_provincia AS up', 'up.idprovincia', '=', 'c.idprovincia')
            ->leftJoin('ubigeo_distrito AS udis', 'udis.iddistrito', '=', 'c.iddistrito')
            ->selectRaw('c.*,ud.nombre AS departamento,up.nombre AS provincia,udis.nombre AS distrito')
            ->where('c.idcosto_envio', $idcosto_envio)
            ->first();


        if(!$costoEnvio){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($costoEnvio);


    }


    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idcosto_envio = $request->input('idcosto_envio');

        $costoEnvio = DB::table('costo_envio AS c')
            ->selectRaw('c.*')
            ->where('c.idcosto_envio', $idcosto_envio)
            ->first();

        if(!$costoEnvio){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($costoEnvio);


    }


    public function update(CostoEnvioRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try{

            $costoEnvio = CostoEnvio::query()->findOrFail($request->input('idcosto_envio'));
            $costoEnvio->iddepartamento = $request->input('iddepartamentoEditar');
            $costoEnvio->idprovincia = $request->input('idprovinciaEditar');
            $costoEnvio->iddistrito = $request->input('iddistritoEditar');
            $costoEnvio->precio = $request->input('precioEditar');
            $costoEnvio->descripcion = $request->input('descripcionEditar');
            $costoEnvio->restriccion = $request->input('restriccionEditar');
            $costoEnvio->estado = $request->input('estadoEditar');
            $costoEnvio->update();


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
            $registro = CostoEnvio::query()->findOrFail($request->input('idcosto_envio'));
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
            $registro = CostoEnvio::query()->findOrFail($request->input('idcosto_envio'));
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

    public function destroy(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $registro = CostoEnvio::query()->findOrFail($request->input('idcosto_envio'));
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

    public function getProvincia(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $iddepartamento = $request->input('iddepartamento');

        $provincias = DB::table('ubigeo_provincia')
            ->where('iddepartamento', $iddepartamento)
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($provincias);


    }

    public function getDistrito(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $idprovincia = $request->input('idprovincia');

        $distritos = DB::table('ubigeo_distrito')
            ->where('idprovincia', $idprovincia)
            ->orderBy('nombre', 'ASC')
            ->get();

        return response()->json($distritos);


    }
}
