<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LibroReclamacion extends Model
{
    protected  $table = 'libro_reclamacion';
    protected $primaryKey = 'idlibro_reclamacion';
    public $timestamps = false;
    protected $guarded = [];
}
