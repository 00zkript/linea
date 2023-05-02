<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\CategoriaRequest;
use App\Http\Traits\CategoriaTrait;
use App\Models\Categoria;
use App\Models\CategoriaMarca;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class CategoriaController extends Controller
{
    use CategoriaTrait;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $marcas = DB::table('marca')
            ->select('idmarca', 'nombre')
            ->where('estado', 1)
            ->get();

        $categorias = DB::table('categoria AS c')
            ->selectRaw('c.*')
            ->orderBy('c.idcategoria', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        return view('panel.categoria.index')->with(compact('categorias', 'marcas'));
    }


    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->cantidadRegistros;
        $paginaActual = $request->paginaActual;
        $txtBuscar = trim($request->txtBuscar);

        $categorias = DB::table('categoria AS c')
            ->selectRaw('c.*')
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->whereRaw('c.nombre LIKE ? ', ["%" . $txtBuscar . "%"]);
            })
            ->orderBy('c.idcategoria', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);

        return response()->json(view('panel.categoria.listado')->with(compact('categorias'))->render());


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
    public function store(CategoriaRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();

        try {

            $categoria = new Categoria;
            $categoria->pariente = $request->input('pariente');
            $categoria->nombre = $request->input('nombre');
            $categoria->slug = Str::slug($request->input('nombre'));
            $categoria->nivel = $request->input('nivel');
            $categoria->color = $request->input('color');
            $categoria->orden = $request->input('orden');
            $categoria->descripcion = $request->input('descripcion');
            $categoria->estado = $request->input('estado');
            $categoria->save();

            foreach ($request->input('marca', []) as $marca) {

                $categoriaMarca = new CategoriaMarca;
                $categoriaMarca->idcategoria = $categoria->idcategoria;
                $categoriaMarca->idmarca = $marca;
                $categoriaMarca->save();
            }

            DB::commit();

            return response()->json([
                'mensaje'=> "Registro creado exitosamente.",
            ]);

        } catch (Throwable $th) {
            DB::rollBack();

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

        $categoria = Categoria::query()->find($request->input('idcategoria'));

        if(!$categoria){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        $pariente = DB::table('categoria')
            ->select('nombre')
            ->where('idcategoria', $categoria->pariente)
            ->first();

        $marcas = DB::table('categoria_marca')
            ->where('idcategoria', $categoria->idcategoria)
            ->pluck('idmarca')
            ->toArray();


        return response()->json([
            "categoria" => $categoria,
            "pariente" => $pariente,
            "marcas" => $marcas,
        ]);


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

        $categoria = Categoria::query()->find($request->input('idcategoria'));

        if(!$categoria){
            return response()->json( ['mensaje' => "Registro no encontrado"],400);
        }

        $marcas = DB::table('categoria_marca')
            ->where('idcategoria', $categoria->idcategoria)
            ->pluck('idmarca')
            ->toArray();


        return response()->json([
            "categoria" => $categoria,
            "marcas" => $marcas
        ]);



    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(CategoriaRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        DB::beginTransaction();
        try{
            $categoria              = Categoria::query()->findOrFail($request->input('idcategoria'));
            $categoria->pariente    = $request->input('parienteEditar');
            $categoria->nombre      = $request->input('nombreEditar');
            $categoria->slug        = Str::slug($request->input('nombreEditar'));
            $categoria->nivel       = $request->input('nivelEditar');
            $categoria->color       = $request->input('colorEditar');
            $categoria->orden       = $request->input('ordenEditar');
            $categoria->descripcion = $request->input('descripcionEditar');
            $categoria->estado      = $request->input('estadoEditar');
            $categoria->update();


            CategoriaMarca::where('idcategoria', $categoria->idcategoria)->delete();
            foreach ($request->input('marcaEditar', []) as $marca) {

                $categoriaMarca              = new CategoriaMarca;
                $categoriaMarca->idcategoria = $categoria->idcategoria;
                $categoriaMarca->idmarca     = $marca;
                $categoriaMarca->save();
            }

            DB::commit();


            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();

            return response()->json([
                'mensaje'=> "No se pudo actualizar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }




    public function habilitar(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = Categoria::query()->findOrFail($request->input('idcategoria'));
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
        if (!$request->ajax()){
            return abort(404);
        }

        try {
            $registro = Categoria::query()->findOrFail($request->input('idcategoria'));
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


        $idcategoria = $request->input('idcategoria');
        try {

            $categoria = Categoria::query()->findOrFail($idcategoria);

            Categoria::query()->where('pariente',$idcategoria)->update([
                "pariente" => $categoria->pariente,
            ]);

            $subCategoriasIds = $this->_getSubCategoriasIds([$idcategoria]);
            if (count($subCategoriasIds) > 0) {
                Categoria::query()->whereIn('idcategoria',$subCategoriasIds)->each(function ($subcategoria) {
                    $subcategoria->nivel = $subcategoria->nivel > 1 ? $subcategoria->nivel - 1 : 1;
                    $subcategoria->update();
                });
            }

            CategoriaMarca::query()->where('idcategoria', $idcategoria)->delete();

            Producto::query()->where('idcategoria',$idcategoria)->update([
                "idcategoria" => $categoria->pariente,
            ]);



            $categoria->delete();


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


    private function _updateNivelSubCategorias($idsCategorias)
    {


    }


    public function getParientes(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $nivel = $request->input('nivel');

        $parientes = DB::table('categoria AS c')
            ->selectRaw('
                c.idcategoria,
                c.nombre,
                (SELECT ca.nombre FROM categoria AS ca WHERE c.pariente = ca.idcategoria LIMIT 1) AS nombrePariente
                ')
            ->when($nivel == 1, function ($query) use ($nivel) {
                $query->where('c.nivel', 0);
            })
            ->when($nivel == 2, function ($query) use ($nivel) {
                $query->where('c.nivel', 1);
            })
            ->when($nivel == 3, function ($query) use ($nivel) {
                $query->where('c.nivel', 2);
            })
            ->where('c.estado', 1)
            ->get();


        return response()->json($parientes);


    }




    public function getOrden(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $nivel = $request->input('nivel');

        $orden = DB::table('categoria')
            ->select('orden')
            ->where('nivel', $nivel)
            ->max('orden');



        return response()->json(["maxima_posicion" => $orden + 1]);


    }
}
