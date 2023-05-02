<div class="row align-items-center mb-md-5 mb-4">
    <div class="col-md-6 col-sm-8 col-7">
        <h2 class="fw-bold mb-0">{{ $titulo }}</h2>
    </div>
    <div class="col-md-6 col-sm-4 col-5 text-end">
        <h4 class="fw-bold mb-0">{{ $productos->total() }} productos</h4>
    </div>
    @if( !empty($descripcion) )
        <!-- solo si hay descripcion en la categoría -->
        <div class="col-md-12 col-12 mt-3">
            <div>{!! $descripcion !!}</div>
        </div>
        <!-- Fin solo si hay descripcion en la categoría -->
    @endif
</div>




<div class="row align-items-center">

    <div class="hidden-lg hidden-md hidden-sm col-sm-4 col-6">
        <h4 class="fw-bold mb-0" id="btn-menu-left"><i class="fa-solid fa-filter-list"></i> Filtrar</h4>
    </div>


    <div class="col-lg-5 col-md-7 col-4 hidden-xs">
        <div class="btn-group btn-group-sm" role="group" aria-label="Opciones">
            <button type="button" class="btn btn-dark py-2 px-3 me-1 btnCambiarPrensentacion {{ !$presentacion || $presentacion == 'grilla' ? 'active' : '' }}" data-valor="grilla">
                <i class="fa fa-th"></i>
            </button>
            <button type="button" class="btn btn-dark py-2 px-3 btnCambiarPrensentacion {{ $presentacion == 'lista' ? 'active' : '' }}" data-valor="lista">
                <i class="fa fa-list"></i>
            </button>
        </div>
        <div class="listado-producto">
            <div><h4 class="fw-bold mb-md-0 mb-2">Mostrar:</h4></div>
            <aside>
                <a href="javascript:void(0);" data-val="15" class="cantidadRegistros {{ !$cantidadRegistros || $cantidadRegistros == '15' ? 'active' : '' }}">15</a>
                <a href="javascript:void(0);" data-val="30" class="cantidadRegistros {{ $cantidadRegistros == '30' ? 'active' : '' }}">30</a>
                <a href="javascript:void(0);" data-val="45" class="cantidadRegistros {{ $cantidadRegistros == '45' ? 'active' : '' }}">45</a>
            </aside>
        </div>
    </div>


    <div class="col-lg-7 col-md-5 col-sm-8 col-6 text-end">
        <div class="form-group text-liston mb-0">
            <label for="orderProductos" class="fw-bold text-uppercase py-0 texto-abso">
                <i class="fa-solid fa-arrow-down-arrow-up hidden-lg hidden-md hidden-sm"></i>
                Ordenar por:
            </label>
            <aside class="custom-select ps-md-2 select-oculto" style="width: auto;display: inline-block;">
                <select id="orderProductos" class="form-control" style="height: 40px;margin-top: 0;">
                    <option {{ !$orden || $orden == "ultimos-productos" ? 'selected':'' }} value="ultimos-productos">Lo más nuevo</option>
                    <option {{ $orden == "a-z" ? 'selected':'' }} value="a-z">Nombre de la A a la Z</option>
                    <option {{ $orden == "z-a" ? 'selected':'' }} value="z-a">Nombre de la Z a la A</option>
                    <option {{ $orden == "barato" ? 'selected':'' }} value="barato">Precio de el más barato a caro</option>
                    <option {{ $orden == "caro" ? 'selected':'' }} value="caro">Precio de el más caro a barato</option>
                </select>
                <i class="fa-solid fa-sort-down hidden-xs"></i>
            </aside>
        </div>
    </div>
</div>



