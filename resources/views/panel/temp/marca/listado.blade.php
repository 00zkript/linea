@if(count($marcas) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Código</th>
                <th>Imagen</th>
                <th>Marca</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($marcas AS $m)
                <tr>
                    <td class="text-nowrap">{{str_pad($m->idmarca,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td class="text-center">
                        @if(!empty($m->imagen))
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/img/marcas/'.$m->imagen) }}" alt="">
                        @else
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/vacio_img.jpg') }}" alt="">
                        @endif
                    </td>
                    <td>{{ $m->nombre}}</td>
                    <td class="text-nowrap">{!! $m->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center text-nowrap">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $m->idmarca}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $m->idmarca}}" data-idmarca="{{ $m->idmarca}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($m->estado)
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $marcas->currentPage() }}">
            Mostrando del registro {{ $marcas->firstItem() }} al {{ $marcas->lastItem() }} de un total de {{ $marcas->total() }} registros
        </p>

        <div>
            {{ $marcas->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
