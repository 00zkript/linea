<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PuntoVenta extends Model
{
    protected  $table = 'punto_venta';
    protected $primaryKey = 'idpunto_venta';
    public $timestamps = false;
    protected $guarded = [];
}
