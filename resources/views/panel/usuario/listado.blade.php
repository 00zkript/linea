@if(count($usuarios) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Código</th>
                <th>Imagen</th>
                {{-- <th>Cargo</th> --}}
                <th>Usuario</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody class="text-nowrap">

            @foreach($usuarios AS $u)
                <tr>
                    <td>{{str_pad($u->idusuario,7,0,STR_PAD_LEFT) }}</td>
                    <td class="text-center">
                        @if(!empty($u->imagen))
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/img/usuarios/'.$u->imagen) }}" alt="">
                        @else
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/default/foto_defecto.jpg') }}" alt="">
                        @endif
                    </td>
                    {{-- <td>{{ $u->cargo}}</td> --}}
                    <td>{{ $u->usuario }}</td>
                    <td>{{ $u->correo}}</td>
                    <td>{!! $u->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $u->idusuario }}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $u->idusuario }}" data-idusuario="{{ $u->idusuario }}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($u->estado)
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $usuarios->currentPage() }}">
            Mostrando del registro {{ $usuarios->firstItem() }} al {{ $usuarios->lastItem() }} de un total de {{ $usuarios->total() }} registros
        </p>

        <div>
            {{ $usuarios->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
