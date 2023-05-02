
<section class="container-fluid ps-lg-5 pe-lg-5">
    <div class="row">
        <div class="col-md-4 col-12 pt-5 pb-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
            <div class="d-flex align-items-center iconos-footer">
                <span class="fa-solid fa-truck text-center"></span>
                <aside>
                    <h3 class="fw-bold">DELIVERY</h3>
                    <h6>ENVÍO GRATIS A TODO LIMA METROPOLITANA <br class="hidden-xs">TAMBIÉN HACEMOS ENVÍOS A PROVINCIAS.</h6>
                </aside>
            </div>
        </div>
        <div class="col-md-4 col-12 pt-md-5 pt-0 pb-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.7s">
            <div class="d-flex align-items-center iconos-footer">
                <span class="bi bi-arrow-clockwise text-centerr"></span>
                <aside>
                    <h3 class="fw-bold">DEVOLUCIÓN EN 30 DÍAS</h3>
                    <h6>SOLO DEVUELVALO DENTRO DE 30 <br class="hidden-xs">DÍAS PARA EL CAMBIO.</h6>
                </aside>
            </div>
        </div>
        <div class="col-md-4 col-12  pt-md-5 pt-0 pb-5 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.9s">
            <div class="d-flex iconos-footer">
                <span class="fas fa-lock text-center"></span>
                <aside>
                    <h3 class="fw-bold">PAGO 100% SEGURO</h3>
                    <h6>GARANTIZAMOS TRANSACCIONES SEGURAS <br class="hidden-xs">CON HTTPS Y CERTIFICADOS SSL.</h6>
                </aside>
            </div>
        </div>
    </div>
</section>


