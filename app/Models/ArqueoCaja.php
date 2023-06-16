<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
