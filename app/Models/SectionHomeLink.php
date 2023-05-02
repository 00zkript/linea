<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionHomeLink extends Model
{
    protected $table = 'section_home_link';
    protected $primaryKey = 'idsection_home_link';
    public $timestamps = false;
    protected $guarded = [];
}
