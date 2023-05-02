<!doctype html>
<html>
<head>
    <title>REPORTE DE VENTAS</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<style>
    table>thead>tr>th{
        border-bottom: 1px solid black;
    }
    table>tbody>tr>td{
        border-bottom: 1px solid grey;
    }
</style>
<body>

<div align="center">
    <h2>REPORTE DE VENTAS</h2>
</div>


@if(count($ventas) > 0)
    <div align="center">
        <table cellpadding="10"  cellspacing="0">
            <thead>
            <tr>
                <th>Codigo</th>
                <th>Cliente</th>
                <th>M. pago</th>
                <th>E. envio</th>
                <th>E. pago</th>
                <th>Fecha y Hora</th>
                <th>Valor venta</th>
                <th>Precio de envio</th>
                <th>Descuento</th>
                <th>Total</th>
                <th>Estado de venta</th>
            </tr>
            </thead>
            <tbody>
            @foreach($ventas AS $v)
                <tr>
                    <td>{{ str_pad($v->idventa,7,'0000000',STR_PAD_LEFT) }}</td>
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
