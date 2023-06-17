<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class ArqueoCajaOperacion extends Model
{
    protected $table = 'arqueo_caja_operaciones';
    protected $primaryKey = 'idarqueo_caja_operaciones';
    public $timestamps = true;
    // protected $appends = [];

    public function tipoOperacion()
    {
        return $this->hasOne(TipoOperacion::class, 'idtipo_operacion', 'idtipo_operacion');
    }

    public function usuario()
    {
        return $this->hasOne(User::class, 'idusuario', 'idusuario');
    }
}
