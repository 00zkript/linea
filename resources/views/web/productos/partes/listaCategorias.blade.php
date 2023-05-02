@if($categorias)
    @php( $id = rand(0,1000))
    <div class="accordion accordion-flush" id="categoria-{{ $id }}">
        @foreach($categorias as $c)
            @if( count($c->subcategorias) > 0 )
            @php($isActive = isset($idsParent) && in_array($c->idcategoria,$idsParent))
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-{{ $c->idcategoria }}">
                    <a href="{{ route('web.productos.categoria',$c->slug_categoria) }}" class="categoria-imagen">{{--<!--<figure><img src="{{ asset('web/imagenes/suministros1.png') }}"></figure>-->--}}<span>{{ $c->nombre }}</span></a>
                    <button class="accordion-button  {{ $isActive ? '': 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapse{{ $c->idcategoria }}" aria-expanded="false" aria-controls="flush-collapse{{ $c->idcategoria }}"></button>
                </h2>
                <div id="flush-collapse{{ $c->idcategoria }}" class="accordion-collapse collapse {{ $isActive ? 'show': '' }}" aria-labelledby="flush-{{ $c->idcategoria }}" data-bs-parent="#categoria-{{ $id }}">
                    @if( count($c->subcategorias) > 0 )
                        @include('web.productos.partes.listaCategorias',["categorias" => $c->subcategorias])
                    @endif
                </div>
            </div>
            @else
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-{{ $c->idcategoria }}">
                    <a href="{{ route('web.productos.categoria',$c->slug_categoria) }}" class="categoria-imagen">{{--<!--<figure><img src="{{ asset('web/imagenes/impresora1.png') }}"></figure>-->--}}<span>{{ $c->nombre }}</span></a>
                </h2>
            </div>
            @endif
        @endforeach
    </div>
@endif
