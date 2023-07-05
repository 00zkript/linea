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



    public function programasPivot()
    {
        return $this->hasMany(ProgramaHasFrecuencia::class, 'idfrecuencia', 'idfrecuencia');
    }

    public function programas()
    {
        return $this->belongsToMany(Programa::class, ProgramaHasFrecuencia::class, 'idfrecuencia', 'idprograma', 'idfrecuencia', 'idprograma');
    }

}
