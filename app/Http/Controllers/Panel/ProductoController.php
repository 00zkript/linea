<?php

namespace App\Http\Controllers\Panel;

use Throwable;
use App\Models\Section;
use App\Models\Atributo;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductoImagen;
use App\Models\ProductoManual;
use App\Imports\ProductoImport;
use Illuminate\Support\Facades\DB;
use App\Models\ProductoRelacionado;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Panel\ProductoRequest;

class ProductoController extends Controller
{
    public function index()
    {

        $categorias = Categoria::query()
            ->where('estado', 1)
            ->orderBy('nivel')
            ->orderBy('nombre')
            ->get();


        $marcas = DB::table('marca')
            ->orderBy('nombre', 'ASC')
            ->where('estado', 1)
            ->get();

        $registros = Producto::query()
            ->with(["categoria"])
            ->orderBy('idproducto', 'DESC')
            ->paginate(10, ['*'], 'pagina', 1);

        $sections = Section::query()->where('estado',1)->get();


        return view('panel.producto.index')->with(compact('registros', 'categorias', 'marcas','sections'));
    }

    public function getResources(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $atributos = Atributo::query()
            ->where('estado',1)
            ->get();

        return response()->json([
            "atributos" => $atributos,
        ]);
    }

    public function listar(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $cantidadRegistros = $request->input('cantidadRegistros');
        $paginaActual = $request->input('paginaActual');
        $txtBuscar = $request->input('txtBuscar');

        $registros = Producto::query()
            ->with(["categoria"])
            ->when(!empty($txtBuscar), function ($query) use ($txtBuscar) {
                return $query->where('nombre', 'like', "%$txtBuscar%")
                    ->orWhere('codigo', 'like', "%$txtBuscar%");
            })
            ->orderBy('idproducto', 'DESC')
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);


