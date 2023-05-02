@extends('web.template.index')
<title>@yield('title')</title>

@section('contenido')
<div class="container fourOfour">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12 text-center">

            <h3 class="message">@yield('message')</h3>

            <p class="message2"><b>Te invitamos a ir a nuestra página de inicio</b></p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg mt-4 mb-4">PÁGINA DE INICIO</a>

        </div>
    </div>
</div>
@endsection
