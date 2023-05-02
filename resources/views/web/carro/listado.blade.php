@if($cart->count() > 0)
    <div class="titulo titulo-span">
        <h2 class="fw-bold"><span class="fa-solid fa-cart-shopping pe-3"></span>Carrito de compras</h2><span></span>
    </div>

    <div class="col-lg-8 col-md-12 col-12 mt-md-4 pe-lg-5">
        <div class="table-responsive tabla-transparente">
            <table class="table" id="tablaCarrito">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th></th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th class="text-md-end">Total</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($cart->content() AS $c)
                        <tr>
                            <td class="cart-figure">
                                <a href="{{ route('web.productos.detalle',$c->model->slug_producto) }}" title="{{ $c->name }}" class="inline-block vertical-middle">
                                    <figure class="border border-1 rounded-2 overflow-hidden"><img src="{{ asset($c->model->path_imagen) }}" class="img-carrito-compras-pag" alt="{{ $c->name }}" title="{{ $c->name }}"></figure>
                                </a>
                            </td>
                            <td class="cart-nombre">
                                <h5 class="fw-bold ps-3 mb-0">
                                    <span>{{ $c->name }}</span>
                                    <i class="text-secondary fw-light mt-2 d-block fs-7 fst-normal">Código: {{ $c->model->codigo }}</i>
                                </h5>
                            </td>
                            <td class="cart-precio">
                                <span class="cart-item-oculto hidden-lg hidden-md hidden-sm">Precio</span>
                                <span class="ps-md-0 ps-3 ws-nowrap">{{ $monedaGeneral->format($c->price * $monedaGeneral->cambio,2,'.','') }}</span>
                            </td>
                            <td class="cart-cantidad">
                                <span class="cart-item-oculto hidden-lg hidden-md hidden-sm">Cantidad</span>
                                <div class="input-group spinner ps-md-0 ps-3">
                                    <input type="text" data-idcarrito="{{ $c->rowId }}" data-idproducto="{{ $c->id }}" class="cantidadProductoCarrito form-control rounded-0" type="number" min="1" value="{{ $c->qty }}" data-value_back="{{ $c->qty }}">
                                    <div class="input-group-btn-vertical">
                                        <button data-idcarrito="{{ $c->rowId }}" data-idproducto="{{ $c->id }}" class="btn btn-default" type="button"><i class="fa-solid fa-plus"></i></button>
                                        <button data-idcarrito="{{ $c->rowId }}" data-idproducto="{{ $c->id }}" class="btn btn-default" type="button"><i class="fa-solid fa-minus"></i></button>
                                    </div>
                                </div>
                            </td>
                            <td class="space-nowrap text-md-end cart-total ws-nowrap">
                                <span class="cart-item-oculto hidden-lg hidden-md hidden-sm">Total</span>
                                <span class="ps-md-0 ps-3">{{ $monedaGeneral->format($c->total() * $monedaGeneral->cambio,2,'.','') }}</span>
                                <button type="button" data-idcarrito="{{ $c->rowId }}" class="btn-transparente btnElimarProductoCarrito" data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
        <a href="{{ route('web.productos') }}" class="btn btn-dark px-3 py-2 mt-3 hidden-xs hidden-sm"><i class="fa-solid fa-angle-left pe-3"></i>SEGUIR COMPRANDO</a>
    </div>

    <div class="col-lg-4 col-md-12 col-12 sticky-top mt-4 resumenPagoCarrito">
        @include('web.carro.resumenPagoCarrito')
    </div>
@else
    <div class="col-md-12 col-md-12 col-12 text-center">
        <svg width="150" height="150" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 129 129" class="styles__Svg-sc-17qdfix-0 cPNGKj"><defs><circle id="path-1empty" cx="62.5" cy="62.5" r="62.5"></circle></defs><g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Group-13" transform="translate(0.680000, 0.680000)"><circle id="Oval" fill="#9B9B9B" cx="40.4925352" cy="63.3798592" r="1.32042254"></circle><circle id="Oval-Copy-3" fill="#9B9B9B" cx="88.9080282" cy="62.4995775" r="1.32042254"></circle><circle id="Oval" stroke="#979797" stroke-width="1.32" cx="57.6580282" cy="37.8516901" r="3.08098592"></circle><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-2" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(87.147465, 44.893944) rotate(-270.000000) translate(-87.147465, -44.893944) "></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-3" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(40.492535, 50.175634) rotate(-270.000000) translate(-40.492535, -50.175634) "></path><path d="M52.8164789,58.098169 L55.4573239,62.4995775" id="Line-5" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M73.0629577,58.098169 L75.7038028,62.4995775" id="Line-5-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(74.383380, 60.298873) scale(-1, 1) translate(-74.383380, -60.298873) "></path><path d="M64.2601408,54.5770423 L64.2601408,63.5983265" id="Line-6" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><circle id="Oval-Copy-2" stroke="#979797" stroke-width="1.32" cx="76.1439437" cy="45.7742254" r="2.20070423"></circle><rect id="Rectangle" fill="#CBCBCB" x="34.7707042" y="71.7425352" width="58.9788732" height="10.5633803"></rect><polygon id="Path-3" fill="#9B9B9B" points="20.6861972 82.3059155 34.7707042 71.7425352 34.7707042 82.3059155"></polygon><polygon id="Path-3-Copy" fill="#9B9B9B" transform="translate(100.568346, 77.024225) scale(-1, 1) translate(-100.568346, -77.024225) " points="93.5260929 82.3059155 107.6106 71.7425352 107.6106 82.3059155"></polygon><g id="Rectangle" transform="translate(1.320000, 1.320000)"><mask id="mask-2empty" fill="white"><use xlink:href="#path-1empty"></use></mask><g id="Mask"></g><rect fill="#EBEAEA" mask="url(#mask-2empty)" x="19.3661972" y="80.9859155" width="87.1478873" height="47.5352113"></rect></g><path d="M63.82,127.64 C99.0668127,127.64 127.64,99.0668127 127.64,63.82 C127.64,28.5731873 99.0668127,5.68434189e-14 63.82,5.68434189e-14 C28.5731873,5.68434189e-14 5.68434189e-14,28.5731873 5.68434189e-14,63.82 C5.68434189e-14,99.0668127 28.5731873,127.64 63.82,127.64 Z M63.82,125 C30.031219,125 2.64,97.608781 2.64,63.82 C2.64,30.031219 30.031219,2.64 63.82,2.64 C97.608781,2.64 125,30.031219 125,63.82 C125,97.608781 97.608781,125 63.82,125 Z" id="Oval" fill="#E5E5E5" fill-rule="nonzero"></path></g></g></svg>
        <h4 class="text-center mt-4">Su carrito está vacío, agrege por lo menos un producto-</h4>
        <div class="text-center mt-4">
            <a href="{{ route('web.productos') }}" class="btn btn-primary fw-bold py-3 px-4">Ver todos los productos
            </a>
        </div>
    </div>
@endif

