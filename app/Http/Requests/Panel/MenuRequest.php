<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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
                    'pariente' => 'nullable|integer|exists:menu,idmenu',
                    'nombre' => 'required|max:250',
                    'nivel' => 'required|integer|in:1,2,3',
                    'orden' => 'required|integer|min:1',
                    'tipoMenu' => 'required|in:interno,externo',
                    'rutaInterna' => 'nullable',
                    'rutaExterna' => 'nullable',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
                    'parienteEditar' => 'nullable|integer|exists:menu,idmenu',
                    'nombreEditar' => 'required|max:250',
                    'nivelEditar' => 'required|integer|in:1,2,3',
                    'ordenEditar' => 'required|integer|min:1',
                    'tipoMenuEditar' => 'required|in:interno,externo',
                    'rutaInternaEditar' => 'nullable',
                    'rutaExternaEditar' => 'nullable',
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
                    'parienteEditar' => 'pariente',
                    'nombreEditar' => 'nombre',
                    'nivelEditar' => 'nivel',
                    'ordenEditar' => 'orden',
                    'tipoMenuEditar' => 'tipo de menu',
                    'rutaInternaEditar' => 'ruta interna',
                    'rutaExternaEditar' => 'ruta externa',
                    'estadoEditar' => 'estado'
                ];
                break;
            default:
                return  [];
                break;
        }
    }
}
