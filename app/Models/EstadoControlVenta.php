<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoControlVenta extends Model
{
    protected  $table = 'estado_control_venta';
    protected $primaryKey = 'idestado_control_venta';
    public $timestamps = false;
    protected $guarded = [];
}
