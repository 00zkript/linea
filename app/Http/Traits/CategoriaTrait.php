<?php


namespace App\Http\Traits;


use App\Models\Categoria;

trait CategoriaTrait
{
    /**
     * Funcion que busca y agrega recursivamente las idssubcategoria encontradas en el $result
     * @param array $array Array al que se le agregara los ids encontrados
     * @param array $categoriasIds Array de ids que se buscaran si tiene subcategorias
     */
    private function _findSubCategoriaIds( array &$array , array $categoriasIds)
    {

        $array = array_merge($array, $categoriasIds);

        $data = Categoria::query()
            ->whereIn('pariente',$categoriasIds)
            ->pluck('idcategoria');


        if (count($data) > 0) {
            $this->_findSubCategoriaIds($array,$data->toArray());

        }



    }

    /**
     * Funcion que busca recursivamente si hay subcategorias apartir de un arreglo compuesto por multipole idcategoria
     * @param array|null $arraySubCategoriaIds Array de idcategorias
     * @return array
     */
    private function _getSubCategoriasIds( array $arraySubCategoriaIds = []): array
    {
        if (empty($arraySubCategoriaIds)){
            return [];
        }

        $result = [];

        $this->_findSubCategoriaIds($result,$arraySubCategoriaIds);

        return $result;
    }



    /**
     * Funcion para buncar el id de la categoria padre y agregarlo en el $result
     * @param array $array Resultado
     * @param int $idcategoria idcategoria
     */
    private function _findParentIds( array &$array, int $idcategoria)
    {
        array_push($array, $idcategoria);

        $data = Categoria::query()->find($idcategoria);


        if ($data && $data->pariente) {
            self::_findParentIds($array,$data->pariente);

        }

    }

    /**
     * Funcion para buscar los ids de los padres de una categoria
     * @param int|null $idcategoria idcategoria
     * @return array
     */
    private function _getParentIds(int $idcategoria = null): array
    {
        if (empty($idcategoria)){
            return [];
        }

        $result = [];

        $this->_findParentIds($result,$idcategoria);

        return $result;

    }








}
