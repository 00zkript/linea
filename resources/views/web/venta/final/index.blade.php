@extends('web.template.index')
@section('titulo','GRACIAS POR COMPRAR EN ABUTECH-PERU')
@push('css')
    <style>
        .panelCarrito > .panel-heading{
            background: #333333;
            color: white;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
@endpush
@section('contenido')
    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-bag-shopping"></i>Inicio</a></li>
                <li><a href="javascript:void(0);">Compra finalizada</a></li>
            </ul>
        </div>
    </section>

    <div class="container-fluid pt-5 pb-5" style="background: #23b4b7;">
        <div class="row">
            <div class="col-lg-12 text-white text-center">
                <h1 class="fw-bold text-white">¡Gracias por su compra!</h1>
                <h5>Estamos muy agradecidos que haya decidido confiar en nuestros productos.</h5>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-4 col-6 mt-4 mb-4">
                <div class="card-compra p-md-5 p-4">
                    <i class="fa-solid fa-circle-check mb-3" style="color: #2db742;"></i>
                    <h4>El proceso de su compra ha sido realizada con éxito.</h4>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-6 mt-4 mb-4">
                <div class="card-compra p-md-5 p-4">
                    <i class="fa-solid fa-envelope-circle-check mb-3" style="color: #2196f3;"></i>
                    <h4>Le llegará un correo con todos los detalles de su compra.</h4>
                </div>
            </div>
            <!-- <div class="col-lg-4 col-md-4 col-12 mt-md-4 mt-0 mb-md-4 mb-0">
                <a href="#">
                    <div class="card-compra p-md-5 p-4">
                        <i class="fa-solid fa-clipboard-check mb-3" style="color: #f44336;"></i>
                        <h4>Ver Boucher de pago con depósito o transferencia.</h4>
                    </div>
                </a>
            </div> -->
        </div>
    </div>

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 me-lg-5 col-md-5 col-12">
                @if($venta->costoEnvio)
                    <div class="border rounded-2 p-4 mb-md-5 mb-4">
                        <h3 class="fw-bold mb-4">Información de Envío</h3>
                        <hr>
                        @if ($venta->otro_receptor)
                            <h4 class="fw-bold mb-3">
                                <i class="fa-solid fa-person-walking pe-2 text-primary fs-5"></i>Persona que recibirá el pedido
                            </h4>
                            <p class="mb-4 d-flex align-items-center fw-bold ps-4 text-muted">
                                {{ $venta->otro_receptor }}
                            </p>
                        @endif

                        <h4 class="fw-bold mb-3 mt-4">
                            <i class="bi bi-geo-alt-fill pe-2 text-primary fs-5"></i>Dirección de Envío
                        </h4>
                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                            <i class="fa-solid fa-location-crosshairs text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                            <span class="w-100">{{ $venta->direccion }} - {{ $venta->distrito->nombre." - ".$venta->provincia->nombre." - ".$venta->departamento->nombre }}</span>
                        </p>
                        @if ($venta->referencia)
                        <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                            <i class="fa-brands fa-deviantart text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                            <span class="w-100">{{ $venta->referencia }}</span>
                        </p>
                        @endif

                        <h4 class="fw-bold mb-3 mt-4">
                            <i class="fa-regular fa-hourglass pe-2 text-primary fs-5"></i>Tiempo promedio de envío
                        </h4>
                        <aside class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                            {!! $venta->costoEnvio->descripcion !!}
                        </aside>

                    </div>
                @else
                    <div class="border rounded-2 p-4 mb-md-5 mb-4">
                        <h3 class="fw-bold mb-4">Información de Recojo</h3>
                        <hr>
                        @if ($venta->otro_receptor)
                            <h4 class="fw-bold mb-3">
                                <i class="fa-solid fa-person-walking pe-2 text-primary fs-5"></i>Persona que recogerá el pedido
                            </h4>
                            <p class="mb-4 d-flex align-items-center fw-bold ps-4 text-muted">
                                {{ $venta->otro_receptor }}
                            </p>
                        @endif

                        @if ($venta->puntoVenta)
                            <h4 class="fw-bold mb-3 mt-4">
                                <i class="bi bi-geo-alt-fill pe-2 text-primary fs-5"></i>{{ $venta->puntoVenta->nombre }}
                            </h4>
                            <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                <i class="fa-solid fa-store text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                <span class="w-100">{{ $venta->puntoVenta->direccion }}</span>
                            </p>
                            @if ($venta->puntoVenta->correo)
                                <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                    <i class="fa-solid fa-envelope text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                    <span class="w-100">{{ $venta->puntoVenta->correo }}</span>
                                </p>
                            @endif
                            @if ($venta->puntoVenta->whatsapp)
                                <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                    <i class="bi bi-whatsapp text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                    <span class="w-100">{{ $venta->puntoVenta->whatsapp }}</span>
                                </p>
                            @endif
                            @if ($venta->puntoVenta->telefono)
                                <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                    <i class="fa-solid fa-phone text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                    <span class="w-100">{{ $venta->puntoVenta->telefono }}</span>
                                </p>
                            @endif
                        @else
                            <h4 class="fw-bold mb-3 mt-4">
                                <i class="bi bi-geo-alt-fill pe-2 text-primary fs-5"></i>Locales disponibles
                            </h4>
                            <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                <i class="fa-solid fa-store text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                <span class="w-100">{!! $contactoGeneral->direccion !!}</span>
                            </p>
                            @if($contactoGeneral->telefono)
                                <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                    <i class="fa-solid fa-phone text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                    <span class="w-100">{{ $contactoGeneral->telefono  }}</span>
                                </p>
                            @endif
                            @if($contactoGeneral->horario)
                                <p class="mb-2 d-flex align-items-center fw-bold ps-4 text-muted">
                                    <i class="fa-solid fa-calendar text-primary me-2 rounded-circle border border-primary d-inline-flex justify-content-center align-items-center fs-8" style="height: 25px;width: 27px;"></i>
                                    <span class="w-100">{{ $contactoGeneral->horario  }}</span>
                                </p>
                            @endif

                        @endif

                    </div>
                @endif


                @if($venta->pago_idmetodo_pago == 3)
                    <div class="border rounded-2 p-4 mb-md-5 mb-4">
                        <h3 class="fw-bold mb-4">Información de Pago</h3>
                        <hr>
                        {!! $empresaGeneral->cuenta_bancaria !!}
                        {{--<p class="mt-2 mb-0 fw-bold">Puedes pagar en:</p>
                        <img src="{{ asset('web/imagenes/listado-de-agentes.jpg') }}" class="mt-2">--}}
                    </div>
                @endif

                @if($venta->pago_idmetodo_pago == 4)
                    <div class="border rounded-2 p-4 mb-md-5 mb-4">
                        <h3 class="fw-bold mb-4">Información de Pago</h3>
                        <hr>
                        <iframe src="{{ $pago->transaction_details->external_resource_url }}" style="width: 100%; height: 350px" frameborder="0"></iframe>
                    </div>
                @endif


            </div>

            <div class="col-lg-6 col-md-5 col-12">
                <div class="border border-1 ps-md-4 ps-3 pe-md-4 pe-3 pt-4 pb-lg-2 pb-4 bg-xs-light rounded-2">
                    <h3 class="fw-bold text-center mt-0">Revisión del pedido</h3>
                    <hr>

                    <div class="row justify-content-center">

                        @foreach($ventaDetalle as $item)
                            <div class="col-12 mb-2">
                                <div class="row">
                                    <div class="col-2">
                                        <a href="{{ route('web.productos.detalle',$item->producto->slug_producto) }}">
                                            <img
                                                class="img-fluid img-carro rounded-2"
                                                src="{{ asset($item->producto->path_imagen) }}"
                                                alt="{{ $item->producto->nombre }}"
                                                title="{{ $item->producto->nombre }}"
                                            >
                                        </a>
                                    </div>
                                    <div class="col-6 ps-0 pe-0">
                                        <a href="{{ route('web.productos.detalle',$item->producto->slug_producto) }}">
                                            <p class="text-secondary fs-7 m-0">{{ $item->producto->nombre }}</p>
                                            <p class="text-secondary fs-8 m-0">x {{ $item->cantidad }}</p>

                                        </a>
                                    </div>

                                    <div class="col-4 sin-padd-left text-end">
                                        <p class="text-secondary fs-7 fw-bold">{{ $venta->moneda->format($item->subtotal * $venta->precio_cambio,2,".","") }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        @if($venta->idcupon)
                            <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                                <div class="row align-items-center">
                                    <div class="col-lg-8 col-md-8 col-6">
                                        <p class="text-secondary m-0 fw-bold">Descuento</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                        <h4 class="fw-bold fs-6 m-0">- {{ $venta->moneda->format($venta->descuento_alt,2,".","") }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if($venta->precio_envio)
                            <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                                <div class="row align-items-center">
                                    <div class="col-lg-8 col-md-8 col-6">
                                        <p class="text-secondary m-0 fw-bold">Costo de envío</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                        <h4 class="fw-bold fs-6 m-0">{{ $venta->moneda->format($venta->precio_envio_alt,2,".","")  }}</h4>
                                    </div>
                                </div>
                            </div>
                        @endif


                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                            <hr>
                        </div>

                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-md-8 col-6">
                                    <p class="text-secondary m-0 fw-bold">Monto del pedido</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                    <h4 class="fw-bold fs-6 m-0">{{ $venta->moneda->format($venta->total_final_alt * $empresaGeneral->neto_porcentaje,2,".","") }}</h4>
                                </div>
                            </div>
                        </div>


                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-md-8 col-6">
                                    <p class="text-secondary m-0 fw-bold">IGV({{ number_format($empresaGeneral->igv,0,".","") }}%)</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                    <h4 class="fw-bold fs-6 m-0">{{ $venta->moneda->format($venta->total_final_alt * $empresaGeneral->igv_porcentaje,2,".","") }}</h4>
                                </div>
                            </div>
                        </div>



                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-md-8 col-6">
                                    <h4 class="text-dark fs-6 m-0 fw-bold">Total</h4>
                                </div>
                                <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                    <h4 class="fw-bold fs-6 m-0">{{ $venta->moneda->format($venta->total_final_alt,2,".","") }}</h4>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1">
                            <a href="{{ route('web.usuario.index') }}" class="btn btn-dark px-3 py-3 w-100"><i class="fas fa-angle-left pe-3"></i> VER MI HISTORIAL DE COMPRAS</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
