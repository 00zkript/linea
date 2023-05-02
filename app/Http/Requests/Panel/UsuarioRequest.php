<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
                    'rol' => 'required|integer|exists:rol,idrol',
                    'usuario' => 'exclude_if:rol,2|required|max:50|unique:usuario,usuario',
                    'clave' => 'required|max:20',
                    'nombres' => 'required|max:250',
                    'apellidos' => 'required|max:250',
                    'correo' => 'nullable|email',
                    'foto' => 'nullable|image|mimes:jpg,jpeg,png',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
                    'rolEditar' => 'required|integer|exists:rol,idrol',
                    'usuarioEditar' => 'exclude_if:rolEditar,2|required|max:50|unique:usuario,usuario,'.$this->idusuario.',idusuario',
                    'claveEditar' => 'nullable|max:20',
                    'nombresEditar' => 'required|max:250',
                    'apellidosEditar' => 'required|max:250',
                    'correoEditar' => 'nullable|email',
                    'fotoEditar' => 'nullable|image|mimes:JPG,JPEG,PNG',
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
                    'rolEditar' => 'rol',
                    'usuarioEditar' => 'usuario',
                    'claveEditar' => 'clave',
                    'nombresEditar' => 'nombres',
                    'apellidosEditar' => 'apellidos',
                    'correoEditar' => 'correo',
                    'fotoEditar' => 'foto',
                    'estadoEditar' => 'estado'
                ];
                break;
            default:
                return  [];
                break;
        }
    }
}
