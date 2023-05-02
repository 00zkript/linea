@extends('web.template.index')
@section('titulo','HOME')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES"/>
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="HOME | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta name="twitter:title" content="HOME | {{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection

@section('contenido')

    @php
        $columns = [
            1 => [ 12 ],
            2 => [ 6, 6 ],
            3 => [ 6, 3, 3 ],
            4 => [ 6, 3, 3, 6 ],
            5 => [ 6, 3, 3, 3, 3 ],
        ];

        $imagesStyle = [
            3 => [ 'width' => '100%', 'height' => '300px' ],
            4 => [ 'width' => '100%', 'height' => 'auto' ],
            6 => [ 'width' => '100%', 'height' => '685px' ],
            12 => [ 'width' => '100%', 'height' => 'auto' ],
        ];
    @endphp

    @foreach($secciones as $seccion)
        @if($seccion->tipo == 'imagenes' && count($seccion->links) > 0 )
            <section class="container-lg container-fluid mt-md-5 mt-4">
                <h1 class="text-center fw-bold m-0 mb-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">- {{ Str::upper($seccion->titulo) }} -</h1>
                <div class="row d-block overflow-hidden">

                    @foreach($seccion->links  as $item)
                        @php( $column = $columns[$loop->count][$loop->index] )
                        <div class="col-lg-{{ $column }} col-md-{{ $column }} col-12  col-auto">
                            <div class="contenido-prod">
                                <figure class="position-relative">
                                    <a href="{{ $item->link }}" tabindex="0">
                                        <picture class="imagen-producto">
                                            <img src="{{ asset('panel/img/sectionHome/'.$item->imagen) }}">
                                        </picture>
                                    </a>
                                    @if($loop->index > 0)
                                        <div class="mascaranegra2 cat">
                                            <a href="{{ $item->link }}" class="btn-mascara" tabindex="0">{{ $item->texto }} <i class="fas fa-eye"></i></a>
                                        </div>
                                    @endif
                                </figure>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>

        @endif

        @if($seccion->tipo == 'productos' && count($seccion->productos) > 0 )
            <section class="container mt-md-5 mt-4">
                <h1 class="text-center fw-bold m-0 mb-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">- {{ Str::upper($seccion->titulo) }} -</h1>
                <div class="row d-block overflow-hidden">

                    @foreach($seccion->productos as $producto)
                        @php( $column = $columns[$loop->count][$loop->index] )
                        <div class="col-lg-{{ $column  }} col-md-{{ $column  }} col-12 col-auto">
                            <div class="contenido-prod shadow-none border-0">
                                <div class="efecto-zoom carruser">
                                    <figure class="position-relative">
                                        <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}">
                                            <figure class="imagen-producto">
                                                <img src="{{ asset($producto->path_imagen) }}"
                                                     style="
                                                        width: {{ $imagesStyle[$column]["width"] }};
                                                        height: {{ $imagesStyle[$column]["height"] }};
                                                     "
                                                >
                                            </figure>
                                        </a>
                                        <div class="mascaranegra2 cat">
                                            <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}" class="btn-mascara">CONSULTAR TALLAS <i class="fas fa-eye"></i></a>
                                        </div>
                                    </figure>
                                    <aside class="px-md-3 pt-3">
                                        <div class="text-center">
                                            <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}" title="Botines Gamuza" class="d-inline-block align-middle"><h5 class="item-tit mb-0">
                                                    {{ $producto->nombre }}</h5></a>
                                            @if($producto->idcategoria !== null)
                                                <a href="{{ route('web.productos.categoria',$producto->categoria->slug_categoria) }}" style="color:{{ $producto->categoria->color }};" class="text-nowrap d-inline-block align-middle">&nbsp;- {{ $producto->categoria->nombre }}</a>
                                            @endif
                                        </div>
                                        @if($producto->show_precio)
                                            <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}" class="text-center mt-2">
                                                <h5 class="precio">{{ $monedaGeneral->format($producto->precio) }}</h5>
                                                @if($producto->precio_descuento > 0)
                                                    <h5 class="dscto ps-2">{{ $monedaGeneral->format($producto->precio_promocional) }}</h5>
                                                @endif
                                            </a>
                                        @endif
                                    </aside>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </section>
        @endif

        @if($seccion->tipo == 'slider' && count($seccion->slider) > 0 )
            <section class="container-fluid pb-4 mt-md-5 mt-5">
                <h1 class="text-center fw-bold m-0 mb-0 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">- {{ Str::upper($seccion->titulo) }} -</h1>
                <div class="row d-block">
                    <div class="slider mt-4 px-md-6 px-0 padding-carru slider-productos slider_productos_carrusel" >
                        @foreach($seccion->slider AS $item)
                            <div class="item">
                                @include('web.productos.partes.itemProducto',["producto" => $item])
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if($seccion->tipo == 'html')
            <section class="container mt-md-5 mt-4">
                <h1 class="text-center fw-bold m-0 mb-0 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">- EMPRENDE CON NOSOTROS -</h1>
            </section>
            <section class="fondo-plomo mt-5 mb-4 mb-3 mb-lg-4 px-0">
                <div class="container-lg container-fluid">
                    {!! $seccion->contenido !!}
                </div>
            </section>
        @endif

    @endforeach



    @if( count($testimonios) > 0)
        <section class="container-fluid mb-5 mb-3 mb-lg-5 pt-md-5 px-0">
            <h1 class="text-center fw-bold m-0 mb-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">- NOS RECOMIENDAN -</h1>

            <div class="sslider mt-4 px-md-6 slider-productos" id="slickTestimonio">
                @foreach($testimonios as $testimonio)
                    <div class="item">
                        <div class="cont-testimonio">
                            <div class="top-testimonio ps-md-5">
                                <picture>
                                    <img src="{{ asset($testimonio->avatar ? 'panel/img/testimonio/'.$testimonio->avatar : 'web/imagenes/avatar-comment.png') }}">
                                </picture>
                                <aside>
                                    <h4>{{ $testimonio->nombre }}<i class="fa-solid fa-comment ps-md-3 ps-2 fs-5"></i></h4>
                                    <p>recomienda <b>Witches</b></p>
                                </aside>
                            </div>
                            <div class="bottom-testimonio mt-4 ps-md-5">
                                {!! $testimonio->testimonio !!}
                                @if($testimonio->imagen)
                                    <picture>
                                        <img src="{{ asset('panel/img/testimonio/'.$testimonio->imagen) }}">
                                    </picture>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

