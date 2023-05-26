@if(count($registros) > 0)

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Imagen</th>
                <th>Código</th>
                <th>Nombre</th>
                <th>Categoria</th>
                <th>Precio ({{ $monedaGeneral->simbolo }})</th>
                <th>Stock</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>

            </thead>

            <tbody>

            @foreach($registros AS $producto)
                <tr>
                    <td class="text-center text-nowrap">
                        <img class="img-thumbnail" style="width: 120px;height: 80px" src="{{ asset($producto->path_imagen) }}" alt="">
                    </td>
                    <td class="text-nowrap">{{ str_pad($producto->idproducto,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td>{{ $producto->nombre_recortado }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td class="text-nowrap">{{ $producto->precio }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td class="text-nowrap">{!! $producto->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center text-nowrap">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $producto->idproducto}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $producto->idproducto}}" data-idproducto="{{ $producto->idproducto}}">
                                @if($producto->estado)
                                    <a class="dropdown-item" target="_blank" href="{{ route('web.productos.detalle',$producto->slug_producto) }}"><i class="fa fa-eye"></i> Ver</a>
                                @endif

                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($producto->estado)
                                    <button class="dropdown-item btnModalInhabilitar" type="button"><i class="fa fa-times"></i> Inhabilitar</button>
                                @else
                                    <button class="dropdown-item btnModalHabilitar" type="button"><i class="fa fa-check"></i> Habilitar</button>
                                @endif
{{--                                <button class="dropdown-item btnModalEliminar" type="button"><i class="fa fa-trash"></i> Eliminar</button>--}}
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <p>
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $registros->currentPage() }}">
            Mostrando del registro {{ $registros->firstItem() }} al {{ $registros->lastItem() }} de un total de {{ $registros->total() }} registros
        </p>
        <div>
            {{ $registros->links() }}
        </div>
    </div>

@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>

    </div>



@endif

