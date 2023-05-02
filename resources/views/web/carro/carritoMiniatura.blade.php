@if(Cart::instance('productos')->count() > 0)
    <div class="contenedor-carrito" style="z-index: 999999;">
        @foreach(Cart::instance('productos')->content() AS $c)
            <div class="item-carrito">
                <section>
                    <figure>
                        <a href="{{ route('web.productos.detalle',$c->model->slug_producto) }}">
                            <img src="{{ asset($c->model->path_imagen) }}">
                        </a>
                    </figure>

                    <a style="text-decoration: none;" href="{{ route('web.productos.detalle',$c->model->slug_producto) }}">
                        <i>x{{ $c->qty }}</i> {{ $c->name}}
                        <strong>{{ $monedaGeneral->format($c->total() * $monedaGeneral->cambio,2,'.','') }}</strong>
                    </a>

                    <a href="javascript:void(0)" data-idcarrito="{{ $c->rowId}}" class="cerrar-carrito eliminarItemCarritoMiniatura" style="cursor: pointer;vertical-align: top"><i class="bi bi-x-lg"></i></a>
                </section>
            </div>
        @endforeach
    </div>
    <div class="contenedor-carrito-abajo">
        <table class="table tabla-sin-borde mb-0">
            <tbody>

            {{--<tr>
                <td class="text-end"><strong>Valor Venta $</strong></td>
                <td class="text-end">{{calcularMontoBase($empresaGeneral->igv,Cart::instance('productos')->total()) }}</td>
            </tr>


            <tr>
                <td class="text-end"><strong>IGV({{number_format($empresaGeneral->igv,0,".","") }}%) $</strong></td>
                <td class="text-end">{{calcularIgv($empresaGeneral->igv,Cart::instance('productos')->total()) }}</td>
            </tr>--}}

            {{--<tr>
                <td class="text-end"><strong>Total:</strong></td>
                <td class="text-end">
                    {{ $empresaGeneral->moneda->simbolo }}
                    {{Cart::instance('productos')->total() }}

                </td>
            </tr>--}}
            <tr>
                <td class="text-start"><h4 class="fw-bold">TOTAL</h4></td>
                <td class="text-end">
                    <h4 class="fw-bold">{{ $monedaGeneral->format(Cart::instance('productos')->total() * $monedaGeneral->cambio,2,'.','') }}</h4>
                </td>
            </tr>
            </tbody>
        </table>

        <a href="{{ route('web.carrito-de-compras.index') }}" class="boton-pagar"><span class="fa-solid fa-cart-arrow-down"></span> Ver carrito</a>
        <a href="{{ route('web.venta.usuario.index') }}" class="boton-carrito"><span class="icont-tarjeta-de-credito"></span> Pagar</a>
    </div>
@else
    <div class="contenedor-carrito text-center" style="z-index: 999999;">
        <svg width="100" height="100" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 129 129" class="styles__Svg-sc-17qdfix-0 cPNGKj"><defs><circle id="path-1empty" cx="62.5" cy="62.5" r="62.5"></circle></defs><g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><g id="Group-13" transform="translate(0.680000, 0.680000)"><circle id="Oval" fill="#9B9B9B" cx="40.4925352" cy="63.3798592" r="1.32042254"></circle><circle id="Oval-Copy-3" fill="#9B9B9B" cx="88.9080282" cy="62.4995775" r="1.32042254"></circle><circle id="Oval" stroke="#979797" stroke-width="1.32" cx="57.6580282" cy="37.8516901" r="3.08098592"></circle><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-2" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M87.1474648,42.2530986 L87.1474648,47.5347887" id="Line-4-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(87.147465, 44.893944) rotate(-270.000000) translate(-87.147465, -44.893944) "></path><path d="M40.4925352,47.5347887 L40.4925352,52.8164789" id="Line-4-Copy-3" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(40.492535, 50.175634) rotate(-270.000000) translate(-40.492535, -50.175634) "></path><path d="M52.8164789,58.098169 L55.4573239,62.4995775" id="Line-5" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><path d="M73.0629577,58.098169 L75.7038028,62.4995775" id="Line-5-Copy" stroke="#979797" stroke-width="1.32" stroke-linecap="square" transform="translate(74.383380, 60.298873) scale(-1, 1) translate(-74.383380, -60.298873) "></path><path d="M64.2601408,54.5770423 L64.2601408,63.5983265" id="Line-6" stroke="#979797" stroke-width="1.32" stroke-linecap="square"></path><circle id="Oval-Copy-2" stroke="#979797" stroke-width="1.32" cx="76.1439437" cy="45.7742254" r="2.20070423"></circle><rect id="Rectangle" fill="#CBCBCB" x="34.7707042" y="71.7425352" width="58.9788732" height="10.5633803"></rect><polygon id="Path-3" fill="#9B9B9B" points="20.6861972 82.3059155 34.7707042 71.7425352 34.7707042 82.3059155"></polygon><polygon id="Path-3-Copy" fill="#9B9B9B" transform="translate(100.568346, 77.024225) scale(-1, 1) translate(-100.568346, -77.024225) " points="93.5260929 82.3059155 107.6106 71.7425352 107.6106 82.3059155"></polygon><g id="Rectangle" transform="translate(1.320000, 1.320000)"><mask id="mask-2empty" fill="white"><use xlink:href="#path-1empty"></use></mask><g id="Mask"></g><rect fill="#EBEAEA" mask="url(#mask-2empty)" x="19.3661972" y="80.9859155" width="87.1478873" height="47.5352113"></rect></g><path d="M63.82,127.64 C99.0668127,127.64 127.64,99.0668127 127.64,63.82 C127.64,28.5731873 99.0668127,5.68434189e-14 63.82,5.68434189e-14 C28.5731873,5.68434189e-14 5.68434189e-14,28.5731873 5.68434189e-14,63.82 C5.68434189e-14,99.0668127 28.5731873,127.64 63.82,127.64 Z M63.82,125 C30.031219,125 2.64,97.608781 2.64,63.82 C2.64,30.031219 30.031219,2.64 63.82,2.64 C97.608781,2.64 125,30.031219 125,63.82 C125,97.608781 97.608781,125 63.82,125 Z" id="Oval" fill="#E5E5E5" fill-rule="nonzero"></path></g></g></svg>
        <p class="text-center mt-2 mb-2" style="font-weight: bold">SU CARRITO NO TIENE PRODUCTOS</p>
    </div>
@endif
