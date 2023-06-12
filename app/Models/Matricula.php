<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
 	protected $table = 'matricula';
	protected $primaryKey = 'idmatricula';
	public $timestamps = true;

    public function clienteTipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class, 'cliente_idtipo_documento_identidad', 'idtipo_documento_identidad');
    }

    public function empleadoTipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class, 'empleado_idtipo_documento_identidad', 'idtipo_documento_identidad');
    }

    public function concepto()
    {
        return $this->hasOne(Concepto::class, 'idconcepto', 'idconcepto');
    }

    public function piscina()
    {
        return $this->hasOne(Piscina::class, 'idpiscina', 'idpiscina');
    }

    public function carril()
    {
        return $this->hasOne(Carril::class, 'idcarril', 'idcarril');
    }




}
