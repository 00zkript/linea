<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nivel extends Model
{
    //
 	protected $table = 'nivel';
	protected $primaryKey = 'idnivel';
	public $timestamps = true;



    public function programasPivot()
    {
        return $this->hasMany(ProgramaHasFrecuencia::class, 'idnivel', 'idnivel');
    }

    public function programas()
    {
        return $this->belongsToMany(Frecuencia::class, ProgramaHasFrecuencia::class, 'idnivel', 'idprograma', 'idnivel', 'idprograma');
    }


    public function carrilesPivot()
    {
        return $this->hasMany(NivelhasCarril::class, 'idnivel', 'idnivel');
    }

    public function carriles()
    {
        return $this->belongsToMany(Carril::class,NivelhasCarril::class,'idnivel', 'idcarril','idnivel', 'idcarril');
    }

}
