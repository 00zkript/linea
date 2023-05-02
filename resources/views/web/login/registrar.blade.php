@extends('web.template.index')
@section('titulo','REGISTRATE')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="REGISTRARSE | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="REGISTRARSE | {{ $seoGeneral->titulo_general }}" />
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
                <li><a href="#">Registrarse</a></li>
            </ul>
        </div>
    </section>

    <div class="container mt-5 mb-md-6 mb-4">
        <h2 class="fw-bold text-center text-uppercase">Registrarse</h2>
        <p class="text-center mb-4">Registrarse en este sitio le permite acceder al estado e historial de su pedido.<br>Solo te pediremos la información necesaria para que el proceso de compra sea más rápido y sencillo.</p>

        <div class="row justify-content-center mt-md-5 mt-4 align-items-center">
            <div class="col-lg-7 col-md-6 col-12">
                <form id="frmRegistro" onsubmit="return false;">
                    <div class="row">
                        @csrf
                        {{--<div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group text-liston">
                                <label for="nombres" class="fw-bold mb-2">NOMBRES <span class="text-danger">*</span></label>
                                <input type="text" id="nombres" name="nombres" placeholder="Nombres" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group text-liston">
                                <label for="apellidos" class="fw-bold mb-2">APELLIDOS <span class="text-danger">*</span></label>
                                <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group text-liston">
                                <label for="tipoDocumento" class="fw-bold mb-2">TIPO DOCUMENTO <span class="text-danger">*</span></label>
                                <aside>
                                    <select  name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control mb-3" required>
                                        <option value="" hidden selected>[--Seleccione--]</option>
                                        @foreach($tipoDocumentoIdentidad as $item)
                                            <option value="{{ $item->idtipo_documento_identidad }}">
                                                {{ $item->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fa-solid fa-sort-down"></i>
                                </aside>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group text-liston">
                                <label for="numeroDocumentoIdentidad" class="fw-bold mb-2">NUM. DOCUMENTO <span class="text-danger">*</span></label>
                                <input type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" required class="form-control soloNumeros mb-3" maxlength="8" minlength="8" placeholder="#">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group text-liston">
                                <label for="telefono" class="fw-bold mb-2">TELÉFONO <span class="text-danger">*</span></label>
                                <input type="text" name="telefono" id="telefono" required class="form-control soloNumeros mb-3" maxlength="15" placeholder="#">
                            </div>
                        </div>--}}

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="correo" class="fw-bold mb-2">CORREO <span class="text-danger">*</span></label>
                                <input type="email" id="correo" name="correo" placeholder="Ejemplo@correo.com" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group text-liston">
                                <label for="clave" class="fw-bold mb-2">CONTRASEÑA <span class="text-danger">*</span></label>
                                <input type="password" id="clave" name="clave" placeholder="*******" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-12">
                            <div class="form-group text-liston">
                                <label for="clave_confirmation" class="fw-bold mb-2">CONFIRME CONTRASEÑA <span class="text-danger">*</span></label>
                                <input type="password" id="clave_confirmation" name="clave_confirmation" placeholder="*******" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="checkbox">
                                <input type="checkbox" value="1" name="terms" id="terms">
                                <label for="terms">
                                    Acepto los <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalTerminosCondicionesGeneral" >Términos y condiciones</a>
                                </label>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-12 mt-4 text-center">
                            <button type="submit" class="btn btn-primary p-3 px-5 w-100"><span class="glyphicon glyphicon-check"></span><i class="fa-solid fa-circle-check"></i>&nbsp;&nbsp; REGISTRARME</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 offset-lg-1 col-md-6 col-12 mt-md-0 mt-4">
                <div class="fondo-plomo p-md-5 p-4 rounded">
                    <h3 class="fw-bold text-center">Otras formas de Iniciar Sesión</h3>

                    @empty( !env('FACEBOOK_CLIENT_ID') )
                    <a href="{{ route('web.login.auth','facebook') }}" class="btn btn-default p-3 px-4 w-100 mt-4"><i class="fa-brands fa-facebook"></i>&nbsp;&nbsp;  FACEBOOK</a>
                    @endempty

                    @empty( !env('GOOGLE_CLIENT_ID') )
                    <a href="{{ route('web.login.auth','google') }}" class="btn btn-danger p-3 px-4 w-100 mt-4"><i class="fa-brands fa-google"></i>&nbsp;&nbsp;  GOOGLE</a>
                    @endempty

                    <a href="{{ route('web.login') }}" class="btn btn-secondary p-3 px-4 w-100 mt-4"><i class="fa-solid fa-arrow-right-to-arc"></i>&nbsp;&nbsp;  Iniciar Sesión</a>


                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
 <script !src="">



         const removerClaseErrorForm = function (argument) {

            $("#frmRegistro input").on("keyup",function (e) {
                e.preventDefault();
                $(this).removeClass('input-error');
            })

        }

        const guardarRegistro = function () {
            $("#frmRegistro").on("submit",function(e){
                e.preventDefault();

                if ($('#clave').val().length <= 5 ){
                    toast("error","La contraseña debe tener una longitud minima de 6 carácteres.");
                    return false;
                }

                if ($('#clave').val() !== $('#clave_confirmation').val()){
                    toast("error","La contraseña no coincide. Intente nuevamente.");
                    $('#clave').focus()
                    return false;
                }

                if (!document.querySelector('#terms').checked){
                    toast('error','Debe aceptar los Términos y condiciones.')
                    return false;
                }


                const form = new FormData($("#frmRegistro")[0]);
                $('body').waitMe(waitMeEffectBounce);
                $("#frmRegistro button[type=submit]").prop('disabled',true);

                axios.post("{{ route("web.login.registro.guardar") }}",form)
                .then( response => {
                    const data = response.data;


                    toast("success",data.mensaje);
                    setTimeout(function () {
                        $('body').waitMe(waitMeEffectBounce);
                        window.location.href = '{{ route('web.usuario.index') }}';
                    },1000);
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;


                    if(response.status === 400){
                        toast("error",data.mensaje);
                        return false;
                    }

                    if(response.status === 422){

                        toast("error",listErrors(data));
                        return false;
                    }

                    toast("error","Error del servidor, contácte con soporte.");

                })
                .then( _ => {
                    stop();
                    $("#frmRegistro button[type=submit]").prop('disabled',false);
                })



            });

        }


        const changeTipoDocumentoIdentidad = () => {
            $(document).on('change','#tipoDocumentoIdentidad', function(e){
                e.preventDefault();

                const val = $(this).val();

                if (val == 1){
                    $('#numeroDocumentoIdentidad').attr('minLength',8);
                    $('#numeroDocumentoIdentidad').attr('maxLength',8);
                    $('#numeroDocumentoIdentidad').val($('#numeroDocumentoIdentidad').val().substring(0,8));
                }

                if (val == 2){
                    $('#numeroDocumentoIdentidad').attr('minLength',12);
                    $('#numeroDocumentoIdentidad').attr('maxLength',12);
                    $('#numeroDocumentoIdentidad').val($('#numeroDocumentoIdentidad').val().substring(0,12));
                }

                if (val == 3){
                    $('#numeroDocumentoIdentidad').attr('minLength',12);
                    $('#numeroDocumentoIdentidad').attr('maxLength',12);
                    $('#numeroDocumentoIdentidad').val($('#numeroDocumentoIdentidad').val().substring(0,12));

                }
            })
        }




         $(function () {
             guardarRegistro();
             removerClaseErrorForm();
             changeTipoDocumentoIdentidad();

             $('.soloNumeros').on('keypress',validarSoloNumeros);
         });

    </script>
@endpush
