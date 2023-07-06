<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    //
 	protected $table = 'programa';
	protected $primaryKey = 'idprograma';
	public $timestamps = true;

    public function nivelesPivot()
    {
        return $this->hasMany(ProgramaHasNivel::class, 'idprograma', 'idprograma');
    }

    public function niveles()
    {
        return $this->belongsToMany(Nivel::class,ProgramaHasNivel::class,'idprograma', 'idnivel','idprograma', 'idnivel');
    }


    public function frecuenciasPivot()
    {
        return $this->hasMany(ProgramaHasFrecuencia::class, 'idprograma', 'idprograma');
    }

    public function frecuencias()
    {
        return $this->belongsToMany(Frecuencia::class, ProgramaHasFrecuencia::class, 'idprograma', 'idfrecuencia', 'idprograma', 'idfrecuencia');
    }

}
