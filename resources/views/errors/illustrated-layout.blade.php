@extends('web.template.index')
{{--<title>@yield('title') | Venta de Impresoras | Toner | Cartuchos | Tintas | Abutech peru | abutechperu</title>--}}
{{--@section('titulo', 'PÁGINA NO ENCONTRADA '.html_entity_decode('|').' Venta de Impresoras | Toner | Cartuchos | Tintas | Abutech peru | abutechperu') --}}

@section('titulo', 'PÁGINA NO ENCONTRADA '.html_entity_decode('|').' Venta de Impresoras | Toner | Cartuchos | Tintas | Abutech peru | abutechperu')

@section('contenido')
<div class="container fourOfour">
    <div class="row justify-content-center">
        <div class="col-md-8 col-12 text-center">
            <h1>@yield('code', __('Oh no'))</h1>

            <h3 class="message">@yield('message')</h3>

            <p class="message2"><b>Te invitamos a ir a nuestra página de inicio</b></p>
            <a href="{{ url('/') }}" class="btn btn-primary btn-lg mt-4 mb-4">PÁGINA DE INICIO</a>

        </div>
    </div>

    <div class="relative pb-full md:flex md:pb-0 md:min-h-screen w-full md:w-1/2">
        @yield('image')
    </div>
</div>
@endsection
