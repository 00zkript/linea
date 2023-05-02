@extends('mail.web.plantilla')
@push('css')
@endpush

@section('cuerpo')

    <div class="container">
        <div class="centrado col-lg-10 col-md-12 col-12 pt-5 pb-5 px-4" style="background: #a2d345;">
            <div class="row">
                <div class="col-lg-12 text-white text-center">
                    @if(in_array($venta->pago_idmetodo_pago,[2,3,4]))
                        <!-- Pago por tranferencia -->
                        <h2 class="fw-bold text-white">¡Estás por finalizar tu compra!</h2>
                        <p class="text-white mb-0">Envíanos la imagen de tu voucher ni bien realices el pago.</p>
                        <!-- Fin pago por tranferencia -->
                    @else
                        <!-- pago con tarjeta -->
                        <h2 class="fw-bold text-white">¡Gracias por tu compra!</h2>
                        <p class="text-white mb-0">Nos comunicaremos contigo apenas hagamos el envío de tu pedido.</p>
                        <!-- Fin pago con tarjeta -->
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="container">

        <div class="centrado col-lg-10 col-md-12 col-12 bg-white">
            <div class="row justify-content-center">
                @if($venta->pago_idmetodo_pago == 3)
                <!-- Pago por tranferencia -->
                <div class="col-lg-12 col-md-12 col-12 mt-lg-0 mb-3">
                    <div class="card-compra p-4">
                        {!! $empresaGeneral->cuenta_bancaria !!}
                    </div>
                </div>
                <!-- Fin pago por tranferencia -->
                @else
                    <!-- pago con tarjeta -->
                    <div class="col-lg-6 col-md-6 col-12 mt-lg-0 mb-3">
                        <div class="card-compra p-4">
                            <img src="{{ asset('web/imagenes/mail-verificar.png') }}" height="60" class="mb-3">
                            <h6>Tu compra se ah realizado con éxito</h6>
                            {{-- <p>El estado de su venta será confirmado por este medio de comunicación.</p> --}}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-12 mt-md-0 mb-3">
                        <div class="card-compra p-4">
                            <img src="{{ asset('web/imagenes/mail-pedido.png') }}" height="60" class="mb-3">
                            <h6>Te pedido está en proceso de elaboración</h6>
                            {{-- <p>Tu compra será confirmada hasta en un plazo máximo de 24 horas.</p> --}}
                        </div>
                    </div>
                    <!-- Fin pago con tarjeta -->
                @endif
            </div>
        </div>

    </div>

    <div class="container">
        <div class="col-lg-10 col-md-12 col-12 centrado bg-white" style="border-top: 5px solid #212529;">
            @if( $venta->idmetodo_entrega === 1)
                <div class=" ps-md-4 ps-3 pe-md-4 pe-3 pt-4 pb-4">
                    <h3 class="fw-bold text-center mt-0 mb-4">Información de envío</h3>
                    {{-- <hr> --}}
                    <div class="justify-content-center">
                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Cliente</p>
                                    <p class="text-dark fw-bold"> {{ $venta->nombres." ".$venta->apellidos }} </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Correo</p>
                                    <p class="text-dark fw-bold"> {{ $venta->correo }} </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Telefono</p>
                                    <p class="text-dark fw-bold"> {{ $venta->telefono }} </p>
                                </div>

                                @if($venta->otro_receptor)
                                    <div class="col-lg-12 col-md-12 col-12">
                                        <p class="text-dark mb-2">Persona que recibirá el pedido</p>
                                        <p class="text-dark fw-bold">{{ $venta->otro_receptor }}</p>
                                    </div>
                                @endif
                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Fecha y hora de entrega (referencial)</p>
                                    <p class="text-dark fw-bold"> {{ now()->parse($venta->fecha_entrega)->format('d/m/Y h:i A') }} </p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Dirección</p>
                                    <p class="text-dark fw-bold">{{ $venta->direccion }} - {{ $venta->distrito->nombre." - ".$venta->provincia->nombre." - ".$venta->departamento->nombre }}</p>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Referencia</p>
                                    <p class="text-dark fw-bold">{{ $venta->referencia }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class=" ps-md-4 ps-3 pe-md-4 pe-3 pt-4 pb-4">
                    <h3 class="fw-bold text-center mt-0 mb-4">Información de entrega</h3>
                    {{-- <hr> --}}
                    <div class="justify-content-center">
                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
                            <div class="row align-items-center">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Cliente</p>
                                    <p class="text-dark fw-bold"> {{ $venta->nombres." ".$venta->apellidos }} </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Correo</p>
                                    <p class="text-dark fw-bold"> {{ $venta->correo }} </p>
                                </div>

                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Telefono</p>
                                    <p class="text-dark fw-bold"> {{ $venta->telefono }} </p>
                                </div>

                                @if($venta->otro_receptor)
                                <div class="col-lg-12 col-md-12 col-12">
                                    <p class="text-dark mb-2">Persona que recogerá el pedido</p>
                                    <p class="text-dark fw-bold"> {{ $venta->otro_receptor }} </p>
                                </div>
                                @endif

                                @if ($venta->puntoVenta)
                                    <div class="col-lg-12 col-md-12 col-12">
                                    {{-- <h6 class="text-dark m-0">Información de Tienda de recojo</h6> --}}

                                        <div class="mb-1">
                                            <p class="text-dark mb-2">Dirección de tienda:</p>
                                            <p class="text-dark fw-bold">{{ $venta->puntoVenta->direccion }}</p>
                                        </div>
                                        <div class="mb-1">
                                            <p class="text-dark mb-2">E-mail:</p>
                                            <a href="mailto:{{ $venta->puntoVenta->correo  }}" class="text-dark">
                                                <p class="text-dark fw-bold">{{ $venta->puntoVenta->correo }}</p>
                                            </a>
                                        </div>
                                        <div class="mb-1">
                                            <p class="text-dark mb-2">Whatsapp:</p>
                                            <a href="https://api.whatsapp.com/send?phone=51{{ $venta->puntoVenta->whatsapp }}&text=¡Buen día!" class="text-dark">
                                                <p class="text-dark fw-bold">{{ $venta->puntoVenta->whatsapp }}</p>
                                            </a>
                                        </div>
                                        <div class="mb-1">
                                            <p class="text-dark mb-2">Teléfono:</p>
                                            <a href="tel:{{ $venta->puntoVenta->telefono }}" class="text-dark">
                                                <p class="text-dark fw-bold">{{ $venta->puntoVenta->telefono }}</p>
                                            </a>
                                        </div>
                                    </div>
                                @else
                                    <div class="col-lg-12 col-md-12 col-12">
                                    {{-- <h6 class="text-dark m-0">Información de Tienda de recojo</h6> --}}

                                        <div class="mb-1">
                                            <p class="text-dark mb-2">Dirección de tienda:</p>
                                            <p class="text-dark fw-bold">{!! $contactoGeneral->direccion !!}</p>
                                        </div>

                                        <div class="mb-1">
                                            <p class="text-dark mb-2">Whatsapp:</p>
                                            <a href="https://api.whatsapp.com/send?phone=51{{ $contactoGeneral->celular }}&text={{ $contactoGeneral->whatsapp }}" class="text-dark">
                                                <p class="text-dark fw-bold">{{ $contactoGeneral->celular }}</p>
                                            </a>
                                        </div>
                                        <div class="mb-1">
                                            <p class="text-dark mb-2">Teléfono:</p>
                                            <a href="tel:{{ $contactoGeneral->telefono }}" class="text-dark">
                                                <p class="text-dark fw-bold">{{ $contactoGeneral->telefono }}</p>
                                            </a>
                                        </div>
                                    </div>

                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>
    </div>




    <div class="container">
        <div class="col-lg-10 col-md-12 col-12 centrado bg-white" style="border-top: 5px solid #212529;">
            <div class=" ps-md-4 ps-3 pe-md-4 pe-3 pt-4 pb-4">
                <h3 class="fw-bold text-center mt-0">Resumen del pedido</h3>
                <hr>

                <div class="justify-content-center">

                    @foreach($ventaDetalle as $item)
                        <div class="col-12 mb-2 px-0">
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
                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
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
                        <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
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

                    <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
                        <hr>
                    </div>

                    <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <p class="text-secondary m-0 fw-bold">Monto del pedido</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0">{{ $venta->moneda->format($venta->total_final_alt * $empresaGeneral->neto_porcentaje,2,".","") }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <p class="text-secondary m-0 fw-bold">IGV({{ number_format($empresaGeneral->igv,0,".","") }}%)</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0">{{ $venta->moneda->format($venta->total_final_alt * $empresaGeneral->igv_porcentaje,2,".","") }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pb-lg-2 pb-md-2 pt-lg-2 pt-md-2 pb-1 pt-1 px-0">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <h4 class="text-dark fs-6 m-0 fw-bold">Total</h4>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0">{{ $venta->moneda->format($venta->total_final_alt,2,".","") }}</h4>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
@endpush
