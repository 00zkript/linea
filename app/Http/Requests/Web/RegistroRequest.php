<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class RegistroRequest extends FormRequest
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
        return [

            // 'nombres'     => 'required|max:100',
            // 'apellidos' => 'required|max:100',
            'clave' => 'required|max:50|confirmed',
            // 'tipoDocumentoIdentidad' => 'required',
            // 'numeroDocumentoIdentidad' => 'required|min:8',
            // 'telefono' => 'required|max:50',
            'correo'    => 'required|email|max:100|unique:usuario,correo',
            //'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
            'terms'     => 'accepted',
        ];
    }

    public function attributes()
    {
        return [

            'nombres'     => 'nombres',
            'apellidos' => 'apellidos',
            'clave' => 'contraseña',
            'tipoDocumentoIdentidad' => 'tipo de documento',
            'numeroDocumentoIdentidad' => 'numero de documento',
            'correo'    => 'correo',
            //'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
            'terms'     => 'terminos y condiciones',
        ];
    }
}
