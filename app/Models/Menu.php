<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Route;

class Menu extends Model
{
    protected $table = 'menu';
    protected $primaryKey = 'idmenu';
    public $timestamps = false;
    protected $guarded = [];

    protected $appends = ["ruta_completa"];


    public static function getRoutesInternal(){
        $rutaInterna = array();

        foreach (Route::getRoutes() as $k => $route) {

            $name = $route->getName();

            if ( strpos($name,"web.") !== false && substr_count($name,".") === 1){
                $url = route($name);



                $rutaInterna[]= (Object)[
                    "key" => $name,
                    "name" => $url,
                ];

            }
        }

        $rutaInterna = (Object)$rutaInterna ;

        return $rutaInterna;
    }

    public function submenus()
    {
        return $this->hasMany(Menu::class,'pariente','idmenu')
            ->with(['submenus'])
            ->where('estado',1)
            ->orderBY('posicion');
    }

    public function padre()
    {
        return $this->hasOne(Menu::class,'idmenu','pariente')
            ->withDefault([
                "nombre" => "Sin parientes"
            ]);

    }

    public function tipoRuta()
    {
        return $this->hasOne(TipoRuta::class,'idtipo_ruta','idtipo_ruta')
            ->withDefault([
                "nombre" => "Sin Ruta"
            ]);

    }

    protected function getRutaCompletaAttribute()
    {

        $tipoRuta = TipoRuta::query()->find($this->idtipo_ruta);

        if (!$tipoRuta || !$this->ruta || $this->ruta == 'javscript:void(0);'){
            return 'javascript:void(0);';
        }

        if (!$tipoRuta->is_internal){
            return $this->ruta;
        }

        if (!$tipoRuta->route_alias){
            return route($this->ruta);
        }


        return route($tipoRuta->route_alias,$this->ruta);

    }


}
