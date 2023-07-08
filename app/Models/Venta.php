<?php

namespace App\Models;

use App\Traits\GlobalScopesTrait;
use Illuminate\Database\Eloquent\Model;
use MercadoPago\Card;

class Venta extends Model
{
    use GlobalScopesTrait;

    protected  $table = 'venta';
    protected $primaryKey = 'idventa';
    public $timestamps = true;
    // protected $guarded = [];

    public function sucursal()
    {
        return $this->hasOne(Sucursal::class, 'idsucursal', 'idsucursal')->withDefault([
            'nombre' => 'Sin sucursal',
        ]);
    }

    public function tipoFacturacion()
    {
        return $this->hasOne(TipoFacturacion::class, 'idtipo_facturacion', 'idtipo_facturacion')->withDefault([
            'nombre' => 'Sin facturación',
        ]);
    }

    public function tipoPago()
    {
        return $this->hasOne(TipoPago::class, 'idtipo_pago', 'idtipo_pago')->withDefault([
            'nombre' => 'Sin tipo de pago',
        ]);
    }


    public function detalle()
    {
        return $this->hasMany(VentaDetalle::class, 'idventa', 'idventa');
    }


}
