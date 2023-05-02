@extends('web.template.index')
@section('titulo','RECUPERAR CONSTRASEÑA')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="RECUPERAR CONTRASEÑA | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="RECUPERAR CONTRASEÑA | {{ $seoGeneral->titulo_general }}" />
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
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-house-chimney"></i>Inicio</a></li>
                <li><a href="#">Olvidé mi contraseña</a></li>
            </ul>
        </div>
    </section>

    <div class="container mt-5 mb-md-6 mb-4">
        <h2 class="fw-bold text-center text-uppercase">Recuperar contraseña</h2>
        <p class="text-center mb-4">¿Perdiste tu contraseña? Por favor, introduce tu correo electrónico.<br>Recibirás un enlace para crear una contraseña nueva por correo electrónico.</p>

        <div class="row justify-content-center mt-md-5 mt-4 align-items-center">
            <div class="col-lg-6 col-md-6 col-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">

                            <form id="frmRecuperarClave" onsubmit="return false;">
                                @csrf
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group text-liston">
                                        <label for="correo" class="fw-bold mb-2">CORREO:</label>
                                        <input type="email" id="correo" name="correo" placeholder="Ejemplo@correo.com" required class="form-control mb-0" maxlength="250">
                                    </div>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">
                                    <button type="submit" class="btn btn-primary p-3 px-4 w-100 mt-2"><i class="fa-solid fa-lock-keyhole"></i>&nbsp;&nbsp;RECUPERAR CONTRASEÑA</button>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <a class="btn btn-secondary p-3 px-4 w-100 mt-4" href="{{ route('web.login') }}"><i class="fa-solid fa-arrow-right-to-arc"></i>&nbsp;&nbsp;INICIAR SESIÓN</a>
                                </div>
                            </form>



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="module">
        $(function () {

            recuperarClave();
        });



        var recuperarClave = function () {
            $("#frmRecuperarClave").on("submit",function(e){
                e.preventDefault();
                $.ajax({
                    url:'{{ route("web.login.recuperar-clave.enviarClave") }}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmRecuperarClave")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        $('body').waitMe(waitMeEffectBounce);
                    },
                    success:function (data) {

                        if (!data.error){
                            toast("success",data.mensaje);
                            $("#frmRecuperarClave")[0].reset();
                        }else{
                            toast("error",data.mensaje);
                        }



                    },
                    error:function (data) {

                        if(data.status === 422){

                            var errors = data.responseJSON.errors;
                            var listErrors = '<ul>';

                            $.each(errors,function (index,value) {
                                listErrors += '<li>'+value[0]+'</li>';
                            })
                            listErrors += '</ul>';

                            toast("error",listErrors);

                        }else{
                            toast("error",data.responseJSON);
                        }


                    },
                    complete:function () {
                        stop();
                    }
                });
            });
        }
    </script>
@endpush
