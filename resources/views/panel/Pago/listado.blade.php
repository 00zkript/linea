{{-- @if(count($registros) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Nombre</th>
                <th>Estado</th>
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
@endif --}}

<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr class="text-center">
                <th>Opciones</th>
                <th>Matrícula</th>
                <th>Alumno</th>
                <th>Cantidad pagos</th>
                <th>Monto total</th>
                <th>Monto pagado</th>
                <th>Monto deuda</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-7" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                            Seleccione
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu-7" data-idregistro="7">
                            <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                            <a href="{{ route('pago.create', 7) }}" class="dropdown-item" type="button"><i class="fa fa-eye"></i> Pagar matrícula</a>
                        </div>
                    </div>
                </td>
                <td>0000007</td>
                <td>Juan Perez Mancilla</td>
                <td>2</td>
                <td>S/. 350.00</td>
                <td>S/. 250.00</td>
                <td>S/. 100.00</td>
            </tr>
            <tr>
                <td class="text-center">
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-7" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                            Seleccione
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu-7" data-idregistro="7">
                            <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                            <a href="{{ route('pago.create', 7) }}" class="dropdown-item" type="button"><i class="fa fa-eye"></i> Pagar matrícula</a>
                        </div>
                    </div>
                </td>
                <td>0000008</td>
                <td>Maria Aguirre lazo</td>
                <td>1</td>
                <td>S/. 350.00</td>
                <td>S/. 200.00</td>
                <td>S/. 150.00</td>
            </tr>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4" class="text-center"><b>Total Final</b></td>
                <td>S/. 700.00</td>
                <td>S/. 450.00</td>
                <td>S/. 250.00</td>
            </tr>
        </tfoot>
    </table>
    <p>
        Mostrando del registro 7 al 1 de un total de 2 registros
    </p>


</div>
