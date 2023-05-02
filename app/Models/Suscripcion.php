<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    protected  $table = 'suscripcion';
    protected $primaryKey = 'idsuscripcion';
//    public $timestamps = false;
    protected $guarded = [];

    const CREATED_AT = "creado";
    const UPDATED_AT = "actualizado";

}