<footer class="fondo-suscribete fondo-pie pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-12 pt-4">
                <h4 class="mb-4 fw-bold">UBÍCANOS</h4>
                @empty(!$contactoGeneral->direccion)
                <a {{ (empty( !$contactoGeneral->google_maps) ? 'href='.$contactoGeneral->google_maps.'  target=_blank' : 'href=javascript:void();') }}>
                    <div class="iconos-pie d-flex">
                        <span class="bi bi-geo-alt-fill"></span>
                        <aside>{{ $contactoGeneral->direccion}}</aside>
                    </div>
                </a>
                @endempty

                @empty(!$contactoGeneral->correo)
                <div class="iconos-pie d-flex">
                    <span class="fa-solid fa-envelope"></span>
                    <aside>
                        @foreach( $contactoGeneral->correos AS $c)
                            <a href="mailto:{{ $c }}">{{ $c }}</a>
                            @if(!$loop->last)
                                <br>
                            @endif
                        @endforeach
                    </aside>
                </div>
                @endempty

                @empty(!$contactoGeneral->celular)
                <a href="tel:{{ $contactoGeneral->celular}}"><div class="iconos-pie d-flex"><span class="fa-solid fa-mobile-screen"></span><aside>{{ $contactoGeneral->celular}} </aside></div></a>
                @endempty

                @empty(!$contactoGeneral->telefono)
                <a href="tel:{{ $contactoGeneral->telefono}}"><div class="iconos-pie d-flex"><span class="fas fa-phone"></span><aside>{{ $contactoGeneral->telefono}} </aside></div></a>
                @endempty

                <div class="redes mt-2">
                    @empty(!$contactoGeneral->whatsapp)
                        <a href="{{ $contactoUrlWhatsappEmpresa}}" target="_blank"><span
                                class="fa-brands fa-whatsapp"></span></a>
                    @endempty
                    @empty(!$contactoGeneral->facebook)
                        <a href="{{ $contactoGeneral->facebook}}" target="_blank"><span
                                class="fa-brands fa-facebook-f"></span></a>
                    @endempty
                    @empty(!$contactoGeneral->twitter)
                        <a href="{{ $contactoGeneral->twitter}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                    @endempty
                    @empty(!$contactoGeneral->instagram)
                        <a href="{{ $contactoGeneral->instagram}}" target="_blank"><span class="fa-brands fa-instagram"></span></a>
                    @endempty
                    @empty(!$contactoGeneral->youtube)
                        <a href="{{ $contactoGeneral->youtube}}" target="_blank"><span class="fa-brands fa-youtube"></span></a>
                    @endempty
                    @empty(!$contactoGeneral->linkendin)
                        <a href="{{ $contactoGeneral->linkendin}}" target="_blank"><span class="fa-brands fa-linkedin-in"></span></a>
                    @endempty
                </div>
            </div>
            <div class="col-lg-2 offset-lg-1 col-md-3 col-12 ps-lg-0 pt-4">
                @if( count( $categoriasGeneral ) > 0)
                <h4 class="mb-4 fw-bold">CATEGORÍAS</h4>
                @foreach($categoriasGeneral AS $c)
                    <a href="{{ route('web.productos.categoria',$c->slug_categoria) }}"><div class="iconos-pie d-flex text-uppercase"><aside>{{ $c->nombre }}</aside></div></a>
                @endforeach
                @endif
            </div>
            <div class="col-lg-3 offset-lg-1 col-md-3 col-12 ps-lg-0 pt-4">
                <h4 class="mb-4 fw-bold">INFORMACIÓN</h4>
                <a href="{{ route('web.preguntas-frecuentes') }}"><div class="iconos-pie d-flex"><aside>PREGUNTAS FRECUENTES</aside></div></a>
                <a href="{{ route('web.terminos-condiciones') }}"><div class="iconos-pie d-flex"><aside>TÉRMINOS Y CONDICIONES</aside></div></a>
                <a href="{{ route('web.politicas-privacidad') }}"><div class="iconos-pie d-flex"><aside>POLÍTICAS DE PRIVACIDAD</aside></div></a>
                <a href="{{ route('web.contacto') }}"><div class="iconos-pie d-flex"><aside>CONTÁCTENOS</aside></div></a>
                <a href="{{ route('web.blog') }}"><div class="iconos-pie d-flex"><aside>BLOG</aside></div></a>
            </div>
            <div class="col-lg-2 col-md-3 col-12 pt-4">
                <h4 class="mb-4 fw-bold">ENLACES RÁPIDOS</h4>
                <a href="{{ auth()->check() ? route('web.usuario.index') : route('web.login') }}" title="{{ auth()->check() ? 'Mi cuenta' : 'Iniciar Sesión' }}"><div class="iconos-pie d-flex"><aside>{{ auth()->check() ? 'MI CUENTA' : 'INICIAR SESIÓN' }}</aside></div></a>

                @if( !auth()->check() )
                    <a href="{{ route('web.login.registro') }}" title="Registrarse"><div class="iconos-pie d-flex"><aside>REGISTRARME</aside></div></a>
                @endif
                <a href="{{ route('web.favorito') }}" title="Favoritos"><div class="iconos-pie d-flex"><aside>FAVORITOS</aside></div></a>



                <a href="{{ route('web.libro-reclamacion') }}" class="mt-4 d-block text-md-center"><img src="{{ asset('web/imagenes/libro-de-reclamo.png') }}" style="height:50px;"></a>
                <h4 class="mb-4 fw-bold mt-3 text-md-center">LIBRO DE RECLAMACIONES</h4>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-lg-8 col-12 pt-4">
                <div class="div-iconos margen-arriba">
                    <img src="{{ asset('web/imagenes/pago1.png') }}">
                    <img src="{{ asset('web/imagenes/pago2.png') }}">
                    <img src="{{ asset('web/imagenes/pago3.png') }}">
                    <img src="{{ asset('web/imagenes/pago4.png') }}">
                    <img src="{{ asset('web/imagenes/pago5.png') }}">
                    <img src="{{ asset('web/imagenes/pago6.png') }}">
                    <img src="{{ asset('web/imagenes/pago7.png') }}">
                </div>
            </div>
        </div>
    </div>
</footer>

<section class="fondo-negro pt-4 pb-4">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12 text-center">
                <p class="mb-0">© {{ now()->format('Y') }} {{ $empresaGeneral->nombre }}. Todos los derechos reservados.</p>
            </div>
        </div>
    </div>
</section>


<div class="scrollup btn-to-top">
</div>

