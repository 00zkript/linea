<div class="border border-1 ps-md-4 ps-3 pe-md-4 pe-3 pt-4 pb-lg-2 pb-4 bg-xs-light rounded-2">
    <h3 class="fw-bold d-flex align-items-center justify-content-between mt-0">Revisión del pedido<a href="{{ route('web.carrito-de-compras.index') }}" class="fs-8"><i class="fas fa-angle-left pe-1"></i> <span>EDITAR CARRITO</span></a></h3>
    <hr>

    <div class="row justify-content-center">

        @foreach($ventaDetalle AS $item)
            <div class="col-12 mb-2">
                <div class="row">
                    <div class="col-2">
                        <a href="{{ route('web.productos.detalle',$item->producto->slug_producto) }}">
                            <img class="img-fluid img-carro rounded-2" src="{{ asset($item->producto->path_imagen) }}" alt="{{ $item->producto->nombre }}" title="{{ $item->name }}">
                        </a>
                    </div>
                    <div class="col-6 ps-0 pe-0">
                        <a href="{{ route('web.productos.detalle',$item->producto->slug_producto) }}">
                            <p class="text-secondary fs-7 m-0">{{ $item->producto->nombre }}</p>
                            <p class="text-secondary fs-8 m-0">x {{ $item->cantidad }}</p>

                        </a>
                    </div>

                    <div class="col-4 sin-padd-left text-end">
                        <p class="text-secondary fs-7 fw-bold">{{ $monedaGeneral->format($item->subtotal * $monedaGeneral->cambio,2,".","") }}</p>
                    </div>
                </div>
            </div>

        @endforeach

        @if($venta->descuento > 0 )
            <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-8 col-6">
                        <p class="text-secondary m-0 fw-bold ">Descuento</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                        <h4 class="fw-bold fs-6 m-0">
                            - {{ $monedaGeneral->format($venta->descuento * $monedaGeneral->cambio,2,".","") }}

                        </h4>
                    </div>
                </div>
            </div>
        @endif


        @if($venta->precio_envio)
            <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                <div class="row align-items-center">
                    <div class="col-lg-8 col-md-8 col-6">
                        <p class="text-secondary m-0 fw-bold ">Costo de envío</p>
                    </div>
                    <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                        <h4 class="fw-bold fs-6 m-0">{{ $monedaGeneral->format($venta->precio_envio * $monedaGeneral->cambio,2,".","")  }}</h4>
                    </div>
                </div>
            </div>
        @endif



        <div class="col-12">
            <hr>
        </div>

        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-6">
                    <p class="text-secondary m-0 fw-bold ">Monto del pedido </p>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                    <h4 class="fw-bold fs-6 m-0">{{ $monedaGeneral->format($venta->total_final * $empresaGeneral->neto_porcentaje * $monedaGeneral->cambio,2,".","") }}</h4>
                </div>
            </div>
        </div>

        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-6">
                    <p class="text-secondary m-0 fw-bold ">IGV({{ number_format($empresaGeneral->igv,0,".","") }}%)</p>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                    <h4 class="fw-bold fs-6 m-0">{{ $monedaGeneral->format($venta->total_final * $empresaGeneral->igv_porcentaje * $monedaGeneral->cambio,2,".","") }}</h4>
                </div>
            </div>
        </div>

        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-6">
                    <h4 class="text-dark fs-6 m-0 fw-bold ">Total</h4>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                    <h4 class="fw-bold fs-6 m-0">{{ $monedaGeneral->format($venta->total_final * $monedaGeneral->cambio,2,".","") }}</h4>
                </div>
            </div>
        </div>

        {{--<!-- <div class="col-12 pb-lg-3 pt-lg-0 pt-3">
            <a href="{{ route('web.carrito-de-compras.index') }}" class="btn btn-dark w-100 pt-3 pb-3"><i class="fas fa-angle-left pe-3"></i> <span>EDITAR CARRITO</span></a>
        </div> -->--}}

    </div>
</div>
