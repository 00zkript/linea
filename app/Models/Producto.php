<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    protected  $table = 'producto';
    protected $primaryKey = 'idproducto';
    public $timestamps = false;
    // protected $guarded = [];


    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class,'idproducto','idproducto')->orderBy('posicion');
    }



}
