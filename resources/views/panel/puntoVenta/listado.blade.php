@if(count($puntoVentas) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Telefono</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody class="text-nowrap">

            @foreach($puntoVentas AS $p)
                <tr>
                    <td>{{str_pad($p->idpunto_venta,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{ $p->nombre}}</td>
                    <td>{{ $p->direccion}}</td>
                    <td>{{ $p->telefono}}</td>
                    <td>{!! $p->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $p->idpunto_venta}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $p->idpunto_venta}}" data-idpunto_venta="{{ $p->idpunto_venta}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($p->estado)
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $puntoVentas->currentPage() }}">
            Mostrando del registro {{ $puntoVentas->firstItem() }} al {{ $puntoVentas->lastItem() }} de un total de {{ $puntoVentas->total() }} registros
        </p>

        <div>
            {{ $puntoVentas->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
