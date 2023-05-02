@extends('web.template.index')

@section('titulo', 'CONTACTO')

@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="CONTACTO | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="CONTACTO | {{ $seoGeneral->titulo_general }}" />
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
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-address-card"></i>Inicio</a></li>
                <li><a href="javascript:void(0);">Contacto</a></li>
            </ul>
        </div>
    </section>

    <section class="banner-int" style="background-image: url('{{ asset('web/imagenes/banner-contacto.jpg') }}');">
        <div class="container h-100">
            <div class="row align-items-center justify-content-center h-100">
                <div class="col-lg-8 col-md-10 col-12 text-center">
                    <h2 class="fw-bold text-white">CONTÁCTANOS</h2>
                    <h2 class="fw-light mt-lg-5 mt-4 text-white">Para contactarte con nosotros por favor llena el siguiente formulario y te atenderemos a la brevedad:</h2>
                </div>
            </div>
        </div>
    </section>

    <section class="container mb-md-5 mb-4">
        <div class="row">
            <div class="col-lg-8 col-md-7 col-12 mt-md-5 mt-4">
                <form class="form-plomo" id="frmComunicate">
                    <div class="row">
                        <div class="col-md-6 col-12 mb-4">
                            <input class="form-control" type="text" title="Nombres" required="" id="nombres" name="nombres" placeholder="Nombres">
                        </div>
                        <div class="col-md-6 col-12 mb-4">
                            <input class="form-control" type="text" title="Apellidos" required="" id="apellidos" name="apellidos" placeholder="Apellidos">
                        </div>
                        <div class="col-md-12 col-12 mb-4">
                            <input class="form-control" type="email" title="E-mail" required="" id="correo" name="correo" placeholder="E-mail">
                        </div>
                        <div class="col-md-12 col-12 mb-4">
                            <input class="form-control" type="text" title="Teléfono" required="" id="telefono" name="telefono" placeholder="Teléfono">
                        </div>
                        <div class="col-md-12 col-12 mb-4">
                            <textarea class="form-control" rows="6" name="mensaje" id="mensaje" title="Mensaje" placeholder="Mensaje"></textarea>
                        </div>
                        <div class="col-md-12 col-12 mb-4">
                            <div class="checkbox fw-bold">
                                <input type="checkbox" name="datos_consignados" id="datos_consignados" >
                                <label for="datos_consignados">He leído y acepto la <a href="{{ route('web.politicas-privacidad') }}" target="_blank">Política de Privacidad</a></label>
                            </div>
                        </div>
                        <div class="col-12" style="display: none;" id="msgExitoContacto">
                            <div class="alert alert-success text-center" role="alert">
                                <p class="mensaje-correo">Hola, tu mensaje ha sido enviado con éxito. Te responderemos a la brevedad posible. Gracias!</p>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6 col-12 mb-4">
                                        <button type="submit" class="btn btn-primary w-100 pt-3 pb-3"><i class="fas fa-paper-plane pe-3"></i> <span>ENVIAR</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-md-5 col-12 mt-md-5 mt-4">
                @empty(!$contactoGeneral->horario)
                    <div class="iconos-chicos d-flex align-items-center mb-lg-5 mb-4">
                        <i class="fa-solid fa-calendar-days"></i>
                        <aside>{!! html_entity_decode($contactoGeneral->horario) !!}</aside>
                    </div>
                @endempty

                @empty(!$contactoGeneral->direccion)
                <a {{ (empty( !$contactoGeneral->google_maps) ? 'href='.$contactoGeneral->google_maps.'  target=_blank' : 'href=javascript:void();') }}>
                    <div class="iconos-chicos d-flex align-items-center mb-lg-5 mb-4">
                        <i class="bi bi-geo-alt-fill"></i>
                        <aside>{{ $contactoGeneral->direccion}}</aside>
                    </div>
                </a>
                @endempty

                @empty(!$contactoGeneral->correo)
                <div class="iconos-chicos d-flex align-items-center mb-lg-5 mb-4">
                    <i class="fa-solid fa-envelope"></i>
                    <aside>
                        @foreach( $contactoGeneral->correos AS $c)
                            <a href="mailto:{{ $c }}"> {{ $c }}</a>
                            @if(!$loop->last)
                                |
                            @endif
                        @endforeach
                    </aside>
                </div>
                @endempty

                @empty(!$contactoGeneral->celular)
                <a href="tel:{{ $contactoGeneral->celular}}">
                    <div class="iconos-chicos d-flex align-items-center mb-lg-5 mb-4">
                        <i class="fa-solid fa-mobile-screen"></i>
                        <aside>{{ $contactoGeneral->celular}}</aside>
                    </div>
                </a>
                @endempty

                @empty(!$contactoGeneral->telefono)
                <a href="tel:{{ $contactoGeneral->telefono}}">
                    <div class="iconos-chicos d-flex align-items-center mb-lg-5 mb-4">
                        <i class="fas fa-phone"></i>
                        <aside>{{ $contactoGeneral->telefono}} </aside>
                    </div>
                </a>
                @endempty

                <div class="redes2 mt-4">
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
        </div>
    </section>

@endsection

@push('js')
    <script type="module">
        $(function () {
            enviarCorreo();
        });

        var enviarCorreo = function () {
            $("#frmComunicate").on("submit",function (e) {
                e.preventDefault();

                if(!document.querySelector('#datos_consignados').checked){
                    toast("error","Debe aceptar haber leido las politicas de privacidad.");
                    return false;
                }

                const form = new FormData($(this)[0]);

                cargando();
                axios.post("{{ route('web.contacto.enviar') }}",form)
                .then( response => {
                    const data = response.data;

                    // $("#msgExitoContacto").html("Gracias por comunicarte con nosotros, en breve te responderemos.");
                    $("#msgExitoContacto").show(2000);

                    setTimeout(function() { $("#msgExitoContacto").hide(2000); }, 8000);
                    $("#frmComunicate")[0].reset();

                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;

                    toast("error",'Ocurrió un error vuelva a intentar o contacte con el soporte');
                    console.log(data.mensaje);
                })
                .then( _ => {
                    $("body").waitMe('hide');

                })




            })
        }


    </script>
@endpush







