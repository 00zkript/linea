<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    //
 	protected $table = 'nivel';
	protected $primaryKey = 'idnivel';
	public $timestamps = true;


    public function carriles()
    {
        return $this->hasMany(Carril::class,'idnivel','idnivel');
    }



    public function programasPivot()
    {
        return $this->hasMany(ProgramaHasFrecuencia::class, 'idnivel', 'idnivel');
    }

    public function programas()
    {
        return $this->belongsToMany(Frecuencia::class, ProgramaHasFrecuencia::class, 'idnivel', 'idprograma', 'idnivel', 'idprograma');
    }

}
