@extends('web.template.index')
@section('titulo','DATOS DE CLIENTE')
@push('css')
@endpush
@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-bag-shopping"></i>Inicio</a></li>
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
        <form onsubmit="return false;" id="frmDatosCliente" autocomplete="off">
            <div class="row align-items-start">
                <div class="col-lg-8 col-md-12 col-12 mt-md-4 pe-lg-5">
                    <div class="titulo titulo-span mb-md-5 mb-4">
                        <h2 class="fw-bold"><i class="fa-solid fa-user-pen"></i> Información del Cliente</h2><span></span>
                    </div>
                    <div class="row">
                        <div class="col-lg-9 col-md-12 col-12">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="nombres">NOMBRES <span class="text-danger">*</span></label>
                                    <input type="text" name="nombres" id="nombres" required class="form-control" maxlength="250" placeholder="NOMBRES" value="{{ $data->nombres }}">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="apellidos">APELLIDOS <span class="text-danger">*</span></label>
                                    <input type="text" name="apellidos" id="apellidos" required class="form-control" maxlength="250" placeholder="APELLIDOS" value="{{ $data->apellidos }}">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="telefono">TÉLEFONO <span class="text-danger">*</span></label>
                                    <input type="text" name="telefono" id="telefono" required class="form-control soloNumeros" maxlength="15" placeholder="XXXXXXXXX" value="{{ $data->telefono }}">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="correo">CORREO <span class="text-danger">*</span></label>
                                    <input type="email" name="correo" id="correo" required class="form-control" maxlength="250" placeholder="CORREO" value="{{ $data->correo }}">
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3 text-liston">
                                    <label class="form-label fw-bold text-dark" for="tipoDocumentoIdentidad">TIPO DOCUMENTO <span class="text-danger">*</span></label>
                                    <aside class="custom-select">
                                        <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" required>
                                            <option value="" hidden>[--- Seleccione ---]</option>
                                            @foreach($tipoDocumentoIdentidad as $item)
                                                <option
                                                    value="{{ $item->idtipo_documento_identidad }}"
                                                    {{ $data->idtipo_documento_identidad == $item->idtipo_documento_identidad ? 'selected' : '' }}
                                                >
                                                    {{ $item->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </aside>
                                </div>

                                <div class="col-lg-6 col-md-6 col-12 mb-3">
                                    <label class="form-label fw-bold text-dark" for="numeroDocumentoIdentidad">N° DE DOCUMENTO <span class="text-danger">*</span></label>
                                    <input
                                        type="text"
                                        name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad"
                                        required
                                        class="form-control soloNumeros"
                                        placeholder="XXXXXXXX"
                                        value="{{ $data->numero_documento_identidad }}"
                                        minlength="{{ $data->idtipo_documento_identidad == 1 ? 8 : 12  }}"
                                        maxlength="{{ $data->idtipo_documento_identidad == 1 ? 8 : 12  }}"
                                    >
                                </div>


                                <div class="col-lg-12 col-md-12 col-12 mb-3 text-liston">
                                    <label class="form-label fw-bold text-dark" for="tipoComprobante">TIPO COMPROBANTE <span class="text-danger">*</span></label>
                                    <aside class="custom-select">
                                        <select name="tipoComprobante" id="tipoComprobante" class="form-control" required>
                                            <option value="1" {{ $data->facturacion_idcomprobante == 1 ? 'selected' : '' }} >Boleta</option>
                                            <option value="2" {{ $data->facturacion_idcomprobante == 2 ? 'selected' : '' }} >Factura</option>
                                        </select>
                                        <i class="fa-solid fa-sort-down"></i>
                                    </aside>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12 mb-3 divComprobante" style="display: {{ $data->facturacion_idcomprobante == 2 ? '' : 'none'  }}">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" name="ruc" id="ruc" placeholder="R.U.C" maxlength="11" value="{{ $data->facturacion_ruc }}">
                                        </div>

                                        <div class="col-md-6 mb-3">
                                            <input type="text" class="form-control" name="razonSocial" id="razonSocial" placeholder="Razón social" value="{{ $data->facturacion_razon_social }}">
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 col-12 sticky-top mt-md-4 mt-2">
                    <div id="contenidoRevisionPedido"></div>
                    <div class="col-12 pt-3">
                        <button type="submit" class="btn btn-primary w-100 pt-3 pb-3 fw-bold"><span>MÉTODO DE ENTREGA</span><i class="fas fa-angle-right ps-3"></i></button>
                    </div>
                </div>
            </div>
        </form>
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

        const pasarlSiguientePaso = () => {
            $(document).on("submit","#frmDatosCliente",function (e){
                e.preventDefault();

                $('body').waitMe(waitMeEffectBounce);
                const form = new FormData($('#frmDatosCliente')[0]);

                axios.post("{{ route('web.venta.usuario.guardar') }}",form)
                .then( response => {
                    const data = response.data;

                    toast("success",data.mensaje);
                    location.href = "{{ route('web.venta.entrega.index') }}";



                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;

                    if (response.status == 400){
                        toast("error",data.mensaje);
                        return false
                    }

                    toast("error","Error del servidor, contácte con soporte.");
                })
                .then( _ => {
                    stop();
                })


            })
        }

        const changeComprobante = () => {
            $(document).on('change','#tipoComprobante', function(e){
                e.preventDefault();

                const val = $(this).val();

                if (val == 2 ){
                    $('.divComprobante').show();
                    $('.divComprobante input').attr('required','required');


                }else{
                    $('.divComprobante').hide();
                    $('.divComprobante input').removeAttr('required');
                }

            })
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



        $(document).ready(function(){
            getResumenPedido();
            pasarlSiguientePaso();
            changeComprobante();
            changeTipoDocumentoIdentidad();

            $('.soloNumeros').on('keypress',validarSoloNumeros);
        })

    </script>
@endpush
