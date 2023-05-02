<?php

function calcularMontoBase($porcentaje,$montoTotal){

    $montoBase = $montoTotal / (1 + ($porcentaje/100));
    return number_format($montoBase,2,".","");
}

function calcularIgv($porcentaje,$montoTotal){

    $montoBase = calcularMontoBase($porcentaje,$montoTotal);
    $igv = $montoTotal - $montoBase;
    return number_format($igv,2,".","");
}



