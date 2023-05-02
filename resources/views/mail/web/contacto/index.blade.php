@extends('mail.web.plantilla')
@push('css')
@endpush

@section('cuerpo')
    <div class="container">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 px-4" style="background: #23b4b7;">
            <div class="row">
                <div class="col-lg-12 text-white text-center">
                    <h2 class="fw-bold text-white">{{ $usuario->cliente->nombres }}</h2>
                    <p class="text-white">quiere ponerse en contacto contigo.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 bg-white px-3">
            <table class="table table-bordered table-striped text-start" style="width:100%;">
                <tbody>
                    <tr>
                        <th scope="row" class="text-nowrap">Nombres: </th>
                        <td>{{ $contacto->nombres }}</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Apellidos: </th>
                        <td>{{ $contacto->apellidos }}</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Correo electrónico: </th>
                        <td>{{ $contacto->correo }}</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Teléfono: </th>
                        <td>{{ $contacto->telefono }}</td>
                    </tr>

                    {{--<tr>
                        <th scope="row" class="text-nowrap">Empresa: </th>
                        <td>ANDINA</td>
                    <tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Tipo de contacto: </th>
                        <td>Empresario</td>
                    </tr>--}}

                    <tr>
                        <th scope="row" class="text-nowrap">Consulta: </th>
                        <td>{{ $contacto->mensaje }}</td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
@endsection

@push('js')
@endpush
