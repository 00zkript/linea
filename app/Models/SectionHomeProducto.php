<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHomeProducto extends Model
{
    protected $table = 'section_home_producto';
    protected $primaryKey = 'idsection_home_producto';
    public $timestamps = false;
    protected $guarded = [];
}
