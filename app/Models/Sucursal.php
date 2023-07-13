<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    //
 	protected $table = 'sucursal';
	protected $primaryKey = 'idsucursal';
	public $timestamps = false;


    public function departamento()
    {
        return $this->hasOne(Departamento::class,'iddepartamento','iddepartamento')->withDefault([
            'nombre' => 'Sin departamento'
        ]);
    }

    public function provincia()
    {
        return $this->hasOne(Provincia::class,'idprovincia','idprovincia')->withDefault([
            'nombre' => 'Sin provincia'
        ]);
    }

    public function distrito()
    {
        return $this->hasOne(Distrito::class,'iddistrito','iddistrito')->withDefault([
            'nombre' => 'Sin distrito'
        ]);
    }


}
