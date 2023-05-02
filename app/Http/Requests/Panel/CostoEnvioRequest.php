<?php

namespace App\Http\Requests\panel;

use Illuminate\Foundation\Http\FormRequest;

class CostoEnvioRequest extends FormRequest
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
//                    'iddepartamento' => 'required|exists:ubigeo_departamento,iddepartamento',
//                    'idprovincia' => 'required|exists:ubigeo_provincia,idprovincia',
//                    'iddistrito' => 'required|exists:ubigeo_distrito,iddistrito',
                    'precio' => 'nullable|numeric|min:0',
                    'descripcion' => 'nullable',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
//                    'iddepartamentoEditar' => 'required|exists:ubigeo_departamento,iddepartamento',
//                    'idprovinciaEditar' => 'required|exists:ubigeo_provincia,idprovincia',
//                    'iddistritoEditar' => 'required|exists:ubigeo_distrito,iddistrito',
                    'precioEditar' => 'nullable|numeric|min:0',
                    'descripcionEditar' => 'nullable',
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
                    'iddepartamento' => 'departamento',
                    'idprovincia' => 'provincia',
                    'iddistrito' => 'distrito',
                    'precio' => 'precio',
                    'descripcion' => 'descripcion',
                    'estado' => 'estado'
                ];
                break;
            case "PUT":
                return [
                    'iddepartamentoEditar' => 'departamento',
                    'idprovinciaEditar' => 'provincia',
                    'iddistritoEditar' => 'distrito',
                    'precioEditar' => 'precio',
                    'descripcionEditar' => 'descripcion',
                    'estadoEditar' => 'estado'
                ];
                break;
            default:
                return  [];
                break;
        }
    }
}
