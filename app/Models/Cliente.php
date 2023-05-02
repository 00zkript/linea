<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected  $table = 'cliente';
    protected $primaryKey = 'idcliente';
    public $timestamps = false;
    protected $guarded = [];



    public function tipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class,'idtipo_documento_identidad','idtipo_documento_identidad')
            ->withDefault([
                "nombre" => "Sin Documento de Identidad",
            ]);
    }
}
