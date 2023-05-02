<div class="contenido-prod shadow-none item-producto">
    @if($producto->stock > 0 && $producto->liquidacion)
        <span class="oferta text-uppercase"><i>{{ $producto->stock }} en oferta</i></span>
    @endif

    @if($producto->stock <= 0)
        <span class="sinstock text-uppercase"><i>Sin Stock</i></span>
    @endif

    @if($producto->nuevo)
        <span class="descuento text-uppercase {{ $producto->liquidacion ? '' : 'solo' }}"><i>Nuevo</i></span>
    @endif

    <div class="efecto-zoom carruser">
        <figure class="position-relative">
            <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}">
                <div class="seccionimg">
                    <div class="imgsec" style="background-image: url('{{ asset($producto->path_imagen) }}')"></div>
                </div>
            </a>
            <div class="grid-iconos">
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ in_array($producto->idproducto,$favoritos) ? 'Tu favorito' : 'Añadir a Favoritos' }}" data-idproducto="{{ $producto->idproducto}}" class="favorito {{ in_array($producto->idproducto,$favoritos) ? 'active' : '' }}" alt="{{ in_array($producto->idproducto,$favoritos) ? 'Tu favorito' : 'Añadir a Favoritos' }}"><span><i class="fa-light fa-heart"></i></span></a>
                {{--<!--<a href="#" data-bs-toggle="tooltip" data-bs-placement="top" title="Comparar"><span><i class="bi bi-shuffle"></i></span></a>-->--}}
            </div>
        </figure>
        <aside>
            @if($producto->idmarca)
                <a href="{{ route('web.productos.marca',$producto->marca->idmarca.'-'.$producto->marca->slug) }}"><h6 class="item-text text-uppercase mb-2">{{ $producto->marca->nombre }}</h6></a>
            @endif
            <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}" title="{{ $producto->nombre }}"><h5 class="item-tit mb-2">{{ $producto->nombre_recortado }}</h5></a>

            @if($producto->codigo > 0)
                <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}">
                    <h6 class="item-text mb-2">Código: {{ $producto->codigo}}</h6>
                </a>
            @endif

            @if($producto->stock > 0 && $producto->show_precio)
                <a href="{{ route('web.productos.detalle',$producto->slug_producto) }}">
                    @if($producto->precio_promocional > 0)
                        <h5 class="dscto">{{ $monedaGeneral->format($producto->precio * $monedaGeneral->cambio,2,".","") }}</h5>
                        <h5 class="precio">{{ $monedaGeneral->format($producto->precio_promocional * $monedaGeneral->cambio,2,".","") }}</h5>
                    @else
                        <h5 class="precio">{{ $monedaGeneral->format($producto->precio * $monedaGeneral->cambio,2,".","") }}</h5>
                    @endif
                </a>

                <article>
                    <a href="javascript:void(0);" data-idproducto="{{ $producto->idproducto}}" class="btn btn-agregar fw-bold agregarCarritoGlobal">
                        <span class="fa-solid fa-cart-shopping"></span>&nbsp;&nbsp;&nbsp;
                        AÑADIR AL CARRITO
                    </a>
                </article>
            @endif

        </aside>
    </div>
</div>
