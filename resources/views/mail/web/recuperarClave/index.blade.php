@extends('mail.web.plantilla')
@push('css')
@endpush

@section('cuerpo')
    <div class="container">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 px-4" style="background: #23b4b7;">
            <div class="row">
                <div class="col-lg-12 text-white text-center">
                    <h2 class="fw-bold text-white">Recuperar tu contraseña</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 bg-white">
            <h3>¡Hola, {{ $usuario->cliente->nombres }}!</h3>
            <p class="mb-0">Recibimos una solicitud para recuperar tu contraseña.</p>
            <p>Recuerda que puedes restablecer tu contraseña desde nuestra web cuando quieras.</p>
            <br>
            <div class="bg-informacion mb-4">
                <figure>
                    <img src="{{ asset('web/imagenes/mail-contrasena.png') }}">
                </figure>
                <span>
                    <i>Tu contraseña es:</i>
                    <b>{{ decrypt($usuario->clave) }}</b>
                </span>
            </div>
            <p class="mb-0">&nbsp;&nbsp;</p>
        </div>
    </div>
@endsection

@push('js')
@endpush
