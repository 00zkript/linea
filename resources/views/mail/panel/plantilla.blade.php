<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{env('APP_NAME') }}</title>
    @include('mail.panel.style')

    @stack('css')
</head>


<body>
    <div class="body">
        <div class="container text-center pt-3 pb-3">
            <img src="{{ asset($empresaGeneral->logo ? 'panel/img/empresa/'.$empresaGeneral->logo : 'panel/default/logo.png') }}" alt="logo" class="loguito">
        </div>

    @yield('cuerpo')
        <div class="container">
            <div class="centrado col-lg-10 col-md-12 col-12 bg-dark text-white pt-4 pb-4">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-12 text-center">
                        <p class="mb-1">¿Dudas o consultas? Ingresa a nuestra web</p>
                        <p class="mb-4"><i><a href="{{ url('/') }}" target="_blank" class="mb-1 text-verde">{{ $empresaGeneral->nombre }}</a></i></p>
                        <p class="mb-1">Síguenos en nuestras redes:</p>
                        @empty(!$contactoGeneral->facebook)
                            <a href="{{ $contactoGeneral->facebook }}" target="_blank" class="p-2"><img src="{{ asset('web/imagenes/mail-facebook.png') }}" height="25"></a>
                        @endempty
                        @empty(!$contactoGeneral->twitter)
                            <a href="{{ $contactoGeneral->twitter }}" target="_blank" class="p-2"><img src="{{ asset('web/imagenes/mail-twitter.png') }}" height="25"></a>
                        @endempty
                        @empty(!$contactoGeneral->instagram)
                            <a href="{{ $contactoGeneral->instagram }}" target="_blank" class="p-2"><img src="{{ asset('web/imagenes/mail-instagram.png') }}" height="25"></a>
                        @endempty
                        @empty(!$contactoGeneral->youtube)
                            <a href="{{ $contactoGeneral->youtube }}" target="_blank" class="p-2"><img src="{{ asset('web/imagenes/mail-youtube.png') }}" height="25"></a>
                        @endempty
                        @empty(!$contactoGeneral->linkendin)
                            <a href="{{ $contactoGeneral->linkendin }}" target="_blank" class="p-2"><img src="{{ asset('web/imagenes/mail-linkedin.png') }}" height="25"></a>
                    @endempty
                        <!-- <p class="mb-1">© {{ now()->format('Y') }} {{ $empresaGeneral->nombre }} Todos los derechos reservados.</p> -->
                    </div>
                </div>
            </div>
        </div>
    @stack('js')
    </div>
</body>
</html>
