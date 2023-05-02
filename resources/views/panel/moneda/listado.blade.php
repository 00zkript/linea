@if(count($monedas) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Nombre</th>
                <th>Moneda</th>
                <th>Simbolo</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($monedas AS $item)
                <tr>
                    <td>{{ str_pad($item->idmoneda,7,'0000000',STR_PAD_LEFT)}}</td>
                    <td>{{ $item->nombre }}</td>
                    <td>{{ $item->moneda }}</td>
                    <td>{{ $item->simbolo }}</td>
                    <td>{!! $item->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{$item->idmoneda}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{$item->idmoneda}}" data-idmoneda="{{$item->idmoneda}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($item->estado)
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{$monedas->currentPage()}}">
            Mostrando del registro {{$monedas->firstItem()}} al {{$monedas->lastItem()}} de un total de {{$monedas->total()}} registros
        </p>

        <div>
            {{$monedas->links()}}
        </div>

    </div>
@else
    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>
@endif

