<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
 	protected $table = 'empleado';
	protected $primaryKey = 'idempleado';

    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';
	public $timestamps = true;
    // public static $snakeAttributes = true;





    public function tipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class,'idtipo_documento_identidad','idtipo_documento_identidad')
            ->withDefault([
                "nombre" => "Sin Documento de Identidad",
            ]);
    }


}
