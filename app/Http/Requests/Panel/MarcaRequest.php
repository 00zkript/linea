<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class MarcaRequest extends FormRequest
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
                    'nombre' => 'required|max:250|unique:marca,nombre',
                    'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
                    'descripcion' => 'nullable',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
                    'nombreEditar' => 'required|max:250|unique:marca,nombre,'.$this->idmarca.',idmarca',
                    'imagenEditar' => 'nullable|image|mimes:jpg,jpeg,png',
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
            case "PUT":
                return [
                    'nombreEditar' => 'nombre',
                    'imagenEditar' => 'imagen',
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
