<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    protected  $table = 'contacto';
    protected $primaryKey = 'idcontacto';
    public $timestamps = false;
    protected $guarded = [];

    protected $appends = [
      "correos",
    ];


    protected function getCorreosAttribute()
    {
        return explode(',',$this->correo);
    }




}
