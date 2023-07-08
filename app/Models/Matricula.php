<?php

namespace App\Models;

use App\Traits\GlobalScopesTrait;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use GlobalScopesTrait;

 	protected $table = 'matricula';
	protected $primaryKey = 'idmatricula';

	public $timestamps = true;
    protected $casts = [
        'fecha_inicio' => 'date:d/m/Y',
        'fecha_fin' => 'date:d/m/Y',
    ];



    public function clienteTipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class, 'idtipo_documento_identidad', 'cliente_idtipo_documento_identidad')
            ->withDefault([
                'nombre' => 'Sin documento'
            ]);
    }

    public function empleadoTipoDocumentoIdentidad()
    {
        return $this->hasOne(TipoDocumentoIdentidad::class, 'idtipo_documento_identidad', 'empleado_idtipo_documento_identidad')
            ->withDefault([
                'nombre' => 'Sin documento'
            ]);
    }

    public function sucursal()
    {
        return $this->hasOne(Sucursal::class, 'idsucursal', 'idsucursal')->withDefault([
            'nombre' => 'Sin sucursal',
            'direccion' => '',
        ]);
    }

    public function concepto()
    {
        return $this->hasOne(Concepto::class, 'idconcepto', 'idconcepto')->withDefault([
            'nombre' => 'Sin concepto',
        ]);
    }

    public function temporada()
    {
        return $this->hasOne(Temporada::class, 'idtemporada', 'idtemporada')->withDefault([
            'nombre' => 'Sin temporada',
        ]);
    }

    public function programa()
    {
        return $this->hasOne(Programa::class, 'idprograma', 'idprograma')->withDefault([
            'nombre' => 'Sin programa',
        ]);
    }

    public function nivel()
    {
        return $this->hasOne(Nivel::class, 'idnivel', 'idnivel')->withDefault([
            'nombre' => 'Sin nivel',
        ]);
    }

    public function carril()
    {
        return $this->hasOne(Carril::class, 'idcarril', 'idcarril')->withDefault([
            'nombre' => 'Sin carril',
        ]);
    }

    public function frecuencia()
    {
        return $this->hasOne(Frecuencia::class, 'idfrecuencia', 'idfrecuencia')->withDefault([
            'nombre' => 'Sin frecuencia',
        ]);
    }

    public function horario()
    {
        return $this->hasOne(Horario::class, 'idhorario', 'idhorario')->withDefault([
            'nombre' => 'Sin horario',
        ]);
    }

    public function cantidadClases()
    {
        return $this->hasOne(CantidadClases::class, 'idcantidadClases', 'idcantidadClases')->withDefault([
            'nombre' => 'Sin cantidad de clases',
        ]);
    }

    public function detalle()
    {
        return $this->hasMany(MatriculaDetalle::class, 'idmatricula', 'idmatricula')->orderBy('fecha','asc');
    }



}
