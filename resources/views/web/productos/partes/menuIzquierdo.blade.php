<section class="menu-left" id="menu-left">
    <i class="fa-solid fa-xmark btn-ocultarmenu p-2 hidden-lg hidden-md hidden-sm"></i>
    <div class="menu-left-section">
        <h3 class="fw-bold tit-menu-left hidden-lg hidden-md hidden-sm">
            <span class="glyphicon glyphicon-tasks"></span>
            Filtrar por:
        </h3>

        <div class="titulos collapse-title mb-md-3 mb-1 {{ $menuShow == 'section' ? '' : 'collapsed' }} "
             data-bs-toggle="collapse" data-bs-target="#collapseSection" aria-expanded="false"
             aria-controls="collapseSection">
            <h3 class="text-uppercase fw-bold mb-0 text-white">Secciones</h3>
            <i class="bi bi-plus-lg"></i>
        </div>

        <aside class="px-3 collapse  {{ $menuShow == 'section' ? 'show' : '' }} " id="collapseSection">

            <div class="accordion accordion-flush">
                @if(count($sections) > 0)
                    @foreach($sections as $s)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="sub-{{ $s->idsection }}">
                                <a href="{{ route('web.productos.section',$s->idsection.'-'.$s->slug) }}" class="categoria-imagen">
                                    <span> {{ $s->nombre }}</span>
                                </a>
                            </h2>
                        </div>
                    @endforeach
                @endif
                <div class="accordion-item">
                    <h2 class="accordion-header" id="sub-sin-section">
                        <a href="{{ route('web.productos.section',"0-sin-seccion") }}" class="categoria-imagen">
                            <span> Sin sección</span>
                        </a>
                    </h2>
                </div>

            </div>



        </aside>





        <div class="titulos collapse-title mb-md-3 mb-1 {{ $menuShow == 'categoria' ? '' : 'collapsed' }} "
             data-bs-toggle="collapse" data-bs-target="#collapseCategorias" aria-expanded="false"
             aria-controls="collapseCategorias">
            <h3 class="text-uppercase fw-bold mb-0 text-white">Categorías</h3>
            <i class="bi bi-plus-lg"></i>
        </div>

        <aside class="px-3 collapse  {{ $menuShow == 'categoria' ? 'show' : '' }} " id="collapseCategorias">

            @include('web.productos.partes.listaCategorias')

            <div class="accordion accordion-flush primero" id="categoria-EJ">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-EJ">
                        <a href="{{ route('web.productos.categoria',"0-sin-categoria") }}"
                           class="categoria-imagen"><span>Sin categoria</span></a>
                    </h2>
                </div>
            </div>

        </aside>




        <div class="titulos collapse-title mb-1 mt-4  {{ $menuShow == 'marca' ? '' : 'collapsed' }} "
             data-bs-toggle="collapse" data-bs-target="#collapseMarcas" aria-expanded="false"
             aria-controls="collapseMarcas">
            <h3 class="text-uppercase fw-bold mb-0 text-white">Marcas</h3>
            <i class="bi bi-plus-lg"></i>
        </div>

        <aside class="px-3 collapse  {{ $menuShow == 'marca' ? 'show' : '' }} " id="collapseMarcas">

            <div class="accordion accordion-flush">
                @if(count($marcasGeneral) > 0)
                    @foreach($marcasGeneral as $m)
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="sub-{{ $m->idmarca }}">
                                <a href="{{ route('web.productos.marca',$m->idmarca.'-'.$m->slug) }}"
                                   class="categoria-imagen">
                                    {{--<!-- <i class="fa-light fa-chevron-right fs-8"></i> -->--}}
                                    <span> {{ $m->nombre }}</span>
                                </a>
                            </h2>
                        </div>
                    @endforeach
                @endif
                <div class="accordion-item">
                    <h2 class="accordion-header" id="sub-sin-marca">
                        <a href="{{ route('web.productos.marca',"0-sin-marca") }}" class="categoria-imagen">
                            <span> Sin marca</span>
                        </a>
                    </h2>
                </div>

            </div>
        </aside>




        @if( isset($caracteristicas) && count($caracteristicas) > 0)
            @foreach($caracteristicas as $atributo)
                <div class="titulos collapse-title mb-1 mt-4  {{ $menuShow == $atributo->slug ? '' : 'collapsed' }} "
                     data-bs-toggle="collapse" data-bs-target="#collapse-{{ $atributo->slug }}" aria-expanded="false"
                     aria-controls="collapse-{{ $atributo->slug }}">
                    <h3 class="text-uppercase fw-bold mb-0 text-white">{{ $atributo->nombre }}</h3>
                    <i class="bi bi-plus-lg"></i>
                </div>

                <aside class="px-3 collapse  {{ $menuShow == $atributo->slug ? 'show' : '' }} "
                       id="collapse-{{ $atributo->slug }}">

                    <div class="accordion accordion-flush">
                        @foreach($atributo->valores as $valor)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="sub-{{ $atributo->slug.'-'.$valor->slug }}">
                                    <a href="{{ route('web.productos.caracteristica',[$atributo->slug,$valor->slug]) }}" class="categoria-imagen">
                                        <span> {{ $valor->valor }}</span>
                                    </a>
                                </h2>
                            </div>
                        @endforeach

                    </div>

                </aside>
            @endforeach
        @endif




        <div class="titulos mb-3 mt-4">
            <h3 class="text-uppercase fw-bold mb-0 text-white">Precio</h3>
        </div>

        <aside class="px-3">
            <p class="mb-md-3 mb-4">
                <label for="amount">Rango:</label>
                <input type="text" id="amount" style="border:0;font-weight:bold;">
            </p>
            <div id="slider-range"></div>
            <button class="btn btn-primary px-3 py-2 mt-4 aplicarRangoPrecio">Aplicar Rango</button>
        </aside>

        {{--<div class="w-100 mt-5 mb-4 px-md-0 px-3">
            <a href="#" class="efecto-img-zoom">
                <figure>
                    <img src="{{ asset('web/imagenes/publicidad-cate.jpg') }}">
                </figure>
            </a>
        </div>--}}
    </div>
</section>
