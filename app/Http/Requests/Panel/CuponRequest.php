<?php

namespace App\Http\Requests\Panel;

use Illuminate\Foundation\Http\FormRequest;

class CuponRequest extends FormRequest
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
                    'codigo' => 'required|max:250|unique:cupon,codigo',
                    'nombre' => 'nullable|max:250',
                    'tipoDescuento' => 'required|in:monto,porcentaje',
                    'descuentoMonto' => 'nullable|numeric|min:0',
                    'descuentoPorcentaje' => 'nullable|numeric|min:0',
                    'montoMinimo' => 'nullable|numeric|min:0',
                    'cantidad' => 'required|integer|min:1',
                    'fechaInicio' => 'required',
                    'fechaExpiracion' => 'required',
                    'estado' => 'required|boolean'
                ];
                break;

            case "PUT":
                return [
                    'codigoEditar' => 'required|max:250|unique:cupon,codigo,'.$this->idcupon.',idcupon',
                    'nombreEditar' => 'nullable|max:250',
                    'tipoDescuentoEditar' => 'required|in:monto,porcentaje',
                    'descuentoMontoEditar' => 'nullable|numeric|min:0',
                    'descuentoPorcentajeEditar' => 'nullable|numeric|min:0',
                    'montoMinimoEditar' => 'nullable|numeric|min:0',
                    'cantidadEditar' => 'required|integer|min:1',
                    'fechaInicioEditar' => 'required',
                    'fechaExpiracionEditar' => 'required',
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
            case "POST" :
                return [

                    'codigo' => 'codigo',
                    'nombre' => 'nombre',
                    'tipoDescuento' => 'tipo de descuento',
                    'descuentoMonto' => 'descuento monto',
                    'descuentoPorcentaje' => 'descuento porcentaje',
                    'montoMinimo' => 'monto minimo',
                    'cantidad' => 'cantidad',
                    'fechaInicio' => 'fecha de inicio',
                    'fechaExpiracion' => 'fecha de expiracion',
                    'estado' => 'required|boolean'
                ];
                break;
            case "PUT":
                return [
                    'codigoEditar' => 'codigo',
                    'nombreEditar' => 'nombre',
                    'tipoDescuentoEditar' => 'tipo de descuento',
                    'descuentoMontoEditar' => 'descuento monto',
                    'descuentoPorcentajeEditar' => 'descuento porcentaje',
                    'montoMinimoEditar' => 'monto minimo',
                    'cantidadEditar' => 'cantidad',
                    'fechaInicioEditar' => 'fecha de inicio',
                    'fechaExpiracionEditar' => 'fecha de expiracion',
                    'estadoEditar' => 'required|boolean'
                ];
                break;
            default:
                return  [];
                break;
        }
    }
}
