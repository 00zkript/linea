<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario extends Model
{
    //
 	protected $table = 'horario';
	protected $primaryKey = 'idhorario';
	public $timestamps = true;

    public function frecuencia()
    {
        return $this->hasOne(Frecuencia::class, 'idfrecuencia', 'idfrecuencia' )->withDefault([
            'nombre' => 'Sin frecuencia'
        ]);
    }

}
