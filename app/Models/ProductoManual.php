<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoManual extends Model
{
    protected  $table = 'producto_manual';
    protected $primaryKey = 'idproducto_manual';
    public $timestamps = false;
    protected $guarded = [];
}
