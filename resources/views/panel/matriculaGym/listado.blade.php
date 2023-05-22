{{--
@if(count($registros) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Cliente</th>
                <th>Temporada</th>
                <th>Programa</th>
                <th>Precio total</th>
                <th>Fecha</th>
                <th>Fecha de registro</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>
                @foreach($registros AS $item)
                <tr>
                    <td>{{ str_pad($item->idregistro,7,'0000000',STR_PAD_LEFT)}}</td>
                    <td>{{ $item->nombre}}</td>
                    <td>{!! $item->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{$item->idregistro}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{$item->idregistro}}" data-idregistro="{{$item->idregistro}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <a href="{{ route('pago.create',$item->idregistro) }}" class="dropdown-item" type="button"><i class="fa fa-eye"></i> Pagar</a>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($item->estado)
                                    <button class="dropdown-item btnModalInhabilitar" type="button"><i class="fa fa-times"> Inhabilitar</i></button>
                                @else
                                    <button class="dropdown-item btnModalHabilitar" type="button"><i class="fa fa-check"> Habilitar</i></button>
                                @endif
                                <button class="dropdown-item btnModalEliminar" type="button"><i class="fa fa-trash"> Eliminar</i></button>

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
 --}}


<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr class="text-center">
            <th>Código</th>
            <th>Cliente</th>
            <th>Temporada</th>
            <th>Programa</th>
            <th>Precio total</th>
            <th>Fecha</th>
            <th>Fecha de registro</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>
            <tr>
                <td>00000001</td>
                <td>Juan Manual Perez Aguila</td>
                <th>Verano 2023</th>
                <th>Para adultos</th>
                <th>S/. 350.00</th>
                <th>01/01/2023 - 01/02/2023</th>
                <th>01/01/2023</th>
                <td class="text-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-0" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                            Seleccione
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu-0" data-idregistro="0">
                            <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                            {{-- <a href="{{ route('pago.create',7) }}" class="dropdown-item" type="button"><i class="fa fa-eye"></i> Pagar</a> --}}
                        </div>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
    <p>
        Mostrando del registro 1 al 1 de un total de 1 registros
    </p>


</div>
