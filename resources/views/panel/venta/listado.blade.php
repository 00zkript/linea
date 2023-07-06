@if(count($registros) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Cliente</th>
                <th>Monto Pagado (S/.)</th>
                <th>Monto Deuda (S/.)</th>
                <th>Monto Total (S/.)</th>
                {{-- <th>Estado</th> --}}
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($registros AS $item)
                <tr>
                    <td>{{ str_pad($item->idventa,7,0,STR_PAD_LEFT)}}</td>
                    <td>{{ $item->cliente_nombres }} {{ $item->cliente_apellidos }}</td>
                    <td class="text-right">S/. {{ $item->monto_pagado }}</td>
                    <td class="text-right">S/. {{ $item->monto_faltante }}</td>
                    <td class="text-right">S/. {{ $item->monto_total }}</td>
                    {{-- <td>{!! $item->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td> --}}
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{$item->idventa}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{$item->idventa}}" data-idventa="{{$item->idventa}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                {{-- <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button> --}}
                                {{-- @if($item->estado)
                                    <button class="dropdown-item btnModalInhabilitar" type="button"><i class="fa fa-times"> Inhabilitar</i></button>
                                @else
                                    <button class="dropdown-item btnModalHabilitar" type="button"><i class="fa fa-check"> Habilitar</i></button>
                                @endif --}}
                                {{-- <button class="dropdown-item btnModalEliminar" type="button"><i class="fa fa-trash"> Eliminar</i></button> --}}

                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <p>
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{$registros->currentPage()}}">
            Mostrando del registro {{$registros->firstItem()}} al {{$registros->lastItem()}} de un total de {{$registros->total()}} registros
        </p>

        <div>
            {{$registros->links()}}
        </div>

    </div>
@else
    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>
@endif
