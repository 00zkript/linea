@extends("web.template.index")

@section('titulo',Str::upper($titulo) )

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

    <style>
        .listFiltros ul{
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            padding: 0;

        }
        .listFiltros ul li{
            list-style-type: none;
            margin-left: 0;
            margin-right: .5em;
            margin-top: .5em;
            border-radius: .4em;
        }
        .listFiltros ul button{
            background-color: #ffcd01;
            border-radius: .4em;
            border: 1px solid #ffcd01;
            color: #ffffff;
        }

        .listFiltros ul li:hover,button:hover{
            background: #000 !important;
            border: 1px solid #000 !important;
            color: #ffffff !important;
        }

        @media( max-width: 767px ){
            .listFiltros ul{
                /* margin-top: 1em; */
            }

        }

    </style>
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

    <div class="container mt-lg-4 mt-md-5 mt-4 mb-md-6 mb-4">
        <div class="row">

            <div class="col-md-12">

                <div class="row" id="contentProducts">
                    <div class="col-lg-12 col-md-12 col-12">
                        <section class="menu-left position-relative float-md-start" id="menu-left" style="z-index: 2;">
                            <i class="fa-solid fa-xmark btn-ocultarmenu p-2 hidden-lg hidden-md hidden-sm"></i>
                            <div class="menu-left-section">
                                <h4 class="fw-bold tit-menu-left d-md-inline-block mb-0">
                                    <span class="glyphicon glyphicon-tasks"></span>
                                    FILTROS:
                                </h4>
                                <div class="btn-group dropdown-hover ps-lg-4">
                                    <button type="button" class="btn dropdown-toggle d-flex" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" id="filtro1">
                                        <span class="sr-solo" id="seleccion">Nombre Filtro</span>
                                        <i class="fa-solid fa-sort-down ps-3"></i>
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="filtro1">
                                        <li class="filtro1-opcion active" data-value="" >-- Mostrar todos --</li>
                                        @foreach( $filtro1 ?? [] as $opcion)
                                            <li class="filtro1-opcion" data-value="{{ $opcion->slug }}" >{{ $opcion->valor }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </section>
                    </div>

                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="row align-items-center mb-md-5 mb-4 hidden-lg hidden-md mtd-md">
                            <div class="col-md-6 col-sm-8 col-7">
                                <h2 class="fw-bold mb-0">{{ $titulo }}</h2>
                            </div>
                            <div class="col-md-6 col-sm-4 col-5 text-end">
                                <h4 class="fw-bold mb-0"><span id="totalProducts">0</span> productos</h4>
                            </div>
                        </div>

                        <div class="row align-items-center justify-content-md-end">

                            <div class="hidden-lg hidden-md hidden-sm col-sm-4 col-6">
                                <h4 class="fw-bold mb-0" id="btn-menu-left"><i class="fa-solid fa-filter-list"></i> Filtrar</h4>
                            </div>

                            <div class="col-md-6 offset-md-6 col-sm-8 col-6 mtd-lg text-lg-end">
                                <div class="row align-items-center justify-content-md-end">
                                    <div class="col-12 p-md-0 text-end">
                                        <div class="btn-group btn-group-sm" role="group" aria-label="Opciones">
                                            <button type="button" class="btn btn-white py-2 px-3 me-0 btnCambiarPrensentacion filtro-prensentacion active" data-value="grilla">
                                                <i class="bi bi-grid-fill"></i>
                                            </button>
                                            <button type="button" class="btn btn-white py-2 px-3 btnCambiarPrensentacion filtro-prensentacion" data-value="lista">
                                                <i class="bi bi-grid-3x3-gap-fill"></i>
                                            </button>
                                        </div>
                                        <div class="btn-group dropdown-hover align-items-center ps-lg-4">
                                            <button type="button" class="btn dropdown-toggle d-flex" data-bs-toggle="dropdown" data-bs-auto-close="true" aria-expanded="false" id="filtroAtributo3">
                                                <span class="sr-solo">Ordenar <span class="hidden-xs">listado</span> por:</span>
                                                <i class="fa-solid fa-sort-down ps-3"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="filtroAtributo3">
                                                <li class="filtro-orden active" data-value="ultimos-productos">Lo más nuevo</li>
                                                <li class="filtro-orden" data-value="a-z" >Nombre de la A a la Z</li>
                                                <li class="filtro-orden" data-value="z-a" >Nombre de la Z a la A</li>
                                                <li class="filtro-orden" data-value="barato" >Precio de el más barato a caro</li>
                                                <li class="filtro-orden" data-value="caro" >Precio de el más caro a barato</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                    <div class="col-lg-12 col-md-12 col-12 listFiltros">
                        <ul >
                            <li>
                                <button class="btn btn-sm">
                                    <b>Color:</b>
                                    Marrón
                                    <i class="fa fa-close"></i>
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-sm">
                                    <b>Color:</b>
                                    Azul
                                    <i class="fa fa-close"></i>
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-sm">
                                    <b>Color:</b>
                                    Verde
                                    <i class="fa fa-close"></i>
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-sm">
                                    <b>Color:</b>
                                    Amarillo
                                    <i class="fa fa-close"></i>
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-sm">
                                    <b>Talla:</b>
                                    42
                                    <i class="fa fa-close"></i>
                                </button>
                            </li>
                        </ul>
                    </div>



                    <div class="col-lg-12 col-md-12 col-12">

                        <div id="listado" class="row justify-content-md-start justify-content-sm-center mt-4"></div>

                        <div id="preListado">
                            <div class="row justify-content-md-start justify-content-sm-center mt-4">
                                <div class="col-12 text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="module">

        let ultimoProducto;
        const dataFiltros = {
            paginaActual : 1,
            cantidadRegistros: 12,
            buscadorGlobal : "{{ $buscadorGlobal ?? '' }}",
            marca : "{{ $marca->idmarca ?? null }}",
            categoria : '{{ ($categoria ?? '') ? $categoria->idcategoria : '' }}',
            seccion : '{{ ($section ?? '') ? $section->idsection : '' }}',
            slugAtributo : "{{ $atributo->slug ?? null }}",
            slugValor : "{{ $valor->slug ?? null }}",
            filtro1: [],
            presentacion: 'grilla',
            orden : 'ultimos-productos',
        }

        const tags = {
            filtro1 : {
                name: 'Filtro 1',
                value: []
            },
        };



        let obeserver = new IntersectionObserver((entradas, observador) => {
            entradas.forEach( entrada => {
                if (entrada.isIntersecting){
                    dataFiltros.paginaActual++;
                    listProducts();
                }
            })
        },{
            'rootMargin' : '0px 0px 100px 0px',
            'threshold' : 1.0
        })
        const preListado = document.querySelector('#preListado');

        const listProducts = ({ refresh_list = false} = '') => {
            preListado.style.display = '';
            if (refresh_list){
                dataFiltros.paginaActual = 1;
                document.querySelector("#listado").innerHTML = '';
            }

            axios({
                url: "{{ route('web.productos.listadoProductosAjax') }}",
                method:'POST',
                data: dataFiltros,
            })
            .then( response => {
                const data = response.data;
                preListado.style.display = 'none';

                if (ultimoProducto){
                    obeserver.unobserve(ultimoProducto);
                }

                if(data.total_productos > 0 && data.count_productos === 0) {
                    return;
                }

                document.querySelector('#totalProducts').innerHTML = data.total_productos
                document.querySelector("#listado").innerHTML += data.view;

                if(data.total_productos > 0){
                    const productosEnPantalla = document.querySelectorAll('.item-producto');
                    ultimoProducto = productosEnPantalla[productosEnPantalla.length -1];
                    obeserver.observe(ultimoProducto);
                }
            })
            .catch( error => {
                const response = error.response;
                const data = response.data;

                if (response.status == 419){
                    listProducts();
                }

                if( response.status == 500){
                    const $msje = data.toString().replace(/\s+/g,"").replace("}{","},{").split(",")[0];
                    try {
                        $val = JSON.parse($msje);
                        if ($val.message == "ServerError"){
                            listProducts();

                        }
                    }catch (e){

                    }

                }

            })


        }

        const selectMultipleOptions = ({ dataFiltrosKey , className , event ,tagKey = '' }) => {
            const el = event.target;
            const hasTagkey = typeof tagKey  === 'string' && tags[tagKey] !== undefined;

            if(el.classList.contains(className)){
                event.preventDefault();

                dataFiltros.paginaActual = 1;
                const items = document.querySelectorAll('.'+className);
                const primaryItem = items[0];

                if (el.dataset.value === ''){
                    dataFiltros[dataFiltrosKey] = [];

                    items.forEach( item => {
                        item.classList.remove('active');
                    });
                    primaryItem.classList.add('active');

                    if( hasTagkey ){
                        tags[tagKey]['value'] = [];
                        listTags();
                    }

                    listProducts({ refresh_list : true });

                    return;
                }

                if (! el.classList.contains('active') ) {
                    dataFiltros[dataFiltrosKey].push( el.dataset.value);
                    primaryItem.classList.remove('active');
                    el.classList.add('active');

                    if( hasTagkey ){
                        tags[tagKey]['value'].push({
                            key: crypto.randomUUID(),
                            id: el.dataset.value,
                            name: el.innerText,
                            filter: dataFiltrosKey,
                            class: className,
                        });
                        listTags();
                    }

                    listProducts({ refresh_list : true });
                    return;
                }

                if( hasTagkey ){
                    tags[tagKey]['value'] = tags[tagKey]['value'].filter( elem => elem.id !== el.dataset.value );
                    listTags();
                }

                dataFiltros[dataFiltrosKey] = dataFiltros[dataFiltrosKey].filter( elem => elem !== el.dataset.value );

                if(dataFiltros[dataFiltrosKey].length === 0){
                    primaryItem.classList.add('active');
                }

                el.classList.remove('active');

                listProducts({ refresh_list : true });

            }
        }

        const selectOneOption = ({ dataFiltrosKey , className , event }) => {
            const el = event.target;
            if(el.classList.contains(className) ){
                event.preventDefault();

                dataFiltros.paginaActual = 1;

                document.querySelectorAll('.'+className).forEach( item => {
                    item.classList.remove('active');
                });
                el.classList.add('active');

                dataFiltros[dataFiltrosKey] = el.dataset.value;

                listProducts({ refresh_list : true });
            }
        }


        const filtros = () => {
            document.querySelector('#contentProducts').addEventListener("click", function (e){
                const el = e.target;


                selectMultipleOptions({ dataFiltrosKey : 'filtro1', className : 'filtro1-opcion', event : e, tagKey: 'filtro1' });


                selectOneOption({ dataFiltrosKey : 'orden', className : 'filtro-orden', event : e });


                if(el.classList.contains('filtro-prensentacion') || (el.tagName === 'I' && el.classList.contains('bi') ) ){
                    e.preventDefault();
                    dataFiltros.paginaActual = 1;
                    document.querySelectorAll('.filtro-prensentacion').forEach(function (item) {
                        item.classList.remove('active');
                    });

                    if(el.tagName === 'I'){
                        el.parentElement.classList.add('active');
                        dataFiltros.presentacion = el.parentElement.dataset.value;
                    } else {
                        el.classList.add('active');
                        dataFiltros.presentacion = el.dataset.value;
                    }

                    if(dataFiltros.presentacion === 'grilla'){
                        dataFiltros.cantidadRegistros = 12;
                    }else {
                        dataFiltros.cantidadRegistros = 15;
                    }

                    listProducts({ refresh_list : true });
                }




            })
        }

        const listTags = () => {

            document.querySelector('.listFiltros ul').innerHTML = '';
            for (const key in tags) {
                const item = tags[key];

                for (const val of item.value) {
                    document.querySelector('.listFiltros ul').innerHTML += `
                        <li>
                            <button class="btn btn-sm tag-item"
                                data-collect="${ key }"
                                data-tagkey="${ val.key }"
                                >
                                <b>${ item.name }:</b>
                                <span>${ val.name }</span>
                                <i class="fa fa-close"></i>
                            </button>
                        </li>
                    `;;
                }
            }

        }

        const actionsTags = () => {
            document.querySelector('.listFiltros ul').addEventListener('click',function (e) {
                e.preventDefault();
                const target = e.target;
                const element = target.closest('.tag-item');

                if(  element != null ){

                    const collect = element.dataset.collect;
                    const tagKey = element.dataset.tagkey;
                    const tag = tags[collect]['value'].find( elem =>  elem.key === tagKey );

                    if(tag === undefined) return

                    const items = document.querySelectorAll('.'+tag.class);
                    const primaryItem = items[0];


                    tags[collect]['value'] = tags[collect]['value'].filter( item => item.id !== tag.id );
                    listTags();


                    dataFiltros[tag.filter] = dataFiltros[tag.filter].filter( item => item !== tag.id );
                    items.forEach( item => {
                        item.classList.remove('active');

                        if( dataFiltros[tag.filter].includes( item.dataset.value ) ){
                            item.classList.add('active');
                        }
                    });

                    if (dataFiltros[tag.filter].length === 0) {
                        primaryItem.classList.add('active');
                    }
                    listProducts({refresh_list:true});



                }


            })
        }


        $(function () {
            listProducts();
            filtros();
            actionsTags();
        });

    </script>
@endpush
