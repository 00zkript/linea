<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carril extends Model
{
    //
 	protected $table = 'carril';
	protected $primaryKey = 'idcarril';
	public $timestamps = true;

    public function nivelesPivot()
    {
        return $this->hasMany(NivelhasCarril::class, 'idcarril', 'idcarril');
    }

    public function niveles()
    {
        return $this->belongsToMany(Nivel::class,NivelhasCarril::class,'idcarril', 'idnivel','idcarril', 'idnivel');
    }

}