        return response()->json(view('panel.producto.listado')->with(compact('registros'))->render());


    }

    public function create()
    {
        //
    }

    public function store(ProductoRequest $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();

        try {

            $producto                      = new Producto;
            $producto->idmarca             = $request->input('idmarca');
            $producto->idcategoria         = $request->input('idcategoria');
            $producto->idsection           = $request->input('idsection');
            $producto->codigo              = $request->input('codigo');
            $producto->nombre              = $request->input('nombre');
            $producto->slug                = Str::slug($request->input('nombre'));
            $producto->show_precio         = $request->input('showPrecio', 1);
            $producto->precio              = $request->input('precio', 0);
            $producto->precio_promocional  = $request->input('precio_promocional', 0);
            $producto->stock               = $request->input('stock');
            $producto->destacado           = $request->input('destacado', 0);
            $producto->nuevo               = $request->input('nuevo', 0);
            $producto->liquidacion         = $request->input('liquidacion', 0);
            $producto->descripcion_corta   = $request->input('descripcionCorta');
            $producto->descripcion         = $request->input('descripcion');
            $producto->ficha_tecnica       = $request->input('ficha_tecnica');
            $producto->video               = $request->input('video');
            $producto->estado              = $request->input('estado');
            $producto->save();

            foreach ($request->input("attributes",[]) as $atribute ){
                $producto->atributos()->attach($atribute['idatributo'], [
                    'valor' => $atribute['valor'],
                    'slug' => Str::slug($atribute['valor']),
                ]);
            }

            foreach ($request->input('idproductoRelacionado', []) as  $idproductoRelacionado) {
                $pivot = new ProductoRelacionado();
                $pivot->idproducto = $producto->idproducto;
                $pivot->idproducto_relacionado = $idproductoRelacionado;
                $pivot->save();
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

    public function show(Request $request, $id)
    {

    }

    public function edit(Request $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $producto = Producto::query()
            ->with(['imagenes', 'manuales', 'atributos', 'productosRelacionadosPivot'])
            ->where('idproducto', $request->input('idproducto'))
            ->first();



        if (!$producto) {
            return response()->json(["mensaje" => "Registro no encontrado"], 400);
        }


        return response()->json( $producto );

    }

    public function update(ProductoRequest $request, $id)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();

        try {

            $producto                      = Producto::query()->find($request->input('idproducto'));
            $producto->idmarca             = $request->input('idmarcaEditar');
            $producto->idcategoria         = $request->input('idcategoriaEditar');
            $producto->idsection           = $request->input('idsectionEditar');
            $producto->codigo              = $request->input('codigoEditar');
            $producto->nombre              = $request->input('nombreEditar');
            $producto->slug                = Str::slug($request->input('nombreEditar'));
            $producto->show_precio         = $request->input('showPrecioEditar', 1);
            $producto->precio              = $request->input('precioEditar', 0);
            $producto->precio_promocional  = $request->input('precio_promocionalEditar', 0);
            $producto->stock               = $request->input('stockEditar');
            $producto->destacado           = $request->input('destacadoEditar', 0);
            $producto->nuevo               = $request->input('nuevoEditar', 0);
            $producto->liquidacion         = $request->input('liquidacionEditar', 0);
            $producto->descripcion_corta   = $request->input('descripcionCortaEditar');
            $producto->descripcion         = $request->input('descripcionEditar');
            $producto->ficha_tecnica       = $request->input('ficha_tecnicaEditar');
            $producto->video               = $request->input('videoEditar');
            $producto->estado              = $request->input('estadoEditar');
            $producto->update();

            $producto->atributos()->detach();
            foreach ($request->input("attributesEditar",[]) as $atribute ){
                $producto->atributos()->attach($atribute['idatributo'], [
                    'valor' => $atribute['valor'],
                    'slug' => Str::slug($atribute['valor']),
                ]);
            }

            ProductoRelacionado::query()->where('idproducto',$producto->idproducto)->delete();
            foreach ($request->input('idproductoRelacionadoEditar', []) as  $idproductoRelacionado) {
                $pivot = new ProductoRelacionado();
                $pivot->idproducto = $producto->idproducto;
                $pivot->idproducto_relacionado = $idproductoRelacionado;
                $pivot->save();
            }



            DB::commit();
            return response()->json([
                'mensaje'=> "Registro actualizado exitosamente.",
            ]);

        } catch (Throwable $th) {
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
        if (!$request->ajax()) {
            return abort(404);
        }

        try {
            $producto = Producto::query()->find($request->input('idproducto'));
            $producto->estado = 1;
            $producto->update();

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
            $producto = Producto::query()->find($request->input('idproducto'));
            $producto->estado = 0;
            $producto->update();

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

        DB::beginTransaction();
        try {

            $producto = Producto::query()->find($request->input('idproducto'));
            $imagenes = ProductoImagen::query()
                ->where('idproducto', $producto->idproducto)
                ->get();

            $manuales = ProductoManual::query()
                ->where('idproducto', $producto->idproducto)
                ->get();

            foreach ($imagenes as $m) {
                if (Storage::disk('panel')->exists('producto/' . $m->imagen)) {
                    Storage::disk('panel')->delete('producto/' . $m->imagen);
                }
                ProductoImagen::query()->find($m->idproducto_imagen)->delete();
            }

            foreach ($manuales as $m) {
                if (Storage::disk('panel')->exists('manuales/' . $m->manual)) {
                    Storage::disk('panel')->delete('manuales/' . $m->manual);
                }
                ProductoManual::query()->find($m->idproducto_manual)->delete();
            }

            $producto->delete();
            DB::commit();


            return response()->json([
                'mensaje'=> "Registro eliminado exitosamente.",
            ]);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json([
                'mensaje'=> "No se pudo eliminar el registro.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }


    public function imagenUpload(Request $request)
    {
        if(!$request->ajax()){
            return abort(404);
        }

        $idproducto = Producto::query()->max('idproducto');


        foreach ($request->file('imagen', []) as $key => $imagen) {
            if ($request->hasFile('imagen.' . $key)) {
                $nombreImagen = Storage::disk('panel')->putFile('producto', $imagen);
                $imagenProducto = new ProductoImagen;
                $imagenProducto->idproducto = $idproducto;
                $imagenProducto->nombre = basename($nombreImagen);
                $imagenProducto->posicion = $key + 1;
                $imagenProducto->save();

            }
        }


        return response()->json([
            "mensaje" => "imagen agregados",
        ]);
    }

    public function imagenUpdate(Request $request)
    {
        if(!$request->ajax()){
            return abort(404);
        }

        $idproducto = $request->input('idproducto');
        $producto = Producto::query()->find($idproducto);

        if (!$producto){
            return abort(404);
        }

        $max = ProductoImagen::query()
            ->where('idproducto',$producto->idproducto)
            ->orderBy('posicion','desc')
            ->first();

        $maximaPosicion = $max ? $max->posicion : 0;


        foreach ($request->file('imagenEditar',[]) as $key => $img) {
            if ($request->hasFile('imagenEditar.'.$key)){

                $nombreImagen = Storage::disk('panel')->putFile('producto',$img);

                $imagen             = new ProductoImagen();
                $imagen->idproducto = $producto->idproducto ;
                $imagen->nombre     = basename($nombreImagen);
                $imagen->posicion   = $maximaPosicion + $key + 1;;
                $imagen->save();
            }
        }

        return response()->json([
            "mensaje" => "imagen agregados",
        ]);

    }

    public function imagenSort(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();
        try {

            $stack = $request->input('stack');

            foreach (json_decode($stack) as $key => $s) {

                $imagenProducto = ProductoImagen::query()->find($s->key);
                $imagenProducto->posicion = $key + 1;
                $imagenProducto->update();
            }

            DB::commit();

            return response()->json([
                'mensaje'=> "Orden modificado exitosamente.",
            ]);

        } catch (Throwable $th) {
            DB::rollBack();

            return response()->json([
                'mensaje'=> "No se pudo modificar el orden.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);
        }


    }

    public function imagenRemove(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();
        try {

            $imagen = ProductoImagen::query()->find($request->input('key'));
            Storage::disk('panel')->delete('producto/' . $imagen->imagen);
            $imagen->delete();
            DB::commit();

            return response()->json([
                "mensjae" => "Archivo eliminado exitosamente."
            ]);

        }catch (\Throwable $th){
            DB::rollBack();
            return response()->json([
                'mensaje'=> "No se pudo eliminar el archivo.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }



    }



    public function manualUpload(Request $request)
    {
        if(!$request->ajax()){
            return abort(404);
        }

        $idproducto = Producto::query()->max('idproducto');


        foreach ($request->file('manual', []) as $key => $manual) {
            if ($request->hasFile('manual.' . $key)) {
                $nombreManual = Storage::disk('panel')->putFile('manuales', $manual);

                $productoManual = new ProductoManual;
                $productoManual->idproducto = $idproducto;
                $productoManual->nombre     = basename($nombreManual);
                $productoManual->posicion   = $key + 1;;
                $productoManual->save();

            }
        }


        return response()->json([
            "mensaje" => "imagen agregados",
        ]);
    }

    public function manualUpdate(Request $request)
    {
        if(!$request->ajax()){
            return abort(404);
        }

        $idproducto = $request->input('idproducto');
        $producto = Producto::query()->find($idproducto);

        if (!$producto){
            return abort(404);
        }

        $max = ProductoManual::query()
            ->where('idproducto',$idproducto)
            ->orderBy('posicion','desc')
            ->first();

        $maximaPosicion = $max ? $max->posicion : 0;



        foreach ($request->file('manualEditar',[]) as $key => $manual) {
            if ($request->hasFile('manualEditar.'.$key)){

                $nombreManual = Storage::disk('panel')->putFile('manuales',$manual);

                $productoManual             = new ProductoManual();
                $productoManual->idproducto = $idproducto ;
                $productoManual->nombre     = basename($nombreManual);
                $productoManual->posicion   = $maximaPosicion + $key + 1;;
                $productoManual->save();
            }
        }

        return response()->json([
            "mensaje" => "imagen agregados",
        ]);

    }

    public function manualRemove(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        DB::beginTransaction();
        try {

            $manual = ProductoManual::query()->find($request->input('key'));
            Storage::disk('panel')->delete('manuales/' . $manual->manual);
            $manual->delete();
            DB::commit();

            return response()->json([
                "mensjae" => "Archivo eliminado exitosamente."
            ]);

        }catch (\Throwable $th){
            DB::rollBack();
            return response()->json([
                'mensaje'=> "No se pudo eliminar el archivo.",
                "error" => $th->getMessage(),
                "linea" => $th->getLine(),
            ],400);

        }


    }



    public function importarProductos(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        if (!$request->hasFile('excel')){
            return response()->json([
                "mensaje" => "No se subio ningun archivo.",
            ],400);
        }


        Excel::import(new ProductoImport(), $request->file('excel'));

        return response()->json([
           "mensaje" => "Se importo correctamente.",
        ]);


    }

    public function getProductos(Request $request)
    {
        if (!$request->ajax()){
            return abort(404);
        }

        $productos = DB::table('producto')
        // $productos = Producto::query()
            ->select([
                'idproducto',
                'nombre'
            ])
            ->where('estado',1)
            ->get();


        return response()->json(
            $productos->unsetAppends()->toArray()
        );
    }

}
