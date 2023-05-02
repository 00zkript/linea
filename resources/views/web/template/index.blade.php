<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@php( $v = time() )
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" id="token" content="{{ csrf_token() }}">

    @if( app()->isLocal() )
        <meta name="robots" content="noindex" />
        <meta name="googlebot" content="noindex" />
    @endif

    <title>@yield('titulo','Bienvenido') | {{ $seoGeneral->titulo_general}}</title>
    <link rel="”canonical”" href="{{ url('/') }}">
    <meta name="author" content="{{ $seoGeneral->autor }}"/>
    <meta name="description" content="{{ $seoGeneral->descripcion }}"/>
    <meta name="keywords" content="{{ $seoGeneral->keywords }}"/>
    @yield('meta')
    <!-- Cambiar color de navegador movil -->
    <meta name="theme-color" content="#f5f5f5"/>
    <meta name="msapplication-navbutton-color" content="#f5f5f5"/>
    <meta name="apple-mobile-web-app-capable" content="yes"/>
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <!-- fin cambiar color de navegador movil -->

    <link rel="shortcut icon" href="{{ asset( $empresaGeneral->favicon ? 'panel/img/empresa/'.$empresaGeneral->favicon : 'panel/default/favicon.jpg') }}">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="{{ asset( $empresaGeneral->favicon ? 'panel/img/empresa/'.$empresaGeneral->favicon : 'panel/default/favicon.jpg') }}">



    <link rel="stylesheet" type="text/css" href="{{ asset('web/fonts/iconos.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/fonts/icont.css?v='.$v) }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('web/bootstrap-5/css/bootstrap.min.css?v='.$v) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/bootstrap-5/css/bootstrap-grid.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/bootstrap-5/css/bootstrap-reboot.min.css?v='.$v) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('web/bootstrap-5/css/bootstrap-utilities.min.css') }}">
    <link rel="stylesheet" href="https://icons.getbootstrap.com/assets/font/bootstrap-icons.css">

    <!-- Datepicker -->
    <link rel="stylesheet" href="{{ asset('web/bootstrap-datepicker-1.9.0/css/bootstrap-datepicker3.min.css') }}">


    <link href="{{ asset('web/css/animate.css?v='.$v) }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('web/css/style_general.css?v='.$v) }}">


    <!-- fontawesome -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.1.1/css/all.css">


    <script src="{{ asset('generales/jquery/jquery-3.0.0.min.js') }}"></script>
    <script src="{{ asset('generales/jquery/jquery-ui.js') }}"></script>

    <!-- slider slick -->
    <link rel="stylesheet" type="text/css" href="{{ asset('web/slick/hero-slick-slider.css?v='.$v) }}"/>
    <link rel="stylesheet" type="text/css" href="{{ asset('web/slick/slick.css') }}"/>

    <!-- fileinput -->
    <link href="{{ asset('panel/fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet">


    <link rel="stylesheet" type="text/css" href="{{ asset('generales/toast/toastr.min.css?v='.$v) }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('generales/waitMe/waitMe.css') }}">

    <!-- Rango precio -->
    <link href="{{ asset('web/rangos/jquery-ui.css?v='.$v) }}" rel="stylesheet">

    {!! $seoGeneral->googleAnalytics !!}
    {!! $seoGeneral->googleTagManager !!}
    {!! $seoGeneral->facebookPixel !!}

    @stack('css')
