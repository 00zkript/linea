@extends('web.template.index')

@section('titulo', 'PREGUNTAS FRECUENTES')

@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="PREGUNTAS FRECUENTES | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="PREGUNTAS FRECUENTES | {{ $seoGeneral->titulo_general }}" />
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
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-circle-question"></i>Inicio</a></li>
                <li><a href="javascript:void(0);">Preguntas Frecuentes</a></li>
            </ul>
        </div>
    </section>

    <section class="container mt-5 mb-md-6 mb-4">
        <h2 class="fw-bold text-center text-uppercase mb-md-5 mb-4">Preguntas Frecuentes</h2>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-9 col-12">
                <div class="accordion" id="preguntasFrecuentes">
                    @foreach($preguntas as $p)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="pregunta{{ $loop->iteration }}">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#cp{{ $loop->iteration }}" aria-expanded="false" aria-controls="cp{{ $loop->iteration }}">
                                    {{ $p->pregunta }}
                                </button>
                            </h2>
                            <div id="cp{{ $loop->iteration }}" class="accordion-collapse collapse" aria-labelledby="pregunta{{ $loop->iteration }}" data-bs-parent="#preguntasFrecuentes">
                                <div class="accordion-body">
                                    {!! $p->respuesta !!}
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    </section>

@endsection

@push('js')
@endpush
