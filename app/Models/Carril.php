<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carril extends Model
{
    //
 	protected $table = 'carril';
	protected $primaryKey = 'idcarril';
	public $timestamps = true;

    public function frecuencias()
    {
        return $this->hasMany(Frecuencia::class,'idcarril','idcarril');
    }


    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'idnivel', 'idnivel')->withDefault([
            'nombre' => 'Sin nivel'
        ]);
    }
}
