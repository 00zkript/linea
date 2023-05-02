@extends('web.template.index')
@section('titulo','ASESORES COMERCIALES')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="ASESORES COMERCIALES | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="ASESORES COMERCIALES | {{ $seoGeneral->titulo_general }}" />
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
                <li><a href="#">Asesores Comerciales</a></li>
            </ul>
        </div>
    </section>

    <section class="container mt-5 mb-md-6 mb-4">
        <div class="row">
            <div class="col-12 mb-md-5 mb-4">
                <h2 class="fw-bold text-center text-uppercase">Asesores Comerciales</h2>
            </div>
            @foreach ($asesores as $a)
                <div class="col-lg-6 col-md-12 col-12 mb-4">
                    <div class="card p-3 rounded-4">
                        <div class="row">
                            <div class="col-4">
                                <img src="{{ asset($a->foto ? 'panel/img/asesores/'.$a->foto : 'web/imagenes/asesor-hombre.jpeg') }}">
                            </div>

                            <div class="col-8">
                                <h4 class="fw-bold mt-2">{{ $a->nombres}}</h4>
                                <h5 class="fw-bold" style="color: #d62844;">Asesor</h5>

                                <p>
                                    ¡Te ayudamos a realizar tu compra OnLine! sólo escríbanos al número de Whatsapp,
                                    Telegram, correo o llámenos que lo estaremos atendiendo de inmediato.
                                </p>

                                <p class="fw-bold mt-4 text-dark">Teléfono:</p>

                                <div class="d-flex justify-content-between mt-2 mb-4">
                                    @empty(!$a->celular)
                                    <p class="noselect mb-0">
                                        <img src="{{ asset('web/imagenes/ico-telefono1.png') }}">
                                        <span>{{ $a->celular}}</span>
                                    </p>
                                    @endempty
                                    @empty(!$a->whatsapp)
                                    <p class="mb-0">
                                        @php
                                            $mensajeWhatsapp = empty($urlProducto)
                                                ? '¡Buen día!'
                                                : '¡Buen día! quiero información sobre este producto:<br>'.$urlProducto
                                        @endphp

                                        <a href="{{ \App\Http\Traits\SocialTrait::whatsapp( $a->whatsapp, $mensajeWhatsapp )  }}" target="_blank" style="color: green;">
                                            <img src="{{ asset('web/imagenes/ico-whatsapp.png') }}"> <span class="hidden-xs">Whatsapp</span>
                                        </a>
                                    </p>
                                    @endempty
                                    @empty(!$a->telegram)
                                    <p class="mb-0">
                                        <a href="https://t.me/{{ $a->telegram }}" target="_blank">
                                            <img src="{{ asset('web/imagenes/ico-telegrama.png') }}">
                                            <span class="hidden-xs">Telegram</span>
                                        </a>
                                    </p>
                                    @endempty
                                </div>
                                @empty(!$a->correo)
                                <p class="fw-bold mt-4 mb-1 text-dark">Correo:</p>
                                <p class="noselect mb-2">{{ $a->correo}}</p>
                                @endempty
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>

    </section>
@endsection
@push('js')
@endpush
