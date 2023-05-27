<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temporada extends Model
{
    //
 	protected $table = 'temporada';
	protected $primaryKey = 'idtemporada';
	// public $timestamps = false;


    public function programas()
    {
        return $this->hasMany(Programa::class,'idtemporada','idtemporada');
    }

}
