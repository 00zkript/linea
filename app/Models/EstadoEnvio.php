<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoEnvio extends Model
{
    protected  $table = 'estado_envio';
    protected $primaryKey = 'idestado_envio';
    public $timestamps = false;
    protected $guarded = [];
}
