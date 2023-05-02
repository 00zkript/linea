@if(count($ventas) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr class="text-center text-nowrap">
                    <th>Código</th>
                    <th>Fecha y hora</th>
                    <th>Método de pago</th>
                    <th>Estado de envio</th>
                    <th>Estado de pago</th>
                    <th>Valor Venta</th>
                    <th>Descuento</th>
                    <th>Costo de envío</th>
                    <th>Total</th>
                    <th>Estado de venta</th>
                    <th>Comprobante de pago</th>
                    <th>Opciones</th>
                </tr>
            </thead>
            <tbody class="text-nowrap">

            @foreach($ventas AS $v)
                <tr>
                    <td>{{str_pad($v->idventa,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{now()->parse($v->fecha_venta)->format('d/m/Y || h:i A') }}</td>
                    <td>
                        {{ $v->metodoPago->descripcion}}
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="text-info btnModalEstadoEnvio"
                            data-idventa="{{ $v->idventa}}"
                            data-idestado_envio="{{ $v->idestado_envio}}"
                            >
                            <i class="fa fa-refresh"></i>
                            {{ $v->estadoEnvio->nombre}}
                        </a>
                    </td>
                    <td>
                        <a href="javascript:void(0)" class="text-info btnModalEstadoPago"
                            data-idventa="{{ $v->idventa}}"
                            data-idestado_pago="{{ $v->pago_idestado_pago }}"
                            >
                            <i class="fa fa-refresh"></i>
                            {{ $v->estadoPago->nombre}}
                        </a>
                    </td>
                    <td>{{ $v->moneda->format($v->total_alt) }}</td>
                    <td>{{ $v->moneda->format($v->descuento_alt) }}</td>
                    <td>{{ $v->moneda->format($v->precio_envio_alt) }}</td>
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
                        <span class="badge badge-{{ $est }}">
                            {{ $v->estadoControlventa->nombre }}
                        </span>
                    </td>
                    <td>
                        @if ($v->imagen_comprobante_pago)
                            <a href="javascript:void(0)" onclick="window.open('{{ asset("panel/img/comprobante/$v->idventa/$v->imagen_comprobante_pago") }}','{{ $v->imagen_comprobante_pago }}','width=100%')">
                                <img src="{{ asset("panel/img/comprobante/$v->idventa/$v->imagen_comprobante_pago") }}" alt="Comprobante" style="width: 150px">
                            </a>
                        @else
                            Sin Comprobante
                        @endif
                    </td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $v->idventa}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $v->idventa}}" data-idventa="{{ $v->idventa}}">
                                <button class="dropdown-item btnModalDetalleVenta" type="button"><i class="fa fa-eye"></i> Ver Detalles</button>
                                <button class="dropdown-item btnModalPDF" type="button"><i class="fa fa-file"></i> Ver Vaucher</button>
                                @if($v->idestado_control_venta == 1 )
                                    <button class="dropdown-item text-success btnModalFinalizarVenta" type="button"><i class="fa fa-check"></i> Finalizar venta</button>
                                @endif
                                @if($v->idestado_control_venta == 2 )
                                    <button class="dropdown-item text-info btnModalProcesarVenta" type="button"><i class="fa fa-arrow-circle-o-down"></i> Procesar venta</button>
                                @endif
                                @if($v->idestado_control_venta != 3 )
                                    <button class="dropdown-item text-danger btnModalAnularVenta" type="button"><i class="fa fa-times"></i> Anular venta</button>
                                @endif
                            </div>

                        </div>
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
