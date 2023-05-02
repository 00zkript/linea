<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" id="token" content="{{csrf_token() }}">
    <title>CMS - {{ $empresaGeneral->nombre }}</title>
{{--    <link rel="shortcut icon" href="{{ asset('panel/img/favicon.png') }}">--}}
    <link rel="shortcut icon" href="{{ asset($empresaGeneral->favicon ? 'panel/img/empresa/'.$empresaGeneral->favicon : 'panel/default/favicon.jpg') }}">

    <link href="{{ asset('panel/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('generales/font-awesome/6.1.2/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/pnotify/PNotifyBrightTheme.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('generales/waitMe/waitMe.min.css') }}" rel="stylesheet">

    <style>
        [ui-pnotify].ui-pnotify.stack-bar-top {
            width: 100%;
        }

        .page-item.active .page-link {
            z-index: 1;
            color: #fff;
            background-color: #2a3f54;
            border-color: #2a3f54;
        }

        .page-link {
            position: relative;
            display: block;
            padding: .5rem .75rem;
            margin-left: -1px;
            line-height: 1.25;
            color:#2a3f54;
            background-color: #fff;
            border: 1px solid #dee2e6;
        }
        @media (min-width: 992px) {
            .modal-xl {
                max-width: 100%;
                margin-left: 1%;
                margin-right: 1%;
            }
        }

        #modalVer .modal-body .row .col-12 p:first-child {
            font-weight: bold;
            font-size: 11pt;
        }

    </style>

    @stack('css')

