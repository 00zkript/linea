<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Popup extends Model
{
    protected  $table = 'popup';
    protected $primaryKey = 'idpopup';
    public $timestamps = false;
    protected $guarded = [];
}
