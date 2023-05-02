<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\MarcaRequest;
use App\Models\Marca;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MarcaController extends Controller
{

    public function index()
    {

        $marcas = DB::table('marca AS m')
            ->selectRaw('m.*')
            ->orderBy('m.idmarca', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.marca.index')->with(compact('marcas'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $marcas = DB::table('marca AS m')
            ->selectRaw('m.*')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('m.nombre LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('m.idmarca', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.marca.listado')->with(compact('marcas'))->render());


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


    public function store(MarcaRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        try {

            $marca              = new Marca;
            $marca->nombre      = $request->input('nombre');
            $marca->slug        = Str::slug($request->input('nombre'));
            $marca->descripcion = $request->input('descripcion');
            $marca->estado      = $request->input('estado');

            if ($request->hasFile('imagen')) {
                $imagen = Storage::disk('panel')->putFile('marcas', $request->file('imagen'));
                $marca->imagen = basename($imagen);
            }

            $marca->save();

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

        $marca = Marca::query()->find($request->input('idmarca'));

        if(!$marca){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($marca);


    }


    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $marca = Marca::query()->find($request->input('idmarca'));

        if(!$marca){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }


        return response()->json($marca);

    }


    public function update(MarcaRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        try {

            $marca = Marca::query()->findOrFail($request->input('idmarca'));
            $marca->nombre = $request->input('nombreEditar');
            $marca->slug = Str::slug($request->input('nombreEditar'));

            if ($request->hasFile('imagenEditar')) {

                if (Storage::disk('panel')->exists('marcas/' . $marca->imagen)) {
                    Storage::disk('panel')->delete('marcas/' . $marca->imagen);
                }

                $imagen = Storage::disk('panel')->putFile('marcas', $request->file('imagenEditar'));
                $marca->imagen = basename($imagen);
            }
            $marca->descripcion = $request->input('descripcionEditar');
            $marca->estado = $request->input('estadoEditar');
            $marca->update();


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
            $marca = Marca::query()->find($request->input('idmarca'));
            $marca->estado = 1;
            $marca->update();


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

            $marca = Marca::query()->find($request->input('idmarca'));
            $marca->estado = 0;
            $marca->update();

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

        $idmarca = $request->input('idmarca');
        try {
            $marca = Marca::query()->find($idmarca);
            if (Storage::disk('panel')->exists('marcas/' . $marca->imagen)) {
                Storage::disk('panel')->delete('marcas/' . $marca->imagen);
            }

            $marca->delete();

            Producto::query()->where('idmarca',$idmarca)->update([
                "idmarca" => null,
            ]);

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
