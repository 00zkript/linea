<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected  $table = 'empresa';
    protected $primaryKey = 'idempresa';
    public $timestamps = false;
    protected $guarded = [];
    protected $appends = ['igv_porcentaje','neto_porcentaje'];


    protected function getIgvPorcentajeAttribute()
    {
        $igv = $this->igv ?: 18;
        $porcentaje = $igv / (100 + $igv);

        return $porcentaje;
    }


    protected function getNetoPorcentajeAttribute()
    {
        $porcentaje = 1 - $this->igv_porcentaje;

        return $porcentaje;
    }


    public function moneda()
    {
        return $this->hasOne(Moneda::class,'idmoneda','idmoneda');
    }


}
