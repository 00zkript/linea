@extends('web.template.index')

@section('titulo', Str::upper($blog->titulo))

@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ Str::upper($blog->titulo) }} | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="{{ Str::upper($blog->titulo) }} | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection

@push('css')
@endpush

@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-brands fa-hive"></i>Inicio</a></li>
                <li><a href="{{ route('web.blog') }}">Blog</a></li>
                <li><a href="javascript:void(0);">{{ $blog->titulo }}</a></li>
            </ul>
        </div>
    </section>

    <section class="container mt-5 mb-md-6 mb-4">
        <div class="row align-items-start">
            <div class="col-lg-12 col-md-12 col-12">
                <figure class="position-relative">
                    <img src="{{ asset('panel/img/blog/'.$blog->imagen) }}" class="w-100">
                    <h5 class="fechadate blog"><span>{{ now()->parse($blog->fecha)->format('d') }}</span><span>{{ now()->parse($blog->fecha)->format('m/Y') }}</span></h5>
                </figure>


                <h1 class="fw-bold mt-md-5 mt-4 mb-md-5 mb-4 text-center">{{ $blog->titulo }}</h1>
                {{--<h4 class="mb-md-5 mb-4 text-center text-secondary">{{ $empresaGeneral->nombre }}</h4>--}}
                <aside>
                    {!! $blog->contenido !!}
                </aside>
            </div>
            {{--<div class="col-lg-3 col-md-3 col-12 mt-md-0 mt-4 sticky-top">
                <div class="p-md-4 p-4 rounded-3 fondo-suscribete">
                    <h4 class="fw-bold mb-md-3 mb-2 mt-0">Etiquetas</h4>
                    <aside class="d-flex flex-wrap">
                        <a href="#" class="m-1 rounded-pill bg-primary text-white py-1 px-2 fs-7">Tecnología</a>
                        <a href="#" class="m-1 rounded-pill bg-primary text-white py-1 px-2 fs-7">Bienenstar</a>
                        <a href="#" class="m-1 rounded-pill bg-primary text-white py-1 px-2 fs-7">Gamers</a>
                        <a href="#" class="m-1 rounded-pill bg-primary text-white py-1 px-2 fs-7">Soporte técnico</a>
                    </aside>
                </div>
            </div>--}}
        </div>
    </section>

@endsection

@push('js')
@endpush
