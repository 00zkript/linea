<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorito extends Model
{
    protected  $table = 'favorito';
    protected $primaryKey = 'idfavorito';
    public $timestamps = false;
    protected $guarded = [];


    public static function getCountFavoritos()
    {
        $countFavoritos = 0;
        if (auth()->check()){
            $cliente    = Cliente::query()->where("idusuario",auth()->id())->first();
            $countFavoritos = Favorito::query()
                ->selectRaw("count('idproducto') as cantidad")
                ->where("idcliente",$cliente->idcliente)
                ->first()
                ->cantidad;
        }else{
            if (session()->has('favorito')){
                $countFavoritos = count(session()->get('favorito'));
            }
        }

        return $countFavoritos;
    }


    public static function getFavoritos()
    {
        $favoritos = !session()->has("favorito") ? [] : session()->get("favorito");
        if (auth()->check()){
            $cliente    = Cliente::query()->where("idusuario",auth()->id())->first();

            $favoritos = Favorito::query()->where("idcliente",$cliente->idcliente)->get()->pluck("idproducto")->toArray();
        }
        return $favoritos;
    }


    public static function guardarFavoritos()
    {
        if (!session()->has('favorito')){
            return false;
        }

        $favoritos = session()->get('favorito');
        $cliente    = Cliente::query()->where("idusuario",auth()->id())->first();

        foreach ($favoritos as $item) {

            $favorito = new Favorito();
            $favorito->idproducto = $item;
            $favorito->idcliente = $cliente->idcliente;
            $favorito->save();

        }
        return true;
    }



}
