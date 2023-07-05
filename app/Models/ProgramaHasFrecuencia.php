<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProgramaHasFrecuencia extends Model
{
    protected $table = 'programa_has_frecuencia';
    protected $primaryKey = 'idprograma_has_frecuencia';
    public $timestamps = false;
    // protected $appends = [];
}