</head>
<body class="body">



    <div id="loader-wrapper">
        <div class="loaders">
            <div class="loader">
                <div class="loader-inner">
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>
            </div>
        </div>
        {{--<!-- <div class="spinner_load"></div> -->--}}
    </div>

    {{-- MODAL BUSCADOR --}}
        <div class="modal fade" id="modalBuscador" tabindex="-1" role="dialog" aria-labelledby="modalBuscador" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header justify-content-center">
                        <h2 class="modal-title fw-bold" id="modalBuscador">Buscar producto</h2>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal" role="form" id="formBuscarProductoModal">
                            <div class="input-group">
                                <input type="text"
                                    value="{{(isset($buscadorGlobal) && !empty($buscadorGlobal) ? $buscadorGlobal : '') }}"
                                    style="height: 45px;" name="buscadorGlobal" id="iptBuscadorProductoGlobalModal"
                                    placeholder="Escriba aquí" class="busca form-control">
                                <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit">&nbsp;<i class="fa fa-search"></i></button>
                                </span>
                            </div>
                            <div id="display2"></div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    {{-- MODAL BUSCADOR --}}

    {{-- MODAL NOTIFICAION A TODOS LOS USUARIO ACTIVOS EN LA WEB--}}
        <div id="modal-nuevo-producto" class="modal fade modal-home" tabindex="-1" role="dialog" style="display: none">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-cabecera">
                        <button type="button" class="close" data-bs-dismiss="modal">×</button>
                    </div>
                    <div class="modal-cuerpo">
                        <div class="row-flex2">
                            <div class="col-xs-12 padd-left padd-right text-center" >
                                <a id="enlace-producto-notificion" href="#" target="_blank" style="color: white!important;">
                                    <h1 >NUEVA OFERTA</h1>
                                    <p id="titulo-producto-notificion"></p>
                                    <img id="imagen-producto-notificion" src="" alt="imagen">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- MODAL NOTIFICAION A TODOS LOS USUARIO ACTIVOS EN LA WEB--}}

    {{-- TERMINOS Y CONDICIONES --}}
        <div data-keyboard="false" data-backdrop="static" tabindex="-1" class="modal fade" id="modalTerminosCondicionesGeneral" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header p-0 border-0">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="min-height: 500px">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p class="text-center font-weight-bold" style="font-size: 24px;margin-bottom: 40px;text-decoration: underline">
                                    TÉRMINOS Y CONDICIONES
                                </p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                {!! $terminosCondicionesGeneral->contenido !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- TERMINOS Y CONDICIONES --}}

    {{-- POLITICAS DE PRIVACIDAD --}}
        <div data-keyboard="false" data-backdrop="static" tabindex="-1" class="modal fade" id="modalPoliticaPrivacidadGeneral" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header p-0 border-0">
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body" style="min-height: 500px">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <p class="text-center font-weight-bold" style="font-size: 24px;margin-bottom: 40px;text-decoration: underline">
                                    POLÍTICAS DE PRIVACIDAD
                                </p>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                {!! $politicaPrivacidadGeneral->contenido !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    {{-- POLITICAS DE PRIVACIDAD --}}


    @include('web.template.header')
    @include('web.template.banner')

    @yield('contenido')

    @include('web.template.carruselMarcas')
    @include('web.template.suscribirte')
    @include('web.template.footer')
    @include('web.template.mensajeCookie')
    @include('web.template.whatsappChat')
    @include('web.template.popUp')


<!-- Bootstrap -->
<script src="{{ asset('web/bootstrap-5/js/bootstrap.bundle.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>


<script src="{{ asset('web/slick/slick.min.js?v='.$v) }}" type="text/javascript"></script>
<script src="{{ asset('web/js/myscript.js?v='.$v) }}"></script>
<script src="{{ asset('web/js/wow.js') }}"></script>



<!--fileinput-->
<script src="{{ asset('panel/fileinput/js/fileinput.min.js') }}"></script>
<script src="{{ asset('panel/fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('panel/fileinput/js/locales/es.js') }}"></script>
<script src="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.js') }}"></script>
<script src="{{ asset('panel/fileinput/themes/fa/theme.min.js') }}"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script src="{{ asset('generales/toast/toastr.min.js?v='.$v) }}"></script>
<script src="{{ asset('generales/waitMe/waitMe.js') }}"></script>
<script src="{{ asset('generales/js/funciones.js') }}"></script>
<script src="{{ asset('generales/js/SocialShare.js') }}"></script>
<script src="{{ asset('generales/js/axios.min.js') }}"></script>

<!-- datepicker -->
<script src="{{ asset('web/bootstrap-datepicker-1.9.0/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('web/bootstrap-datepicker-1.9.0/locales/bootstrap-datepicker.es.min.js') }}"></script>

<!-- Scroll de página -->
<script src="{{ asset('web/scroll/count-to.js') }}" type="text/javascript"></script>
<script src="{{ asset('web/scroll/jquery.appear.js') }}" type="text/javascript"></script>
<!-- <script src="{{ asset('web/scroll/script.js') }}" type="text/javascript"></script> -->
{{-- <script src="{{ asset('web/scroll/jquery.nicescroll.min.js') }}" type="text/javascript"></script> --}}
<!-- Fin Scroll de página -->

{{-- CONFIGURACIÓN--}}
<script >
    axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}' ;
    axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
        }
    });
    const errorCatch = ( error ) => {
        const response = error.response;
        const data = response.data;
        let mensaje = '';
        stop();

        if (response.status == 422){
            toast("error",listErrors(data),"Errores :");
        }

        if (response.status == 500){
            toast("error","Error del servidor, contácte con soporte.");
        }


        if (response.status == 419){
            toast("error","Error del servidor, contácte con soporte.");
        }

        if (response.status == 400){
            mensaje = data.mensaje
            toast("error",mensaje);
        }
        console.log(data);
        return false;
    }
