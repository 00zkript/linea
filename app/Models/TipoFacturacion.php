<?php

namespace App\Models;

use App\Traits\GlobalScopesTrait;
use Illuminate\Database\Eloquent\Model;

class TipoFacturacion extends Model
{
    use GlobalScopesTrait;

    protected $table = 'tipo_facturacion';
    protected $primaryKey = 'idtipo_facturacion';
    public $timestamps = false;
    // protected $appends = [];
}
