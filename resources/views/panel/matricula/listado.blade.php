@if(count($registros) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Alumno</th>
                <th>Temporada</th>
                <th>Programa</th>
                <th>Precio total</th>
                <th>Periodo</th>
                <th>Fecha de registro</th>
                {{-- <th>Estado</th> --}}
                <th>¿Finalizado?</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach($registros AS $item)
                <tr>
                    <td>{{ str_pad($item->idmatricula,7,'0000000',STR_PAD_LEFT)}}</td>
                    <td>{{ $item->cliente_nombres }} {{ $item->cliente_apellidos }}</td>
                    <td>{{ $item->temporada->nombre }}</td>
                    <td>{{ $item->programa->nombre }}</td>
                    <td>S/. {{ number_format($item->monto_total,2) }}</td>
                    <td>{{ now()->parse($item->fecha_inicio)->format('d/m/Y') }} -- {{ now()->parse($item->fecha_fin)->format('d/m/Y') }}</td>
                    <td>{{ now()->parse($item->created_at)->format('d/m/Y  h:i A') }}</td>
                    {{-- <td>{!! $item->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td> --}}
                    <td>{!! $item->finalizado_at ? '<label class="badge badge-primary">Finalizado</label>' : '<label class="badge badge-secondary">Sin finalizar</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{$item->idmatricula}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{$item->idmatricula}}" data-idmatricula="{{$item->idmatricula}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <a href="{{ route('matricula.edit',$item->idmatricula) }}" class="dropdown-item" type="button"><i class="fa fa-pencil"></i> Editar</a>
                                <a href="{{ route('pago.create',$item->idcliente) }}" class="dropdown-item" type="button"><i class="fa fa-money-bill"></i> Pagar</a>
                                {{-- <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button> --}}
                                @if($item->estado)
                                    <button class="dropdown-item btnModalInhabilitar" type="button"><i class="fa fa-times"></i> Inhabilitar</button>
                                @else
                                    <button class="dropdown-item btnModalHabilitar" type="button"><i class="fa fa-check"></i> Habilitar</button>
                                @endif
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

