<?php

namespace App\Http\Requests\Web;

use Illuminate\Foundation\Http\FormRequest;

class VentaRequest extends FormRequest
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
            'correo' => 'required|email|max:250',
            'telefono' => 'required|max:50',
            'nombres' => 'required|max:250',
            'apellidos' => 'required|max:250',
            'tipoDocumento' => 'required|in:DNI,CARNET EXTRANJERIA',
            'numDocumento' => 'required|max:8|min:8',
            'iddepartamento' => 'exclude_if:idmodalidad_despacho,2|required|exists:ubigeo_departamento,iddepartamento',
            'idprovincia' => 'exclude_if:idmodalidad_despacho,2|required|exists:ubigeo_provincia,idprovincia',
            'iddistrito' => 'exclude_if:idmodalidad_despacho,2|required|exists:ubigeo_distrito,iddistrito',
            'direccion' => 'exclude_if:idmodalidad_despacho,2|required|max:250',
            //'idcosto_envio' => 'required|exists:costo_envio,idcosto_envio',
            'tipoComprobante' => 'required|in:BOLETA,FACTURA',
            'razonSocial' => 'nullable|max:250',
            'personaDest' => 'required|max:250',
            'nomApeDest' => 'required|max:250',
            'numDocumentoDest' => 'required|max:8|min:8',
            'idventa_metodo_pago' => 'required|exists:venta_metodo_pago,idventa_metodo_pago',
            'idmodalidad_despacho' => 'required|exists:modalidad_despacho,idmodalidad_despacho',
            'terms' => 'required|accepted'
        ];
    }

    public function messages()
    {
        return [
          'idcosto_envio.required' => 'Debe elegir un :attribute'
        ];
    }

    public function attributes()
    {
        return [
            'correo' => 'corrreo',
            'telefono' => 'telefono',
            'nombres' => 'nombres',
            'apellidos' => 'apellidos',
            'tipoDocumento' => 'tipo de documento',
            'numDocumento' => 'numero de documento',
            'iddepartamento' => 'departamento',
            'idprovincia' => 'provincia',
            'iddistrito' => 'distrito',
            'direccion' => 'direccion',
            'idcosto_envio' => 'método de envio',
            'tipoComprobante' => 'tipo de comprobante',
            'razonSocial' => 'razon social',
            'personaDest' => 'persona destinatario',
            'nomApeDest' => 'nombre y apellido destinatario',
            'numDocumentoDest' => 'numero de documento destinatario',
            'idventa_metodo_pago' => 'método de pago',
            'idmodalidad_despacho' => 'modalidad de despacho',
            'terms' => 'terminos y condiciones'
        ];
    }
}
