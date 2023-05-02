@extends('web.template.index')
@section('titulo',Str::upper($pagina->titulo))
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ Str::upper($pagina->titulo) }} | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="{{ Str::upper($pagina->titulo) }} | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection
@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-notes"></i>Inicio</a></li>
                <li><a href="javascript:void(0);">{{ $pagina->titulo }}</a></li>
            </ul>
        </div>
    </section>

    <section class="container mt-4 mb-md-6 mb-4">
        <div class="row align-items-start">
            <div class="col-lg-12 col-md-12 col-12">

                <h1 class="fw-bold mb-4 text-center">{{ $pagina->titulo }}</h1>
                <aside>
                    {!! $pagina->contenido !!}
                </aside>
            </div>
        </div>
    </section>

@endsection
