<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected  $table = 'ubigeo_departamento';
    protected $primaryKey = 'iddepartamento';
    public $timestamps = false;
    protected $guarded = [];


    public function provincias()
    {
        return $this->hasMany(Provincia::class, 'iddepartamento');
    }

}