</script>
{{-- CONFIGURACIÓN--}}



<script type="module">
    const pusher = () => {
        //Pusher.logToConsole = true;
        var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
            cluster: '{{ env('PUSHER_APP_CLUSTER') }}',
        });

        let channel = pusher.subscribe('canal.usuarios.web');
        channel.bind('evento.notificacion.nuevo.producto', function(data) {

            $("#enlace-producto-notificion").attr('href',data.url);
            $("#titulo-producto-notificion").text(data.nombre)
            $("#imagen-producto-notificion").attr('src',data.imagen);
            $("#modal-nuevo-producto").modal('show');
        });
    }

    const date_conf = () => {
        let today = new Date();
        let date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
        let time = today.getHours() + ":" + today.getMinutes();
        let dateTime = date+' '+time;
        $("#datepickerEntrega").datepicker({
            language: "es",
            todayBtn: "linked",
            clearBtn: false,
            format: "dd/mm/yyyy",
            multidate: false,
            todayHighlight: false,
            startDate: dateTime
        });
        $("#datepickerRecojo").datepicker({
            language: "es",
            todayBtn: "linked",
            clearBtn: false,
            format: "dd/mm/yyyy",
            multidate: false,
            todayHighlight: false,
            startDate: dateTime
        });
    }

    const ancho_conf = () => {
        let winancho = $(window).width();
        if (winancho > 767) {
            setTimeout(function () {
                let anchoprod = $('.contenido-prod').outerWidth();
                $(".contenido-prod").each(function (i) {
                    // let artprod = $(this).children('article');
                    $(this).css('width', '' + anchoprod + 'px');
                    $(this).children("article").css('width', '' + anchoprod + 'px');
                });
            }, 1500);
        }
        // $('.contenido-prod article').css('width',''+anchoprod+'px');
    }

    /*Tooltips*/
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    const tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    /*Popover*/
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    const popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl)
    })

    $(document).ready(function () {
        pusher();
        date_conf();
        ancho_conf();
    });
</script>

