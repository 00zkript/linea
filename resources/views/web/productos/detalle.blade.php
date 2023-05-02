@extends("web.template.index")
@section('titulo',Str::upper($producto->nombre))

@section('meta')

    <!-- compartir redes -->
    <meta property="og:locale" content="es_ES" />
    <meta property="og:image" content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}"/>
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="628">
    <meta property="og:image:type" content="image/jpeg">
    <meta property="og:type" content="website" />
    <meta property="og:title" content="{{ Str::upper($producto->nombre) }} | {{ $seoGeneral->titulo_general }}"/>
    <meta property="og:description" content="{{ $seoGeneral->descripcion }}"/>
    <meta property="og:url" content="{{ request()->url() }}"/>
    <meta property="og:site_name" content="{{ $seoGeneral->titulo_general }}"/>
    <meta name="twitter:card" content="summary" />
    <meta name="twitter:description" content="{{ $seoGeneral->descripcion }}" />
    <meta name="twitter:title" content="{{ Str::upper($producto->nombre) }} | {{ $seoGeneral->titulo_general }}" />
    <meta name="twitter:site" content="{{ "@".$seoGeneral->titulo_general }}"/>
    <meta name="twitter:creator" content="{{ "@".$seoGeneral->titulo_general }}" />
    <meta name=”twitter:image” content="{{ asset('panel/img/seo/'.$seoGeneral->imagen_compartir ) }}">
    <!-- fin compartir redes -->

@endsection

@push('css')
    <link href="{{ asset('web/zoom/magiczoom.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('web/zoom/magicscroll.core.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('web/zoom/magicscroll.default.css') }}" rel="stylesheet" type="text/css"/>
    <!-- ZOOM DE IMAGEN -->
    <style>
        .app-figure {
            margin: 0px auto;
            border: 0px solid red;
            padding: 2px;
            position: relative;
            text-align: center;
        }
        #Zoom-1 {
            max-height: 500px !important;
        }
        .selectors {
            margin-top: 10px;
        }
        .selectors .mz-thumb img {
            max-height: 70px;
            padding: 4px;
            -webkit-transition: all 0.5s ease;
            -moz-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;
            -o-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }
        body div div div#zoom-fig a#Zoom-1 > .mz-figure > img {
            width: auto !important;
        }
        .MagicZoom > img, .mz-figure > img {
            height: auto;
            max-height: 500px !important;
            max-width: 100% !important;
        }
        @media (max-width: 767px) and (min-width: 529px) {
            .selectors .mz-thumb img {
                max-width: 120px;
            }
        }
    </style>
