<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class CarroRequest extends FormRequest
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
            'idproducto' => 'required|exists:producto,idproducto',
            'cantidad' => 'required|integer|min:1',
        ];

    }

    public function messages()
    {
        return [
            'idproducto.required' => 'Este :attribute no existe en nuestro inventario',
            'idproducto.exists' => 'Este :attribute no existe en nuestro inventario',
            'cantidad.required' => 'Ingrese una :attribute valida',
            'cantidad.integer' => 'Esta :attribute no es valida',
            'cantidad.min' => 'La :attribute minima es :min',
        ];
    }

    public function attributes()
    {
        return [
            'idproducto' => 'producto',
            'cantidad' => 'cantidad',
        ];
    }
}
