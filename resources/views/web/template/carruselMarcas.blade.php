<section class="container mb-5">
    <!-- <div class="titulos"><h4>Marcas</h4></div> -->
    <hr>
    <div class="slider mt-5 flechas-blancas padding-carru2 fondo-marcas" id="slickMarcas">
        @foreach($marcasGeneral AS $m)
            @if(!empty($m->imagen))
                <div class="item">
                    <a href="{{ route('web.productos.marca',$m->idmarca.'-'.$m->slug) }}">
                        <div class="text-center">
                            <img src="{{ asset('panel/img/marcas/'.$m->imagen) }}">
                        </div>
                    </a>
                </div>
            @else
                <div class="item">
                    <a href="{{ route('web.productos.marca',$m->idmarca.'-'.$m->slug) }}">
                        <div class="text-center">
                            <span class="text-uppercase">{{ $m->nombre }}</span>
                        </div>
                    </a>
                </div>
            @endif
        @endforeach
        
    </div>
</section>