@if(count($productos) == 0)
    <div class="row mt-md-5 mt-0 mb-md-5 mb-4">
        <div class="col-md-12 col-md-12 col-12 text-center">
            <svg width="150" height="150" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 129 129" class="styles__Svg-sc-17qdfix-0 cPNGKj"><defs><circle id="path-1empty" cx="62.5" cy="62.5" r="62.5"></circle></defs><g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Group-13" transform="translate(0.680000, 0.680000)"><circle id="Oval" fill="#9B9B9B" cx="40.4925352" cy="63.3798592" r="1.32042254"></circle><circle id="Oval-Copy-3" fill="#9B9B9B" cx="88.9080282" cy="62.4995775" r="1.32042254"></circle><circle id="Oval" stroke="#979797" stroke-width="1.32" cx="57.6580282" cy="37.8516901" r="3.08098592"></circle><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-2" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(87.147465, 44.893944) rotate(-270.000000) translate(-87.147465, -44.893944) "></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-3" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(40.492535, 50.175634) rotate(-270.000000) translate(-40.492535, -50.175634) "></path><path d="M52.8164789,58.098169 L55.4573239,62.4995775" id="Line-5" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M73.0629577,58.098169 L75.7038028,62.4995775" id="Line-5-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(74.383380, 60.298873) scale(-1, 1) translate(-74.383380, -60.298873) "></path><path d="M64.2601408,54.5770423 L64.2601408,63.5983265" id="Line-6" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><circle id="Oval-Copy-2" stroke="#979797" stroke-width="1.32" cx="76.1439437" cy="45.7742254" r="2.20070423"></circle><rect id="Rectangle" fill="#CBCBCB" x="34.7707042" y="71.7425352" width="58.9788732" height="10.5633803"></rect><polygon id="Path-3" fill="#9B9B9B" points="20.6861972 82.3059155 34.7707042 71.7425352 34.7707042 82.3059155"></polygon><polygon id="Path-3-Copy" fill="#9B9B9B" transform="translate(100.568346, 77.024225) scale(-1, 1) translate(-100.568346, -77.024225) " points="93.5260929 82.3059155 107.6106 71.7425352 107.6106 82.3059155"></polygon><g id="Rectangle" transform="translate(1.320000, 1.320000)"><mask id="mask-2empty" fill="white"><use xlink:href="#path-1empty"></use></mask><g id="Mask"></g><rect fill="#EBEAEA" mask="url(#mask-2empty)" x="19.3661972" y="80.9859155" width="87.1478873" height="47.5352113"></rect></g><path d="M63.82,127.64 C99.0668127,127.64 127.64,99.0668127 127.64,63.82 C127.64,28.5731873 99.0668127,5.68434189e-14 63.82,5.68434189e-14 C28.5731873,5.68434189e-14 5.68434189e-14,28.5731873 5.68434189e-14,63.82 C5.68434189e-14,99.0668127 28.5731873,127.64 63.82,127.64 Z M63.82,125 C30.031219,125 2.64,97.608781 2.64,63.82 C2.64,30.031219 30.031219,2.64 63.82,2.64 C97.608781,2.64 125,30.031219 125,63.82 C125,97.608781 97.608781,125 63.82,125 Z" id="Oval" fill="#E5E5E5" fill-rule="nonzero"></path></g></g></svg>
            <h4 class="text-center mt-4">Lo sentimos, no hay productos disponibles con éstas especificaciones</h4>
            <div class="text-center mt-4">
                <a href="{{ route('web.productos') }}" class="btn btn-primary fw-bold py-3 px-4">Ver todos los productos
                </a>
            </div>
        </div>
    </div>
@else

    <div class="row justify-content-md-start justify-content-sm-center mt-4">
        @foreach($productos AS $producto)
            <div class="{{ $presentacion == 'lista' ? 'col-lg-12 col-md-12 col-12 lista mb-md-4 mb-3' : 'col-lg-4 col-md-6 col-sm-11 col-12 mb-md-5 mb-5' }}">
                @include('web.productos.partes.itemProducto', ['producto' => $producto])
            </div>
        @endforeach

        <div class="col-md-12 col-md-12 col-12 text-center">
            {{ $productos->links() }}
        </div>
    </div>


@endif


