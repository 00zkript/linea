@extends('web.template.index')
@section('titulo','MI CARRITO')
@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="MI CARRITO | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="MI CARRITO | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection
@push('css')
    <style>
        .img-carrito-compras-pag{
            width: 100px;
            padding: 10px;
        }
    </style>
@endpush
@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-bag-shopping"></i>Inicio</a></li>
                <li><a href="javascript:void(0);">Su carrito</a></li>
            </ul>
        </div>
    </section>

    <div class="container mt-md-5 mt-4 mb-4">
        <div class="row align-items-start" id="contenidoCarro">
            @include('web.carro.listado')
        </div>
    </div>
@endsection
@push('js')
    <script >
        const listadoAjaxCarrito = () => {

            $('body').waitMe(waitMeEffectBounce);

            return axios.post("{{ route('web.carrito-de-compras.listadoAjax') }}")
                .then( response => {
                    const data = response.data;

                    $("#contenidoCarro").html(data);
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;

                    console.log(data);
                })
                .then( _ => {
                    stop();
                })

        }
    </script>

    <script type="module">
        const getProvincias = ({ iddepartamento }) => {
            $("#idprovincia option").not(':first').remove();
            $("#iddistrito option").not(':first').remove();

            return axios.post("{{ route('web.carrito-de-compras.getProvincia') }}",{ iddepartamento : iddepartamento })
                .then( response => {
                    const data = response.data;

                    for (let val of data){
                        $("#idprovincia").append('<option value="'+val.idprovincia+'" >'+val.nombre+'</option>');
                    }

                })
                .catch( errorCatch );
        }

        const getDistritos = ({ idprovincia }) => {
            $("#iddistrito option").not(':first').remove();

            return axios.post("{{ route('web.carrito-de-compras.changeProvincia') }}", { idprovincia : idprovincia })
                .then( response => {
                    const data = response.data;

                    for (let val of data){
                        $("#iddistrito").append('<option value="'+val.iddistrito+'" >'+val.nombre+'</option>');
                    }
                })
                .catch( errorCatch );
        }

        const actionsUbigeo = () => {
            $(document).on("change","#iddepartamento",function (e) {
                e.preventDefault();
                let iddepartamento = $(this).val();
                getProvincias({ iddepartamento })
            });

            $(document).on("change","#idprovincia",function (e) {
                e.preventDefault();
                let idprovincia = $(this).val();
                getDistritos({ idprovincia })

            })

            $(document).on("change","#iddistrito",function (e) {
                e.preventDefault();
                let iddepartamento = $("#iddepartamento").val();
                let idprovincia = $("#idprovincia").val();
                let iddistrito = $("#iddistrito").val();

                if (empty(iddepartamento)){
                    toast("error","Seleccione un departamento");
                    return;
                }

                if (empty(idprovincia)){
                    toast("error","Seleccione una provincia");
                    return;
                }

                if (empty(iddistrito)){
                    toast("error","Seleccione un distrito");
                    return;
                }

                axios.post("{{ route('web.carrito-de-compras.calcularCostoEnvio') }}", {
                    iddepartamento:iddepartamento,
                    idprovincia:idprovincia,
                    iddistrito:iddistrito
                })
                    .then( response => {
                        const data = response.data;

                        if (data.length <= 0){
                            toast("info","No hay metodos de envio para esta ubicación.");
                            return false;
                        }

                        listadoResumenPagoCarrito();

                    })
                    .catch( errorCatch )
                    .then( _ => {
                    })

            })
        }


        const aplicarCostoEnvio = () => {

            $(document).on("change",".chckCostoEnvio",function (e) {
                e.preventDefault();
                let idcosto_envio = $(this).val();

                axios.post("{{ route('web.carrito-de-compras.aplicarCostoEnvio') }}", { idcosto_envio : idcosto_envio })
                .then( response => {
                    const data = response.data;
                    toast("success",data.mensaje)
                    listadoAjaxCarrito();
                })
                .catch( errorCatch )



            })

            $(document).on('click','#pasarAPagar',function (e) {
                const contenido = document.querySelector('.costoEnvioDiv').innerHTML.trim()
                const costoSeleccionado = document.querySelector('input[name=idcosto_envio]:checked');

                if( !empty(contenido) && costoSeleccionado === null ){
                    e.preventDefault();
                    toast('error','Para continuar debe seleccionar una tarifa de envio.')
                    return;
                }


            })

        }


        const listadoResumenPagoCarrito = () => {

            $('body').waitMe(waitMeEffectBounce);

            axios.post("{{ route('web.carrito-de-compras.resumenPagoCarrito') }}")
                .then( response => {
                    const data = response.data;

                    $(".resumenPagoCarrito").html(data);
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;

                    console.log(data);
                })
                .then( _ => {
                    stop();
                })

        }


        const aplicarCupon = () => {
            $(document).on("click","#btnAplicarCupon",function (e) {
                e.preventDefault();
                let codigo = $("#codigo").val();

                if (!codigo){
                    toast('error',"Ingrese el código del cupón");
                    return false;
                }

                $("#btnAplicarCupon").prop("disabled",true);
                axios.post("{{ route('web.carrito-de-compras.aplicarCupon') }}", { codigo : codigo })
                .then( response => {
                    const data = response.data;
                    toast("success",data.mensaje)
                    listadoAjaxCarrito();
                })
                .catch( errorCatch )
                .then( _ => {
                    $("#btnAplicarCupon").prop("disabled",false);

                })



            })
        }

        const removerCupon = () => {
            $(document).on("click","#btnRemoverCupon",function (e) {
                e.preventDefault();

                $("#btnRemoverCupon").prop("disabled",true);
                axios.post("{{ route('web.carrito-de-compras.removerCupon') }}")
                .then( response => {
                    const data = response.data;
                    toast("success",data.mensaje)
                    listadoAjaxCarrito();
                })
                .catch( errorCatch )
                .then( _ => {
                    $("#btnRemoverCupon").prop("disabled",false);
                })


            })
        }


        const eliminarProductoCarrito = () => {
            $(document).on("click",".btnElimarProductoCarrito",function (e) {
                e.preventDefault();
                let boton = $(this);
                let idcarrito = $(this).data("idcarrito");

                boton.prop('disabled',true);

                axios.post("{{ route('web.carrito-de-compras.destroy','destroy') }}", { idcarrito:idcarrito, _method : 'DELETE' })
                .then( response => {
                    const data = response.data;
                    toast("success",data.mensaje)
                    $(".cantidadGlobalCarrito").text(data.cantidadProductos);
                    $("#contenido-carrito").html(data.miniaturaCarrito);

                })
                .catch( errorCatch )
                .then( _ => {
                    boton.prop('disabled',false);
                    listadoAjaxCarrito();
                })



            })

        }


        const changeQuantity = (idcarrito, idproducto, cantidad) => {

            $('body').waitMe(waitMeEffectBounce);
            axios.put("{{ route('web.carrito-de-compras.update','update') }}", {
                idcarrito: idcarrito,
                idproducto: idproducto,
                cantidad: cantidad,
            })
            .then( response => {
                const data = response.data;

                toast("success",data.mensaje)
                $(".cantidadGlobalCarrito").text(data.cantidadProductos);
                $("#contenido-carrito").html(data.miniaturaCarrito);
                listadoAjaxCarrito();

            })
            .catch( errorCatch )
            .then( _ => {
                stop();
            })


        }

        const changeQuantityProduct = () => {

            $(document).on('click','.spinner .btn:first-of-type', function() {
                const idcarrito = $(this).data("idcarrito");
                const idproducto = $(this).data("idproducto");
                const valorActual = $(this).closest('.spinner').find('input').val();

                let cantidad = parseInt(valorActual, 10) + 1;
                // $(this).closest('.spinner').find('input').val(cantidad);

                changeQuantity(idcarrito, idproducto, cantidad);

            });

            $(document).on('click','.spinner .btn:last-of-type', function() {
                const idcarrito   = $(this).data("idcarrito");
                const idproducto  = $(this).data("idproducto");
                const valorActual = $(this).closest('.spinner').find('input').val();

                if (valorActual <= 1){
                    return false;
                }

                let cantidad = parseInt(valorActual, 10) - 1
                // $(this).closest('.spinner').find('input').val( cantidad );

                changeQuantity(idcarrito, idproducto, cantidad);


            });

            $(document).on("input",".cantidadProductoCarrito",function (e) {
                e.preventDefault();
                const idcarrito = $(this).data("idcarrito");
                const idproducto = $(this).data("idproducto");
                const cantidadPrev = $(this).data('value_back');
                const cantidad = $(this).val();

                if (cantidad <= 0){
                    toast("error","La cantida minima es 1.");
                    $(this).val(cantidadPrev);
                    return false;
                }

                setTimeout(()=> {
                    changeQuantity(idcarrito, idproducto, cantidad);
                },500)
            });



        }


        $(function () {
            actionsUbigeo();
            aplicarCostoEnvio();

            changeQuantityProduct();
            eliminarProductoCarrito();

            aplicarCupon();
            removerCupon();


        });

    </script>
@endpush
