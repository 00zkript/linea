<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Traits\CategoriaTrait;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Categoria;
use App\Models\Cliente;
use App\Models\Favorito;
use App\Models\Producto;
use App\Models\Section;
use App\Models\SectionHome;
use App\Models\Testimonio;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    use CategoriaTrait;

    public function index(Request $request)
    {
        $favoritos = Favorito::getFavoritos();


        $secciones = SectionHome::query()
            ->with(["links"])
            ->where('estado',1)
            ->orderBy('posicion','ASC')
            ->get();

        $secciones = $secciones->map(function($seccion){

            $seccion->slider =  [];

            if($seccion->tipo == 'slider'){
                $seccion->slider =  Producto::query()
                    ->with(['marca', 'categoria'])
                    ->when($seccion->idmarca, function ($query) use ($seccion) {
                        return $query->where('idmarca', $seccion->idmarca);
                    })
                    ->when($seccion->idcategoria, function ($query) use ($seccion) {
                        return $query->where('idcategoria', $seccion->idcategoria);
                    })
                    ->when($seccion->idsection, function ($query) use ($seccion) {
                        return $query->where('idsection', $seccion->idsection);
                    })
                    ->when($seccion->nuevo, function ($query) use ($seccion) {
                        return $query->where('nuevo', $seccion->nuevo);
                    })
                    ->when($seccion->destacado, function ($query) use ($seccion) {
                        return $query->where('destacado', $seccion->destacado);
                    })
                    ->when($seccion->liquidacion, function ($query) use ($seccion) {
                        return $query->where('liquidacion', $seccion->liquidacion);
                    })
                    ->where('estado',1)
                    ->orderBy('idproducto', 'DESC')
                    ->take($seccion->cantidad_slider ?: 15)
                    ->get();

            }

            $seccion->productos = [];

            if($seccion->tipo == 'productos') {
                $productos = [];
                foreach ($seccion->products()->pluck('idproducto')->toArray() as $id) {
                    $product = Producto::query()
                        ->with(['marca', 'categoria'])
                        ->where('estado',1)
                        ->where('idproducto', $id)
                        ->first();

                    if ($product) {
                        $seccion->productos[] = $product;
                    }
                }
                $seccion->productos = $productos;
            }


            return $seccion;
        });


        $testimonios = Testimonio::query()
            ->where('estado',1)
            ->orderBy('idtestimonio','DESC')
            ->get();



        return view('web.inicio.index')->with(compact('secciones',   'favoritos', 'testimonios'));
    }






}
