<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CostoEnvio extends Model
{
    protected  $table = 'costo_envio';
    protected $primaryKey = 'idcosto_envio';
    public $timestamps = false;
    protected $guarded = [];
}
