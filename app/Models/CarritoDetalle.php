<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CarritoDetalle extends Model
{
    protected $table = 'carrito_detalle';
    protected $primaryKey = 'idcarrito_detalle';
    public $timestamps = false;
    // protected $appends = [];
}
