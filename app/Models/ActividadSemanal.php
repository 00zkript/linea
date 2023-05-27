<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActividadSemanal extends Model
{
    //
 	protected $table = 'actividad_semanal';
	protected $primaryKey = 'idactividad_semanal';
	// public $timestamps = false;


    public function dias()
    {
        return $this->belongsToMany(Dia::class, 'actividad_semanal_has_dia', 'idactividad_semanal', 'iddia');
    }
}
