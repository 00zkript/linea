<!doctype html>
<html>
<head>
    <title>REPORTE DE SUSCRIPCIONES</title>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
</head>
<style>
table>thead>tr>th{
    border: 1px solid black;
}
</style>
<body>

@if(count($suscripciones) > 0)
    <div align="center">
        <table border="1">
            <thead>
            <tr>
                <th style="font-weight: bold;text-align: center">Codigo</th>
                <th style="font-weight: bold;text-align: center">Email</th>
                <th style="font-weight: bold;text-align: center">Fecha suscripción</th>
            </tr>
            </thead>
            <tbody>
            @foreach($suscripciones AS $s)
                <tr>
                    <td>{{ str_pad($s->idsuscripcion,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{ $s->email }}</td>
                    <td>
                        {{ now()->parse($s->creado)->format('d/m/Y || h:i A') }}
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
