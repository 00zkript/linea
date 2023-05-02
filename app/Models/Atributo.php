<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Atributo extends Model
{
    protected $table = "atributo";
    protected $primaryKey = "idatributo";
    public $timestamps = false;
    protected $guarded = [];


    public function productos()
    {
        return $this->belongsToMany(
            Producto::class,
            "producto_has_atributo",
            "idatributo",
            "idproducto",
            'idatributo',
            'idproducto'
        )->withPivot('valor','slug');
    }



}
