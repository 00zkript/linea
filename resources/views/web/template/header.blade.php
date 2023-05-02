<header id="header" class="menu-efecto">
    <section class="top-cab pt-md-0 pt-2 pb-md-0 pb-2 fw-normal">
        <div class="container">
            <!-- <div class="text-start"></div> -->
            <div class="text-md-end text-center hr-top">
                <aside>
                    @empty(!$contactoGeneral->whatsapp)
                        <a href="{{ $contactoUrlWhatsappEmpresa}}" target="_blank"><i
                                class="fa-brands fa-whatsapp"></i></a>
                    @endempty
                    @empty(!$contactoGeneral->facebook)
                        <a href="{{ $contactoGeneral->facebook}}" target="_blank"><i
                                class="fa-brands fa-facebook-f"></i></a>
                    @endempty
                    @empty(!$contactoGeneral->twitter)
                        <a href="{{ $contactoGeneral->twitter}}" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                    @endempty
                    @empty(!$contactoGeneral->instagram)
                        <a href="{{ $contactoGeneral->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    @endempty
                    @empty(!$contactoGeneral->youtube)
                        <a href="{{ $contactoGeneral->youtube}}" target="_blank"><i class="fa-brands fa-youtube"></i></a>
                    @endempty
                    @empty(!$contactoGeneral->linkendin)
                        <a href="{{ $contactoGeneral->linkendin}}" target="_blank"><i class="fa-brands fa-linkedin-in"></i></a>
                    @endempty
                </aside>

                @empty(!$contactoGeneral->correo)
                <aside class="hidden-sm hidden-xs">
                    <p class="m-0">
                        <i class="iconos-email"></i>
                        @foreach( $contactoGeneral->correos AS $c)
                            <a href="mailto:{{ $c }}"> {{ $c }}</a>
                            @if(!$loop->last)
                                |
                            @endif
                        @endforeach
                    </p>
                </aside>
                @endempty

                <aside class="hidden-sm hidden-xs">
                    <p class="m-0">
                        <a href="{{ route('web.preguntas-frecuentes') }}">PREGUNTAS FRECUENTES</a>
                    </p>
                </aside>
            </div>
        </div>
    </section>

    <section class="container head-logo pt-md-2 pb-md-2" style="background: #fff;">
        <div class="row align-items-center">
            <div class="col-lg-3 col-md-3 col-12 pt-md-0 pt-2 pb-md-0 pb-2">
                <div class="logo pe-md-4">
                    <a href="{{ url('/') }}">
                        <img src="{{ asset($empresaGeneral->logo ? 'panel/img/empresa/'.$empresaGeneral->logo : 'panel/default/logo.png') }}" alt="logo">
                    </a>
                </div>
            </div>


            {{--modo movil--}}
            <div class="hidden-lg hidden-md hidden-sm p-0">
                <ul class="div-ul" >

                    {{--login--}}
                    <li><a href="{{ route('web.login') }}"><i class="fa-solid fa-user"></i></a></li>
                    {{--login--}}


                    {{--carrito--}}
                    <li>
                        <div class="div-carrito">
                            <a href="{{ route('web.carrito-de-compras.index') }}">
                                <i class="fa-solid fa-cart-shopping item-carro cantidadGlobal"><em class="cantidadGlobalCarrito">{{ Cart::instance('productos')->count() }}</em></i>
                            </a>
                        </div>
                    </li>
                    {{--carrito--}}

                    {{--search product--}}
                    <li>
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalBuscador">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </a>
                    </li>
                    {{--search product--}}

                    {{--icono de menu movil--}}
                    <li>
                        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </li>
                    {{--icono de menu movil--}}
                </ul>
            </div>
            {{--modo movil--}}


            <div class="col-lg-6 col-md-6 col-12 d-none d-md-block">
                <form class="form-buscar" role="form" autocomplete="off" id="formBuscarProducto">
                    <div class="input-group p-0">
                        <input type="text" value="{{(isset($buscadorGlobal) && !empty($buscadorGlobal) ? $buscadorGlobal : '') }}" name="buscadorGlobal" id="iptBuscadorProductoGlobal" placeholder="Buscar productos" class="form-control busador-global">
                        <span class="input-group-btn">
                          <button class="btn-buscar" type="submit">
                              <img class="imgLoaderBuscadorGloblar" src="{{ asset('web/imagenes/loading.gif') }}" style="display: none">
                              <aside><i class="iconos-lupa"></i></aside>
                          </button>
                        </span>
                        <div class="scroll-bar" id="display"></div>
                    </div>
                </form>
            </div>


            <div class="col-lg-3 col-md-3 col-12 d-none d-md-block">
                <div class="p-0">
                    <ul class="div-ul ps-0 mb-0 text-end">

                        <li class="div-li">
                            <div class="div-user">
                                <div class="dropdown menu-sesion">

                                    <a href="javascript:void(0);" class="btn-toggle dropdown-toggle cantidadGlobal text-center no-dropdown" type="button" id="usuarioContenido" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="fa-light fa-user"></i>
                                        <span>{{ auth()->check() ? (auth()->user()->usuario ?: 'USUARIO') : 'Ingresar' }}</span>
                                    </a>

                                    <ul class="dropdown-menu" aria-labelledby="usuarioContenido">
                                        <li>
                                            <span class="div-cerrar">
                                                <a href="{{ auth()->check() ? route('web.usuario.index') : route('web.login') }}" title="{{ auth()->check() ? 'Mi cuenta' : 'Iniciar Sesión' }}">
                                                    <span class="fa-light fa-user"></span>
                                                    {{ auth()->check() ? 'Mi cuenta' : 'Iniciar Sesión' }}
                                                </a>
                                            </span>
                                        </li>

                                        <li>
                                            <span class="div-cerrar">

                                                @if( auth()->check() )
                                                    <a style="text-decoration: none;" href="{{ route('web.login.salir') }}" title="Cerrar sesión">
                                                        <span class="fa-light fa-user-large-slash"></span>
                                                        Cerrar Sesión
                                                    </a>
                                                @else
                                                    <a style="text-decoration: none;" href="{{ route('web.login.registro') }}" title="Registrarse">
                                                        <span class="fa-light fa-user-pen"></span>
                                                        Registrarse
                                                    </a>
                                                @endif

                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </li>

                        <li class="div-li hidden-sm hidden-xs">
                            <a href="{{ route('web.favorito') }}" class="cantidadGlobal text-center">
                                <i class="fa-light fa-heart">
                                    <em class="countFavorito">{{ $countFavoritos }}</em>
                                </i>
                                <span>Favoritos</span>
                            </a>
                        </li>
                        {{--<!-- <li class="div-li hidden-sm hidden-xs">
                            <a href="#" class="cantidadGlobal text-center">
                                <i class="bi bi-shuffle">
                                    <em>0</em>
                                </i>
                                <span>Comparar</span>
                            </a>
                        </li> -->--}}
                        <li class="div-li">
                            <div class="div-carrito">

                                <a href="javascript:void(0);" id="carrito-item" class="cantidadGlobal text-center">
                                    <i class="fa-light fa-cart-shopping item-carro">
                                        <em class="cantidadGlobalCarrito">{{ Cart::instance('productos')->count() }}</em>
                                    </i>
                                    <span>Carrito</span>
                                </a>

                                <input type="hidden" id="mostrarContenidoCarrito" value="0">
                                <div id="contenido-carrito" style="display: none;">
                                    @include('web.carro.carritoMiniatura')
                                </div>
                            </div>
                        </li>

                        <li class="div-li hidden-lg hidden-md hidden-xs">
                            <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="navbar-toggler-icon"></span>
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- MENU -->
    <section class="menu header" id="menu">
        <nav class="navbar navbar-expand-lg navbar-light pt-0 pb-0" aria-label="Menu principal">
            <div class="container-fluid pe-lg-4 ps-lg-4 ps-0 pe-0">

                <div class="collapse navbar-collapse justify-content-center" id="navbarsExample07XL">
                    @include('web.template.menu')
                </div>

            </div>
        </nav>
    </section>
    <!-- FIN MENU -->
</header>
