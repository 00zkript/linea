<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategoriaMarca extends Model
{
    protected  $table = 'categoria_marca';
    protected $primaryKey = 'idcategoria_marca';
    public $timestamps = false;
    protected $guarded = [];
}
