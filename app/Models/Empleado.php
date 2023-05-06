<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    //
 	protected $table = 'empleado';
	protected $primaryKey = 'idempleado';
	public $timestamps = true;




    public function tipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class,'idtipo_documento_identidad','idtipo_documento_identidad')
            ->withDefault([
                "nombre" => "Sin Documento de Identidad",
            ]);
    }


}
