<!doctype html>
<html>
<head>
    <title>REPORTE DE VENTAS</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<style>
table>thead>tr>th{
    border: 1px solid black;
}
</style>
<body>

@if(count($ventas) > 0)
    <div align="center">
        <table border="1">
            <thead>
            <tr>
                <th style="font-weight: bold;text-align: center">Codigo</th>
                <th style="font-weight: bold;text-align: center">Cliente</th>
                <th style="font-weight: bold;text-align: center">M. pago</th>
                <th style="font-weight: bold;text-align: center">E. envio</th>
                <th style="font-weight: bold;text-align: center">E. pago</th>
                <th style="font-weight: bold;text-align: center">Fecha y Hora</th>
                <th style="font-weight: bold;text-align: center">Valor venta</th>
                <th style="font-weight: bold;text-align: center">Precio de envio</th>
                <th style="font-weight: bold;text-align: center">Descuento</th>
                <th style="font-weight: bold;text-align: center">Total</th>
                <th style="font-weight: bold;text-align: center">Estado de venta</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ventas AS $v)
                <tr>
                    <td>{{str_pad($v->idventa,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{ $v->cliente->nombres }}</td>
                    <td>
                        {{ $v->metodoPago->descripcion}}
                    </td>
                    <td>
                        {{ $v->estadoEnvio->nombre}}
                    </td>
                    <td>
                        {{ $v->estadoPago->nombre}}
                    </td>
                    <td>
                        {{ now()->parse($v->fecha_venta)->format('d/m/Y || h:i A') }}
                    </td>
                    <td>
                        {{ $v->moneda->format($v->total_alt,2,".","") }}
                    </td>
                    <td>
                        {{ $v->moneda->format($v->precio_envio_alt,2,".","") }}
                    </td>
                    <td>
                        {{ $v->moneda->format($v->descuento_alt,2,".","") }}
                    </td>
                    <td>
                        {{ $v->moneda->format($v->total_final_alt,2,".","") }}
                    </td>
                    <td>
                        {{ $v->estadoControlVenta->nombre }}
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
@else
    <div align="center">
        <h1>NO HAY REGISTROS PARA MOSTRAR</h1>
    </div>
@endif


</body>
</html>
