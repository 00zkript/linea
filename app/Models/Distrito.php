<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected  $table = 'ubigeo_distrito';
    protected $primaryKey = 'iddistrito';
    public $timestamps = false;
    protected $guarded = [];
}
