<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlogCategoria extends Model
{
    protected  $table = 'blog_categoria';
    protected $primaryKey = 'idblog_categoria';
    public $timestamps = false;
    protected $guarded = [];
}
