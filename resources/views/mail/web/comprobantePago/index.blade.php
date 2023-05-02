@extends('mail.web.plantilla')
@push('css')
@endpush

@section('cuerpo')
    <div class="container">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 px-4" style="background: #23b4b7;">
            <div class="row">
                <div class="col-lg-12 text-white text-center">
                    <p class="text-white">Se actualizo el comprobante de pago.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 bg-white px-3">
            <table class="table table-bordered table-striped text-start" style="width:100%;">
                <tbody>
                    <tr>
                        <th scope="row" class="text-nowrap">N° Venta: </th>
                        <td>{{ str_pad($venta->idventa,7,0,STR_PAD_LEFT) }}</td>
                    </tr>
                    <tr>
                        <th scope="row" class="text-nowrap">Nombres: </th>
                        <td>{{ $venta->nombres }}</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Apellidos: </th>
                        <td>{{ $venta->apellidos }}</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Correo electrónico: </th>
                        <td>{{ $venta->correo }}</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Teléfono: </th>
                        <td>{{ $venta->telefono }}</td>
                    </tr>

                    <tr>
                        <th scope="row" class="text-nowrap">Comprobante: </th>
                        @php( $url = asset("panel/img/comprobante/$venta->idventa/$venta->imagen_comprobante_pago"))
                        <td>
                            <a href="{{ $url }}">
                                <img src="{{ $url }}" style="width: 200px" alt="">
                            </a>
                        </td>
                    </tr>
                </tbody>

            </table>
        </div>
    </div>
@endsection

@push('js')
@endpush
