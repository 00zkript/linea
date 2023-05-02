@extends('web.template.index')
@section('titulo','MÉTODO DE ENTREGA')
@push('css')
@endpush
@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}">{{--<i class="fa-solid fa-bag-shopping"></i>--}}Inicio</a></li>
                <li><a href="javascript:void(0);">Método de entrega</a></li>
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
                <li class="list-inline-item" id="titleStep2">
                    <span class="circle">2</span>
                    <span><a href="{{ route('web.venta.usuario.index') }}" class="text-secondary">Información<br>del cliente</a></span>
                </li>
                <li class="active list-inline-item" id="titleStep3">
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


    <div class="container margen-arriba margen-abajo mt-4 mb-5">

        <div class="row align-items-start">

            <div class="col-lg-8 col-md-12 col-12 mt-md-4 pe-lg-5">
                <div class="titulo titulo-span mb-4">
                    <h2 class="fw-bold"><i class="fa-solid fa-box"></i> ¿Cómo quieres recibir tu producto?</h2><span></span>
                </div>

                <div class="row">
                    <div class="col-lg-9 col-md-12 col-12">
                        <form onsubmit="return false;" id="frmMetodoEntrega" autocomplete="off">
                            <div class="row justify-content-center">
                                <div class="col-lg-12 ps-lg-4 col-12">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-5 col-12 mt-md-4 mt-1">
                                            <label class="radio-cuadro cuadro-pagoplomo" for="metodoEntrega-domicilio">
                                                <input type="radio" id="metodoEntrega-domicilio" value="domicilio" name="metodoEntrega" checked="" {{ $isDelivery ? 'checked' : '' }}>
                                                <div>
                                                    <span class="color-debajo"></span>
                                                    <p class="d-none d-md-block fw-bold">Delivery</p>
                                                    <figure>
                                                        <img src="{{ asset('web/imagenes/camion-envio.png') }}">
                                                    </figure>
                                                    <p class="mt-2">Envío a tu casa / oficina.</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-12 text-dark mt-md-5 mt-4 divMetodoEntrega-domicilio" style="display: {{ $isDelivery ? '' : 'none' }}">
                                            <div class="cuadro-pagoplomo-cel">

                                                <div class="row justify-content-center">

                                                    <div class="col-lg-12 col-md-12 col-12 mb-3 required">
                                                        <label class="form-label fw-bold text-dark" for="direccion">DIRECCIÓN</label>
                                                        <input type="text" class="form-control" id="direccion" name="direccion" value="{{ $venta->direccion }}" {{ $isDelivery ? 'required' : '' }}>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12 mb-3 required">
                                                        <label class="form-label fw-bold text-dark" for="referencia">REFERENCIA</label>
                                                        <input type="text" class="form-control" id="referencia" name="referencia" value="{{ $venta->referencia }}" {{ $isDelivery ? 'required' : '' }}>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12 mb-3 text-liston required">
                                                        <label class="form-label fw-bold text-dark" for="departamento">DEPARTAMENTO</label>
                                                        <aside class="custom-select">
                                                            <select class="form-control" id="departamento" name="departamento" {{ $isDelivery ? 'required' : '' }}>
                                                                <option value="" {{ $venta->idprovincia ? 'selected': '' }} hidden="">[---SELECCIONE---]</option>
                                                                @foreach($departamentos as $item)
                                                                    <option value="{{ $item->iddepartamento }}" {{ $venta->iddepartamento == $item->iddepartamento ? 'selected' : '' }} >{{ $item->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                            <i class="fa-solid fa-sort-down"></i>
                                                        </aside>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12 mb-3 text-liston required">
                                                        <label class="form-label fw-bold text-dark" for="provincia">PROVINCIA</label>
                                                        <aside class="custom-select">
                                                            <select class="form-control" id="provincia" name="provincia" {{ $isDelivery ? 'required' : '' }}>
                                                                <option value="" {{ !$venta->idprovincia ? 'selected' : '' }} hidden="">[---SELECCIONE---]</option>
                                                                @empty(!$provincias)
                                                                    @foreach($provincias as $item)
                                                                        <option value="{{ $item->idprovincia }}" {{ $venta->idprovincia == $item->idprovincia ? 'selected' : '' }} >{{ $item->nombre }}</option>
                                                                    @endforeach
                                                                @endempty
                                                            </select>
                                                            <i class="fa-solid fa-sort-down"></i>
                                                        </aside>
                                                    </div>

                                                    <div class="col-lg-6 col-md-6 col-12 mb-3 text-liston required">
                                                        <label class="form-label fw-bold text-dark" for="distrito">DISTRITO</label>
                                                        <aside class="custom-select">
                                                            <select class="form-control" id="distrito" name="distrito" {{ $isDelivery ? 'required' : '' }} >
                                                                <option value="" {{ !$venta->iddistrito ? 'selected' : '' }} hidden="">[---SELECCIONE---]</option>
                                                                @empty(!$distritos)
                                                                    @foreach($distritos as $item)
                                                                        <option value="{{ $item->iddistrito }}" {{ $venta->iddistrito == $item->iddistrito ? 'selected' : '' }} >{{ $item->nombre }}</option>
                                                                    @endforeach
                                                                @endempty
                                                            </select>
                                                            <i class="fa-solid fa-sort-down"></i>
                                                        </aside>
                                                    </div>


                                                    <div class="col-lg-12 col-md-12 col-12 mb-3 costoEnvioDivParent" style="display: {{ $venta->idcosto_envio ? '' : 'none' }};">
                                                        <div class="costoEnvioDiv mt-3">
                                                            @empty(!$costoEnvio)
                                                                @foreach($costoEnvio as $item)
                                                                    <div class="form-check mb-3">
                                                                        <input type="radio" name="costoEnvio" id="costoEnvio-{{ $item->idcosto_envio }}" value="{{ $item->idcosto_envio }}" class="form-check-input" {{ $item->idcosto_envio == $venta->idcosto_envio ? 'checked' : '' }} >
                                                                        <label for="costoEnvio-{{ $item->idcosto_envio }}" class="form-check-label"><b>Costo de envío</b><br><span class="text-secondary"><b>{{ $item->restriccion }} {{ $monedaGeneral->format($item->precio * $monedaGeneral->cambio,2,".","") }}</b></span></label>
                                                                    </div>
                                                                @endforeach
                                                            @endempty

                                                        </div>
                                                    </div>




                                                    <div class="col-lg-12 col-md-12 col-12 mb-3">
                                                        @php( $hasOtherReceiver = $isDelivery && $venta->otro_receptor )
                                                        <div class="checkbox m-0 d-inline-block">
                                                            <input type="checkbox" name="otroReceptorDomicilio" {{ $hasOtherReceiver ? 'checked' : '' }} id="otroReceptorDomicilio" value="1">
                                                            <label class="estilos-label-pc2 fw-bold" for="otroReceptorDomicilio">
                                                                OTRA PERSONA RECIBIRÁ EL PEDIDO
                                                            </label>
                                                        </div>

                                                        <div id="div-registrar-otro-domicilio" class="mt-3" style="display: {{ $hasOtherReceiver ? '' : 'none' }}">
                                                            <label class="form-label fw-bold text-dark" for="nombreReceptorDomicilio">NOMBRE COMPLETO DE LA PERSONA</label>
                                                            <input id="nombreReceptorDomicilio" name="nombreReceptorDomicilio" type="text" class="form-control" value="{{ $hasOtherReceiver ? $venta->otro_receptor : '' }}" {{ $hasOtherReceiver ? 'required' : '' }} >
                                                        </div>
                                                    </div>


                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-xl-4 col-lg-4 col-md-5 col-12 mt-md-4 mt-3 mb-md-0 mb-3 col-absoluto">
                                            <label class="radio-cuadro cuadro-pagoplomo" for="metodoEntrega-tienda">
                                                <input type="radio" id="metodoEntrega-tienda" name="metodoEntrega" value="tienda" {{ !$isDelivery ? 'checked' : '' }}>
                                                <div>
                                                    <span class="color-debajo"></span>
                                                    <p class="d-none d-md-block fw-bold">Retiro en tienda</p>
                                                    <figure>
                                                        <img src="{{ asset('web/imagenes/recojo-tienda.png') }}">
                                                    </figure>
                                                    <p class="mt-2">Acercate a la más cercana.</p>
                                                </div>
                                            </label>
                                        </div>
                                        <div class="col-12 text-dark mt-md-5 mt-4 divMetodoEntrega-tienda" style="display: {{ !$isDelivery ? '' : 'none' }};">

                                            @if ( count($listPuntosVentas) > 0)

                                                <div class="col-lg-12 col-md-12 col-12 mb-4">
                                                    <div class="px-md-0 px-3">
                                                        <h4 class="fw-bold mt-1 mb-2 text-dark">Escoge una tienda</h4>
                                                        <div class="escoge-tiendas scroll-bar overflow-auto">
                                                            <ul>
                                                                @foreach( $listPuntosVentas as $item )
                                                                    <li data-punto="{{ $item->idpunto_venta }}" class="{{ $item->idpunto_venta == $venta->idpunto_venta ? 'active' : '' }}">
                                                                        <h4 class="fw-bold"><i class="bi bi-geo-alt-fill pe-2 text-primary fs-5"></i>{{ $item->nombre }}</h4>
                                                                        @empty(!$item->direccion)
                                                                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                                                            <i class="bi bi-shop text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center" style="height: 24px;width: 24px;"></i>
                                                                            {{ $item->direccion }}
                                                                        </p>
                                                                        @endempty
                                                                        @empty(!$item->correo)
                                                                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                                                            <i class="bi bi-envelope text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center" style="height: 24px;width: 24px;"></i>
                                                                            {{ $item->correo }}
                                                                        </p>
                                                                        @endempty
                                                                        @empty(!$item->whatsapp)
                                                                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                                                            <i class="fa-brands fa-whatsapp text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center" style="height: 24px;width: 24px;"></i>
                                                                            {{ $item->whatsapp }}
                                                                        </p>
                                                                        @endempty
                                                                        @empty(!$item->telefono)
                                                                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                                                            <i class="bi bi-telephone text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center" style="height: 24px;width: 24px;"></i>
                                                                            {{ $item->telefono }}
                                                                        </p>
                                                                        @endempty
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                            @else

                                                <div class="col-lg-12 col-md-12 col-12 mb-4">
                                                    <h4 class="fw-bold mb-3 mt-4">
                                                        <i class="bi bi-geo-alt-fill pe-2 text-primary fs-5"></i>Locales disponibles
                                                    </h4>
                                                    <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                                        <i class="fa-solid fa-store text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                                        <span class="w-100">{!! $contactoGeneral->direccion !!}</span>
                                                    </p>
                                                    @if($contactoGeneral->telefono)
                                                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                                            <i class="fa-solid fa-phone text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                                            <span class="w-100">{{ $contactoGeneral->telefono  }}</span>
                                                        </p>
                                                    @endif
                                                    @if($contactoGeneral->horario)
                                                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                                            <i class="fa-solid fa-calendar text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                                            <span class="w-100">{{ $contactoGeneral->horario  }}</span>
                                                        </p>
                                                    @endif
                                                </div>
                                            @endif

                                            <div class="col-lg-12 col-md-12 col-12 mb-3">
                                                @php( $hasOtherReceiver = !$isDelivery && $venta->otro_receptor )
                                                <div class="checkbox m-0 d-inline-block">
                                                    <input type="checkbox" name="otroReceptorTienda" {{ $hasOtherReceiver ? 'checked' : '' }} id="otroReceptorTienda" value="1">
                                                    <label class="estilos-label-pc2 fw-bold" for="otroReceptorTienda">
                                                        OTRA PERSONA RECIBIRÁ EL PEDIDO
                                                    </label>
                                                </div>

                                                <div id="div-registrar-otro-tienda" class="mt-3" style="display: {{ $hasOtherReceiver ? '' : 'none' }}">
                                                    <label class="form-label fw-bold text-dark" for="nombreReceptorTienda">NOMBRE COMPLETO DE LA PERSONA</label>
                                                    <input id="nombreReceptorTienda" name="nombreReceptorTienda" type="text" class="form-control" value="{{ $hasOtherReceiver ? $venta->otro_receptor : '' }}" {{ $hasOtherReceiver ? 'required' : '' }} >
                                                </div>
                                            </div>


                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12 sticky-top mt-md-4 mt-2">
                <div id="contenidoRevisionPedido"></div>
                <div class="col-12 pt-3">
                    <button class="btn btn-primary w-100 pt-3 pb-3 fw-bold enviarForm"><span>MÉTODO DE PAGO</span><i class="fas fa-angle-right ps-3"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')


<script type="module">
    const moneyFormat = "{{ $monedaGeneral->format('0.00') }}";

    const monedaCambio = "{{ $monedaGeneral->cambio }}";
    const sucursales = "{{ count($listPuntosVentas) }}";

    const getResumenPedido = () => {
        axios.get("{{ route('web.venta.resumen') }}")
            .then(response => {
                const data = response.data;

                $('#contenidoRevisionPedido').html(data);
            })
            .catch(error => {
                const response = error.response;
                const data = response.data;

                if (response.status == 419) {
                    getResumenPedido();
                }

                if (response.status == 500) {
                    const $msje = data.toString().replace(/\s+/g, "").replace("}{", "},{").split(",")[0];

                    try {
                        $val = JSON.parse($msje);
                        if ($val.message == "ServerError") {

                            getResumenPedido();

                        }
                    } catch (e) {
                    }

                }
            })
    }

    const pasarlSiguientePaso = () => {
        $(document).on('click', '.enviarForm', function (e) {
            e.preventDefault();

            $('#frmMetodoEntrega').submit();
        })

        $(document).on("submit", "#frmMetodoEntrega", function (e) {
            e.preventDefault();


            const $errores = validarFormDireccion();
            if ($errores.length > 0) {
                toast("error", listErrorsForm($errores), "Errores econtrados :");
                return false;
            }

            $('body').waitMe(waitMeEffectBounce);
            const form = new FormData($('#frmMetodoEntrega')[0]);

            const metodoEntrega = $('input[name=metodoEntrega]:checked').val();

            if(metodoEntrega == 'domicilio'){
                form.append('otroReceptor',$('#otroReceptorDomicilio').is(':checked'));
                form.append('nombreReceptor',$('#nombreReceptorDomicilio').val());
            }else{
                form.append('otroReceptor',$('#otroReceptorTienda').is(':checked'));
                form.append('nombreReceptor',$('#nombreReceptorTienda').val());
                if(sucursales > 0){
                    form.append('puntoVenta',$('.escoge-tiendas li.active').data('punto'));
                }

            }

            axios.post("{{ route('web.venta.entrega.guardar') }}", form)
                .then(response => {
                    const data = response.data;

                    toast("success", data.mensaje);
                    location.href = "{{ route('web.venta.pago.index') }}";


                })
                .catch(error => {
                    const response = error.response;
                    const data = response.data;

                    if (response.status == 400) {
                        toast("error", data.mensaje);
                        return false
                    }

                    toast("error", "Error del servidor, contácte con soporte.");
                })
                .then(_ => {
                    stop();
                })


        })
    }


    const getProvincia = ({iddepartamento, valorActual = null}) => {

        axios.get("{{ route('web.venta.entrega.getProvincia') }}", {
            params: {
                iddepartamento: iddepartamento
            }
        })
            .then(response => {
                const data = response.data;


                $('#provincia').html(`<option value="" ${valorActual == '' ? 'selected' : ''} hidden>[---SELECCIONE---]</option>`);

                for (const provincia of data) {
                    $('#provincia').append(`<option ${valorActual == provincia.idprovincia ? 'selected' : ''}  value="${provincia.idprovincia}" >${provincia.nombre}</option>`);
                }


                $('#distrito').html(`<option value="" selected hidden>[---SELECCIONE---]</option>`);


            })
            .catch(error => {
                const response = error.response;
                const data = response.data;

                if (response.status == 400) {
                    toast("error", data.mensaje);
                    return false;
                }


                toast("error", "Error del servidor, contácte con soporte.");
            })
            .then(_ => {
                stop();
            })


    }

    const getDistrito = ({iddepartamento, idprovincia = null, valorActual = ''}) => {
        axios.get("{{ route('web.venta.entrega.getDistrito') }}", {
            params: {
                iddepartamento: iddepartamento,
                idprovincia: idprovincia
            }
        })
            .then(response => {
                const data = response.data;

                $('#distrito').html(`<option value="" ${valorActual == '' ? 'selected' : ''} hidden>[---SELECCIONE---]</option>`);

                for (const distrito of data) {
                    $('#distrito').append(`<option ${valorActual == distrito.iddistrito ? 'selected' : ''}  value="${distrito.iddistrito}" >${distrito.nombre}</option>`);
                }


            })
            .catch(error => {
                const response = error.response;
                const data = response.data;

                if (response.status == 400) {
                    toast("error", data.mensaje);
                    return false;
                }


                toast("error", "Error del servidor, contácte con soporte.");
            })
            .then(_ => {
                stop();
            })
    }


    const selectUbigeo = () => {
        $(document).on('change', '#departamento', function (e) {
            e.preventDefault();
            const iddepartamento = $(this).val();

            getProvincia({iddepartamento});
        });

        $(document).on('change', '#provincia', function (e) {
            e.preventDefault();
            const iddepartamento = $('#departamento').val();
            const idprovincia = $(this).val();

            getDistrito({iddepartamento, idprovincia});
        });

        $(document).on('change', '#distrito', function (e) {
            e.preventDefault();

            axios.post("{{ route('web.venta.entrega.getPrecioEnvio') }}", {
                iddepartamento: $('#departamento').val(),
                idprovincia: $('#provincia').val(),
                iddistrito: $('#distrito').val()
            })
                .then(response => {
                    const data = response.data;

                    $('.costoEnvioDiv').html('');
                    for (let item of data) {
                        const html = `
                        <div class="form-check mb-3">
                            <input type="radio" name="costoEnvio" id="costoEnvio-${item.idcosto_envio}" value="${item.idcosto_envio}" class="form-check-input" >
                            <label for="costoEnvio-${item.idcosto_envio}" class="form-check-label">
                                <b> ${ moneyFormat('0.00').replace('0.00',number_format(item.precio * monedaCambio, 2, ".", "")) } </b>
                                <br>
                                <span class="text-secondary">
                                    <b>Nota:${item.restriccion}</b></span>
                                </label>
                        </div>
                    `;


                        $('.costoEnvioDiv').append(html);
                    }
                    $('.costoEnvioDivParent').show();


                })
                .catch(error => {
                    const response = error.response;
                    const data = response.data;

                    if (response.status == 400) {
                        toast("error", data.mensaje);
                        return false;
                    }


                    toast("error", "Error del servidor, contácte con soporte.");
                })
                .then(_ => {
                    stop();
                })

        })
    }

    const receptor = () => {
        $(document).on("click", "#otroReceptorDomicilio", function () {
            $("#div-registrar-otro-domicilio").slideToggle(5);
            $('#nombreReceptorDomicilio').focus();

            if (document.querySelector("#otroReceptorDomicilio").checked) {
                $('#nombreReceptorDomicilio').attr("required", "required");
            } else {
                $('#nombreReceptorDomicilio').removeAttr("required");
            }

        });

        $(document).on("click", "#otroReceptorTienda", function () {
            $("#div-registrar-otro-tienda").slideToggle(5);
            $('#nombreReceptorTienda').focus();

            if (document.querySelector("#otroReceptorTienda").checked) {
                $('#nombreReceptorTienda').attr("required", "required");
            } else {
                $('#nombreReceptorTienda').removeAttr("required");
            }

        });
    }

    const validarFormDireccion = () => {
        let errors = [];

        if (document.querySelector('#metodoEntrega-domicilio').checked) {


            if ( empty($("#direccion").val()) ) {
                errors.push("La dirección no debe estar vacía.");
            }

            /* if ( empty($("#referencia").val()) ) {
                errors.push("La referencia no debe estar vacía.");
            } */

            if ( empty($("#departamento").val()) ) {
                errors.push("Debe seleccionar un departamento.");
            }

            if ( empty($("#provincia").val()) ) {
                errors.push("Debe seleccionar una provincia.");
            }

            if ( empty($("#distrito").val()) ) {
                errors.push("Debe seleccionar un distrito.");
            }

            if (document.querySelector('#otroReceptorDomicilio').checked) {
                if ($('#nombreReceptorDomicilio').val().trim() == '') {
                    errors.push("Debe agregar el nombre de la persona que recibirá el pedido.");
                }
            }

            if (!document.querySelector('input[name="costoEnvio"]:checked')) {
                errors.push("Debe seleccionar un precio de envío.");
            }


        }

        if (document.querySelector('#metodoEntrega-tienda').checked) {


            if( sucursales > 0 &&  document.querySelectorAll('.escoge-tiendas li.active').length !== 1 ){
                errors.push('Debe escoger una tienda para continuar.')
            }


            if (document.querySelector('#otroReceptorTienda').checked) {
                if ( empty($('#nombreReceptorTienda').val()) ) {
                    errors.push("Debe agregar el nombre de la persona que recibirá el pedido.");
                }
            }

        }

        return errors;


    }

    const changeMetthodDelivery = () => {
        $(document).on("change", 'input[name="metodoEntrega"]', function (e) {
            e.preventDefault();
            const val = $(this).val();


            if (val == "tienda") {
                $('.divMetodoEntrega-domicilio').slideUp();
                $('.divMetodoEntrega-tienda').slideDown();
                $('.required input,select').attr('required', 'required');
            } else {

                $('.divMetodoEntrega-tienda').slideUp();
                $('.divMetodoEntrega-domicilio').slideDown();
                $('.required input,select').removeAttr('required');
            }

        })
    }

    const selectStore = () => {
        $(document).on('click', '.escoge-tiendas li', function (e) {
            e.preventDefault();
            $('.escoge-tiendas li').removeClass('active');
            $(this).addClass('active')
        })
    }

    const getDatePickerTitle = elem => {
        // From the label or the aria-label
        const label = elem.nextElementSibling;
        let titleText = '';
        if (label && label.tagName === 'LABEL') {
            titleText = label.textContent;
        } else {
            titleText = elem.getAttribute('aria-label') || '';
        }

        return titleText;
    }

    $(function () {
        $('#datepickerFechaRetiro').datepicker({
            // daysOfWeekDisabled: [0, 6], /* deshabilita los fines de semana*/
            daysOfWeekDisabled: [0,0], /* deshabilita los domingos*/
            startDate: '+1d', /* dice cuantos días después empieza*/
            format: 'dd/mm/yyyy',
            language: 'es',
            orientation: "auto left",
            forceParse: false,
            autoclose: true,
            todayHighlight: false, /*pinta la fecha de hoy*/
            toggleActive: false,
        });

        $('#datepickerFechaDelivery').datepicker({
            // daysOfWeekDisabled: [0, 6], /* deshabilita los fines de semana*/
            daysOfWeekDisabled: [0,0], /* deshabilita los domingos*/
            startDate: '+1d', /* dice cuantos días después empieza*/
            format: 'dd/mm/yyyy',
            language: 'es',
            orientation: "auto left",
            forceParse: false,
            autoclose: true,
            todayHighlight: false, /*pinta la fecha de hoy*/
            toggleActive: false,
        });
    });

    $(document).ready(function () {
        getResumenPedido();
        pasarlSiguientePaso();


        selectUbigeo();
        selectStore();
        receptor();
        changeMetthodDelivery();


        /* const elems = document.querySelectorAll('.datepicker_input');
        for (const elem of elems) {
            const datepicker = new Datepicker(elem, {
                'format': 'dd/mm/yyyy', // UK format
                title: getDatePickerTitle(elem)
            });
        } */

    })
</script>
@endpush
