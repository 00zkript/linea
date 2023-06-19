<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reporte de Arqueo de caja</title>
    {{-- <link href="{{ asset('panel/css/bootstrap.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('generales/font-awesome/6.1.2/css/all.min.css') }}" rel="stylesheet"> --}}
    {{-- <link href="{{ asset('panel/css/custom.min.css') }}" rel="stylesheet"> --}}

    <style>
        .text-center{ text-align: center; }
        .text-start{ text-align: left; }
        .text-end{ text-align: right; }

        .border-1{ border: 1px solid; }
        .border-2{ border: 2px solid; }
        .border-3{ border: 3px solid; }
        .border-4{ border: 4px solid; }
        .border-5{ border: 5px solid; }

        .border-top-1{ border-top: 1px solid; }
        .border-top-2{ border-top: 2px solid; }
        .border-top-3{ border-top: 3px solid; }
        .border-top-4{ border-top: 4px solid; }
        .border-top-5{ border-top: 5px solid; }

        .border-bottom-1{ border-bottom: 1px solid; }
        .border-bottom-2{ border-bottom: 2px solid; }
        .border-bottom-3{ border-bottom: 3px solid; }
        .border-bottom-4{ border-bottom: 4px solid; }
        .border-bottom-5{ border-bottom: 5px solid; }

        .border-start-1{ border-left: 1px solid; }
        .border-start-2{ border-left: 2px solid; }
        .border-start-3{ border-left: 3px solid; }
        .border-start-4{ border-left: 4px solid; }
        .border-start-5{ border-left: 5px solid; }

        .border-end-1{ border-right: 1px solid; }
        .border-end-2{ border-right: 2px solid; }
        .border-end-3{ border-right: 3px solid; }
        .border-end-4{ border-right: 4px solid; }
        .border-end-5{ border-right: 5px solid; }

        .border-radius{ border-radius: 1rem }
        .border-radius-circle{ border-radius: 50% }

        .p-1{ padding: 0.25rem; }
        .p-2{ padding: 0.5rem; }
        .p-3{ padding: 1rem; }
        .p-4{ padding: 1.5rem; }
        .p-5{ padding: 3rem; }

        .pt-1{ padding-top: 0.25rem; }
        .pt-2{ padding-top: 0.5rem; }
        .pt-3{ padding-top: 1rem; }
        .pt-4{ padding-top: 1.5rem; }
        .pt-5{ padding-top: 3rem; }

        .pb-1{ padding-bottom: 0.25rem; }
        .pb-2{ padding-bottom: 0.5rem; }
        .pb-3{ padding-bottom: 1rem; }
        .pb-4{ padding-bottom: 1.5rem; }
        .pb-5{ padding-bottom: 3rem; }

        .ps-1{ padding-left: 0.25rem; }
        .ps-2{ padding-left: 0.5rem; }
        .ps-3{ padding-left: 1rem; }
        .ps-4{ padding-left: 1.5rem; }
        .ps-5{ padding-left: 3rem; }

        .pe-1{ padding-right: 0.25rem; }
        .pe-2{ padding-right: 0.5rem; }
        .pe-3{ padding-right: 1rem; }
        .pe-4{ padding-right: 1.5rem; }
        .pe-5{ padding-right: 3rem; }


        .m-1{ margin: 0.25rem; }
        .m-2{ margin: 0.5rem; }
        .m-3{ margin: 1rem; }
        .m-4{ margin: 1.5rem; }
        .m-5{ margin: 3rem; }

        .mt-1{ margin-top: 0.25rem; }
        .mt-2{ margin-top: 0.5rem; }
        .mt-3{ margin-top: 1rem; }
        .mt-4{ margin-top: 1.5rem; }
        .mt-5{ margin-top: 3rem; }

        .mb-1{ margin-bottom: 0.25rem; }
        .mb-2{ margin-bottom: 0.5rem; }
        .mb-3{ margin-bottom: 1rem; }
        .mb-4{ margin-bottom: 1.5rem; }
        .mb-5{ margin-bottom: 3rem; }

        .ms-1{ margin-left: 0.25rem; }
        .ms-2{ margin-left: 0.5rem; }
        .ms-3{ margin-left: 1rem; }
        .ms-4{ margin-left: 1.5rem; }
        .ms-5{ margin-left: 3rem; }

        .me-1{ margin-right: 0.25rem; }
        .me-2{ margin-right: 0.5rem; }
        .me-3{ margin-right: 1rem; }
        .me-4{ margin-right: 1.5rem; }
        .me-5{ margin-right: 3rem; }
    </style>

    <style>
        body{
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", "Liberation Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
        }
        .header .logo{
            width: 200px;
            height: 100px;
        }
        .header h3,
        .header h4,
        .header h5{
            margin: 0.25rem;
        }


        .table{
            border-spacing: 0;
            width: 100%;
        }
        .table th{
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        .table td{
            padding: 0.5rem;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #aaa;
        }
        .table-border th,
        .table-border td {
            border-bottom: 1px solid #aaa;
        }

        .table-border tr:first-child th{
            border-top: 1px solid #aaa;
        }

        .table-striped tr:nth-child(even){
            background: #e3e3e3;
        }

        .table-dark{
            background: #1E1E1E;
            color: #fff;
        }

        .table-secondary{
            background: #cecece;
            color: #1E1E1E;
            font-weight: bold;
        }

        .table-min{
            border-spacing: 0;
        }
        .table-min th{
            padding-left: 0.5rem;
            padding-right: 0.5rem;
            padding-top: 0.75rem;
            padding-bottom: 0.75rem;
        }
        .table-min td{
            padding: 0.5rem;
        }




    </style>
</head>
<body>


    <section class="header border-bottom-1 pb-3">
        <table class="table">
            <tr>
                <td colspan="2" class="">
                    <img src="http://via.placeholder.com/500x300" class="logo ps-5 pe-5">
                </td>
                <td colspan="4">
                    <h4 class="title">ARQUEO DE CAJA NO : 000000001</h4>
                    <h5 class="subtitle">fecha y hora de impresión : {{ now()->format('d/m/Y - h:i A') }}</h5>
                    <h5 class="subsubtitle">por : {{ auth()->user()->nombres }} {{ auth()->user()->apellidos }}</h5>
                </td>
            </tr>
        </table>
    </section>


    <section class="border-bottom-1 pb-3">
        <h3 class="text-center">ARQUEO DE CAJA DEL {{ now()->parse($fechaDesde)->format('d/m/Y') }} AL {{ now()->parse($fechaHasta)->format('d/m/Y') }}</h3>

        <table class="table table-border mt-5">
            <thead>
                <tr>
                    <th colspan="2">SALDO INICIAL EFECTIVO EN CAJA</th>
                </tr>
                <tr class="table-dark">
                    <th>Soles</th>
                    <th>Dolares</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $item)
                    <tr>
                        <td class="text-center">S/. {{ number_format($item->monto_inicial_sol,2) }}</td>
                        <td class="text-center">$ {{ number_format($item->monto_inicial_dolar,2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <table class="table table-border mt-5">
            <thead>
                <tr>
                    <th colspan="7">INGRESOS EFECTIVO EN CAJA</th>
                </tr>
                <tr class="table-dark">
                    <th>Codígo</th>
                    <th>Apellidos y nombres</th>
                    <th>Concepto</th>
                    <th>Efectivo (S/.)</th>
                    <th>Tarjeta (S/.)</th>
                    <th>Efectivo ($)</th>
                    <th>Tarjeta ($)</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Codígo</td>
                    <td>Apellidos y nombres</td>
                    <td>Concepto</td>
                    <td>Efectivo (S/.)</td>
                    <td>Tarjeta (S/.)</td>
                    <td>Efectivo ($)</td>
                    <td>Tarjeta ($)</td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3"> Total:</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                    <td>0.00</td>
                </tr>
            </tfoot>
        </table>

        <table class="table table-border mt-5">
            <thead>
                <tr>
                    <th colspan="5">INGRESOS - MOVIMIENTOS CAJA</th>
                </tr>
                <tr class="table-dark">
                    <th>Codígo</th>
                    <th>Descripción</th>
                    <th>Efectivo(S/.)</th>
                    <th>Efectivo($)</th>
                    <th>Autorizado</th>
                </tr>
            </thead>
            <tbody>
                @php($sumIngresosSol = 0)
                @php($sumIngresosDolar = 0)
                @foreach ($registros as $item)
                    @foreach ($operacionesIngresos as $operacion)
                        @if ($item->idarqueo_caja === $operacion->idarqueo_caja)
                            <tr>
                                <td>{{ str_pad($operacion->idarqueo_caja_operaciones,7,0,STR_PAD_LEFT) }}</td>
                                <td>{{ $operacion->descripcion }}</td>
                                <td>S/. {{ number_format($operacion->monto_sol,2) }}</td>
                                <td>$ {{ number_format($operacion->monto_dolar,2) }}</td>
                                <td>{{ $operacion->supervisor->nombres }} {{ $operacion->supervisor->apellidos }}</td>
                            </tr>
                            @php($sumIngresosSol += $operacion->monto_sol)
                            @php($sumIngresosDolar += $operacion->monto_dolar)
                        @endif
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"> Total:</td>
                    <td>S/. {{ number_format($sumIngresosSol,2) }}</td>
                    <td>$ {{ number_format($sumIngresosDolar,2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <table class="table table-border mt-5">
            <thead>
                <tr>
                    <th colspan="5">EGRESOS - MOVIMIENTOS CAJA</th>
                </tr>
                <tr class="table-dark">
                    <th>Codígo</th>
                    <th>Descripción</th>
                    <th>Efectivo(S/.)</th>
                    <th>Efectivo($)</th>
                    <th>Autorizado</th>
                </tr>
            </thead>
            <tbody>
                @php($sumEgresosSol = 0)
                @php($sumEgresosDolar = 0)
                @foreach ($registros as $item)
                    @foreach ($operacionesEgresos as $operacion)
                        @if ($item->idarqueo_caja === $operacion->idarqueo_caja)
                            <tr>
                                <td>{{ str_pad($operacion->idarqueo_caja_operaciones,7,0,STR_PAD_LEFT) }}</td>
                                <td>{{ $operacion->descripcion }}</td>
                                <td>S/. {{ number_format($operacion->monto_sol,2) }}</td>
                                <td>$ {{ number_format($operacion->monto_dolar,2) }}</td>
                                <td>{{ $operacion->supervisor->nombres }} {{ $operacion->supervisor->apellidos }}</td>
                            </tr>
                            @php($sumEgresosSol += $operacion->monto_sol)
                            @php($sumEgresosDolar += $operacion->monto_dolar)
                        @endif
                    @endforeach
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"> Total:</td>
                    <td>S/. {{ number_format($sumEgresosSol,2) }}</td>
                    <td>$ {{ number_format($sumEgresosDolar,2) }}</td>
                    <td></td>
                </tr>
            </tfoot>
        </table>

        <table class="table border-botttom-1 mt-3">
            <tr>
                <td>EXCEDENTES SOLES: S/. {{ number_format($registros->sum('monto_final_sol_excedente'),2) }}</td>
                <td>EXCEDENTES DOLARES: $ {{ number_format($registros->sum('monto_final_dolar_excedente'),2) }}</td>
            </tr>
            <tr>
                <td>FALTA SOLES: S/. {{ number_format($registros->sum('monto_final_sol_faltante'),2) }}</td>
                <td>FALTA DOLARES: $ {{ number_format($registros->sum('monto_final_dolar_faltante'),2) }}</td>
            </tr>
        </table>
    </section>


    <section class="pb-3 border-bottom-1">
        <table class="table">
            <thead>
                <tr>
                    <th>DINERO EN CAJA </th>
                    <th>VENTAS DEL DíA </th>
                    <th>ESTADÍSIICAS </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Soles (S/.):
                        <br>
                        Tarjeta (S/.):
                        <br>
                        Cheque (S/.):
                        <br>
                        Transferencia (S/.):
                        <br>
                        dolares (S/.):
                    </td>
                    <td>
                        Total soles (Sí.):
                        <br>
                        Total dolaes (S.USD):
                        <br>
                        Total tarjeta (S/.):
                        <br>
                        Total cheque (S/.):
                        <br>
                        Total transferencia (S/.):
                    </td>
                    <td>
                        N° alumnos nuevos:
                        <br>
                        N° alumnos renovados:
                        <br>
                        N° pagos por deuda:
                        <br>
                        N° pagos con tarjeta:
                        <br>
                        N° pagos con cheque:
                        <br>
                        N° pagos por transferencia:
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table border-1 mt-5">
            <tr>
                <td>TOTAL DINERO CAJA SOLES: </td>
                <td>2500 </td>
                <td>TOTAL DINERO CAJA DOLARES: </td>
                <td>456 </td>
            </tr>
        </table>
    </section>

    <section class="mt-4">
        @php( $year = now()->year )
        <table class="table-min table-striped">
            <thead class="table-secondary">
                <tr>
                    <td>Mes</td>
                    <td>N° Alumnos</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Enero - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Febrero - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Marzo - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Abril - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Mayo - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Junio - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Julio - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Agosto - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Septiembre - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Octubre - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Noviembre - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
                <tr>
                    <td>Diciembre - {{ $year }}</td>
                    <td class="text-end">10</td>
                </tr>
            </tbody>
        </table>

    </section>



</body>
</html>
