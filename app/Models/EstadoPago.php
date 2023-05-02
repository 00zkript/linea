<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstadoPago extends Model
{
    protected  $table = 'estado_pago';
    protected $primaryKey = 'idestado_pago';
    public $timestamps = false;
    protected $guarded = [];
}
