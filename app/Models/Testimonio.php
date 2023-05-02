<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model
{
    protected $table = 'testimonio';
    protected $primaryKey = 'idtestimonio';
    public $timestamps = false;
    protected $guarded = [];

}