@endpush
@section("contenido")
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-basket-shopping-simple"></i>Inicio</a></li>
                <li><a href="{{ route('web.productos') }}">Productos</a></li>
                @if(!empty($categoria))
                    @if(count($parentsCategoria) > 0)
                        @foreach($parentsCategoria as $catParent)
                            <li><a href="{{ route('web.productos.categoria',$catParent->slug_categoria) }}"> {{ $catParent->nombre}}</a></li>
                        @endforeach
                    @endif
                    <li><a href="{{ route('web.productos.categoria',$categoria->slug_categoria) }}">{{ $categoria->nombre}}</a></li>
                @else
                    <li><a href="{{ route('web.productos.categoria',"0-sin-categoria") }}">Sin categoria</a></li>
                @endif
                <li><a href="javascript:void(0);" title="{{ $producto->nombre }}"> {{ $producto->nombre_recortado }}</a></li>
            </ul>
        </div>
    </section>

    <section class="container mt-5 mb-md-6 mb-4">
        <div class="row">
            <div class="col-md-12">
                <div class="row align-items-start">
                    <div class="col-md-6 sticky-top">
                        <div class="app-figure" id="zoom-fig">
                            <a id="Zoom-1" class="MagicZoom" href="{{ asset($producto->path_imagen) }}">
                                <img src="{{ asset($producto->path_imagen) }}"/>
                            </a>


                            @if(count($producto->imagenes) > 1)
                                <!-- mas imagenes en el zoom -->
                                <div class="selectors MagicScroll" data-options="items:5;">
                                    @foreach($producto->imagenes AS $img)
                                        <a data-zoom-id="Zoom-1" href="{{ asset('panel/img/producto/'.$img->nombre) }}">
                                            <img srcset="{{ asset('panel/img/producto/'.$img->nombre) }}" src="{{ asset('panel/img/producto/'.$img->nombre) }}"/>
                                        </a>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-md-6">
                        @if($producto->stock > 0 && $producto->liquidacion)
                            <div class="tooldiv mb-4">
                                <aside>
                                    <h4 class="m-0 fw-bold text-white">PRODUCTO EN OFERTA</h4>
                                    <h5 class="m-0">Quedan {{ $producto->stock }} en oferta</h5>
                                </aside>
                                <span></span>
                            </div>
                        @endif

                        <h2 class="fw-bold mb-1">{{ $producto->nombre}}</h2>

                        <p class="text-muted">
                            <b>
                                <a href="{{ route('web.productos.marca',$producto->marca->idmarca.'-'.$producto->marca->slug) }}"> {{ $producto->marca->nombre }}</a>
                            </b>

                            {!! $producto->codigo ? '&nbsp;&nbsp;|&nbsp;&nbsp;Código: '.$producto->codigo : '' !!}
                        </p>

                        @empty(!$producto->descripcion_corta)
                            <aside class="textos mt-1">
                                {!! $producto->descripcion_corta !!}
                                <a href="#tabs">ver más</a>
                            </aside>
                        @endempty

                        @if($producto->stock > 0)
                            <hr>
                            @if($producto->show_precio)
                                <div class="dividido">
                                    <h1 class="mb-0 mt-1">
                                        @if($producto->precio_promocional > 0)
                                            <span class="dscto p-dscto">{{ $monedaGeneral->format($producto->precio * $monedaGeneral->cambio,2,".","") }}</span>
                                            <span class="precio p-price">{{ $monedaGeneral->format($producto->precio_promocional * $monedaGeneral->cambio,2,".","") }}</span>
                                        @else
                                            <span class="precio p-price">{{ $monedaGeneral->format($producto->precio * $monedaGeneral->cambio,2,".","") }}</span>
                                        @endif
                                    </h1>
                                </div>


                                <p class="mt-3 d-flex align-items-center">
                                    <i class="fa-regular fa-circle-check pe-2" style="font-size: 18px;"></i> Disponible {{ $producto->stock }} unidades
                                </p>

                                {{--<!-- <p class="mt-3 d-flex align-items-center">
                                    <i class="fa-regular fa-truck-fast pe-2" style="font-size: 18px;"></i> Delivery de 1 a 10 días.
                                </p> -->--}}


                                <div class="content-options">
                                </div>


                                <div class="mt-4">
                                    <div class="input-group spinner sin-padding">
                                        <input type="text" id="cantidadProductos" class="form-control px-1" value="1" min="1" max="{{ $producto->stock }}" step="1" style="font-size: 18px;border-radius: 4px;">
                                        <div class="input-group-btn-vertical">
                                            <button class="btn btn-default aument" type="button" data-s="mas" style="background: #676767;color: #fff;"><i class="fa-solid fa-plus"></i></button>
                                            <button class="btn btn-default aument mb-0" type="button" data-s="menos" style="background: #bcbcbc;color: #fff;"><i class="fa-solid fa-minus"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-4 d-md-flex align-items-center">
                                    <button type="button" data-idproducto="{{ $producto->idproducto}}" class="btn btn-primary px-3 fw-bold mb-md-0 mb-3 w-xs-100" id="btnAgregarProductoCarrito" data-bs-toggle="tooltip" data-bs-placement="top" title="Agregar al carrito" style="height: 50px;margin-right: 10px;">
                                        <span class="fa-solid fa-cart-shopping"></span> AÑADIR AL CARRITO
                                    </button>
                                    <a class="btn btn-success px-3 fw-bold w-xs-100" href="{{ route('web.asesor') }}?url_producto={{ route('web.productos.detalle',$producto->slug_producto ) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Consultar con un asesor" style="height: 50px;margin: 0 10px 0 0;line-height: 2.3;">
                                        <span class="fa-brands fa-whatsapp"></span> WHATSAPP - <i class="fa-solid fa-paper-plane"></i> TELEGRAM
                                    </a>
                                </div>
                            @else
                                <div class="mt-4 d-md-flex align-items-center">
                                    <a class="btn btn-success px-3 fw-bold w-xs-100" href="{{ route('web.asesor') }}?url_producto={{ route('web.productos.detalle',$producto->slug_producto ) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Consultar con un asesor" style="height: 50px;margin: 0 10px 0 0;line-height: 2.3;">
                                        <span class="fa-brands fa-whatsapp"></span> WHATSAPP - <i class="fa-solid fa-paper-plane"></i> TELEGRAM
                                    </a>
                                </div>
                            @endif

                        @else
                            <div class="dividido mt-1" style="color: #cdcdcd;">
                                <h1 class="mb-0 mt-0">
                                    <span>PRODUCTO AGOTADO</span>
                                </h1>
                            </div>
                        @endif
                        <hr>
                        <div class="row align-items-center">
                            <div class="col-md-6 col-6">
                                <h4>Compartir:</h4>
                                <a class="btn-redes btn-whatsapp2 mt-1" href="https://api.whatsapp.com/send?text={{request()->fullUrl()}}" target="_blank"><span class="fa-brands fa-whatsapp"></span></a>
                                <a class="btn-redes btn-facebook mt-1" href="https://www.facebook.com/sharer/sharer.php?u={{request()->fullUrl()}}" target="_blank"><span class="fa-brands fa-facebook-f"></span></a>
                                <a class="btn-redes btn-twitter mt-1" href="http://twitter.com/intent/tweet?text={{$producto->nombre}} {{request()->fullUrl()}}" target="_blank"><span class="fa-brands fa-twitter"></span></a>
                                <a class="btn-redes btn-linkedin mt-1" href="https://www.linkedin.com/shareArticle?mini=true&amp;url={{request()->fullUrl()}}&amp;title={{$producto->nombre}}&amp;summary={{$producto->nombre}}&amp;source={{$producto->nombre}}" target="_blank"><span class="fa-brands fa-linkedin-in"></span></a>
                            </div>
                            <div class="col-md-6 col-6">
                                <div style="display: flex;align-items: center;justify-content: flex-end">
                                {{--<!-- <a href="javascript:void(0)" class="btn btn-outline-dark px-3 d-flex align-items-center" alt="Comparar productos" data-bs-toggle="tooltip" data-bs-placement="top" title="Comparar productos" data-idproducto="{{ $producto->idproducto}}" style="height: 50px;margin: 0 10px 0 0;"><span class="bi bi-shuffle"></span></a> -->--}}

                                <a href="javascript:void(0)" class="btn btn-outline-dark px-3 d-flex align-items-center favorito {{ in_array($producto->idproducto,$favoritos) ? 'active' : '' }}" alt="{{ in_array($producto->idproducto,$favoritos) ? 'Tu favorito' : 'Añadir a favoritos' }}" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ in_array($producto->idproducto,$favoritos) ? 'Tu favorito' : 'Añadir a favoritos' }}" data-idproducto="{{ $producto->idproducto}}" style="height: 50px;"><span class="fa-light fa-heart"></span></a>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-md-5 mt-4">
            <div class="col-lg-12">
                <div class="tabulador wow fadeInUp" data-wow-duration="2s" data-wow-delay="0s">
                    <ul id="tabs">
                        <li id="current"><a href="javascript:void(0);" title="tab1"><b>DESCRIPCIÓN</b></a></li>
                        <li><a href="javascript:void(0);" title="tab2"><b>VIDEO</b></a></li>
                        <li><a href="javascript:void(0);" title="tab3"><b>MANUALES</b></a></li>
                        <li><a href="javascript:void(0);" title="tab4"><b>FICHA TÉCNICA </b></a></li>
                    </ul>
                    <div id="content" class="scroll tab_bg">
                        <article id="tab1" style="display: block;">
                            <div class="tab-t1">
                                @if(!empty($producto->descripcion))
                                    {!! html_entity_decode($producto->descripcion) !!}
                                @else
                                    <h4 class="fw-bold text-center">DESCRIPCIÓN NO DISPONIBLE</h4>
                                @endif
                            </div>
                        </article>
                        <article id="tab2" style="display: none;">
                            <div class="tab-t1">
                                <div>
                                    @if(!empty($producto->video))
                                        <div class="cajadevideo">
                                            <div class="videomp4">
                                                {!! html_entity_decode($producto->video) !!}
                                            </div>
                                        </div>
                                    @else
                                        <h4 class="fw-bold text-center">VIDEO NO DISPONIBLE</h4>
                                    @endif
                                </div>
                            </div>
                        </article>
                        <article id="tab3" style="display: none;">
                            <div class="tab-t1">
                                <div>
                                    @if(count($manuales) > 0)
                                        @foreach ($manuales as $m)
                                            <a class="btn btn-primary px-3 py-3 mb-4 mx-1" href="{{ asset('panel/img/manuales/'.$m->nombre) }}" target="_blank" download=""><i class="fa fa-download"></i> DESCARGAR MANUAL {{ $loop->iteration}}</a>
                                        @endforeach
                                    @else
                                        <h4 class="fw-bold text-center">MANUALES NO DISPONIBLES</h4>
                                    @endif
                                </div>
                            </div>
                        </article>
                        <article id="tab4" style="display: block;">
                            <div class="tab-t1">
                                <div>
                                @empty(!$producto->ficha_tecnica)
                                    {!! html_entity_decode($producto->ficha_tecnica) !!}
                                @else
                                    <h4 class="fw-bold text-center">FICHA TÉCNICA NO DISPONIBLE</h4>
                                @endempty
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container">
        @if(count($productosRelacionados) > 0)

            <div class="titulos justify-content-center p-md-4"><h4 class="me-0 ms-auto fs-4">Productos Relacionados</h4></div>

            <div class="slider mt-4 flechas-blancas padding-carru slider-productos" id="slick2">
                @foreach($productosRelacionados AS $productoRelacionado)
                    <div class="item">
                        @include('web.productos.partes.itemProducto',["producto" => $productoRelacionado])
                    </div>
                @endforeach

            </div>
        @endif
    </section>
