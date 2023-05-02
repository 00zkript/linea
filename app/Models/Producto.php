<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Producto extends Model
{
    protected  $table = 'producto';
    protected $primaryKey = 'idproducto';
    // public $timestamps = false;
    // protected $guarded = [];
    protected $appends = ["descuento_soles", "descuento_porcentaje", "imagen","nombre_recortado","path_imagen","slug_producto"];

    public const CREATED_AT = 'fecha_registro';
    public const UPDATED_AT = 'fecha_registro';


    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class,'idproducto','idproducto')->orderBy('posicion');
    }

    public function manuales()
    {
        return $this->hasMany(ProductoManual::class,'idproducto','idproducto');
    }

    public function categoria()
    {
        return $this->hasOne(Categoria::class,'idcategoria','idcategoria')->withDefault([
            "nombre" => "Sin categoria",
            "idcategoria" => 0,
            "slug" => "sin-categoria",
        ]);
    }

    public function marca()
    {
        return $this->hasOne(Marca::class,'idmarca','idmarca')->withDefault([
            "nombre" => "Sin marca",
            "idmarca" => 0,
            "slug" => "sin-marca",
        ]);
    }

    public function atributos()
    {
        return $this->belongsToMany(
            Atributo::class,
            "producto_has_atributo",
            "idproducto",
            "idatributo",
            'idproducto',
            'idatributo'
        )->withPivot('valor','slug');
    }

    public function section()
    {
        return $this->hasOne(Section::class,'idsection','idsection')->withDefault([
            "nombre" => "Sin seccion",
            "idsection" => 0,
            "slug" => "sin-seccion",
        ]);
    }


    public function productosRelacionados()
    {
        return $this->belongsToMany(
            Producto::class,
            ProductoRelacionado::class,
            'idproducto',
            'idproducto_relacionado',
            'idproducto',
            'idproducto');
    }

    public function productosRelacionadosPivot()
    {
        return $this->hasMany(ProductoRelacionado::class,'idproducto', 'idproducto');
    }




    protected function getDescuentoSolesAttribute()
    {
        return $this->precio - $this->precio_promocional;
    }

    protected function getDescuentoPorcentajeAttribute()
    {
        $porcentaje = 0;

        if ($this->precio > 0){
            $porcentaje = (($this->precio - $this->precio_promocional) / $this->precio) * 100;
        }

        return $porcentaje;
    }

    protected function getNombreRecortadoAttribute()
    {
        $text = substr($this->nombre,0,50);
        if ( strlen($text) == 50 ){
            $text = $text."...";
        }
        return  $text;
    }

    protected function getImagenAttribute()
    {
        $imagen = DB::table('producto_imagen')
            ->select('nombre')
            ->where('idproducto',$this->idproducto)
            ->orderBy('posicion')
            ->first();

        $result = "";

        if($imagen){
            $result = $imagen->nombre;
        }

        return $result;
    }

    protected function getPathImagenAttribute()
    {
        $path = 'panel/vacio_img.jpg';

        if ($this->imagen){
            $path = 'panel/img/producto/'.$this->imagen;
        }

        return $path;
    }

    protected  function getSlugProductoAttribute()
    {
        return $this->slug;
    }


}
