@if(count($categorias) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Código</th>
                <th>Nombre</th>
                <th>Nivel</th>
                <th>Orden</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($categorias AS $c)
                <tr>
                    <td class="text-nowrap">{{str_pad($c->idcategoria,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{ $c->nombre}}</td>
                    <td>{{ $c->nivel}}</td>
                    <td>{{ $c->orden}}</td>
                    <td class="text-nowrap">{!! $c->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center text-nowrap">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $c->idcategoria}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $c->idcategoria}}" data-idcategoria="{{ $c->idcategoria}}">
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $categorias->currentPage() }}">
            Mostrando del registro {{ $categorias->firstItem() }} al {{ $categorias->lastItem() }} de un total de {{ $categorias->total() }} registros
        </p>

        <div>
            {{ $categorias->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
