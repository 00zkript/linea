@extends('web.template.index')
@section('titulo','DATOS DE CLIENTE')
@push('css')
@endpush
@section('contenido')

    <section class="fondo-blanco pt-2 pb-2">
        <div class="container-fluid px-md-45">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}">{{--<i class="fa-solid fa-bag-shopping"></i>--}}Inicio</a></li>
                <li><a href="javascript:void(0);">Información del cliente</a></li>
            </ul>
        </div>
    </section>

    <section class="container">
        <div id="steps" class="simulador">
            <ul class="list-inline list-step-simulafacil text-center mt-4 mb-5">
                <li class="list-inline-item" id="titleStep1">
                    <span class="circle">1</span>
                    <span><a href="{{ route('web.carrito-de-compras.index') }}" class="text-secondary">Ver<br>carrito</a></span>
                </li>
                <li class="active list-inline-item" id="titleStep2">
                    <span class="circle">2</span>
                    <span>Información<br>del cliente</span>
                </li>
                <li class="list-inline-item" id="titleStep3">
                    <span class="circle">3</span>
                    <span>Modo de<br>entrega</span>
                </li>
                <li class="list-inline-item" id="titleStep4">
                    <span class="circle">4</span>
                    <span>Método<br>de pago</span>
                </li>

            </ul>
        </div>
    </section>


    <div class="container mt-4 mb-5">
        <div class="row align-items-start">
            <div class="col-lg-8 col-md-12 col-12 mt-md-4 pe-lg-5">
                <div class="titulo titulo-span mb-md-5 mb-4">
                    <h2 class="fw-bold"><i class="fa-solid fa-user-lock"></i> Inicia o Registrate con nosotros</h2><span></span>
                </div>
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-12" id="contenidoFrmLogin">

                        @error('login')
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="alert alert-danger text-center">{{ $message }}</div>
                        </div>
                        @enderror


                        <form onsubmit="return false;" style="display: block" id="frmLogin" class="form" autocomplete="off">
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label for="correo" class="form-label fw-bold text-dark">CORREO <span class="text-danger">*</span></label>
                                    <input type="email" name="correo" required class="form-control" maxlength="250" placeholder="Ejemplo@gmail.com">
                                </div>

                                <div class="col-12 mb-3">
                                    <label for="clave" class="form-label fw-bold text-dark">CONTRASEÑA <span class="text-danger">*</span></label>
                                    <input type="password" name="clave" required class="form-control" maxlength="50" placeholder="******">
                                </div>


                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" value="1" type="checkbox" name="recuerdame" id="recuerdame">
                                        <label class="form-check-label" for="recuerdame">Recuérdame</label>
                                    </div>
                                </div>

                                <div class="col-12 mb-3" >
                                    <a href="{{ route('web.login.recuperar-clave') }}" target="_blank" >¿Olvidaste tu contraseña?</a>
                                </div>


                                <div class="col-12 mb-3">
                                    ¿No tienes una cuenta? <a href="javascript:void(0)" class="link showRegistro">Registrate</a>.
                                </div>

                                <div class="col-12 mb-3 text-center">
                                    <button type="submit" class="btn btn-primary p-3 px-4 w-100">INICIAR SESIÓN</button>
                                </div>

                            </div>
                        </form>

                        <form onsubmit="return false;" style="display: none;" id="frmRegistro" class="form" autocomplete="off">
                            <div class="row">

                                {{--<div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="nombres">NOMBRES <span class="text-danger">*</span></label>
                                    <input type="text" id="nombres" name="nombres" placeholder="Nombres" required="" class="form-control" maxlength="250">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="apellidos">APELLIDOS <span class="text-danger">*</span></label>
                                    <input type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required="" class="form-control" maxlength="250">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3 text-liston">
                                    <label class="form-label fw-bold text-dark" for="tipoDocumentoIdentidad">TIPO DOCUMENTO <span class="text-danger">*</span></label>
                                    <aside class="custom-select">
                                        <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" required="">
                                            <option value="" hidden="" selected="">[--Seleccione--]</option>
                                            @foreach($tipoDocumentoIdentidad as $item)
                                                <option value="{{ $item->idtipo_documento_identidad }}">
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </aside>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="numeroDocumentoIdentidad">NUM. DOCUMENTO <span class="text-danger">*</span></label>
                                    <input type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" required="" class="form-control soloNumeros" maxlength="8" minlength="8" placeholder="#">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="telefono">TELÉFONO <span class="text-danger">*</span></label>
                                    <input type="text" name="telefono" id="telefono" required class="form-control soloNumeros" maxlength="15" placeholder="#">
                                </div>--}}

                                <div class="col-lg-12 col-md-12 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="correo">CORREO <span class="text-danger">*</span></label>
                                    <input type="email" id="correo" name="correo" placeholder="Ejemplo@correo.com" required="" class="form-control" maxlength="250">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="clave">CONTRASEÑA <span class="text-danger">*</span></label>
                                    <input type="password" id="clave" name="clave" placeholder="*******" required="" class="form-control" maxlength="250">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="clave_confirmation">CONFIRME CONTRASEÑA <span class="text-danger">*</span></label>
                                    <input type="password" id="clave_confirmation" name="clave_confirmation" placeholder="*******" required class="form-control" maxlength="250">
                                </div>

                                <div class="col-12 mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" value="1" type="checkbox" name="terms" id="terms">
                                        <label class="form-check-label" for="terms">
                                            Acepto los <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalTerminosCondicionesGeneral" >Términos y condiciones</a>.
                                        </label>
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    ¿Ya tienes una cuenta con nosotros? <a href="javascript:void(0)" class="link showLogin">Inicia sesión</a>.
                                </div>

                                <div class="col-12 mb-3 text-center">
                                    <button type="submit" class="btn btn-primary p-3 px-4 w-100"> REGISTRARME</button>
                                </div>

                            </div>
                        </form>

                        <div class="row">
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
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12 sticky-top mt-4" id="contenidoRevisionPedido">
            </div>

        </div>
    </div>

@endsection
@push('js')

    <script type="module">

        const getResumenPedido = () => {
            axios.get("{{ route('web.venta.resumen') }}")
            .then( response => {
                const data = response.data;

                $('#contenidoRevisionPedido').html(data);
            })
            .catch( error => {
                const response = error.response;
                const data = response.data;

                if (response.status == 419){
                    getResumenPedido();
                }

                if( response.status == 500){
                    const $msje = data.toString().replace(/\s+/g,"").replace("}{","},{").split(",")[0];

                    try {
                        $val = JSON.parse($msje);
                        if ($val.message == "ServerError"){

                            getResumenPedido();

                        }
                    }catch (e){}

                }

            })
        }

        const acciones = () => {
            $(document).on("click",".showRegistro",function(e) {
                e.preventDefault();

                $('#frmLogin').hide();
                $('#frmRegistro').show();
                scrollTo("#frmRegistro")


            })

            $(document).on("click",".showLogin",function(e) {
                e.preventDefault();

                $('#frmLogin').show();
                $('#frmRegistro').hide();
                scrollTo("#frmLogin")


            })

        }

        const verificarLogin = () => {
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

        const guardarRegistro = () => {
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
                        location.reload();
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
            verificarLogin();
            guardarRegistro();
            acciones();
            getResumenPedido();
            changeTipoDocumentoIdentidad();

            $('.soloNumeros').on('keypress',validarSoloNumeros);
        });

    </script>
@endpush
