<!Doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('panel/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/css/waitMe.min.css') }}">
    <link rel="stylesheet" href="{{ asset('panel/pnotify/PNotifyBrightTheme.css') }}">

    <style>
        [ui-pnotify].ui-pnotify.stack-bar-top {
            width: 100%;
        }
        .login-container{
            background-image: url("{{ asset('panel/img/modern-home-gym.jpg') }}");
            width: 100%;
            height: 100vh;
        }
        .border-radius-10{
            border-radius: 10px;
        }
    </style>

</head>
<body>
@include('panel.template.alertModal')

<div class="container-fluid login-container">
    <div class="row justify-content-around" >

        <div class="col-md-4 col-12" >

            <div class="card shadow mt-5 border-radius-10">
                <div class="card-body ml-4 mr-4">
                    <form id="frmLogin">
                        @csrf
                        <div class="row">

                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12 text-center" style="">
                                <img src="{{ asset($empresaGeneral->logo ? 'panel/img/empresa/'.$empresaGeneral->logo : 'panel/default/logo.png') }}" class="img-fluid" style="width: 300px">
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="usuario">Usuario:</label>
                                    <input name="usuario" id="usuario" type="text" required placeholder="Usuario" class="form-control">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="clave">Contraseña:</label>
                                    <input name="clave" id="clave" type="password" required placeholder="*******" class="form-control">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" id="recuerdame" name="recuerdame"  value="1">
                                    <label class="custom-control-label" for="recuerdame">Recuerdame</label>
                                </div>
                                <br>
                            </div>

                            <div class="col-12">
                                <button type="submit" class="btn btn-success btn-block"><i class="fa fa-sign-in"></i> INGRESAR</button>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="{{ asset('panel/js/jquery.min.js') }}"></script>
<script src="{{ asset('panel/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('panel/js/waitMe.min.js') }}"></script>
<script src="{{ asset('panel/pnotify/PNotify.js') }}"></script>
<script src="{{ asset('panel/pnotify/PNotifyButtons.js') }}"></script>
<script src="{{ asset('generales/js/funciones.js') }}"></script>


<script !src="">
    $(function () {

        verificarLogin();
    });



    var verificarLogin = () => {
        $("#frmLogin").on("submit",(e)=>{
            e.preventDefault();
            $.ajax({
                url:'{{ route("panel.login.verificar") }}',
                method:'POST',
                dataType:'json',
                data: new FormData($("#frmLogin")[0]),
                cache:false,
                contentType:false,
                processData:false,
                beforeSend:function () {
                    cargando();
                },
                success:function (data) {

                    if (!data.error){
                        $("#frmLogin button[type=submit]").prop('disabled',true);
                        notificacion('success','Exito',data.mensaje);
                        setTimeout(function () {
                            cargando('Redirigiendo...');
                            window.location.href = '{{ route('inicio.index') }}';
                        },2000);

                    }else{
                        notificacion('error','Error',data.mensaje);
                    }

                },
                error:function (data) {

                    if(data.status === 422){

                        var errors = data.responseJSON.errors;
                        var listErrors = '<ul>';

                        $.each(errors,function (index,value) {
                            listErrors += '<li>'+value[0]+'</li>';
                        })
                        listErrors += '</ul>';

                        notificacion('error','Error',listErrors);

                    }else{
                        notificacion('error','Error',data.responseJSON);
                    }


                },
                complete:function () {
                    stop();
                }
            });
        });
    }

</script>
</body>
</html>