@endsection
@push('js')
    <script type="module">
        var mzOptions = {
            hint: "always",
            variableZoom: true,
            expand: "window",
            'zoom-width': 350,
            'zoom-height': 350
        };
    </script>

    <script src="{{ asset('web/zoom/magiczoom.js') }}" type="text/javascript"></script>
    <script src="{{ asset('web/zoom/magicscroll.js') }}" type="text/javascript"></script>

    <script>(function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.0";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>

    <script type="module">
        const moneyFormat = "{{ $monedaGeneral->format('0.00') }}";

        @if( $producto->precio_promocional > 0 )

        const dsctoGeneral = "{{ number_format($producto->precio * $monedaGeneral->cambio,2,".","") }}";
        const priceGeneral = "{{ number_format($producto->precio_promocional * $monedaGeneral->cambio,2,".","") }}";

        @else

        const dsctoGeneral = 0
        const priceGeneral = "{{ number_format($producto->precio * $monedaGeneral->cambio,2,".","") }}";

        @endif

        const btn = document.querySelector('#btnAgregarProductoCarrito');
        const tallaSelected = document.querySelector('#talla-selected');
        const tallaUnselected = document.querySelector('#talla-unselected');
        const htmlPrice = document.querySelectorAll('.p-price');
        const htmlDscto = document.querySelectorAll('.p-dscto');
        const htmlStock = document.querySelectorAll('.p-stock');

        const actionsToActivateButton = () => {
            // example
            document.querySelector('.content-options').addEventListener('click', (e) => {
                const el = e.target;

                if (el.classList.contains('p-radio')) {
                    const radioChecked = document.querySelector('input[name=talla]:checked');

                    if (!radioChecked) {
                        tallaUnselected.style.display = 'block';
                        tallaSelected.style.display = 'none';
                        btn.disabled = true;
                        return;
                    }

                    const stock = radioChecked.dataset.stock;
                    const price = radioChecked.dataset.price;
                    const equivalence = radioChecked.dataset.equivalence;
                    const priceFinal = parseFloat(priceGeneral) + parseFloat(price);
                    const priceFinalFormatted = moneyFormat.repalce('0.00',priceFinal.toFixed(2));

                    tallaSelected.style.display = 'block';
                    tallaUnselected.style.display = 'none';

                    tallaSelected.querySelector('#p-talla-selected').innerHTML = radioChecked.parentNode.innerText;
                    tallaSelected.querySelector('#p-equivalence').innerHTML = equivalence;


                    htmlStock.forEach(el => {
                        el.innerHTML = stock;
                    });

                    htmlPrice.forEach(el => {
                        el.innerHTML = priceFinalFormatted;
                    });

                    if ( htmlDscto.length > 0 ) {
                        const priceFinalDscto = parseFloat(dsctoGeneral) + parseFloat(price);
                        const priceFinalDsctoFormatted = moneyFormat.replace('0.00',priceFinalDscto.toFixed(2));

                        htmlDscto.forEach(el => {
                            el.innerHTML = priceFinalDsctoFormatted;
                        });
                    }

                    btn.disabled = false;




                }
            })

        }


        const agregarProductoCarrito = () => {
            $(document).on("click", "#btnAgregarProductoCarrito", function (e) {
                e.preventDefault();
                let idproducto = $(this).data("idproducto");
                let cantidad = $("#cantidadProductos").val();


                $("#btnAgregarProductoCarrito").prop('disabled', true);

                axios({
                    url : "{{ route('web.carrito-de-compras.store') }}",
                    method : 'POST',
                    data : {
                        idproducto: idproducto,
                        cantidad: cantidad,
                    }
                })
                    .then( response => {
                        const data = response.data;

                        toast("success",data.mensaje);
                        $(".cantidadGlobalCarrito").text(data.cantidadProductos);
                        $("#contenido-carrito").html(data.miniaturaCarrito);
                    })
                    .catch( error => {
                        const response = error.response;
                        const data = response.data;

                        if (response.status === 422) {
                            toast("error", listErrors(data.errors) );
                            return false;
                        }

                        if (response.status === 400) {
                            toast("error",data.mensaje);
                            return false;
                        }

                        toast("error","Ocurrió un error interno.");

                    })
                    .then( _ => {
                        $("#btnAgregarProductoCarrito").prop('disabled', false);
                    })


            })
        }

        const agregarProductoCarritoRelacionados = () => {
            $(document).on("click", ".agregarCarritoGlobal", function (e) {
                e.preventDefault();
                let botton = $(this);
                let idproducto = $(this).data("idproducto");
                let cantidad = 1;

                botton.prop('disabled', true);
                axios.post('{{ route('web.carrito-de-compras.store') }}',{
                    idproducto: idproducto,
                    cantidad: cantidad
                })
                    .then( response => {
                        const data = response.data;

                        toast("success",data.mensaje);
                        $(".cantidadGlobalCarrito").text(data.cantidadProductos);
                        $("#contenido-carrito").html(data.miniaturaCarrito);
                    })
                    .catch( error => {
                        const response = error.response;
                        const data = response.data;

                        if (response.status === 422) {
                            toast("error", listErrors(data.errors) );
                            return false;
                        }

                        if (response.status === 400) {
                            toast("error",data.mensaje);
                            return false;
                        }

                        toast("error","Ocurrió un error interno.");

                    })
                    .then( _ => {
                        botton.prop('disabled', false);
                    })


            })
        }

        const actionsChangeQuantity = () => {
            $('.spinner .btn:first-of-type').on('click', function () {
                $('.spinner input').val(parseInt($('.spinner input').val(), 10) + 1);
            });

            $('.spinner .btn:last-of-type').on('click', function () {
                if ($('.spinner input').val() >= 2) {
                    $('.spinner input').val(parseInt($('.spinner input').val(), 10) - 1);
                }

            });
        }

        $(function () {
            actionsToActivateButton();
            actionsChangeQuantity();
            agregarProductoCarrito();
            agregarProductoCarritoRelacionados();


            optionSelected.select.validate = optionSelects.length == 0 ;
            optionSelected.radio.validate = optionRadioGroups.length == 0 ;


        });
    </script>
@endpush
