<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected  $table = 'banner';
    protected $primaryKey = 'idbanner';
    public $timestamps = false;
    protected $guarded = [];

    protected $appends = ["ruta_completa"];

    public function tipoRuta()
    {
        return $this->hasOne(TipoRuta::class,'idtipo_ruta','idtipo_ruta')
            ->withDefault([
                "nombre" => "Sin Ruta"
            ]);

    }

    public function tipo()
    {
        return $this->hasOne(BannerTipo::class,'idbanner_tipo','idbanner_tipo');
    }

    protected function getRutaCompletaAttribute()
    {

        $tipoRuta = TipoRuta::query()->find($this->idtipo_ruta);

        if (!$tipoRuta || !$this->ruta){
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
