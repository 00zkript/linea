<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Piscina extends Model
{
    //
 	protected $table = 'piscina';
	protected $primaryKey = 'idpiscina';
	// public $timestamps = false;


    public function carriles()
    {
        return $this->hasMany(Carril::class,'idpiscina','idpiscina');
    }

}