@endsection
@push('js')
    <!--/*banner home*/-->
    <script type="module">
        let slideWrapper = $(".main-slider"), iframes = slideWrapper.find('.embed-player'),
            lazyImages = slideWrapper.find('.slide-image'), lazyCounter = 0;

        // POST commands to YouTube or Vimeo API
        function postMessageToPlayer(player, command) {
            if (player == null || command == null) return;
            player.contentWindow.postMessage(JSON.stringify(command), "*");
        };

        // When the slide is changing
        function playPauseVideo(slick, control) {
            var currentSlide, slideType, startTime, player, video;

            currentSlide = slick.find(".slick-current");
            slideType = currentSlide.attr("class").split(" ")[1];
            player = currentSlide.find("iframe").get(0);
            startTime = currentSlide.data("video-start");

            if (slideType === "vimeo") {
                switch (control) {
                    case "play":
                        if ((startTime != null && startTime > 0) && !currentSlide.hasClass('started')) {
                            currentSlide.addClass('started');
                            postMessageToPlayer(player, {
                                "method": "setCurrentTime",
                                "value": startTime
                            });
                        }
                        postMessageToPlayer(player, {
                            "method": "play",
                            "value": 1
                        });
                        break;
                    case "pause":
                        postMessageToPlayer(player, {
                            "method": "pause",
                            "value": 1
                        });
                        break;
                }
            } else if (slideType === "youtube") {
                switch (control) {
                    case "play":
                        postMessageToPlayer(player, {
                            "event": "command",
                            // "func": "mute"
                        });
                        postMessageToPlayer(player, {
                            "event": "command",
                            "func": "playVideo"
                        });
                        break;
                    case "pause":
                        postMessageToPlayer(player, {
                            "event": "command",
                            "func": "pauseVideo"
                        });
                        break;
                }
            } else if (slideType === "video") {
                video = currentSlide.children("video").get(0);
                if (video != null) {
                    if (control === "play") {
                        video.play();
                    } else {
                        video.pause();
                    }
                }
            }
        }

        // Resize player
        function resizePlayer(iframes, ratio) {
            if (!iframes[0]) return;
            var win = $(".main-slider"),
                width = win.width(),
                playerWidth,
                height = win.height(),
                playerHeight,
                ratio = ratio || 16 / 9;

            iframes.each(function () {
                var current = $(this);
                if (width / ratio < height) {
                    playerWidth = Math.ceil(height * ratio);
                    current.width(playerWidth).height(height).css({
                        left: (width - playerWidth) / 2,
                        top: 0
                    });
                } else {
                    playerHeight = Math.ceil(width / ratio);
                    current.width(width).height(playerHeight).css({
                        left: 0,
                        top: (height - playerHeight) / 2
                    });
                }
            });
        }

        function resizeevent() {
            // Resize event
            $(window).on("resize.slickVideoPlayer", function () {
                resizePlayer(iframes, 16 / 9);
            });
        }

        // Initialize
        slideWrapper.on("init", function (slick) {
            slick = $(slick.currentTarget);
            setTimeout(function () {
                playPauseVideo(slick, "play");
            }, 1000);
            resizePlayer(iframes, 16 / 9);
        });
        slideWrapper.on("beforeChange", function (event, slick) {
            slick = $(slick.$slider);
            playPauseVideo(slick, "pause");
        });
        slideWrapper.on("afterChange", function (event, slick) {
            slick = $(slick.$slider);
            playPauseVideo(slick, "play");
        });
        slideWrapper.on("lazyLoaded", function (event, slick, image, imageSource) {
            lazyCounter++;
            if (lazyCounter === lazyImages.length) {
                lazyImages.addClass('show');
                // slideWrapper.slick("slickPlay");
            }
        });

        //start the slider
        slideWrapper.slick({
            // fade:true,
            lazyLoad: "progressive",
            speed: 600,
            arrows: true,
            dots: false,
            loop: false,
            adaptiveHeight: true,
            cssEase: "cubic-bezier(0.87, 0.03, 0.41, 0.9)",
            autoplaySpeed: 7000,
            autoplay: {
                delay: 8500,
                disableOnInteraction: false,
            },
            responsive: [{
                breakpoint: 767,
                settings: {
                    arrows: true,
                    dots: true
                }
            }]
        });
        resizeevent();



        $('.slider_productos_carrusel').slick({
            dots: false,
            infinite: true,
            speed: 900,
            slidesToShow: 4,
            slidesToScroll: 4,
            centerPadding: '40px',
            adaptiveHeight: true,
            lazyLoad: 'ondemand',
            autoplay: {
                delay: 1500,
                disableOnInteraction: false,
            },
            responsive: [
                {
                    breakpoint: 1200,
                    settings: {
                        centerPadding: '20px',
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 991,
                    settings: {
                        arrows: true,
                        speed: 300,
                        dots: false,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        arrows: true,
                        speed: 300,
                        dots: false,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 2,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        arrows: true,
                        speed: 300,
                        dots: false,
                        centerMode: true,
                        centerPadding: '0px',
                        slidesToShow: 1
                    }
                }
            ]
        });
    </script>
    <!--/*fin banner home*/-->
@endpush
