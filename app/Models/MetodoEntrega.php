<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MetodoEntrega extends Model
{
    protected  $table = 'metodo_entrega';
    protected $primaryKey = 'idmetodo_entrega';
    public $timestamps = false;
    protected $guarded = [];
}
