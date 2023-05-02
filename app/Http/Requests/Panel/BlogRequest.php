<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
                    'titulo' => 'required|max:250|unique:blog,titulo',
                    'imagen' => 'nullable|image|mimes:jpg,jpeg,png',
                    'contenido' => 'required',
                    'fechaCreacion' => 'required',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
                    'tituloEditar' => 'required|max:250|unique:blog,titulo,'.$this->idblog.',idblog',
                    'imagenEditar' => 'nullable|image|mimes:jpg,jpeg,png',
                    'contenidoEditar' => 'required',
                    'fechaCreacionEditar' => 'required',
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
                    'tituloEditar' => 'titulo',
                    'imagenEditar' => 'imagen',
                    'contenidoEditar' => 'contenido',
                    'fechaCreacionEditar' => 'fecha de creacion',
                    'estadoEditar' => 'estado'
                ];
                break;
            default:
                return  [];
                break;
        }
    }
}
