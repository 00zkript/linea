<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch ($this->method()) {
            case "POST":
                return [
                    'idmarca' => 'nullable|integer|exists:marca,idmarca',
//                    'idcategoria' => 'nullable|integer|exists:categoria,idcategoria',
                    'codigo' => 'nullable|max:250',
//                    'nombre' => 'required|max:250|unique:producto,nombre',
                    'nombre' => 'required|max:250',
                    'precio' => 'required|numeric|min:0',
                    'precio_promocional' => 'nullable|numeric|min:0',
                    'stock' => 'required|integer|min:0',
                    'destacado' => 'nullable|boolean',
                    'descuento' => 'nullable|boolean',
                    'liquidacion' => 'nullable|boolean',
                    'imagen.*' => 'required|image|mimes:jpg,jpeg,png',
                    'descripcion' => 'nullable',
                    'ficha_tecnica' => 'nullable',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
                    'idmarcaEditar' => 'nullable|integer|exists:marca,idmarca',
//                    'idcategoriaEditar' => 'nullable|integer|exists:categoria,idcategoria',
                    'codigoEditar' => 'nullable|max:250',
//                    'nombreEditar' => 'required|max:250|unique:producto,nombre,'.$this->idproducto.',idproducto',
                    'nombreEditar' => 'required|max:250',
                    'precioEditar' => 'required|numeric|min:0',
                    'precio_promocionalEditar' => 'nullable|numeric|min:0',
                    'stockEditar' => 'required|integer|min:0',
                    'destacadoEditar' => 'nullable|boolean',
                    'descuentoEditar' => 'nullable|boolean',
                    'liquidacionEditar' => 'nullable|boolean',
                    'descripcionEditar' => 'nullable',
                    'ficha_tecnicaEditar' => 'nullable',
                    'estadoEditar' => 'required|boolean'
                ];
                break;
            default:
                return  [];
                break;
        }

    }

    public function attributes()
    {
        switch ($this->method()) {
            case "POST":
                return [
                    'idmarca' => 'marca',
                    'idcategoria' => 'categoria',
                    'codigo' => 'codigo',
                    'nombre' => 'nombre',
                    'precio' => 'precio original',
                    'precio_promocional' => 'precio promocional',
                    'stock' => 'stock',
                    'destacado' => 'destacado',
                    'imagen' => 'imagen',
                    'descripcion' => 'descripcion',
                    'detalles' => 'detalles',
                    'ficha_tecnica' => 'ficha tecnica',
                    'estado' => 'estado'
                ];
                break;
            case "PUT":
                return [
                    'idmarcaEditar' => 'marca',
                    'idcategoriaEditar' => 'categoria',
                    'codigoEditar' => 'codigo',
                    'nombreEditar' => 'nombre',
                    'precioEditar' => 'precio original',
                    'precio_promocionalEditar' => 'precio promocional',
                    'stockEditar' => 'stock',
                    'destacadoEditar' => 'destacado',
                    'descripcionEditar' => 'descripcion',
                    'detallesEditar' => 'detalles',
                    'ficha_tecnicaEditar' => 'ficha tecnica',
                    'estadoEditar' => 'estado'
                ];
                break;
            default:
                return  [];
                break;
        }
    }
}
