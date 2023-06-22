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


    public function carril()
    {
        return $this->hasOne(Carril::class, 'idcarril', 'idcarril')->withDefault([
            'nombre' => 'Sin carril'
        ]);
    }

}
