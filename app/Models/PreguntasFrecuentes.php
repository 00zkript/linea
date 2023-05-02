<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreguntasFrecuentes extends Model
{
    protected  $table = 'pregunta_frecuente';
    protected $primaryKey = 'idpregunta_frecuente';
    public $timestamps = false;
    protected $guarded = [];
}
