@if(count($costoEnvios) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Código</th>
                <th>Departamento</th>
                <th>Provincia</th>
                <th>Distrito</th>
                <th>Precio</th>
{{--                <th>Descripción</th>--}}
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($costoEnvios AS $c)
                <tr>
                    <td class="text-nowrap">{{str_pad($c->idcosto_envio,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{ $c->departamento ?: 'General' }}</td>
                    <td>{{ $c->provincia ?: 'General' }}</td>
                    <td>{{ $c->distrito ?: 'General' }}</td>
                    <td class="text-nowrap">{{ $monedaGeneral->format($c->precio) }}</td>
{{--                    <td>{!! $c->descripcion !!}</td>--}}
                    <td class="text-nowrap">{!! $c->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $c->idcosto_envio}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $c->idcosto_envio}}" data-idcosto_envio="{{ $c->idcosto_envio}}">
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $costoEnvios->currentPage() }}">
            Mostrando del registro {{ $costoEnvios->firstItem() }} al {{ $costoEnvios->lastItem() }} de un total de {{ $costoEnvios->total() }} registros
        </p>

        <div>
            {{ $costoEnvios->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
