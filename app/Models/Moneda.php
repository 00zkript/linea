<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Moneda extends Model
{
    protected  $table = 'moneda';
    protected $primaryKey = 'idmoneda';
    public $timestamps = false;
    protected $guarded = [];


    /**
     * function format moeny
     * @param float $amount Amount. Example('10.00')
     * @param int $decimal Number decimals. Default 2
     * @param string $decimal_separator separator decimal. Default '.'
     * @param string $thousands_separator separator thousands. Default ','
     * @return string Example '$ 10.00'
     */
    public function format( $amount, $decimal = 2, $decimal_separator = '.', $thousands_separator = ',' )
    {
        $simbolo = $this->simbolo;
        $posicion = $this->simbolo_posicion;
        $cambio = $this->cambio ?: 1;
        $amount = number_format( $amount * $cambio, $decimal, $decimal_separator, $thousands_separator );

        return $this->_formatMoney( $simbolo, $posicion, $amount );
    }

    /**
     * function convertir moeny
     * @param float $amount Amount. Example('10.00')
     * @param string $money Money to search. Example('PEN','USD','EUR')
     * @param int $decimal Number decimals. Default 2
     * @param string $decimal_separator separator decimal. Default '.'
     * @param string $thousands_separator separator thousands. Default ','
     * @return string Example '$ 10.00'
     */
    public function convert($amount, $money, $decimal = 2, $decimal_separator = '.', $thousands_separator = ',' )
    {
        $change = Moneda::query()->where('moneda',$money)->first();
        
        if (!$change) {
            return $this->format( $amount, $decimal, $decimal_separator, $thousands_separator );
        }

        $simbolo = $change->simbolo;
        $posicion = $change->simbolo_posicion;
        $cambio = $change->cambio;
        $amount = number_format( $amount * $cambio, $decimal, $decimal_separator, $thousands_separator );

        return $this->_formatMoney( $simbolo, $posicion, $amount );
    }


    
    private function _formatMoney( $simbolo, $posicion, $amount )
    {

        if ($posicion === 'RIGHT') {
            return "$amount $simbolo";
        }

        return "$simbolo $amount";
    }

}
