<section class="fondo-suscribete pt-md-5 pt-4 pb-md-5 pb-4">
    <div class="container-fluid ps-md-5 pe-md-5">
        <div class="row">
            <div class="col-md-12 pb-4 wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.5s">
                <h2 class="text-center fw-light">Suscríbete a nuestra newsletter y consigue un 10% de descuento en tu primera compra</h2>
            </div>
        </div>
        <form onsubmit="return false;" id="frmSuscribeteFooterGeneral">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-12 text-start wow fadeInLeft" data-wow-duration="1s" data-wow-delay="0.5s">
                    <h3 class="fw-bold m-0">SUSCRÍBETE A LA NEWSLETTER:</h3>
                </div>
                <div class="col-lg-7 col-md-6 col-12 pt-md-0 pt-2 pe-md-0 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                    <input type="email" name="correoSus" id="correoSus" required placeholder="Introduzca una dirección de correo electrónico" class="form-control input-sus">
                </div>
                <div class="col-lg-2 col-md-3 col-12 pt-md-0 pt-2 wow fadeInRight" data-wow-duration="1s" data-wow-delay="0.5s">
                    <button type="submit" class="btn btn-dark w-100 m-0 rounded btn-sus">Enviar  <span class="fas fa-paper-plane"></span></button>
                </div>
                <div class="col-md-7 col-12 pt-md-3 pt-2 offset-md-3">
                    <div class="checkbox">
                        <input type="checkbox" name="datos_consignadosGeneral" id="datos_consignadosGeneral">
                        <label for="datos_consignadosGeneral">He leído y acepto la <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalPoliticaPrivacidadGeneral" >Políticas de Privacidad</a>.</label>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

@push('js')
    <script type="module">
        const suscribeteGeneral = () => {
            $("#frmSuscribeteFooterGeneral").on("submit", function (e) {
                e.preventDefault();
                // toastr.success("Gracias por suscribirte, te enviaremos noticias de todas nuestras ofertas.");
                // $(this)[0].reset();

                if (!document.querySelector('#datosConsignadosGeneral').checked){
                    toast("error","Debe aceptar haber leido las politicas de privacidad.");
                    return false;
                }

                $('input[type="submit"]',this).attr('disabled','disabled');



                const form = new FormData($(this)[0]);

                axios.post("{{ route('web.suscripcion.enviar') }}",form)
                    .then(response => {
                        const data = response.data;

                        // toast("success","Se envió correctamente la solicitud de contacto.");
                        toast("success","Gracias por suscribirte, te enviaremos noticias de todas nuestras ofertas.");
                        $("#frmSuscribeteFooterGeneral")[0].reset();


                    })
                    .catch(errorCatch)
                    .then( _ => {
                        $('input[type="submit"]',this).removeAttr('disabled');
                    })


            });
        }

        $(document).ready(function () {
            suscribeteGeneral();
        })
    </script>
@endpush
