@if(count($popups) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center text-nowrap">
                <th>Orden</th>
                <th>Imagen</th>
                <th>Página</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            </thead>
            <tbody class="text-nowrap">

            @foreach($popups AS $b)
                <tr>
                    <td>{{ $b->orden}}</td>
                    <td class="text-center">
                        @if(!empty($b->imagen))
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/img/popup/'.$b->imagen) }}" alt="">
                        @else
                            <img class="img-thumbnail" style="width: 80px;height: 80px" src="{{ asset('panel/vacio_img.jpg') }}" alt="">
                        @endif
                    </td>
                    <td>{{ $b->pagina}}</td>
                    <td>{!! $b->estado ? '<label class="badge badge-success">Habilidado</label>' : '<label class="badge badge-danger">Inhabilitado</label>' !!}</td>
                    <td class="text-center">
                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{ $b->idpopup}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                Seleccione
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{ $b->idpopup}}" data-idpopup="{{ $b->idpopup}}">
                                <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
                                <button class="dropdown-item btnModalEditar" type="button"><i class="fa fa-pencil"></i> Editar</button>
                                @if($b->estado)
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
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{ $popups->currentPage() }}">
            Mostrando del registro {{ $popups->firstItem() }} al {{ $popups->lastItem() }} de un total de {{ $popups->total() }} registros
        </p>

        <div>
            {{ $popups->links() }}
        </div>

    </div>
@else

    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>

@endif
