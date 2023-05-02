<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TerminosCondiciones extends Model
{
    protected  $table = 'terminos_condiciones';
    protected $primaryKey = 'idterminos_condiciones';
    public $timestamps = false;
    protected $guarded = [];
}
