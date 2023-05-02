@foreach($ventaDetalle as $k => $c)
    <div class="row justify-content-center ps-4 pe-4 d-block d-md-none">
        <div class="col-12 pb-3 pt-4" style="border-bottom: 1px solid #aaaaaa;">
            <div class="row align-items-center">
                <div class="col-lg-8 col-md-8 col-6">
                    <h4 class="text-uppercase font-weight-bolder fs-6 m-0">{{ $c->producto->nombre }} <span class="text-lowercase fw-light texto-avenir-roman d-none">x{{ $c->cantidad }}</span></h4>
                </div>
                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                    <h4 class="fw-light texto-avenir-roman fs-6 m-0">{{ $monedaGeneral->format($c->subtotal,2) }}</h4>
                </div>
            </div>
        </div>
    </div>
@endforeach
<div class="row justify-content-center ps-4 pe-4 d-block d-md-none">
    <div class="col-12 pb-3 pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-6 pb-2">
                <h4 class="text-uppercase font-weight-bolder fs-6 m-0">TOTAL</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-6 pb-2 ps-0 text-end">
                <h4 class="fw-light texto-avenir-roman fs-6 m-0">{{ $monedaGeneral->format($venta->total,2) }}</h4>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-6 pb-2">
                <h4 class="text-uppercase font-weight-bolder fs-6 m-0">ENV&Iacute;O</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-6 pb-2 ps-0 text-end">
                <h4 class="fw-light texto-avenir-roman fs-6 m-0">{{ $monedaGeneral->format($venta->precio_envio + ($venta->precio_entrega_rapido ?:0),2) }}</h4>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-6 pb-2">
                <h4 class="text-uppercase font-weight-bolder fs-6 m-0">DESCUENTO</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-6 pb-2 ps-0 text-end">
                <h4 class="fw-light texto-avenir-roman fs-6 m-0"> -{{ $monedaGeneral->format($venta->descuento,2) }}</h4>
            </div>
        </div>
        <hr class="hr-negro mt-2">

        <div class="row justify-content-center">
            <div class="col-lg-8 col-md-8 col-6">
                <h4 class="text-uppercase font-weight-bolder fs-6 m-0">MONTO A PAGAR</h4>
            </div>
            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                <h4 class="fw-light texto-avenir-roman fs-6 m-0">{{ $monedaGeneral->format($venta->total_final,2) }}</h4>
            </div>
        </div>

        <div class="row">
            <div class="radio radio-oculto p-0">
                <button class="btn-lleno margen-arriba fs-6 w-100 border-0 pt-3 pb-3 finalizarPago">
                    FINALIZAR COMPRA
                </button>
            </div>
        </div>
    </div>
</div>

