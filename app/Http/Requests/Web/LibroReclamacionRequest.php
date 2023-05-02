<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class LibroReclamacionRequest extends FormRequest
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
            'nombres_apellidos' => 'required|max:250',
            'tipo_documento' => 'required|in:DNI,RUC',
            'num_documento' => 'required|min:8|max:50',
            'direccion' => 'nullable|max:250',
            'correo' => 'required|email|max:250',
            'telefono' => 'required|max:50',
            'nombre_apoderado' => 'nullable|max:250',
            'tipo_bien' => 'required|in:PRODUCTO,SERVICIO',
            'descripcion_bien' => 'nullable|max:250',
            'tipo_reclamo' => 'required|in:RECLAMO,QUEJA',
            'detalle_reclamo' => 'nullable|max:250',
            'datos_consignados' => 'accepted',
            'politica_privacidad' => 'accepted'
        ];
    }



    public function attributes()
    {
        return [
            'tipo_documento' => 'tipo de documento',
            'num_documento' => 'número de documento',
        ];
    }
}
