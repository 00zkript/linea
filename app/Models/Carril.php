<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carril extends Model
{
    //
 	protected $table = 'carril';
	protected $primaryKey = 'idcarril';
	public $timestamps = true;

    public function frecuenciasPivot()
    {
        return $this->hasMany(CarrilHasFrecuencia::class, 'idcarril', 'idcarril');
    }

    public function frecuencias()
    {
        return $this->belongsToMany(Frecuencia::class, CarrilHasFrecuencia::class, 'idcarril', 'idfrecuencia', 'idcarril', 'idfrecuencia');
    }


    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'idnivel', 'idnivel')->withDefault([
            'nombre' => 'Sin nivel'
        ]);
    }
}
