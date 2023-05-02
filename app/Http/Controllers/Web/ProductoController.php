<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Traits\CategoriaTrait;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Empresa;
use App\Models\Favorito;
use App\Models\Marca;
use App\Models\Moneda;
use App\Models\Producto;
use App\Models\Atributo;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductoController extends Controller
{
    use CategoriaTrait;

    private function _view($view = 'web.productos.index')
    {
        $categorias = Categoria::query()
            ->with(['subcategorias'])
            ->where('estado', 1)
            ->whereNull('pariente')
            ->get();

        $sections = Section::query()
            ->where('estado',1)
            ->get();


        $caracteristicas = Atributo::query()
            ->where('estado',1)
            ->orderBy('nombre')
            ->get()
            ->filter(function ($item){
                $item->valores = DB::table('producto_has_atributo')
                    ->select('valor','slug')
                    ->where('idatributo', $item->idatributo)
                    ->groupBy('valor')
                    ->get();

                if (count($item->valores) > 0){
                    return $item;
                }

            });

        return view($view)->with(compact('categorias','caracteristicas','sections'));
    }

    public function index(Request $request,$buscadorGlobal = NULL)
    {

        $menuShow = "categoria";
        $titulo = str_replace("-"," ",$buscadorGlobal) ?:  'PRODUCTOS';

        return $this->_view()->with(compact('buscadorGlobal','menuShow','titulo'));
    }


    public function categoria(Request $request,  $slugCategoria)
    {

        $categoria = Categoria::query()
            ->where(DB::raw('concat(idcategoria,"-",slug)'), $slugCategoria)
            ->where('estado', 1)
            ->first();

        if ($slugCategoria == '0-sin-categoria'){
            $categoria = (object) [
              "idcategoria" => 0,
              "nombre" => "Sin Categoria",
              "pariente" => null,
              "padre" => "",
            ];
        }


        if (!$categoria){
            return abort(404);
        }


        $idsParent = $this->_getParentIds($categoria->pariente);
        $parentsCategoria= Categoria::query()->orderBy('nivel')->whereIn("idcategoria",$idsParent)->get();

        $menuShow = "categoria";
        $titulo = $categoria->nombre;

        return $this->_view()->with(compact('categoria','menuShow','idsParent','parentsCategoria','titulo'));
    }




    public function section(Request $request, $slugSection)
    {

        $section = Section::query()
            ->where(DB::raw('concat(idsection,"-",slug)'), $slugSection)
            ->where('estado', 1)
            ->first();

        if ($slugSection == '0-sin-seccion'){
            $section = (object) [
                "idsection" => 0,
                "nombre" => "Sin Sección",
                "slug" => "sin-seccion",
            ];
        }


        if (!$section){
            return abort(404);
        }

        $menuShow = "section";
        $titulo = $section->nombre;


        return $this->_view()->with(compact('section','menuShow','titulo'));
    }



    public function marca(Request $request,  $slugMarca)
    {

        $marca = Marca::query()
            ->where(DB::raw('concat(idmarca,"-",slug)'), $slugMarca)
            ->where('estado', 1)
            ->first();

        if ($slugMarca == '0-sin-marca'){
            $marca = (object) [
                "idmarca" => 0,
                "nombre" => "Sin marca",
            ];
        }


        if (!$marca){
            return abort(404);
        }


        $menuShow = "marca";
        $titulo = $marca->nombre;

        return $this->_view()->with(compact('marca','menuShow','titulo'));

    }


    public function caracteristica(Request $request, $slugAtributo, $slugValor)
    {

        $atributo = Atributo::query()
            ->where('slug', $slugAtributo)
            ->where('estado', 1)
            ->first();

        if (!$atributo){
            return abort(404);
        }

        $valor = DB::table('producto_has_atributo')
            ->where('idatributo', $atributo->idatributo)
            ->where('valor', $slugValor)
            ->first();

        $menuShow = $slugAtributo;
        $titulo = $valor->valor;



        return $this->_view()->with(compact('atributo', 'valor','menuShow','titulo'));

    }




    public function detalle(Request $request, $slug)
    {


        $producto = Producto::query()
            ->with(['imagenes','marca'])
            ->orderBy('idproducto', 'DESC')
            ->where('slug', $slug)
            ->where('estado', 1)
            ->first();

        if (!$producto) {
            return abort(404, 'ESTE PRODUCTO NO EXISTE.');
        }

        $categoria = Categoria::query()
            ->where('idcategoria', $producto->idcategoria)
            ->where('estado', 1)
            ->first();

        $idsParent = $this->_getParentIds($categoria ? $categoria->pariente : null);
        $parentsCategoria = Categoria::query()->orderBy('nivel')->whereIn("idcategoria",$idsParent)->get();


        $idCategoriasHijas = $this->_getSubCategoriasIds([ $producto->idcategoria]);



        $productosRelacionados = Producto::query()
            ->with(['marca'])
            ->orderBy('idproducto', 'DESC')
            ->whereIn('idcategoria', $idCategoriasHijas)
            ->where('idproducto', '!=', $producto->idproducto)
            ->where('estado', 1)
            ->take(8)
            ->get();

        $manuales = DB::table('producto_manual')
            ->where('idproducto', $producto->idproducto)
            ->get();


        $favoritos = Favorito::getFavoritos();


        return view('web.productos.detalle')->with(compact('producto', 'categoria', 'productosRelacionados', 'manuales','favoritos','parentsCategoria'));



    }

    public function buscadorGlobalAjax(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $valor = $request->input('valor');

        $productos = Producto::query()
            ->where('estado', 1)
            ->where(function ($query) use ($valor) {
                $query->where('nombre', 'like', '%' . $valor . '%')
                    ->orWhere('descripcion', 'like', '%' . $valor . '%');
            })
            ->orderBy('idproducto', 'DESC')
            ->take(10)
            ->get();

        return response()->json(view('web.productos.buscadorGlobal')->with(compact('productos', 'valor'))->render());


    }

    public function listadoProductosAjax(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }


        $buscadorGlobal      = $request->input('buscadorGlobal');
        $paginaActual        = $request->input('paginaActual');
        $cantidadRegistros   = $request->input('cantidadRegistros');
        $idcategoria         = $request->input('categoria');
        $idsection           = $request->input('section');
        $idmarca             = $request->input('marca');
        $rangoPrecio         = $request->input('rangoPrecio');
        $presentacion        = $request->input('presentacion');
        $orden               = $request->input('orden');
        $slugAtributo        = $request->input('slugAtributo');
        $slugValor           = $request->input('slugValor');
        $atributoValor = [];

        $titulo = 'Productos';
        $descripcion = '';

        if(!empty($buscadorGlobal)){
            $titulo = "BUSQUEDA: ".str_replace("-"," ",$buscadorGlobal);
        }

        if( $idcategoria !== null){
            $c = Categoria::query()->find($idcategoria);
            $titulo = $c->nombre ?? 'Sin categoria';
            $descripcion = $c->descripcion ?? '';
        }

        if( $idsection !== null){
            $s = Section::query()->find($idsection);
            $titulo = $s->nombre ?? 'Sin Sección';
            $descripcion = $s->contenido ?? '';
        }

        if( $idmarca !== null ){
            $m = Marca::query()->find($idmarca);
            $titulo = $m->nombre ?? 'Sin marca';
            $descripcion = $m->descripcion ?? '';
        }


        if(!empty($slugValor) && !empty($slugAtributo)){

            $atributoValor = DB::table('producto_has_atributo as privot')
                ->select([
                    'pa.nombre',
                    'privot.idatributo',
                    'privot.idproducto',
                    'privot.valor',
                ])
                ->leftJoin('atributo as pa', 'privot.idatributo', '=', 'pa.idatributo')
                ->where('pa.slug', $slugAtributo)
                ->where('privot.valor', $slugValor)
                ->first();


            $titulo = $atributoValor->valor;
        }

        $favoritos = Favorito::getFavoritos();

        $productos = Producto::query()
            ->with(["marca"])
            ->where('estado', 1)
            ->when(!empty($buscadorGlobal), function ($query) use ($buscadorGlobal) {
                return $query->where('nombre', 'LIKE', '%' . $buscadorGlobal . '%');
            })
            ->when($idsection !== null, function ($query) use ($idsection) {
                if ($idsection === "0"){
                    return  $query->whereNull('idsection');
                }

                return $query->where('idsection', $idsection);
            })
            ->when( $idcategoria !== null, function ($query) use ($idcategoria) {
                if ($idcategoria === "0"){
                    return  $query->whereNull('idcategoria');
                }


                $idCategoriasHijas = $this->_getSubCategoriasIds([ $idcategoria ]);


                return $query->whereIn('idcategoria', $idCategoriasHijas);
            })
            ->when( $idmarca !== null, function ($query) use ($idmarca) {
                if ($idmarca === "0"){
                    return  $query->whereNull('idmarca');
                }

                return $query->where('idmarca', $idmarca);
            })
            ->when(!empty($rangoPrecio), function ($query) use ($rangoPrecio) {

                $rango = explode("-",$rangoPrecio);
                $min = $rango[0];
                $max = $rango[1];

                return $query->whereBetween('precio', [$min, $max]);
            })
            ->when(!empty($atributoValor) , function ($query) use ($atributoValor) {

                $productoAtributoIds = DB::table('producto_has_atributo')
                    ->where('idatributo', $atributoValor->idatributo)
                    ->pluck('idproducto')
                    ->toArray();

                return $query->whereIn('idproducto',$productoAtributoIds);
            })
            ->when(!empty($orden),function ($query) use ($orden){
                if( $orden == "a-z" ){
                    return $query->orderBy('nombre', 'ASC');
                }

                if( $orden == "z-a" ){
                    return $query->orderBy('nombre', 'DESC');
                }

                if( $orden == "barato" ){
                    return $query->orderBy('precio', 'ASC');
                }

                if( $orden == "caro" ){
                    return $query->orderBy('precio', 'DESC');
                }

                if( $orden == "ultimos-productos" ){
                    return $query->orderBy('idproducto', 'DESC');
                }

                return $query->orderBy('idproducto', 'DESC');
            })
            ->paginate($cantidadRegistros, ['*'], 'pagina', $paginaActual);



        /* return response()->json([
            "total_productos" => $productos->total(),
            "count_productos" => $productos->count(),
            "view" => view('web.productos.partes.listaProductos')->with(compact('productos','cantidadRegistros','orden','presentacion','titulo' ,'favoritos','descripcion'))->render()
        ]); */
        return response()->json(view('web.productos.partes.listaProductos')->with(compact('productos','cantidadRegistros','orden','presentacion','titulo' ,'favoritos','descripcion'))->render());

    }




    public function cambiarPresentacion(Request $request)
    {
        if (!$request->ajax()) {
            return abort(404);
        }

        $valor = $request->input('valor');

        session()->put('presentacion', $valor);

        return response()->json([
            "mensaje" => 'Presentacion cambiada'
        ]);


    }





}
