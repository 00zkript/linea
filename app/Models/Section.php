<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'section';
    protected $primaryKey = 'idsection';
    public $timestamps = false;
    protected $guarded = [];
}