</head>
<body class="nav-md">

    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a target="_blank" href="{{ url('/') }}" class="site_title"><i class="fa fa-shopping-cart"></i> <span>{{ $empresaGeneral->nombre }}</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <div class="profile clearfix">
                        <div class="profile_pic">
                            @if(empty(auth()->user()->foto))
                                <img src="{{ asset('panel/default/foto_defecto.jpg') }}" alt="..." class="img-circle profile_img">
                            @else
                                <img src="{{ asset('panel/img/usuarios/'.auth()->user()->foto) }}" alt="..." class="img-circle profile_img">
                            @endif

                        </div>
                        <div class="profile_info">
                            <span>Bienvenido,</span>
                            <h2>{{ auth()->user()->usuario }}</h2>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <br/>

                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li class="d-none">
                                    <a href="{{ route('inicio.index') }}"><i class="fa fa-home"></i> Inicio</a>
                                </li>

                                <li class="d-none">
                                    <a><i class="fa fa-lock"></i> Seguridad <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            <a href="{{ route('usuario.index') }}">Usuarios</a>
                                        </li>

                                    </ul>
                                </li>

                                <li class="d-none"><a><i class="fa fa-shopping-cart"></i> Catálogo <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li ><a href="{{ route('marcas.index') }}">Marcas</a></li>
                                        <li><a href="{{ route('categorias.index') }}">Categorias</a></li>
                                        <li ><a href="{{ route('section.index') }}">Secciones</a></li>
                                        <li><a href="{{ route('atributo.index') }}">Atributos</a></li>
                                        <li><a href="{{ route('productos.index') }}">Productos</a></li>
                                    </ul>
                                </li>

                                <li class="d-none"><a><i class="fa fa-money-check-dollar"></i> Ventas o pedidos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li ><a href="{{ route('cliente.index') }}">Clientes</a></li>
                                        <li ><a href="{{ route('ventas.index') }}">Ventas</a></li>
                                        <li><a href="{{ route('cupon.index') }}">Cupones</a></li>
                                        <li><a href="{{ route('costo-envio.index') }}">Costo de envío</a></li>
                                    </ul>
                                </li>

                                <li class="d-none"><a><i class="fa fa-file"></i> Pagina de Inicio <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li ><a href="{{ route('section-home.index') }}">Secciones Home</a></li>
                                    </ul>
                                </li>


                                <li class="d-none"><a><i class="fa fa-tasks"></i> General <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('menu.index') }}">Menú</a></li>
                                        <li><a href="{{ route('empresa.index') }}">Empresa</a></li>
                                        <li><a href="{{ route('seo.index') }}">SEO</a></li>
                                        <li><a href="{{ route('contacto.index') }}">Contacto</a></li>
                                        <li><a href="{{ route('moneda.index') }}">Moneda</a></li>
                                        <li><a href="{{ route('terminos-condiciones.index') }}">Términos y condicones</a></li>
                                        <li><a href="{{ route('politicas-privacidad.index') }}">Políticas de privacidad</a></li>
                                        <li style="display: none"><a href="{{ route('puntoVentas.index') }}">Puntos de venta</a></li>
                                    </ul>
                                </li>

                                <li class="d-none"><a><i class="fa fa-file-circle-plus"></i> Paginas <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li ><a href="{{ route('asesores.index') }}">Asesores</a></li>
                                        <li><a href="{{ route('pagina.index') }}">Página</a></li>
                                        <li><a href="{{ route('instagram.index') }}">instagram</a></li>
                                        <li><a href="{{ route('testimonio.index') }}">Testimonios</a></li>
                                        <li><a href="{{ route('preguntas-frecuentes.index') }}">Preguntas frecuentes</a></li>
                                    </ul>
                                </li>

                                <li class="d-none"><a><i class="fa fa-image"></i> Banners - Popups<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('banner.index') }}">Banners</a></li>
                                        <li><a href="{{ route('popup.index') }}">Popups</a></li>
                                    </ul>
                                </li>


                                <li class="d-none"><a><i class="fa fa-globe"></i> Noticias <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('blogCategoria.index') }}">Blog Categoria</a></li>
                                        <li><a href="{{ route('blog.index') }}">Blog</a></li>
                                    </ul>
                                </li>


                                <li class="d-none"><a><i class="fa fa-people-group"></i> Marketing <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('suscripcion.index') }}">Lista de suscripciones</a></li>
                                    </ul>
                                </li>

                                <li class="d-none"><a><i class="fa fa-file-text"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('reporteVentas.index') }}">Ventas</a></li>
                                    </ul>
                                </li>

                            </ul>
                        </div>

                    </div>


                    <div class="sidebar-footer hidden-small">

                        <a class="w-100" data-toggle="tooltip" data-placement="top" title="Cerrar sesión" href="{{ route('panel.login.salir') }}">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>

                </div>
            </div>

            <div class="top_nav">
                <div class="nav_menu">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>
                    <nav class="nav navbar-nav">
                        <ul class=" navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                                id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                                    @if(empty(auth()->user()->foto))
                                        <img src="{{ asset('panel/default/foto_defecto.jpg') }}" alt="">{{ auth()->user()->usuario }}
                                    @else
                                        <img src="{{ asset('panel/img/usuarios/'.auth()->user()->foto) }}" alt="">{{ auth()->user()->usuario }}
                                    @endif

                                </a>
                                <div class="dropdown-menu dropdown-usermenu float-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('configuracion.edit') }}">
                                        <i class="fa fa-cogs float-right"></i> Configuracion
                                    </a>
                                    <a class="dropdown-item" href="{{ route('panel.login.salir') }}">
                                        <i class="fa fa-sign-out float-right"></i> Cerrar sesión
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>


            <div class="right_col" role="main">
                @yield('cuerpo')
            </div>


            <footer>
                <div class="float-right">
                    System - CMS Admin by <a target="_blank" href="https://dezain.com.pe/">Dezain Estudio</a>
                </div>
                <div class="clearfix"></div>
            </footer>

        </div>
    </div>









    <script src="{{ asset('panel/js/jquery.min.js') }}"></script>
    <script src="{{ asset('panel/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('panel/js/fastclick.js') }}"></script>
    <script src="{{ asset('panel/js/nprogress.js') }}"></script>
    <script src="{{ asset('panel/js/bootstrap-progressbar.min.js') }}"></script>
    {{--<script src="{{ asset('panel/js/custom.min.js') }}"></script>--}}
    <script src="{{ asset('panel/js/sidebar.js') }}"></script>
    <script src="{{ asset('panel/pnotify/PNotify.js') }}"></script>
    <script src="{{ asset('panel/pnotify/PNotifyButtons.js') }}"></script>
    <script src="{{ asset('panel/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('panel/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('panel/fileinput/js/locales/es.js') }}"></script>
    <script src="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.js') }}"></script>
    <script src="{{ asset('panel/fileinput/themes/fa/theme.min.js') }}"></script>
    <script src="{{ asset('panel/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('panel/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('panel/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('panel/js/bootstrap-datepicker.es.min.js') }}"></script>
    <script src="{{ asset('generales/js/axios.min.js') }}"></script>
    <script id="axios-settings">
        axios.defaults.headers.common['X-CSRF-TOKEN'] = '{{ csrf_token() }}' ;
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
    </script>
    <script src="{{ asset('generales/waitMe/waitMe.min.js') }}"></script>
    <script src="{{ asset('generales/js/jquery.mask.js') }}"></script>
    <script src="{{ asset('generales/js/funciones.js') }}"></script>

    @include('ckfinder::setup')


    <script id="settings">
        CKEDITOR.config.language = 'es';
        CKEDITOR.config.uiColor  = '#4C82ED';
        CKEDITOR.config.filebrowserBrowseUrl = "{{ route('ckfinder_browser') }}";
        CKEDITOR.config.filebrowserUploadUrl =  "{{ route('ckfinder_connector') }}";
        CKEDITOR.config.autoParagraph = false;
        CKEDITOR.config.enterMode  = 1;
        CKEDITOR.config.allowedContent = true;
        CKEDITOR.config.extraPlugins ='html5video,widget,widgetselection,clipboard,lineutils';
        /* CKEDITOR.config.contentsCss   = [
            "{{ asset('web/css/style_general.css') }}" ,
            "{{ asset('generales/font-awesome/6.1.2/css/all.min.css') }}",
            "https://icons.getbootstrap.com/assets/font/bootstrap-icons.css",
        ]; */

        CKFinder.setupCKEditor();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
            }
        });

        //File input set dafault
        const fileinputSetting = $.fn.fileinput.defaults;

        fileinputSetting.theme                 = 'fa';
        fileinputSetting.language              = 'es';
        fileinputSetting.uploadAsync           = false;
        fileinputSetting.showUpload            = false;
        fileinputSetting.allowedFileTypes      = ["image"];
        // fileinputSetting.allowedFileExtensions = ['jpg', 'png', 'jpeg','gif','webp','tiff','tif','svg','bmp','mp4']
        fileinputSetting.overwriteInitial      = false;
        fileinputSetting.initialPreviewAsData  = true;
        fileinputSetting.removeFromPreviewOnError  = true;
        fileinputSetting.fileActionSettings    = { showRemove  : false, showUpload  : false, showZoom    : true, showDrag    : false};
        // fileinputSetting.uploadUrl            = "URL de subida",
        // fileinputSetting.uploadExtraData      = false,
        // fileinputSetting.deleteUrl            = "URL de eliminacion",
        // fileinputSetting.deleteExtraData      = false;

        $.fn.fileinput.defaults = fileinputSetting;

        const BASE_URL = "{{ url('/') }}";

        $(function () {
            $("div .modal").removeAttr("tabindex");
        });


        const errorCatch = ( error ) => {

            if ( error.response === undefined) {
                console.error(error);
                return;
            }

            const response = error.response;
            const data = response.data;
            let mensaje = '';
            stop();


            if (response.status == 422){
                notificacion("error","Error",listErrors(data));

            }

            if (response.status == 500){
                notificacion("error","Error","Error del servidor, contácte con soporte.");
            }


            if (response.status == 419){
                notificacion("error","Error","Error del servidor, contácte con soporte.");
            }

            if (response.status == 400){
                mensaje = data.mensaje
                notificacion("error","Error",mensaje);

            }

            console.log(data);
            return false;


        }


    </script>

    @stack('js')

</body>
</html>
