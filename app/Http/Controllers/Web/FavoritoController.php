<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\Favorito;
use App\Models\Producto;
use Illuminate\Http\Request;

class FavoritoController extends Controller
{

    public function index()
    {
        $favoritos = Favorito::getFavoritos();

        $productos = Producto::query()
            ->whereIn('idproducto',$favoritos)
            ->paginate(16,["*"],'pagina',1);

        return view('web.favoritos.index')->with(compact('productos','favoritos'));
    }

    public function listado(Request $request)
    {
        $paginaActual  = $request->input('paginaActual');
        $cantidadPaginas  = $request->input('cantidadPaginas');

        $favoritos = Favorito::getFavoritos();

        $productos = Producto::query()
            ->whereIn('idproducto',$favoritos)
            ->paginate($cantidadPaginas,["*"],'pagina',$paginaActual);

        return view('web.favoritos.carruselProductos')->with(compact('productos'))->render();
    }


    public function agregar(Request $request)
    {


        if (auth()->check()){
            $cliente    = Cliente::query()->where("idusuario",auth()->id())->first();

            $favorito = new Favorito();
            $favorito->idproducto = $request->idproducto;
            $favorito->idcliente = $cliente->idcliente;
            $favorito->save();

        }else{
            if (!session()->has("favorito")){
                session()->put("favorito",[]);
            }

            session()->push("favorito",$request->idproducto);
        }



        return response()->json([
            "mensaje" => "Se agregó a favoritos exitosamente.",
            "count" => Favorito::getCountFavoritos(),
        ]);
    }



    public function eliminar(Request $request){
        if (auth()->check()){
            $cliente    = Cliente::query()->where("idusuario",auth()->id())->first();

            Favorito::query()
                ->where("idcliente",$cliente->idcliente)
                ->where("idproducto",$request->idproducto)
                ->delete();

        }else{
            if (session()->has("favorito")){
                $favoritos = session()->pull("favorito",[]);

                $favoritos = array_filter($favoritos,function ($value) use($request) {
                    return $value != $request->idproducto;
                });

                session()->put("favorito",$favoritos);

            }
        }

        return response()->json([
            "mensaje" => "Se eliminó de favoritos exitosamente.",
            "count" => Favorito::getCountFavoritos(),
        ]);
    }


}
