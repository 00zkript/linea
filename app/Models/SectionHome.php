<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHome extends Model
{
    protected $table = 'section_home';
    protected $primaryKey = 'idsection_home';
    public $timestamps = false;
    protected $guarded = [];


    public function links()
    {
        return $this->hasMany(SectionHomeLink::class, 'idsection_home')->orderBy('posicion');
    }

    public function products()
    {
        return $this->hasMany(SectionHomeProducto::class, 'idsection_home')->orderBy('posicion');
    }



}
