<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected  $table = 'venta';
    protected $primaryKey = 'idventa';
    public $timestamps = true;
    protected $guarded = [];
    protected $appends = ['total_alt', 'descuento_alt', 'precio_envio_alt', 'total_final_alt',];

    public const CREATED_AT = "fecha_registro";
    public const UPDATED_AT = "fecha_modificacion";


    public function departamento()
    {
        return $this->hasOne(Departamento::class,'iddepartamento','iddepartamento')
            ->withDefault([
                "nombre" => ""
            ]);
    }

    public function provincia()
    {
        return $this->hasOne(Provincia::class,'idprovincia','idprovincia')
            ->withDefault([
                "nombre" => ""
            ]);
        //    ->where("ubigeo_provincia.iddepartamento",$this->iddepartamento);
    }

    public function distrito()
    {
        return $this->hasOne(Distrito::class,'iddistrito','iddistrito')
            ->withDefault([
                "nombre" => ""
            ]);
        //    ->where("ubigeo_distrito.iddepartamento",$this->iddepartamento)
        //    ->where("ubigeo_distrito.idprovincia",$this->idprovincia);

    }

    public function cliente()
    {
        return $this->hasOne(Cliente::class,'idcliente','idcliente');
    }


    public function tipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class,'idtipo_documento_identidad','idtipo_documento_identidad');
    }

    public function costoEnvio()
    {
        return $this->hasOne(CostoEnvio::class,'idcosto_envio','idcosto_envio');
    }


    public function estadoEnvio()
    {
        return $this->hasOne(EstadoEnvio::class,'idestado_envio','idestado_envio');
    }

    public function estadoControlVenta()
    {
        return $this->hasOne(EstadoControlVenta::class,'idestado_control_venta','idestado_control_venta');
    }

    public function cupon()
    {
        return $this->hasOne(Cupon::class,'idcupon','idcupon')
            ->withDefault([
                "codigo" => "Sin cupon"
            ]);
    }

    public function metodoEntrega()
    {
        return $this->hasOne(MetodoEntrega::class,'idmetodo_entrega','idmetodo_entrega');
    }

    public function facturacion()
    {
        return $this->hasOne(Comprobante::class,'idcomprobante','facturacion_idcomprobante');
    }


    public function metodoPago()
    {
        return $this->hasOne(MetodoPago::class,'idmetodo_pago','pago_idmetodo_pago')
            ->withDefault([
                "descripcíon" => ""
            ]);
    }

    public function estadoPago()
    {
        return $this->hasOne(EstadoPago::class,'idestado_pago','pago_idestado_pago');
    }

    public function moneda()
    {
        return $this->hasOne(Moneda::class,'idmoneda','idmoneda')
            ->select(["idmoneda","nombre","moneda","simbolo"])
            ->withDefault([
                "idmoneda" => 1,
                "nombre" => "Dolar",
                "moneda" => "USD",
                "simbolo" => "$",
            ]);
    }

    public function puntoVenta()
    {
        return $this->hasOne(PuntoVenta::class,'idpunto_venta','idpunto_venta');
    }


    protected function getTotalAltAttribute()
    {
        return number_format($this->total * $this->precio_cambio,2,".","");
    }


    protected function getDescuentoAltAttribute()
    {
        return number_format($this->descuento * $this->precio_cambio,2,".","");
    }


    protected function getPrecioEnvioAltAttribute()
    {
        return number_format($this->precio_envio * $this->precio_cambio,2,".","");
    }


    protected function getTotalFinalAltAttribute()
    {
        return number_format($this->total_final * $this->precio_cambio,2,".","");
    }



}
