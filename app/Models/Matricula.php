<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
 	protected $table = 'matricula';
	protected $primaryKey = 'idmatricula';

	public $timestamps = true;
    protected $casts = [
        'fecha_inicio' => 'date:d/m/Y',
        'fecha_fin' => 'date:d/m/Y',
    ];


    public function clienteTipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class, 'idtipo_documento_identidad', 'cliente_idtipo_documento_identidad');
    }

    public function empleadoTipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class, 'idtipo_documento_identidad', 'empleado_idtipo_documento_identidad')
            ->withDefault([
                'nombre' => 'Sin documento'
            ]);
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

    public function detalle()
    {
        return $this->hasMany(MatriculaDetalle::class, 'idmatricula', 'idmatricula')->orderBy('fecha','asc');
    }



}
