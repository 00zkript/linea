<section class="fondo-cockies" style="display:block;">
    <div class="container pt-4 pb-4">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <p class="mb-md-0 mb-4 text-white">Al hacer clic en “Aceptar todas las cookies”, usted acepta que las cookies se guarden en su dispositivo para mejorar la navegación del sitio, analizar el uso del mismo, y colaborar con nuestros estudios para marketing.</p>
            </div>
            <div class="col-lg-6 col-md-6 text-md-end text-center">
{{--                <button class="btn btn-outline-white px-3 py-3 mb-lg-0 mb-2">Configuración de cookies</button>--}}
                <button class="btn btn-primary px-3 py-3 btnAceptarCookies">Aceptar todas las cookies</button>
            </div>
        </div>
    </div>
</section>


@push('js')
    <script type="module">
        const aceptarCookies = () => {
            document.querySelector('.btnAceptarCookies').addEventListener('click',function (e) {
                e.preventDefault();

                let cookie = localStorage.getItem('cookie')
                if (!cookie){
                    localStorage.setItem('cookie',1);
                }


                verificarCookie()


            })
        }

        const verificarCookie = () => {

            let cookie = localStorage.getItem('cookie')

            if (cookie){
                document.querySelector('.fondo-cockies').style.display = "none";
            }else{
                document.querySelector('.fondo-cockies').style.display = "";
            }


        }

        document.addEventListener('DOMContentLoaded',function (){
            verificarCookie();
            aceptarCookies();
        })

    </script>
@endpush
