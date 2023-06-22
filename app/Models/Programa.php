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


    public function temporada()
    {
        return $this->hasOne(Temporada::class, 'idtemporada', 'idtemporada');
    }
}
