<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected  $table = 'categoria';
    protected $primaryKey = 'idcategoria';
    public $timestamps = false;
    protected $guarded = [];
    protected $appends = ["slug_categoria",];




    public function subcategorias()
    {
        return $this->hasMany(Categoria::class,'pariente','idcategoria')
            ->with(['subcategorias'])
            ->where('estado',1)
            ->orderBY('orden');
    }

    public function padre()
    {
        return $this->hasOne(Categoria::class,'idcategoria','pariente')
            ->where('estado',1);
    }

    protected function getParentsAttribute()
    {
        $text = $this->nombre;

        $categoria = Categoria::query()->find($this->pariente);

        if ($categoria){
            $text = $categoria->nombre." => ".$text;


            $categoria2 = Categoria::query()->find($categoria->pariente);
            if ($categoria2) {
                $text = $categoria2->nombre . " => " . $text;
            }

        }



        return $text;

    }

    protected function getSlugCategoriaAttribute()
    {
        return $this->idcategoria."-".$this->slug;
    }



}
