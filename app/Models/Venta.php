<?php

namespace App\Models;

use App\Traits\GlobalScopesTrait;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use GlobalScopesTrait;

    protected  $table = 'venta';
    protected $primaryKey = 'idventa';
    public $timestamps = true;
    // protected $guarded = [];


}
