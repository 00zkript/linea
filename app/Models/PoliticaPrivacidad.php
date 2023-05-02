<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PoliticaPrivacidad extends Model
{
    protected  $table = 'politica_privacidad';
    protected $primaryKey = 'idpolitica_privacidad';
    public $timestamps = false;
    protected $guarded = [];
}