<script type="module">
    const efectosCarritos = () => {
        $('body').click(function (e) {
            const $info = $('#contenido-carrito');
            if (!$info.is(e.target) && $info.has(e.target).length === 0) {
                $info.hide();
                $('#mostrarContenidoCarrito').attr('value', 0);
                $('.div-carrito').removeClass("active");
            }
            $("#display").hide();
            $("#display2").hide();
        });

        /* efecto carrito de compra */
        $("#carrito-item").click(function () {
            event.stopPropagation();
            const estado = $('#mostrarContenidoCarrito').attr('value');
            if (estado == 0) {
                $('#contenido-carrito').show();
                $('#mostrarContenidoCarrito').attr('value', 1);
                $('.div-carrito').addClass("active");
            } else {
                $('#contenido-carrito').hide();
                $('#mostrarContenidoCarrito').attr('value', 0);
                $('.div-carrito').removeClass("active");
            }
        });
    }

    const buscadorProductoGlobal = () => {
        $("#iptBuscadorProductoGlobal").on("keyup", function (e) {
            e.preventDefault();
            let valor = $(this).val().trim();

            if (!valor) {
                $("#display").hide();
                return false;
            }
            $(".imgLoaderBuscadorGloblar").show();
            axios.post('{{ route('web.productos.buscadorGlobalAjax') }}',{ valor:valor})
            .then( response => {
                const data = response.data;

                $("#display").html(data)
            })
            .catch( error => {
                const response = error.response;
                const data = response.data;
                console.log(data);
            })
            .then( _ => {
                $(".imgLoaderBuscadorGloblar").hide();
                $("#display").show();
            })
        });

        $("#iptBuscadorProductoGlobalModal").on("keyup", function (e) {
            e.preventDefault();
            let valor = $(this).val().trim();

            if (!valor) {
                $("#display2").hide();
                return false;
            }
            $(".imgLoaderBuscadorGloblar").show();
            axios.post('{{ route('web.productos.buscadorGlobalAjax') }}',{ valor:valor})
                .then( response => {
                    const data = response.data;
                    $("#display2").html(data)
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;
                    console.log(data);
                })
                .then( _ => {
                    $("#display").show();
                })
        })

        $(document).on("submit", "#formBuscarProducto", function(e){
            e.preventDefault();
            const val = $("#iptBuscadorProductoGlobal").val().trim();
            location.href = "{{ route('web.productos.buscadorGlobal') }}/"+val;
        })

        $(document).on("submit", "#formBuscarProductoModal", function(e){
            e.preventDefault();
            const val = $("#iptBuscadorProductoGlobalModal").val().trim();
            location.href = "{{ route('web.productos.buscadorGlobal') }}/"+val;
        })
    }

    const agregarProductoCarritoGeneral = () => {
        $(document).on("click",".agregarCarritoGlobal",function (e) {
            e.preventDefault();
            let botton = $(this);
            let idproducto = $(this).data("idproducto");
            let cantidad = 1;

            axios.post('{{ route('web.carrito-de-compras.store') }}',{
                idproducto: idproducto,
                cantidad: cantidad
            })
            .then( response => {
                const data = response.data;

                let mensaje = data.mensaje;
                let cantidadProductos = data.cantidadProductos;
                let contenidoCarrito = data.miniaturaCarrito;

                toast("success",mensaje);
                $(".cantidadGlobalCarrito").text(cantidadProductos);
                $("#contenido-carrito").html(contenidoCarrito);

                @if( request()->routeIs(["web.carrito-de-compras.index"]) )
                    listadoAjaxCarrito();
                @endif

            })
            .catch( error => {
                const response = error.response;
                const data = response.data;

                if (response.status === 422) {
                    toast("error", listErrors(data.errors) )
                    return false;
                }

                if (data.status === 400) {
                    toast("error",data.mensaje);
                    return false
                }

                toast("error","Error", "Ocurrió un error al agregar este producto.");


            })
            .then( _ => {
                botton.prop('disabled', false);
            })


        })
    }

    const eliminarProductoCarritoGeneral = () => {
        $(document).on("click", ".eliminarItemCarritoMiniatura", function (e) {
            e.preventDefault();
            let boton = $(this);
            let idcarrito = $(this).data("idcarrito");

            boton.prop('disabled', true);

            axios.post('{{ route('web.carrito-de-compras.destroy','destroy') }}',{
                idcarrito: idcarrito,
                _method: 'DELETE'
            })
            .then( response => {
                const data = response.data;

                toastr.success(data.mensaje);
                $(".cantidadGlobalCarrito").text(data.cantidadProductos);
                $("#contenido-carrito").html(data.miniaturaCarrito);

                @if( request()->routeIs(["web.carrito-de-compras.index"]) )
                    listadoAjaxCarrito();
                @endif
            })
            .catch( error => {
                const response = error.response;
                const data = response.data;
                toastr.error("Ocurrió un error al eliminar este producto.");
            })
            .then( _ => {
                boton.prop('disabled', false);
            })
        })
    }

    const agregarFavoritosGeneral = () => {
        $(document).on('click','.favorito',function(e) {
            e.preventDefault();
            const el = $(this);
            const producto = el.data('idproducto');

            let accion = "agregar";
            let URL_FAVORITO = "{{ route('web.favorito.agregar') }}";
            let mensajeError = "Error al agregar a favoritos.";

            if( el.hasClass('active') ){
                accion = "eliminar";
                URL_FAVORITO =  "{{ route('web.favorito.eliminar') }}";
                mensajeError = "Error al eliminar de favoritos.";

            }

            axios.post(URL_FAVORITO,{ idproducto : producto})
            .then(response => {
                const data = response.data;

                if (accion === "agregar"){
                    el.addClass('active');
                }else{
                    el.removeClass('active');
                }

                $('.countFavorito').html(data.count);
            })
            .catch(error => {
                    const response = error.response;
                    const data = response.data;

                    if (response.status == 500){
                        toast("error","Error del servidor, contácte con soporte.");
                    }

                    if (response.status == 400 ){
                        toast("error",mensajeError);
                    }

                })



        })
    }

    $(function () {
        efectosCarritos();
        buscadorProductoGlobal();
        agregarProductoCarritoGeneral();
        eliminarProductoCarritoGeneral();
        agregarFavoritosGeneral();
    });
</script>



@stack('js')

</body>
</html>
