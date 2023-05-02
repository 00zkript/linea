@extends('mail.web.plantilla')
@push('css')
@endpush

@section('cuerpo')
    <div class="container">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 px-4" style="background: #23b4b7;">
            <div class="row">
                <div class="col-lg-12 text-white text-center">
                    <h2 class="fw-bold text-white">Tu cuenta a sido creada con éxito</h2>
                </div>
            </div>
        </div>
    </div>

    <div class="container text-center">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 bg-white px-3">
            <h5>¡Bienvenido(a), {{ $usuario->cliente->nombres }}!</h5>
            <p class="mb-0">Estamos felices de que ahora seas parte de nuestra familia.</p>
            <p>Para que en un futuro sea más fácil visitarnos, te enviamos los accesos a tu cuenta:</p>
            <br>
            

            <table border="0" class="tabla">
                <tbody>
                    <tr>
                        <td><b>Usuario: </b></td>
                        <td>{{ $usuario->correo }}</td>
                    </tr>
                    <tr>
                        <td><b>Contraseña: </b></td>
                        <td>{{ decrypt($usuario->clave) }}</td>
                    </tr>
                </tbody>
            </table>

            
            <p class="mt-5">Te recomedamos modificar tu contraseña y otros datos de tu perfil en el siguiente enlace:</p>
            <p><a href="{{ route('web.usuario.index') }}" class="btn btn-dark">Click aquí</a></p>

            <p>Que tengas un buen día {{ $usuario->cliente->nombres }}, recuerda no compartir esta información con nadie.</p>
            <p class="mb-0">&nbsp;&nbsp;</p>
        </div>
    </div>
@endsection

@push('js')
@endpush
