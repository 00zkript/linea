@extends('web.template.index')
@section('titulo','LOGIN')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="LOGIN | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="LOGIN | {{ $seoGeneral->titulo_general }}" />
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
                <li><a href="#">Mi perfil</a></li>
            </ul>
        </div>
    </section>

    <div class="container mt-5 mb-md-6 mb-4">
        <h2 class="fw-bold text-center text-uppercase">Iniciar Sesión</h2>
        <p class="text-center mb-4">Solo te pediremos la información necesaria para que el proceso de compra sea más rápido y sencillo.</p>

        <div class="row justify-content-center mt-md-5 mt-4">
            <div class="col-lg-5 col-md-6 col-12">
                <form id="frmLogin" onsubmit="return false;">
                    <div class="row">
                        @csrf


                        @error('login')
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="alert alert-danger text-center">{{ $message }}</div>
                        </div>
                        @enderror



                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston text-liston">
                                <label for="correo" class="fw-bold mb-2">CORREO:</label>
                                <input type="email" id="correo" name="correo" placeholder="Ejemplo@correo.com" required class="form-control mb-3" maxlength="250">

                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="clave" class="fw-bold mb-2">CONTRASEÑA:</label>
                                <input type="password" id="clave" name="clave" placeholder="*******" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="checkbox">
                                <input type="checkbox" value="1" name="recuerdame" id="recuerdame">
                                <label for="recuerdame">Recuérdame</label>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12 mt-4">
                            <a href="{{ route('web.login.recuperar-clave') }}">¿Olvidaste tu contraseña?</a>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12 mt-4">
                            <button type="submit" class="btn btn-primary p-3 px-4 w-100"><span class="glyphicon glyphicon-log-in"></span> INICIAR SESIÓN</button>
                        </div>

                        <div class="custom-hr mt-4" style="display: {{ !empty(env('FACEBOOK_CLIENT_ID')) || !empty(env('GOOGLE_CLIENT_ID')) ? '' : 'none' }};">
                          <span class="hr-text">o</span>
                        </div>

                        @empty( !env('FACEBOOK_CLIENT_ID') )
                        <div class="col-lg-12 col-md-12 col-12">
                            <a href="{{ route('web.login.auth','facebook') }}" class="btn btn-default p-3 px-4 w-100 mt-4"><i class="fa-brands fa-facebook"></i>&nbsp;&nbsp;  FACEBOOK</a>
                        </div>
                        @endempty

                        @empty( !env('GOOGLE_CLIENT_ID') )
                        <div class="col-lg-12 col-md-12 col-12">
                            <a href="{{ route('web.login.auth','google') }}" class="btn btn-danger p-3 px-4 w-100 mt-4"><i class="fa-brands fa-google"></i>&nbsp;&nbsp;  GOOGLE</a>
                        </div>
                        @endempty

                    </div>
                </form>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-6 col-12 mt-md-0 mt-4">
                <div class="fondo-plomo p-md-5 p-4 rounded">
                    <h3 class="fw-bold">¿NUEVO CLIENTE?</h3>
                    <p>Crea una cuenta con nosotros y podrás:</p>
                    <ul>
                        <li>Echar un vistazo más rápido</li>
                        <li>Guardar varias direcciones de envío</li>
                        <li>Accede a tu historial de pedidos</li>
                        <li>Seguimiento de nuevos pedidos</li>
                        <li>Guarda artículos en tu lista de deseos</li>
                    </ul>


                    <a href="{{ route('web.login.registro') }}" class="btn btn-secondary p-3 px-4 w-100 mt-4"><span class="glyphicon glyphicon-plus-sign"></span> REGÍSTRATE</a>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
 <script type="module">
        $(function () {

            verificarLogin();
            removerClaseErrorForm();
        });


        var removerClaseErrorForm = function (argument) {

        	$("#frmLogin input").on("keyup",function (e) {
        		e.preventDefault();
        		$(this).removeClass('input-error');
        	})

        }


        var verificarLogin = function () {
            $("#frmLogin").on("submit",function(e){
                e.preventDefault();

                const formData = new FormData($("#frmLogin")[0]);

                $('body').waitMe(waitMeEffectBounce);
                axios.post("{{ route('web.login.verificar') }}",formData)
                .then( response => {
                    const data = response.data;

                    $("#frmLogin button[type=submit]").prop('disabled',true);
                    toast("success",data.mensaje);

                    setTimeout(function () {
                        $('body').waitMe(waitMeEffectBounce);
                        location.reload();
                    },1000);


                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;

                    if(response.status === 400){
                        toast("error",data.mensaje);
                    }

                    if(response.status === 422){

                        toast("error",listErrors(data));

                    }

                    if (response.status == 500){
                        toast("error","Error del servidor, contácte con soporte.");
                    }


                })
                .then( _ => {
                    stop();
                })


            });
        }
    </script>
@endpush
