@if(count($ventas) > 0)
    <div class="table-responsive">
        <table class="table table-bordered" id="tablaCompras">
            <thead class="thead-dark">
                <tr class="text-center text-nowrap">
                    <th>Código</th>
                    <th>Fecha y hora</th>
                    {{-- <th>Método de pago</th> --}}
                    <th>Estado de envio</th>
                    <th>Estado de pago</th>
                    {{-- <th>Valor Venta</th> --}}
                    {{-- <th>Descuento</th> --}}
                    {{-- <th>Costo de envio</th> --}}
                    <th>Total </th>
                    <th>Estado de pedido</th>
                    <th>Comprobate de pago</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody class="text-nowrap">

            @foreach($ventas AS $v)
                <tr>
                    <td>{{str_pad($v->idventa,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{now()->parse($v->fecha_venta)->format('d/m/Y || h:i A') }}</td>
                    {{-- <td> {{ $v->metodoPago->descripcion}} </td> --}}
                    <td>{{ $v->estadoEnvio->nombre }}</td>
                    <td>{{ $v->estadoPago->nombre }}</td>
                    {{-- <td>{{ $v->moneda->format($v->total_alt) }}</td> --}}
                    {{-- <td>{{ $v->moneda->format($v->descuento_alt) }}</td> --}}
                    {{-- <td>{{ $v->moneda->format($v->precio_envio_alt) }}</td> --}}
                    <td>{{ $v->moneda->format($v->total_final_alt) }}</td>
                    <td>
                        @php
                            $est = 'info';
                            if($v->idestado_control_venta == 2){
                                $est = 'success';
                            }
                            if($v->idestado_control_venta == 3){
                                $est = 'danger';
                            }
                        @endphp
                        <label class="fw-bold text-{{ $est }}">
                            {{ $v->estadoControlventa->nombre }}
                        </label>
                    </td>
                    <td>
                        @if ($v->imagen_comprobante_pago)
                        <img src="{{ asset("panel/img/comprobante/$v->idventa/$v->imagen_comprobante_pago") }}"  alt="Imagen comprobante" style="width:120px">
                            <button type="buttom" class="btn btn-primary btnModalChangeComprobante"
                            data-idventa="{{ $v->idventa }}"
                            data-comprobante="{{ $v->imagen_comprobante_pago }}"
                            title="Cambiar comprobante" >
                            <i class="fa fa-edit"></i>
                        </button>
                        @else
                        <button type="buttom" class="btn btn-primary btnModalChangeComprobante"
                            data-idventa="{{ $v->idventa }}"
                            title="Subir comprobante" >
                            <i class="fa fa-upload"></i>
                        </button>
                        @endif

                        {{-- <br>
                        <br>

                        <a href="javascript:void(0)" class="text-info btnModalChangeComprobante"
                            data-idventa="{{ $v->idventa }}"
                            data-comprobante="{{ $v->imagen_comprobante_pago }}" >
                            <i class="fa fa-refresh"></i>
                            @if ($v->imagen_comprobante_pago)
                                Cambiar comprobante
                            @else
                                Subir comprobante
                            @endif
                        </a> --}}
                    </td>
                    <td class="text-center">
                        <button type="button" data-idventa="{{ $v->idventa}}" class="btn btn-warning btn-sm btnModalDetalleVenta" data-bs-toggle="tooltip" data-bs-placement="top" title="Detalle de compra"><i class="fa-solid fa-eye"></i></button>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <p>
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $ventas->currentPage() }}">
            Mostrando del registro {{ $ventas->firstItem() }} al {{ $ventas->lastItem() }} de un total de {{ $ventas->total() }} registros
        </p>

        <div>
            {{ $ventas->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
