@if(count($asesores) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Foto</th>
                <th>Nombres</th>
                <th>Celular</th>
                <th>Whatsapp</th>
                <th>Telegram</th>
                <th>Correo</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody>

            @foreach($asesores AS $a)
                <tr>
                    <td class="text-center">
                        @if(!empty($a->foto))
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/img/asesores/'.$a->foto) }}" alt="">
                        @else
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/img/asesores/foto_defecto.jpg') }}" alt="">
                        @endif
                    </td>
                    <td>{{ $a->nombres}}</td>
                    <td class="text-nowrap">{{ $a->celular}}</td>
                    <td class="text-nowrap">{{ $a->whatsapp}}</td>
                    <td class="text-nowrap">{{ $a->telegram}}</td>
                    <td>{{ $a->correo}}</td>
                    <td class="text-nowrap">{!! $a->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center text-nowrap">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $a->idasesor}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $a->idasesor}}" data-idasesor="{{ $a->idasesor}}">
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($a->estado)
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $asesores->currentPage() }}">
            Mostrando del registro {{ $asesores->firstItem() }} al {{ $asesores->lastItem() }} de un total de {{ $asesores->total() }} registros
        </p>

        <div>
            {{ $asesores->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
