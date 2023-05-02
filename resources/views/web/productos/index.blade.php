@extends("web.template.index")

@section('titulo',Str::upper($titulo))

@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ Str::upper($titulo) }} | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="{{ Str::upper($titulo) }} | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection

@push('css')
@endpush


@section("contenido")
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-basket-shopping-simple"></i>Inicio</a></li>

                @if( !request()->routeIs(['web.productos'])  )
                    <li><a href="{{ route('web.productos') }}">PRODUCTOS</a></li>
                @endif

                @if(count($parentsCategoria ?? []) > 0)
                    @foreach($parentsCategoria as $catParent)
                        <li><a href="{{ route('web.productos.categoria',$catParent->slug_categoria) }}"> {{ $catParent->nombre}}</a></li>
                    @endforeach
                @endif

                <li><a href="javascript:void(0);"> {{ $titulo }}</a></li>
            </ul>
        </div>
    </section>

    <div class="container mt-md-5 mt-4 mb-md-6 mb-4">
        <div class="row">

            <div class="col-md-12">

                    <div class="row">
                        <div class="col-lg-3 col-md-4 col-12">
                            @include('web.productos.partes.menuIzquierdo')
                        </div>

                        <div class="col-lg-9 col-md-8 col-12">
                            <div id="listado">

                            </div>
                        </div>

                    </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    <!-- Rango de precios -->
    <script type="module">
        const moneyFormat = "{{ $monedaGeneral->format('0.00') }}";
        const monedaCambio = "{{ $monedaGeneral->cambio }}";


        $(function() {

            $( "#slider-range" ).slider({
              range: true,
              min: 0,
              max: 5000*monedaCambio,
              values: [ 0 * monedaCambio, 2500 * monedaCambio ],
              slide: function( event, ui ) {
                  const minSilder = moneyFormat.replace('0.00', ui.values[ 0 ]) ;
                  const maxSilder = moneyFormat.replace('0.00', ui.values[ 1 ]) ;

                $( "#amount" ).val(  minSilder +" - "+ maxSilder );
              }
            });

            const minSilder = moneyFormat.replace('0.00', $( "#slider-range" ).slider( "values", 0 )) ;
            const maxSilder = moneyFormat.replace('0.00', $( "#slider-range" ).slider( "values", 1 )) ;

            $( "#amount" ).val( minSilder +" - "+ maxSilder );

        });
    </script>
    <!-- fin Rango de precios -->

    <!-- Filtros mobil -->
    <script type="module">

        const dataFiltros = {
            buscadorGlobal : "{{ $buscadorGlobal ?? null }}",
            marca : "{{ $marca->idmarca ?? null }}",
            section: "{{ $section->idsection ?? null }}",
            categoria: "{{ $categoria->idcategoria ?? null }}",
            slugAtributo : "{{ $atributo->slug ?? null }}",
            slugValor : "{{ $valor->slug ?? null }}",
            paginaActual : 1,
            rangoPrecio : '',
            presentacion: 'grilla',
            cantidadRegistros: 15,
            orden : 'ultimos-productos',
        }

        const filtros = () => {

            $(document).on("click", "a.page-link", (e) => {
                e.preventDefault();
                const url = e.target.href;
                const paginaActual = url.split("?pagina=")[1];

                dataFiltros.paginaActual = paginaActual;

                listado();
            });

            $(document).on("change", "#orderProductos", function (e) {
                e.preventDefault();

                dataFiltros.orden = $(this).val();
                listado();
            });


            $(document).on('click', '.btnCambiarPrensentacion', function(e) {
                e.preventDefault();
                let valor = $(this).data('valor');

                dataFiltros.presentacion = valor;
                listado();

            });

            $(document).on('click', '.cantidadRegistros', function(e) {
                e.preventDefault();
                let valor = $(this).data('val');

                dataFiltros.cantidadRegistros = valor;
                listado();

            });

            $(document).on('click', '.aplicarRangoPrecio', function(e) {
                e.preventDefault();
                const valor = $("#amount").val().replace(/[^\d+\-]/g,"");
                const rango = valor.split("-");
                const min = number_format(rango[0] > 0 ? (rango[0] / monedaCambio) : 0,2,".","");
                const max = number_format(rango[1] > 0 ? (rango[1] / monedaCambio) : 0,2,".","");

                dataFiltros.rangoPrecio = min + "-" + max;
                listado();

            });

        }

        const listado = () => {

            $('#listado').waitMe(waitMeEffectBounce);
            axios.post('{{ route('web.productos.listadoProductosAjax') }}',dataFiltros)
            .then( response => {
                const data = response.data;
                $("#listado").html(data);
                var winWidth = $(window).width();
                if (winWidth > 991) {
                    var targetOffset = $("#listado").offset().top-140;
                    $("html, body").animate({scrollTop: targetOffset}, 600);
                }
                if (winWidth < 991) {
                    var targetOffset = $("#listado").offset().top-128;
                    $("html, body").animate({scrollTop: targetOffset}, 600);
                }
            })
            .catch( error => {
                const response = error.response;
                const data = response.data;

                if (response.status == 419){
                    listado();
                }

                if( response.status == 500){
                    const $msje = data.toString().replace(/\s+/g,"").replace("}{","},{").split(",")[0];
                    try {
                        $val = JSON.parse($msje);
                        if ($val.message == "ServerError"){
                            listado();

                        }
                    }catch (e){

                    }

                }

            })
            .then( _ => {
                stop();
                var winancho = $(window).width();
                if (winancho > 767) {
                    var anchoprod = $('.contenido-prod').outerWidth();
                    $(".contenido-prod").each(function (i) {
                        $(this).css('width', '' + anchoprod + 'px');
                        $(this).children("article").css('width', '' + anchoprod + 'px');
                    });
                }
            })


        }

        const agregarProductoCarrito = () => {
            $(document).on("click", ".btnAgregarProductoCarrito", function (e) {
                e.preventDefault();
                let boton = $(this);
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
                    boton.prop('disabled', false);
                })


            })
        }

        const changeQty = () => {
            $(document).on('click', '#btn-menu-left', function(e) {
                e.preventDefault();
                $('#menu-left').addClass("active");
            });

            $(document).on('click', '.btn-ocultarmenu', function(e) {
                e.preventDefault();
                $('#menu-left').removeClass("active");
            });
        }




        $(function () {

            listado();
            filtros();
            changeQty();
            agregarProductoCarrito();




        });

    </script>
@endpush
