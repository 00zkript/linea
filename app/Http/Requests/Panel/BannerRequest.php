<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
                    'tipoRuta' => 'integer|required',
                    'ruta' => 'string|required',
                    'posicion' => 'integer|required',
                    'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
                    'tipoRutaEditar' => 'integer|required',
                    'rutaEditar' => 'string|required',
                    'posicionEditar' => 'integer|required',
                    'imagenEditar' => 'nullable|image|mimes:jpg,jpeg,png',
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
            case "PUT":
                return [
                    'tipoRutaEditar' => 'tipo de ruta',
                    'rutaEditar' => 'ruta',
                    'posicionEditar' => 'posición',
                    'paginaEditar' => 'pagina',
                    'imagenEditar' => 'imagen',
                    'estadoEditar' => 'estado'
                ];
                break;
            default:
                return  [];
                break;
        }
    }
}
