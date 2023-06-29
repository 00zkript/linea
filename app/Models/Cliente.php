<?php

namespace App\Models;

use App\Traits\GlobalScopesTrait;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use GlobalScopesTrait;

    protected  $table = 'cliente';
    protected $primaryKey = 'idcliente';
    protected $guarded = [];
    // const CREATED_AT = 'created_at';
    // const UPDATED_AT = 'updated_at';
	public $timestamps = true;



    public function tipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class,'idtipo_documento_identidad','idtipo_documento_identidad')
            ->withDefault([
                "nombre" => "Sin Documento de Identidad",
            ]);
    }

    public function departamento()
    {
        return $this->hasOne(Departamento::class,'iddepartamento','iddepartamento');
    }

    public function provincia()
    {
        return $this->hasOne(Provincia::class,'idprovincia','idprovincia');
    }

    public function distrito()
    {
        return $this->hasOne(Distrito::class,'iddistrito','iddistrito');
    }




}
