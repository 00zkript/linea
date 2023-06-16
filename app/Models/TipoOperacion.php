<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoOperacion extends Model
{
    protected $table = 'tipo_operacion';
    protected $primaryKey = 'idtipo_operacion';
    public $timestamps = true;
    // protected $appends = [];
}
