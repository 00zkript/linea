@extends('web.template.index')

@section('titulo', 'BLOG')

@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="BLOG | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="BLOG | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection

@push('css')
    <style type="text/css" media="screen">
        .no-link{
            text-decoration: none;
            color: black;
        }

        .no-link:hover{
            text-decoration: none;
            color: black;
        }
    </style>
@endpush

@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-brands fa-hive"></i>Inicio</a></li>
                <li><a href="javascript:void(0);">Blog</a></li>
            </ul>
        </div>
    </section>

    <section class="container mt-5 mb-md-6 mb-4">
        <div class="row align-items-start">
            <div class="col-12 mb-md-5 mb-4">
                <h2 class="fw-bold text-center text-uppercase">Blog</h2>
            </div>

            @foreach($blogs as $b)
                <div class="col-lg-4 col-md-6 col-12 mb-4">
                    <a href="{{ route('web.blog.detalle',$b->slug) }}">
                        <div class="efecto-zoom box-shadow contenido-carru position-relative">
                            <h5 class="fechadate t-1"><span>{{ now()->parse($b->fecha)->format('d') }}</span><span>{{ now()->parse($b->fecha)->format('m/Y') }}</span></h5>
                            <div class="seccionimg">
                                <div class="imgsec2" style="background-image: url('{{ asset('panel/img/blog/'.$b->imagen) }}')"></div>
                                <div class="mascarablanca"></div>
                            </div>
                            <aside class="alto-dinamico">
                                {{--<h4 class="mt-0 mb-1 text-white" style="opacity: 0.7;">{{ $empresaGeneral->nombre }}</h4>--}}
                                <h3 class="mt-0 mb-0 fw-bold text-uppercase text-white">{{ $b->titulo }}</h3>
                            </aside>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </section>

@endsection

@push('js')
@endpush
