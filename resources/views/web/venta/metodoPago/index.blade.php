@extends('web.template.index')
@section("titulo","MÉTODO DE PAGO")

@section("meta")

@endsection

@push("css")
<style>
    .mensaje-red{
        background: #de0015;
        color: #fff;
        font-size: 12pt;
        padding: 15px;
    }
    .mensaje-red span:before {
        background: #fff;
        color: #de0015;
        border-radius: 50%;
        padding: 8px;
        font-weight: bold;
        font-size: 18px;
    }
</style>
{{--<link rel="stylesheet" href="{{ env('IZIPAY_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/classic-reset.css">--}}
@endpush

@section("contenido")


@if($venta && $venta->total > 0)
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}">{{--<i class="fa-solid fa-bag-shopping"></i>--}}Inicio</a></li>
                <li><a href="javascript:void(0);">Método de pago</a></li>
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
                <li class="list-inline-item" id="titleStep3">
                    <span class="circle">3</span>
                    <span><a href="{{ route('web.venta.entrega.index') }}" class="text-secondary">Modo de<br>entrega</a></span>
                </li>
                <li class="active list-inline-item" id="titleStep4">
                    <span class="circle">4</span>
                    <span>Método<br>de pago</span>
                </li>

            </ul>
        </div>
    </section>


    @if( session()->has('error.venta.pago'))
        <div class="container-fluid pt-5 pb-5"  style="background: #a2d345;" >
            <div class="row">
                <div class="col-lg-12 text-white text-center">
                    <h1 class="fw-bold text-white">¡Error al procesar su pago!</h1>
                    <h5>El pago no se pudo realizar, intente nuevamente.</h5>
                </div>
            </div>
        </div>
    @endif

    <section class="container mt-4 mb-5">
        <div class="row align-items-start">
            <div class="col-lg-8 col-md-12 col-12 mt-md-4 pe-lg-5">
                <div class="titulo titulo-span mb-4">
                    <h2 class="fw-bold"><i class="fa-solid fa-cash-register"></i> ¿Cómo deseas pagar?</h2><span></span>
                </div>

                <div class="row">
                    <div class="col-lg-9 col-md-12 col-12">
                        <div class="row">

                            <div class="col-xl-4 col-lg-4 col-md-5 col-12 mt-md-4 mt-1">
                                <label class="radio-cuadro cuadro-pagoplomo texto-avenir-roman" for="pagoTarjeta" id="22">
                                    <input type="radio" id="pagoTarjeta" value="pagoTarjeta" name="pagos" class="metodoPago" data-contenido="contenidoPagoTarjeta" >
                                    <div>
                                        <span class="color-debajo"></span>
                                        <p class="d-none d-md-block fw-bold">Pago con tarjeta</p>
                                        <img src="{{ asset('web/imagenes/icono-tarjeta.png') }}">
                                        <p class="mt-2">Tarjeta de <br class="d-md-block d-none">crédito / débito</p>
                                    </div>
                                </label>
                            </div>
                            <div class="col-12 opcionContenido" id="contenidoPagoTarjeta"  style="display: none;" >
                                <div class="cuadro-pagoplomo-cel">
                                    <div class="row align-items-center justify-content-center mb-md-5 mb-4 text-center">
                                        <div class="col-1-5 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/visa.png') }}">
                                        </div>
                                        <div class="col-1-5 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/mastercard.png') }}">
                                        </div>
                                        <div class="col-1-5 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/amex.png') }}">
                                        </div>
                                        <div class="col-3 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/dinersCl.png') }}">
                                        </div>
                                        <div class="col-3 offset-md-2 offset-1 mt-md-5 mt-3">
                                            <img src="{{ asset('web/imagenes/mercado-pago.png') }}">
                                        </div>
                                    </div>
                                    <form id="metodoPagoTarjeta">
                                        <input type="hidden" name="cardholderEmail" id="cardholderEmail" value="{{ $venta->correo }}"/>

                                        <div class="row">
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold text-dark">NÚMERO DE TARJETA</label>
                                                <input type="text" id="cardNumber" name="cardNumber" class="form-control" maxlength="16" required="">
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-bold text-dark">MES DE VENCIMIENTO</label>
                                                <select name="cardExpirationMonth" id="cardExpirationMonth" class="form-control form-select" required="">
                                                    <option value="" selected="" hidden="">[--MES--]</option>
                                                    <option value="01">ENERO - 01</option>
                                                    <option value="02">FEBRERO - 02</option>
                                                    <option value="03">MARZO - 03</option>
                                                    <option value="04">ABRIL - 04</option>
                                                    <option value="05">MAYO - 05</option>
                                                    <option value="06">JUNIO - 06</option>
                                                    <option value="07">JULIO - 07</option>
                                                    <option value="08">AGOSTO - 08</option>
                                                    <option value="09">SETIEMBRE - 09</option>
                                                    <option value="10">OCTUBRE - 10</option>
                                                    <option value="11">NOVIEMBRE - 11</option>
                                                    <option value="12">DICIEMBRE - 12</option>
                                                </select>
                                            </div>
                                            <div class="col-6 mb-3">
                                                <label class="form-label fw-bold text-dark">AÑO DE VENCIMIENTO</label>
                                                <select name="cardExpirationYear" id="cardExpirationYear" class="form-control form-select" required="">
                                                    <option value="" selected="" hidden="">[--AÑO--]</option>
                                                    @for($anio = now()->format('Y') ; $anio <= now()->format('Y') + 10 ; $anio++)
                                                        <option value="{{ $anio }}">{{ $anio }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold text-dark">CÓDIGO DE SEGURIDAD</label>
                                                <div class="row">
                                                    <div class="col-3">
                                                        <input type="text" id="securityCode" name="securityCode" class="form-control soloNumeros" required="" maxlength="4" minlength="3">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6 mb-3" style="display: none">
                                                <label class="form-label fw-bold text-dark">BANCO EMISOR</label>
                                                <select name="issuer" id="issuer" class="form-control" ></select>
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold text-dark">NOMBRE DEL TITULAR</label>
                                                <input type="text" id="cardholderName" name="cardholderName" class="form-control" required="">
                                            </div>
                                            <div class="col-4 mb-3">
                                                <label class="form-label fw-bold text-dark">DOCUMENTO</label>
                                                <select name="identificationType" id="identificationType" class="form-control form-select text-uppercase">
                                                    <option value="DNI">DNI</option>
                                                    <option value="C.E">C.E</option>
                                                    <option value="RUC">RUC</option>
                                                    <option value="Otro">Otro</option>
                                                </select>
                                            </div>
                                            <div class="col-8 mb-3">
                                                <label class="form-label fw-bold text-dark">NÚMERO DE DOCUMENTO</label>
                                                <input type="text" name="identificationNumber" id="identificationNumber" class="form-control soloNumeros" required="" minLength="8" maxlength="8">
                                            </div>
                                            <div class="col-12 mb-3">
                                                <label class="form-label fw-bold text-dark">CUOTAS</label>
                                                <select name="installments" id="installments" class="form-control form-select">
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>



                            <div class="col-xl-4 col-lg-4 col-md-5 col-12 mt-md-4 mt-3  mb-md-0 mb-3 col-absoluto">
                                <label class="radio-cuadro cuadro-pagoplomo texto-avenir-roman" for="pagoEfectivo">
                                    <input type="radio" id="pagoEfectivo" value="pagoEfectivo" name="pagos" class="metodoPago" data-contenido="contenidoPagoEfectivo">
                                    <div>
                                        <span class="color-debajo"></span>
                                        <p class="d-none d-md-block fw-bold">Pago en efectivo</p>
                                        <img src="{{ asset('web/imagenes/icono-efectivo.png') }}">
                                        <p class="mt-2">Banca por internet / Pagar en agente</p>
                                    </div>
                                </label>
                            </div>
                            <div class="col-12 opcionContenido" id="contenidoPagoEfectivo" style="display: none;">
                                <div class="ps-md-3 pe-md-3 ps-5 pe-5">
                                    <form id="metodoPagoEfectivo"  class="mb-4">
                                        <div class="row">
                                            <div class="col-md-5 col-5 mt-md-5 mt-0 mb-2">
                                                {{--<div class="custom-control custom-radio">
                                                    <input type="radio" required="" checked="" id="paymentMethod" name="paymentMethod" value="pagoefectivo_atm">
                                                    <label for="paymentMethod">--}}
                                                <img src="{{ asset('web/imagenes/logo-pagoefectivo.png') }}">
                                                {{--</label>
                                            </div>--}}
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0 texto-avenir-roman">Al finalizar tu compra se te brindarán las instrucciones para realizar el pago.</p>
                                        <img src="{{ asset('web/imagenes/listado-de-agentes.jpg') }}" class="mt-2">
                                    </form>
                                </div>
                            </div>



                            <div class="col-xl-4 col-lg-4 col-md-5 col-12 mt-md-4 mt-3  mb-md-0 mb-3 col-absoluto offset-4">
                                <label class="radio-cuadro cuadro-pagoplomo texto-avenir-roman" for="pagoIzipay" id="23">
                                    <input type="radio" id="pagoIzipay" value="pagoIzipay" name="pagos" class="metodoPago" data-contenido="contenidoPagoIzipay">
                                    <div>
                                        <span class="color-debajo"></span>
                                        <p class="d-none d-md-block fw-bold">Pago con tarjeta</p>
                                        <img src="{{ asset('web/imagenes/icono-tarjeta.png') }}">
                                        <p class="mt-2">Tarjeta de <br class="d-md-block d-none">crédito / débito</p>
                                    </div>
                                </label>
                            </div>
                            <div class="col-12 opcionContenido" id="contenidoPagoIzipay"  style="display: none;" >
                                <div class="cuadro-pagoplomo-cel">
                                    <div class="row align-items-center justify-content-center mb-md-5 mb-4 text-center">
                                        <div class="col-1-5 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/visa.png') }}">
                                        </div>
                                        <div class="col-1-5 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/mastercard.png') }}">
                                        </div>
                                        <div class="col-1-5 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/amex.png') }}">
                                        </div>
                                        <div class="col-3 mt-md-5 mt-3 ps-1 pe-1">
                                            <img src="{{ asset('web/imagenes/dinersCl.png') }}">
                                        </div>
                                        <div class="col-3 offset-md-2 offset-1 mt-md-5 mt-3">
                                            {{--<img src="{{ asset('web/imagenes/mercado-pago.png') }}">--}}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="offset-6 align-items-center justify-content-center mb-3 text-center">

                                            <div class="kr-embedded" id="metodoPagoIzipay">
                                                @csrf
                                                <div class="kr-pan"></div>
                                                <div class="kr-expiry"></div>
                                                <div class="kr-security-code"></div>
                                                <!-- payment form submit button -->
                                                <button class="kr-payment-button d-none"></button>
                                                <!-- error zone -->
                                                <div class="kr-form-error"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="col-xl-4 col-lg-4 col-md-5 col-12 mt-md-4 mt-3  mb-md-0 mb-3 col-absoluto offset-8">
                                <label class="radio-cuadro cuadro-pagoplomo texto-avenir-roman" for="pagoDepositoBancario">
                                    <input type="radio" id="pagoDepositoBancario" value="pagoDepositoBancario" name="pagos" class="metodoPago" data-contenido="contenidoPagoDepositoBancario">
                                    <div>
                                        <span class="color-debajo"></span>
                                        <p class="d-none d-md-block fw-bold">Pago en deposito bancario</p>
                                        <img src="{{ asset('web/imagenes/icono-efectivo.png') }}">
                                        <p class="mt-2">Banca por internet / Pagar en agente</p>
                                    </div>
                                </label>
                            </div>
                            <div class="col-12 opcionContenido" id="contenidoPagoDepositoBancario" style="display: none;">
                                <div class="ps-md-3 pe-md-3 ps-5 pe-5">
                                    <form id="metodoPagoDepositoBancario"  class="mb-4">
                                        <div class="row">
                                            <div class="col-md-5 col-5 mt-md-5 mt-0 mb-2">
                                                {!! $empresaGeneral->cuenta_bancaria !!}
                                            </div>
                                        </div>
                                        <p class="mt-2 mb-0 texto-avenir-roman">Al finalizar tu compra se te brindarán las instrucciones para realizar el pago.</p>
                                        <img src="{{ asset('web/imagenes/listado-de-agentes.jpg') }}" class="mt-2">
                                    </form>
                                </div>
                            </div>




                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-12 col-12 sticky-top mt-md-4 mt-2">
                <div id="contenidoRevisionPedido"></div>
                <div class="col-12 pt-3">
                    <button class="btn btn-primary w-100 pt-3 pb-3 fw-bold finalizarPago"><span>FINALIZAR COMPRA</span><i class="fas fa-angle-right ps-3"></i></button>
                </div>
            </div>
        </div>
    </section>
@else
<section class="container mt-4 mb-5">
    <div class="row">
        <div class="col-md-12 col-md-12 col-12 text-center">
            <svg width="150" height="150" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 129 129" class="styles__Svg-sc-17qdfix-0 cPNGKj"><defs><circle id="path-1empty" cx="62.5" cy="62.5" r="62.5"></circle></defs><g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Group-13" transform="translate(0.680000, 0.680000)"><circle id="Oval" fill="#9B9B9B" cx="40.4925352" cy="63.3798592" r="1.32042254"></circle><circle id="Oval-Copy-3" fill="#9B9B9B" cx="88.9080282" cy="62.4995775" r="1.32042254"></circle><circle id="Oval" stroke="#979797" stroke-width="1.32" cx="57.6580282" cy="37.8516901" r="3.08098592"></circle><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-2" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(87.147465, 44.893944) rotate(-270.000000) translate(-87.147465, -44.893944) "></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-3" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(40.492535, 50.175634) rotate(-270.000000) translate(-40.492535, -50.175634) "></path><path d="M52.8164789,58.098169 L55.4573239,62.4995775" id="Line-5" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M73.0629577,58.098169 L75.7038028,62.4995775" id="Line-5-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(74.383380, 60.298873) scale(-1, 1) translate(-74.383380, -60.298873) "></path><path d="M64.2601408,54.5770423 L64.2601408,63.5983265" id="Line-6" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><circle id="Oval-Copy-2" stroke="#979797" stroke-width="1.32" cx="76.1439437" cy="45.7742254" r="2.20070423"></circle><rect id="Rectangle" fill="#CBCBCB" x="34.7707042" y="71.7425352" width="58.9788732" height="10.5633803"></rect><polygon id="Path-3" fill="#9B9B9B" points="20.6861972 82.3059155 34.7707042 71.7425352 34.7707042 82.3059155"></polygon><polygon id="Path-3-Copy" fill="#9B9B9B" transform="translate(100.568346, 77.024225) scale(-1, 1) translate(-100.568346, -77.024225) " points="93.5260929 82.3059155 107.6106 71.7425352 107.6106 82.3059155"></polygon><g id="Rectangle" transform="translate(1.320000, 1.320000)"><mask id="mask-2empty" fill="white"><use xlink:href="#path-1empty"></use></mask><g id="Mask"></g><rect fill="#EBEAEA" mask="url(#mask-2empty)" x="19.3661972" y="80.9859155" width="87.1478873" height="47.5352113"></rect></g><path d="M63.82,127.64 C99.0668127,127.64 127.64,99.0668127 127.64,63.82 C127.64,28.5731873 99.0668127,5.68434189e-14 63.82,5.68434189e-14 C28.5731873,5.68434189e-14 5.68434189e-14,28.5731873 5.68434189e-14,63.82 C5.68434189e-14,99.0668127 28.5731873,127.64 63.82,127.64 Z M63.82,125 C30.031219,125 2.64,97.608781 2.64,63.82 C2.64,30.031219 30.031219,2.64 63.82,2.64 C97.608781,2.64 125,30.031219 125,63.82 C125,97.608781 97.608781,125 63.82,125 Z" id="Oval" fill="#E5E5E5" fill-rule="nonzero"></path></g></g></svg>
            <h4 class="text-center mt-4">No hay productos en el carrito, agrege por lo menos un producto.</h4>
            <div class="text-center mt-4">
                <a href="{{ route('web.productos') }}" class="btn btn-primary fw-bold py-3 px-4">Ver todos los productos
                </a>
            </div>
        </div>
    </div>
</section>
@endif





@endsection

@push("js")

<script src="https://sdk.mercadopago.com/js/v2"></script>
{{--<script src="{{ env('IZIPAY_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/classic.js"></script>--}}
{{--<script src="{{ env('IZIPAY_ENDPOINT') }}/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"></script>--}}

<script type="module">

    let $metodoPago =  "pagoTarjeta";

    const actionSoloWeb = () => {
        if(window.outerWidth > 768){
            $('#pagoTarjeta').attr("checked",true)
            $('#contenidoPagoTarjeta').show();
            $('#contenidoPagoEfectivo').hide();
        }
    }

    const actionBotons = () => {
        $(document).on("click",".metodoPago",function (e) {
            const el = $(this);
            const contenido = el.data("contenido");

            $('.opcionContenido').slideUp();
            $('#'+contenido).slideDown();
            $metodoPago = el.val();

        })
    }



    {{--//pago por Izipay (tarjeta de credito)
    let countResponses = 0;
    const createToken = async () => {
        countResponses++;

        try {
            const response = await axios({
                method: 'POST',
                url: '{{ route('web.venta.pago.createToken') }}',
            });

            const data = response.data;
            const token = data.token;
            const endpoint = data.endpoint;
            const public_key = data.public_key;
            const redirect_url = data.redirect_url;


            // document.querySelector("#metodoPagoTarjeta").setAttribute("kr-form-token", token);

            // const scriptForm = document.createElement('script');
            // scriptForm.src = endpoint+"/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js";
            // scriptForm.id = "scriptForm";
            // scriptForm.setAttribute("kr-public-key", public_key);
            // scriptForm.setAttribute("kr-post-url-success", redirect_url);
            // document.body.appendChild(scriptForm);
            KR.setFormConfig({
                formToken: token,
                language: "es-PE",
                'kr-public-key' : public_key,
                'kr-post-url-success': redirect_url
            });
            // KR.setFormToken()


        }catch (error) {
            const response = error.response;
            const data = response.data;

            if (countResponses > 2){
                toast( 'error','No se pudo conectar con el servidor, intente nuevamente más tarde.');
                countResponses = 0;
                return
            }


            createToken();

        }





    }
    //pago por Izipay--}}


    // pago por Mercado pago
    // Agrega credenciales de SDK
    const mp = new MercadoPago('{{ env("MERCADOPAGO_PUBLIC_ID") }}');
    const validacionForm = (error) => {

        let mensaje = [];
        error.forEach(ele => {

            switch (ele.code) {

                case '205':
                    mensaje.push('Ingresa el número de tu tarjeta.');
                    break;

                case '208':
                    mensaje.push('Elige un mes.');
                    break;

                case '209':
                    mensaje.push('Elige un año.');
                    break;

                case '212':
                    mensaje.push('Ingresa tu tipo de documento.');
                    break;

                case '213':
                    mensaje.push('Ingresa tu documento.');
                    break;

                case '214':
                    mensaje.push('Ingresa tu documento.');
                    break;

                case '220':
                    mensaje.push('Ingresa tu banco.');
                    break;

                case '221':
                    mensaje.push('Ingresa el nombre y apellido.');
                    break;

                case '224':
                    mensaje.push('Ingresa el código de seguridad.');
                    break;

                case 'E301':
                    mensaje.push('Ingresa un número de tarjeta válido.');
                    break;

                case 'E302':
                    mensaje.push('Revisa el código de seguridad.');
                    break;

                case '316':
                    mensaje.push('Ingresa un nombre válido.');
                    break;

                case '322':
                    mensaje.push('El tipo de documento es inválido.');
                    break;

                case '323':
                    mensaje.push('Revisa tu documento.');
                    break;

                case '324':
                    mensaje.push('El documento es inválido.');
                    break;

                case '325':
                    mensaje.push('El mes es inválido.');
                    break;

                case '326':
                    mensaje.push('El año es inválido.');
                    break;

                default :
                    mensaje.push('Revisa los datos.');
                    break;
            }

        })

        toast("error",listErrorsForm(mensaje));

    }

    const validacionAdicionalesFormtarjeta = () => {
        $(document).on('change','#identificationType',function (e){
            e.preventDefault();
            const el = $(this);
            const val = el.val();
            const number = $('#identificationNumber');

            number.val('')
            number.attr('minLength',0)

            if(val == 'DNI'){
                number.attr('minLength',8);
                number.attr('maxLength',8);
                return false;
            }
            if(val == 'C.E'){
                number.attr('maxLength',12);
                return false;
            }
            if(val == 'RUC'){
                number.attr('minLength',11);
                number.attr('maxLength',11);
                return false;
            }

            number.attr('maxLength',15);
            return false;

        })
    }

    const enviarPagoTarjeta = async (event) => {
        event.preventDefault();
        await cardForm.createCardToken();
        const cardData = cardForm.getCardFormData();

        $("body").waitMe(waitMeEffectBounce);

        if (cardData.paymentMethodId == ''){

            toast("error","Revisa el número de tarjeta.");
            $("body").waitMe('hide');
            return false;
        }

        axios.post("{{ route('web.venta.pago.pagarConTarjeta') }}", cardData)
            .then(response => {
                const data = response.data;
                location.href = "{{ route('web.venta.finalVenta') }}";
                $("body").waitMe('hide');
                console.log(data);

            })
            .catch(error => {
                const response = error.response;
                const data = response.data;
                let $payment_method_id = cardData.paymentMethodId == 'master' ? 'mastercard' : cardData.paymentMethodId;
                console.log(data);
                $("body").waitMe('hide');


                if (data.error) {
                    toast("error","No pudimos procesar tu pago.");
                    return false;
                }

                if (data.status == "in_process") {

                    if (data.status_detail == "pending_contingency") {
                        toast("error","Estamos procesando tu pago. No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó.")
                    }

                    if (data.status_detail == "pending_contingency") {
                        toast("error","Estamos procesando tu pago. No te preocupes, menos de 2 días hábiles te avisaremos por e-mail si se acreditó o si necesitamos más información.")
                    }

                }

                if (data.status == "rejected") {


                    if (data.status_detail == "cc_rejected_bad_filled_card_number") {
                        toast("error","Revisa el número de tarjeta.");
                    }

                    if (data.status_detail == "cc_rejected_bad_filled_date") {
                        toast("error","Revisa la fecha de vencimiento.");
                    }

                    if (data.status_detail == "cc_rejected_bad_filled_other") {
                        toast("error","Revisa los datos.");
                    }

                    if (data.status_detail == "cc_rejected_bad_filled_security_code") {
                        toast("error","Revisa el código de seguridad de la tarjeta.");
                    }

                    if (data.status_detail == "cc_rejected_blacklist") {
                        toast("error","No pudimos procesar tu pago.");
                    }

                    if (data.status_detail == "cc_rejected_call_for_authorize") {
                        toast("error","Debes autorizar ante " + $payment_method_id + " el pago de " + cardData.amount + ".");
                    }

                    if (data.status_detail == "cc_rejected_card_disabled") {
                        toast("error","Llama a " + $payment_method_id + " para activar tu tarjeta o usa otro medio de pago.");
                    }

                    if (data.status_detail == "cc_rejected_card_error") {
                        toast("error","No pudimos procesar tu pago.");
                    }

                    if (data.status_detail == "cc_rejected_duplicated_payment") {
                        toast("error","Ya hiciste un pago por ese valor.");
                    }

                    if (data.status_detail == "cc_rejected_high_risk") {
                        toast("error","Tu pago fue rechazado.");
                    }

                    if (data.status_detail == "cc_rejected_insufficient_amount") {
                        toast("error","Tu tarjeta no tiene fondos suficientes.");
                    }

                    if (data.status_detail == "cc_rejected_invalid_installments") {
                        toast("error",$payment_method_id + " no procesa pagos en " + cardData.installments + " cuotas.");
                    }

                    if (data.status_detail == "cc_rejected_max_attempts") {
                        toast("error","Llegaste al límite de intentos permitidos.");
                    }

                    if (data.status_detail == "cc_rejected_other_reason") {
                        toast("error",$payment_method_id + " no procesó el pago.");
                    }
                }


            })


    }

    const  cardForm = mp.cardForm({
        amount: "{{ number_format( $total_final,2,'.','') }}",
        autoMount: true,
        form: {
            id: "metodoPagoTarjeta",
            cardholderName: {
                id: "cardholderName",
                // placeholder: "Titular de la tarjeta",
            },
            cardholderEmail: {
                id: "cardholderEmail",
                // placeholder: "E-mail",
            },
            cardNumber: {
                id: "cardNumber",
                // placeholder: "Número de la tarjeta",
            },
            cardExpirationMonth: {
                id: "cardExpirationMonth",
                // placeholder: "Mes de vencimiento",
            },
            cardExpirationYear: {
                id: "cardExpirationYear",
                // placeholder: "Año de vencimiento",
            },
            securityCode: {
                id: "securityCode",
                // placeholder: "Código de seguridad",
            },
            installments: {
                id: "installments",
                // placeholder: "Cuotas",
            },
            identificationType: {
                id: "identificationType",
                // placeholder: "Tipo de documento",
            },
            identificationNumber: {
                id: "identificationNumber",
                // placeholder: "Número de documento",
            },
            issuer: {
                id: "issuer",
                // placeholder: "Banco emisor",
            },
        },
        callbacks: {
            onFormMounted: error => {
                if (error) {
                    return console.log('Form Mounted handling error: ', error)
                }
                console.log('Form mounted')
            },
            onIdentificationTypesReceived: (error, identificationTypes) => {
                if (error) return console.log('identificationTypes handling error: ', error)

            },
            onPaymentMethodsReceived: (error, paymentMethods) => {
                if (error) return console.log('paymentMethods handling error: ', error)

            },
            onIssuersReceived: (error, issuers) => {
                if (error) return console.log('issuers handling error: ', error)

            },
            onInstallmentsReceived: (error, installments) => {
                if (error) return console.log('installments handling error: ', error)

            },
            onCardTokenReceived: (error, token) => {
                if (error) {
                    // console.log('Token handling error: ', error);
                    validacionForm(error.cause ? error.cause : error );
                    return false;
                }

            },
            onSubmit: enviarPagoTarjeta,
        },
    });
    // pago por mercado pago


    // pago por pagoEfectivo
    const enviarPagoEfectivo = () => {
        $("body").waitMe(waitMeEffectBounce);

        axios.post("{{ route('web.venta.pago.pagarConEfectivo') }}")
            .then(response => {
                const data = response.data;
                location.href = "{{ route('web.venta.finalVenta') }}";
                $("body").waitMe('hide');
                console.log(data);
            })
            .catch(error => {
                const response = error.response;
                const data = response.data;

                console.log(data);
                $("body").waitMe('hide');

                if (data.error) {
                    toast("error","No pudimos procesar tu pago.");
                    return false;
                }


            })

    }
    // pago por pagoEfectivo

    // pago por deposito bancario
    const enviarPagoDepositoBancario = () => {
        $("body").waitMe(waitMeEffectBounce);

        axios.post("{{ route('web.venta.pago.pagarConDepositoBancario') }}")
            .then(response => {
                const data = response.data;
                location.href = "{{ route('web.venta.finalVenta') }}";
                $("body").waitMe('hide');
                console.log(data);
            })
            .catch(error => {
                const response = error.response;
                const data = response.data;

                console.log(data);
                $("body").waitMe('hide');

                if (data.error) {
                    toast("error","No pudimos procesar tu pago.");
                    return false;
                }


            })

    }
    // pago por deposito bancario



    const pagar = () => {
        $(document).on('click','.finalizarPago',async function (e) {
            e.preventDefault();


            axios.get("{{ route('web.venta.pago.verificarPedido') }}")
            .then( response => {
                const data = response.data;

                if ($metodoPago == 'pagoTarjeta'){
                    // $('#metodoPagoTarjeta').submit();
                    cardForm.submit();
                }

                if ($metodoPago == 'pagoEfectivo'){
                    enviarPagoEfectivo();
                }

                if ($metodoPago == 'pagoIzipay'){
                    KR.submit();
                }

                if ($metodoPago == 'pagoDepositoBancario'){
                    enviarPagoDepositoBancario();
                }




            })
            .catch(error => {
                const response = error.response;
                const data = response.data;

                if (response.status == 400 ){

                    if(data.codigo == "F001"){
                        for (let item of data.error){
                            toast("error",item,'',30000);
                        }


                    }

                    if(data.codigo == "F002"){
                        toast("error",data.error,'',30000);
                        toast("error","La pagina se recargara en 5s.",'',5000);

                        setTimeout(_ => {
                            location.reload()
                        },5000)

                    }

                    return false;

                }

                toast("error","Error del servidor, contácte con soporte.");


            })



        })
    }

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

    $(document).ready(function () {
        actionSoloWeb();
        validacionAdicionalesFormtarjeta();
        actionBotons();
        pagar();
        getResumenPedido();

        $('.soloNumeros').on('keypress',validarSoloNumeros);

        //blquear el envio a izipay
        /* KR.onSubmit(function (e){
            return false;
        }) */
    })


</script>




@endpush
