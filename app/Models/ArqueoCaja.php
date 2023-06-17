<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ArqueoCaja extends Model
{
    protected $table = 'arqueo_caja';
    protected $primaryKey = 'idarqueo_caja';
    public $timestamps = true;
    // protected $appends = [];
    protected $fillable = ['fecha'];


    public function operaciones()
    {
        return $this->hasMany(ArqueoCajaOperacion::class, 'idarqueo_caja', 'idarqueo_caja');
    }

    public function ventas()
    {
        return $this->hasMany(venta::class, 'fecha', 'fecha');
    }

    public function supervisor()
    {
        return $this->hasOne(User::class,'idusuario', 'idsupervisor');
    }
}
