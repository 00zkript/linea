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


    public function programa()
    {
        return $this->hasOne(Programa::class,'idprograma','idprograma')->withDefault([
            'nombre' => 'Sin programa'
        ]);
    }

}
