<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    protected $table = 'carrito';
    protected $primaryKey = 'idcarrito';
    public $timestamps = true;
    // protected $appends = [];


    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'idcliente', 'idcliente')->withDefault([
            'nombres' => '',
            'apellidos' => '',
            'idtipo_documento_identidad' => '',
            'numero_documento_identidad' => '',
        ]);
    }

    public function detalle()
    {
        return $this->hasMany(CarritoDetalle::class,'idcarrito','idcarrito');
    }
}
