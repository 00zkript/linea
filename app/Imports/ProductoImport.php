<?php

namespace App\Imports;

use App\Http\Traits\CopyFileFromAnotherServer;
use App\Models\Categoria;
use App\Models\Marca;
use App\Models\Producto;
use App\Models\Atributo;
use App\Models\ProductoImagen;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithMappedCells;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;



class ProductoImport implements OnEachRow,WithBatchInserts
{
    use CopyFileFromAnotherServer;

    /*public function collection(Collection $rows)
    {


        $now = now()->format('Y-m-d H:i:s');

        foreach ($rows as $key => $row) {
            if ($key != 0){
                $codigo             = $row[0]; // codigo
                $nombre             = $row[1]; // nombre
                $precio             = $row[2]; // precio
                $precio_promocional = $row[3]; // precio_promocional
                $stock              = $row[4]; // stock
                $marca              = $row[5]; // marca
                $categoria          = $row[6]; // categoria
                $destacado          = $row[7]; // destacado
                $nuevo              = $row[8]; // nuevo
                $liquidacion        = $row[9]; // liquidacion
                $atributos          = $row[10]; // atributos
                $descripcion_corta  = $row[11]; // descripcion_corta
                $descripcion        = $row[12]; // descripcion
                $ficha_tecnica      = $row[13]; // ficha_tecnica
                $video              = $row[14]; // video
                $fecha_registro     = $now; // fecha_registro
                $estado             = $row[15]; // estado
                $imagenes           = $row[16]; // imagenes

                dump($nombre);


            }
        }


    }*/

    /*public function model(array $row)
    {
        dump($row);
        return null;
    }*/

    private function createCategoria( &$idcategoria, $nombre, $nivel, $pariente = null)
    {
        if ( $nombre ) {

            $categoriaResult = Categoria::query()->where('nombre',$nombre)->first();

            if ( !$categoriaResult ) {
                $maxCate = Categoria::query()->where('nivel',$nivel)->max("orden") ?: 0;

                $categoria = new Categoria();
                $categoria->pariente     = $pariente;
                $categoria->nombre       = $nombre;
                $categoria->slug         = Str::slug($nombre);
                $categoria->nivel        = $nivel;
                $categoria->orden        = $maxCate+1;
                $categoria->estado       = 1;
                $categoria->save();

                $idcategoria = $categoria->idcategoria;

            }else{
                $idcategoria = $categoriaResult->idcategoria;
            }

        }


    }


    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex(); // comienza en 1
        $row      = $row->toArray();

        $codigo             = $row[0]; // codigo
        $nombre             = $row[1]; // nombre
        $precio             = $row[2] > 0 ? $row[2] : '0.00'; // precio
        $precio_promocional = $row[3] > 0 ? $row[3] : '0.00'; // precio_promocional
        $stock              = $row[4] ?: 9999999; // stock
        $marcaString        = $row[5]; // marca
        $categoriaString    = $row[6]; // categoria
        $destacado          = $row[7] ?: 0; // destacado
        $nuevo              = $row[8] ?: 0; // nuevo
        $liquidacion        = $row[9] ?: 0; // liquidacion
        $attributes         = $row[10]; // atributos
        $descripcion_corta  = $row[11]; // descripcion_corta
        $descripcion        = $row[12]; // descripcion
        $ficha_tecnica      = $row[13]; // ficha_tecnica
        $video              = $row[14]; // video
        $estado             = $row[15] == 1 ? 1 : 0; // estado
        $imagenes           = $row[16]; // imagenes
        $idcategoria        = null;
        $idmarca            = null;

        if ($rowIndex > 1 && $nombre){

            if ( $marcaString ){
                $marcaResult = Marca::query()->where("nombre",$marcaString)->first();

                if ( !$marcaResult ) {

                    $marca = new Marca();
                    $marca->nombre       = $marcaString;
                    $marca->slug         = Str::slug($marcaString);
                    $marca->estado       = 1;
                    $marca->save();

                    $idmarca = $marca->idmarca;

                }else{
                    $idmarca = $marcaResult->idmarca;

                }
            }

            if ($categoriaString){

                $categoriaArray = explode(">",$categoriaString);

                if (count($categoriaArray) == 1 ){
                    $this->createCategoria($idcategoria,$categoriaString,1);
                }else{
                    foreach ($categoriaArray as $key => $item) {
                        $this->createCategoria($idcategoria, $item, $key+1, $idcategoria);
                    }
                }

            }


            $producto = new Producto();
            $producto->idmarca             = $idmarca;
            $producto->idcategoria         = $idcategoria;
            $producto->codigo              = $codigo;
            $producto->nombre              = $nombre;
            $producto->slug                = Str::slug($nombre);
            $producto->precio              = $precio;
            $producto->precio_promocional  = $precio_promocional;
            $producto->stock               = $stock;
            $producto->destacado           = $destacado;
            $producto->nuevo               = $nuevo;
            $producto->liquidacion         = $liquidacion;
            $producto->descripcion_corta   = $descripcion_corta;
            $producto->descripcion         = $descripcion;
            $producto->ficha_tecnica       = $ficha_tecnica;
            $producto->video               = $video;
            $producto->fecha_registro      = now()->format('Y-m-d H:i:s');
            $producto->estado              = $estado;
            $producto->save();

            if (!empty($attributes)){
                $attributes = explode(",",$attributes);

                foreach ($attributes as $item) {
                    $item = trim($item);
                    $arrayAttributeValor = explode("=",$item);
                    $nameAttribute = trim($arrayAttributeValor[0] ?? null);
                    $valueAtributte = trim($arrayAttributeValor[1] ?? null);

                    $attributeResult = Atributo::query()->where("nombre",$nameAttribute)->first();

                    if ( !$attributeResult ) {
                        $newAtributte = new Atributo();
                        $newAtributte->nombre       = $nameAttribute;
                        $newAtributte->slug         = Str::slug($nameAttribute);
                        $newAtributte->estado       = 1;
                        $newAtributte->save();

                        $idattribute = $newAtributte->idatributo;
                    }else{
                        $idattribute = $attributeResult->idatributo;
                    }

                    $producto->atributos()->attach($idattribute,['valor'=>$valueAtributte,'slug'=>Str::slug($valueAtributte)]);



                }




            }


            if ($imagenes){

                $imagenesArray = explode(",",$imagenes);

                if (count($imagenesArray) == 1 ){

                    $this->methodStorage($imagenes,'productos','panel');

                    $productoImagen = new ProductoImagen();
                    $productoImagen->idproducto        = $producto->idproducto;
                    $productoImagen->nombre            = basename($imagenes);
                    $productoImagen->posicion          = 1;
                    $productoImagen->estado            = 1;
                    $productoImagen->save();

                }else{
                    foreach ($imagenesArray as $key => $img) {

                        $this->methodStorage($img,'productos','panel');

                        $productoImagen = new ProductoImagen();
                        $productoImagen->idproducto        = $producto->idproducto;
                        $productoImagen->nombre            = basename($img);
                        $productoImagen->posicion          = $key + 1;
                        $productoImagen->estado            = 1;
                        $productoImagen->save();
                    }
                }



            }


        }


    }




    public function batchSize(): int
    {
        return 1000;
    }

}
