<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    //
 	protected $table = 'programa';
	protected $primaryKey = 'idprograma';
	public $timestamps = true;

    public function niveles()
    {
        return $this->hasMany(Nivel::class,'idprograma','idprograma');
    }


    public function frecuenciasPivot()
    {
        return $this->hasMany(ProgramaHasFrecuencia::class, 'idprograma', 'idprograma');
    }

    public function frecuencias()
    {
        return $this->belongsToMany(Frecuencia::class, ProgramaHasFrecuencia::class, 'idprograma', 'idfrecuencia', 'idprograma', 'idfrecuencia');
    }




    public function temporada()
    {
        return $this->hasOne(Temporada::class, 'idtemporada', 'idtemporada')->withDefault([
            'nombre' => 'Son temporada'
        ]);
    }
}
