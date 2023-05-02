@if(count($cupones) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Código</th>
                <th>Nombre</th>
                <th>Tipo de descuento</th>
                <th>Descuento</th>
                <th>Cantidad</th>
                <th>Monto mínimo</th>
                <th>Fecha de inicio</th>
                <th>Fecha de expiración</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($cupones AS $c)
                <tr>
                    <td class="text-nowrap">{{ $c->codigo}}</td>
                    <td>{{ $c->nombre}}</td>
                    <td>{{ $c->tipoDescuento}}</td>
                    <td class="text-nowrap">
                        @if($c->tipoDescuento == "monto")
                            {{ $monedaGeneral->format($c->descuentoMonto) }}
                        @else
                            {{round($c->descuentoPorcentaje) }}%
                        @endif
                    </td>
                    <td class="text-nowrap">{{ $c->cantidad}}</td>
                    <td class="text-nowrap">{{ $monedaGeneral->format($c->montoMinimo) }}</td>
                    <td>{{now()->createFromFormat("Y-m-d",$c->fechaInicio)->format("d/m/Y") }}</td>
                    <td>{{now()->createFromFormat("Y-m-d",$c->fechaExpiracion)->format("d/m/Y") }}</td>
                    <td class="text-nowrap">{!! $c->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $c->idcupon}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $c->idcupon}}" data-idcupon="{{ $c->idcupon}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($c->estado)
                                    <button class="dropdown-item btnModalInhabilitar" type="button"><i class="fa fa-times"></i> Inhabilitar</button>
                                @else
                                    <button class="dropdown-item btnModalHabilitar" type="button"><i class="fa fa-check"></i> Habilitar</button>
                                @endif
                                <button class="dropdown-item btnModalEliminar" type="button"><i class="fa fa-trash"></i> Eliminar</button>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <p>
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $cupones->currentPage() }}">
            Mostrando del registro {{ $cupones->firstItem() }} al {{ $cupones->lastItem() }} de un total de {{ $cupones->total() }} registros
        </p>

        <div>
            {{ $cupones->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
