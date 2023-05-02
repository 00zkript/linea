@extends('web.template.index')
@section('titulo','POLITICA DE PRIVACIDAD')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="POLITICA DE PRIVACIDAD | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="POLITICA DE PRIVACIDAD | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection
@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-file-lines"></i>Inicio</a></li>
                <li><a href="#">Políticas de privacidad</a></li>
            </ul>
        </div>
    </section>

    <div class="container mt-5 mb-md-6 mb-4">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 mb-4">
                <h2 class="fw-bold text-center text-uppercase">Políticas de privacidad</h2>
            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                {!! $pagina->contenido !!}
            </div>
        </div>
    </div>
@endsection
