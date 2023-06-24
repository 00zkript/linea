<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarrilHasFrecuencia extends Model
{
    protected $table = 'carril_has_frecuencia';
    protected $primaryKey = 'idcarril_has_frecuencia';
    public $timestamps = false;
    // protected $appends = [];
}
