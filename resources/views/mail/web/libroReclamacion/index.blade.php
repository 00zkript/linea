@extends('mail.web.plantilla')
@push('css')
@endpush

@section('cuerpo')
    <div class="container">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 px-4" style="background: #23b4b7;">
            <div class="row">
                <div class="col-lg-12 text-white text-center">
                    <h2 class="fw-bold text-white">Copia del reclamo ingresado</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 bg-white px-3">
            <h5>Hola, {{ explode(" ",trim($reclamo->nombres_apellidos))[0] }},</h5>
            <p class="mb-0">Nos apena mucho que hayas tenido una mala experiencia con nosotros.</p>
            <p class="mb-4">Esta es una copia del reclamo que has ingresado por nuestra web, lo estaremos revisando y te responderemos lo más pronto posible.</p>

            <table class="table table-bordered" style="width:100%;">
                <thead>
                    <tr>
                        <th rowspan="1" style="vertical-align:middle;">
                            <table style="width:100%;">
                                <tr style="background-color: #f2f2f2;"><td class="p-3"><p class="mb-0">LIBRO DE RECLAMACIONES</p></td></tr>
                                <tr><td><p class="mt-3">Fecha: {{ now()->parse($reclamo->fecha_ingreso)->format('d/m/Y') }}</p></td></tr>
                                <tr><td><p>Hora: {{ now()->parse($reclamo->fecha_ingreso)->format('H:i A') }}</p></td></tr>
                            </table>
                        </th>
                        <th rowspan="1" style="vertical-align:middle;">
                            <table style="width:100%;">
                                <tr>
                                    <td rowspan="1" class="text-center">
                                    <p>HOJA DE RECLAMACIÓN</p>
                                    <p>N° 001 - 9999</p>
                                    </td>
                                </tr>
                            </table>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>

            <table class="table table-bordered table-striped text-start" style="width:100%;">
                <tbody>
                    <tr>
                        <td class="text-nowrap">Tipo de documento: </td>
                        <td>{{ $reclamo->tipo_documento }}</td>
                    </tr>
                    <tr>
                        <td>N° documento: </td>
                        <td>{{ $reclamo->num_documento }}</td>
                    </tr>
                    <tr>
                        <td>Nombres y apellidos: </td>
                        <td>{{ $reclamo->nombres_apellidos }} </td>
                    </tr>
                    {{--<tr>
                        <td>Apellidos: </td>
                        <td>Magno</td>
                    </tr>--}}

                    <tr>
                        <td>Correo electrónico: </td>
                        <td>{{ $reclamo->correo }}</td>
                    </tr>
                    @if($reclamo->nombre_apoderado)
                    <tr>
                        <td>Dirección: </td>
                        <td>{{ $reclamo->direccion }}</td>
                    </tr>
                    @endif
                    @if($reclamo->nombre_apoderado)
                    <tr>
                        <td>Nombre del apoderado : </td>
                        <td>{{ $reclamo->nombre_apoderado }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Tipo de bien recibido: </td>
                        <td>{{ $reclamo->tipo_bien }}</td>
                    </tr>
                    <tr>
                        <td>Descripción del bien: </td>
                        <td>{{ $reclamo->descripcion_bien }}</td>
                    </tr>
                    <tr>
                        <td>Teléfono: </td>
                        <td>{{ $reclamo->telefono }}</td>
                    </tr>
                    <tr>
                        <td>Tipo de reclamación: </td>
                        <td>{{ $reclamo->tipo_reclamo }}</td>
                    </tr>
                    <tr>
                        <td>Detalles: </td>
                        <td>{!! $reclamo->detalle_reclamo !!}</td>
                    </tr>
                </tbody>

            </table>

        </div>
    </div>
@endsection

@push('js')
@endpush
