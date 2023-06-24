<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Frecuencia extends Model
{
    //
 	protected $table = 'frecuencia';
	protected $primaryKey = 'idfrecuencia';
	public $timestamps = true;

    public function horarios()
    {
        return $this->hasMany(Horario::class,'idfrecuencia','idfrecuencia');
    }



    public function carrilesPivot()
    {
        return $this->hasMany(CarrilHasFrecuencia::class, 'idfrecuencia', 'idfrecuencia');
    }

    public function carriles()
    {
        return $this->belongsToMany(Carril::class, CarrilHasFrecuencia::class, 'idfrecuencia', 'idcarril', 'idfrecuencia', 'idcarril');
    }

}
