@extends('web.template.index')
@section('titulo','LIBRO DE RECLAMACIONES')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="LIBRO DE RECLAMACIONES | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="LIBRO DE RECLAMACIONES | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection
@push('css')
    <style>
        .input-error{
            border: 1px solid red;
        }

    </style>
@endpush
@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-book-open"></i>Inicio</a></li>
                <li><a href="#">Libro de reclamaciones</a></li>
            </ul>
        </div>
    </section>

    <div class="container mt-5 mb-md-6 mb-4">
        <h2 class="fw-bold text-center text-uppercase">Libro de reclamaciones</h2>
        <p class="text-center mb-4 px-lg-5">Conforme a lo establecido en el Código de Protección y Defensa del Consumidor ponemos a tu disposición nuestro Libro de Reclamaciones.</p>

        <form onsubmit="return false;" id="frmLibroReclamacion">
            @csrf
            <div class="row justify-content-center mt-md-5 mt-4 align-items-center">
                <div class="col-lg-7 col-md-10 col-12">
                    <div class="row">
                        <h4 class="fw-bold numerador"><i>1</i> <span>Datos del Consumidor</span></h4>

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="nombres_apellidos" class="fw-bold text-uppercase tex mb-2">Nombres y Apellidos <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombres_apellidos" id="nombres_apellidos" maxlength="250" class="form-control mb-3" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group text-liston">
                                <label for="tipo_documento" class="fw-bold text-uppercase tex mb-2">Tipo de Documento <span class="text-danger">(*)</span></label>
                                <aside>
                                    <select name="tipo_documento" id="tipo_documento" class="form-control mb-3" required>
                                        <option value="DNI">DNI</option>
                                        <option value="RUC">RUC</option>
                                    </select>
                                    <i class="fa-solid fa-sort-down"></i>
                                </aside>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group text-liston">
                                <label for="num_documento" class="fw-bold text-uppercase tex mb-2">Número de Documento <span class="text-danger">(*)</span></label>
                                <input type="text" name="num_documento" id="num_documento" minlength="8" maxlength="8"  class="form-control soloNumeros mb-3" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group text-liston">
                                <label for="correo" class="fw-bold text-uppercase tex mb-2">Correo electrónico <span class="text-danger">(*)</span></label>
                                <input type="email" name="correo" id="correo" maxlength="250" class="form-control mb-3" required>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group text-liston">
                                <label for="telefono" class="fw-bold text-uppercase tex mb-2">Número de Teléfono <span class="text-danger">(*)</span></label>
                                <input type="text" name="telefono" id="telefono" maxlength="20" class="form-control mb-3" required>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="direccion" class="fw-bold text-uppercase tex mb-2">Dirección</label>
                                <textarea name="direccion" rows="3" id="direccion" class="form-control mb-3"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="nombre_apoderado" class="fw-bold text-uppercase tex mb-2">Nombre del apoderado (Solo si es menor de edad) </label>
                                <input type="text" name="nombre_apoderado" id="nombre_apoderado" maxlength="250" class="form-control mb-3">
                            </div>
                        </div>

                        <h4 class="fw-bold numerador"><i>2</i> <span>Información del bien contratado</span></h4>

                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="tipo_bien" class="fw-bold text-uppercase tex mb-2">Tipo de bien recibido <span class="text-danger">(*)</span></label>
                                <aside>
                                    <select name="tipo_bien" id="tipo_bien" class="form-control mb-3" required>
                                        <option value="PRODUCTO">PRODUCTO</option>
                                        <option value="SERVICIO">SERVICIO</option>
                                    </select>
                                    <i class="fa-solid fa-sort-down"></i>
                                </aside>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="descripcion_bien" class="fw-bold text-uppercase tex mb-2">Descripción del bien</label>
                                <textarea name="descripcion_bien" rows="3" id="descripcion_bien" class="form-control mb-3"></textarea>
                            </div>
                        </div>

                        <h4 class="fw-bold numerador"><i>2</i> <span>Detalle de la queja o reclamo</span></h4>

                        <div class="col-lg-12 col-md-12 col-12">
                            <p>(1) Queja: Disconformidad no relacionada a los productos o servicios; o, malestar o descontento respecto a la atención al público.</p>
                            <p>(2) Reclamo: Disconformidad relacionada a los productos o servicios.</p>
                            <br>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="tipo_reclamo" class="fw-bold text-uppercase tex mb-2">Tipo de reclamación <span class="text-danger">(*)</span></label>
                                <aside>
                                    <select name="tipo_reclamo" id="tipo_reclamo" class="form-control mb-3" required>
                                        <option value="RECLAMO">RECLAMO</option>
                                        <option value="QUEJA">QUEJA</option>
                                    </select>
                                    <i class="fa-solid fa-sort-down"></i>
                                </aside>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="detalle_reclamo" class="fw-bold text-uppercase tex mb-2">Detalle de la reclamación</label>
                                <textarea name="detalle_reclamo" rows="3" id="detalle_reclamo" class="form-control mb-3"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 mb-3">
                            <div class="checkbox">
                                <input type="checkbox" name="datos_consignados" id="datos_consignados" class="form-control">
                                <label for="datos_consignados">Declaro que los datos consignados son correctos y fiel expresión de la verdad.</label>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-12 mb-3">
                            <div class="checkbox">
                                <input type="checkbox" name="politica_privacidad" id="politica_privacidad" class="form-control">
                                <label for="politica_privacidad">Declaro haber leído y acepto la <a href="{{ route('web.politicas-privacidad') }}" target="_blank">Política de Privacidad</a>.</label>
                            </div>
                        </div>
                        <div class="col-lg-4 offset-lg-4 col-md-6 offset-md-3 col-12 text-center mt-md-5 mt-4">
                            <button type="submit" class="btn btn-primary p-3 px-4 fw-bold w-100">Enviar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('js')
    <script type="module">



        var removerClaseErrorForm = function (argument) {

            $("#frmLibroReclamacion input").on("keyup",function (e) {
                e.preventDefault();
                $(this).removeClass('input-error');
            })

            $("#frmLibroReclamacion select").on("change",function (e) {
                e.preventDefault();
                $(this).removeClass('input-error');
            })

        }

        const guardarRegistro = function () {
            $("#frmLibroReclamacion").on("submit",function(e){
                e.preventDefault();
                $.ajax({
                    url:'{{ route("web.libro-reclamacion.guardarDatos") }}',
                    method:'POST',
                    dataType:'json',
                    data: new FormData($("#frmLibroReclamacion")[0]),
                    cache:false,
                    contentType:false,
                    processData:false,
                    beforeSend:function () {
                        $('body').waitMe(waitMeEffectBounce);
                    },
                    success:function (data) {

                        toast("success",data);
                        $("#frmLibroReclamacion")[0].reset();
                    },
                    error:function (data) {

                        if(data.status === 422){

                            var errors = data.responseJSON.errors;
                            var listErrors = '<ul>';
                            var cont = 0;

                            $.each(errors,function (index,value) {

                                if (cont === 0) {
                                    $("#frmLibroReclamacion #"+index).focus();
                                    $("#frmLibroReclamacion #"+index)[0].scrollIntoView();
                                }

                                $("#frmLibroReclamacion #"+index).addClass('input-error');

                                listErrors += '<li>'+value[0]+'</li>';
                                cont++;
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


        const changeTipoDocumentoIdentidad = () => {
            $(document).on('change','#tipo_documento', function(e){
                e.preventDefault();

                const val = $(this).val();

                if (val == "DNI"){
                    $('#num_documento').attr('minLength',8);
                    $('#num_documento').attr('maxLength',8);
                    $('#num_documento').val($('#num_documento').val().substring(0,8));
                }

                if (val == "RUC"){
                    $('#num_documento').attr('minLength',12);
                    $('#num_documento').attr('maxLength',12);
                    $('#num_documento').val($('#numeroDocumentoIdentidad').val().substring(0,12));
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
