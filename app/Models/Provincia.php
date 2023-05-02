<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    protected  $table = 'ubigeo_provincia';
    protected $primaryKey = 'idprovincia';
    public $timestamps = false;
    protected $guarded = [];


    public function distritos()
    {
        return $this->hasMany(Distrito::class, 'idprovincia');
    }

}
