<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [

            'nombres'     => 'required|max:100',
            'apellidos' => 'required|max:100',
            'clave' => 'nullable|max:50',
            'tipoDocumentoIdentidad' => 'required',
            'numeroDocumentoIdentidad' => 'required|min:8',
            'telefono' => 'required|max:50',
            'correo'    => 'required|email|max:100|unique:usuario,correo,'.auth()->user()->idusuario.',idusuario',
            //'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
        ];
    }

    public function attributes()
    {
        return [

            'nombres'     => 'nombres',
            'apellidos' => 'apellidos',
            'clave' => 'contraseña',
            'correo'    => 'correo',
            //'foto'    => 'nullable|image|mimes:jpg,jpeg,png|max:10000',
        ];
    }
}
