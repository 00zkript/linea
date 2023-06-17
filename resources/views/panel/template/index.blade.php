<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" id="token" content="{{csrf_token() }}">
    <title>CMS - {{ $empresaGeneral->nombre }}</title>
    {{-- <link rel="shortcut icon" href="{{ asset('panel/img/favicon.png') }}"> --}}
    <link rel="shortcut icon" href="{{ asset($empresaGeneral->favicon ? 'panel/img/empresa/'.$empresaGeneral->favicon : 'panel/default/favicon.jpg') }}">

    <link href="{{ asset('panel/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('generales/font-awesome/6.1.2/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/nprogress.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/bootstrap-progressbar-3.3.4.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/custom.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/pnotify/PNotifyBrightTheme.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('generales/toast/toastr.css') }}">
    <link href="{{ asset('panel/fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet">
    <link href="{{ asset('generales/waitMe/waitMe.min.css') }}" rel="stylesheet">

    <style>
        /* [ui-pnotify].ui-pnotify.stack-bar-top {
            width: 100%;
        } */
        [ui-pnotify].ui-pnotify .brighttheme.ui-pnotify-container{
            width: 100% !important;
        }
        [ui-pnotify].ui-pnotify .brighttheme-error {
            background: #f8d7da;
        }
        .ui-pnotify-text{
            word-break: break-word;
        }
        .ui-pnotify-text {
            margin: 0 !important;
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


        .ui-pnotify-container{
            border-radius: 0.75rem !important;
        }

        .main_menu_side{
            overflow-y: auto;
            height: 90%;
        }
        .nav-midium {
            color: #fff;
        }
        .nav.navbar-nav{
            flex-direction: row;
            flex-wrap: nowrap;
            justify-content: flex-end;
            align-items: center;
        }

    </style>

    @stack('css')

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @routes
</head>
<body class="nav-md">

    @include('panel.arqueoCaja.abrirCaja')
    @include('panel.template.alertModal')


    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">
                    <div class="navbar nav_title" style="border: 0;">
                        <a target="_blank" href="{{ url('/') }}" class="site_title"><i class="fa fa-shopping-cart"></i> <span>{{ $empresaGeneral->nombre }}</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <div class="profile clearfix mb-3">
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


                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li class=""><a href="{{ route('inicio.index') }}"><i class="fa fa-home"></i> Inicio</a></li>

                                <li class=""><a><i class="fa fa-lock"></i> Seguridad <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li>
                                            @can('usuario.manage')
                                                <li><a href="{{ route('usuario.index') }}">Usuarios</a></li>
                                            @endcan
                                            @can('rol.manage')
                                                <li><a href="javascript:void(0);">Roles</a></li>
                                            @endcan
                                            {{-- <li><a href="{{ route('empleado.index') }}">Empleado</a></li> --}}
                                        </li>
                                    </ul>
                                </li>

                                <li class=""><a><i class="fa fa-warehouse"></i> Programas <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="javascript:void(0);">Temporada</a></li>
                                        <li><a href="javascript:void(0);">Programas</a></li>
                                        <li><a href="javascript:void(0);">Piscinas</a></li>
                                        <li><a href="javascript:void(0);">Carriles</a></li>
                                        <li><a href="javascript:void(0);">Dias de actividad</a></li>
                                        <li><a href="javascript:void(0);">Cantidad de sesiones</a></li>
                                        {{-- <li><a href="{{ route('productos.index') }}">Productos</a></li> --}}
                                    </ul>
                                </li>


                                <li class=""><a><i class="fa fa-address-card"></i> Matriculas <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('cliente.index') }}">Alumno</a></li>
                                        <li><a href="{{ route('matricula.create') }}">Nueva matrícula</a></li>
                                        <li><a href="{{ route('matricula.index') }}">Matrículas</a></li>
                                        {{-- <li><a href="{{ route('matriculaGym.create') }}">Nueva inscripción GyM</a></li> --}}
                                        {{-- <li><a href="{{ route('matriculaGym.index') }}">Inscripciones GyM</a></li> --}}
                                    </ul>
                                </li>

                                <li class=""><a><i class="fa fa-money-bill"></i> Caja <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('pago.create') }}">Nueva venta</a></li>
                                        <li><a href="{{ route('pago.index') }}">Pago Matricula</a></li>
                                    </ul>
                                </li>


                                <li class=""><a><i class="fa fa-cash-register"></i> Arqueo de caja y cambio <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="javascript:void(0);" data-toggle="modal" data-target="#abrirArqueoCajaModalCenter" >Abrir Caja</a></li>
                                        <li><a href="{{ route('arqueoCaja.cerrar') }}">Cerrar caja</a></li>
                                        <li><a href="{{ route('arqueoCaja.reportePdf') }}">Reporte Arqueo</a></li>
                                        <li><a href="{{ route('historialCambio.index') }}" >Historial de camnio de moneda</a></li>
                                        <li><a href="{{ route('arqueoCajaOperacion.create') }}">Crear operaciones</a></li>
                                        <li><a href="{{ route('arqueoCajaOperacion.index') }}">Operaciones lista</a></li>
                                    </ul>
                                </li>

                                <li class=""><a><i class="fa fa-sliders"></i> General <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('empresa.index') }}">Empresa</a></li>
                                        <li><a href="{{ route('moneda.index') }}">Moneda</a></li>
                                    </ul>
                                </li>



                                {{-- <li class=""><a><i class="fa fa-money-check-dollar"></i> Ventas o pedidos <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('cupon.index') }}">Cupones</a></li>
                                    </ul>


                                {{-- <li class=""><a><i class="fa fa-file-text"></i> Reportes <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="{{ route('reporteVentas.index') }}">Ventas</a></li>
                                    </ul>
                                </li> --}}

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


                    <nav class="nav navbar-nav w-25">
                        <div class="nav-midium mt-2">
                            <h6>{{ auth()->user()->sucursal->nombre }}</h6>
                        </div>

                        <ul class="navbar-right">
                            <li class="nav-item dropdown open" style="padding-left: 15px;">
                                <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
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

    <script src="{{ asset('generales/toast/toastr.min.js') }}"></script>
    <script src="{{ asset('generales/js/jquery.mask.js') }}"></script>
    <script src="{{ asset('generales/js/funciones.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>

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
            stop();


            if (response.status == 422){
                notificacion("error","Error",listErrors(data));

            }

            if (response.status == 500 || response.status == 419){
                notificacion("error","Error","Error del servidor, contácte con soporte.");
            }

            if (response.status == 400){
                notificacion("error","Error",data.mensaje);
            }

            console.log(data);
            return false;


        }


    </script>



    @stack('js')

</body>
</html>
