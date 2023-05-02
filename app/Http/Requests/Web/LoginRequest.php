<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
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
            'correo' => 'required|max:250',
            'clave' => 'required|max:250',
            'recuerdame' => 'nullable|boolean'
        ];
    }

    public function messages()
    {
        return [
            'correo.required' => 'Ingrese su :attribute',
            'clave' => 'Ingrese su clave',
        ];
    }
}
