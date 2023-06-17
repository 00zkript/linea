@if (count($registros) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Código</th>
                    <th>fecha</th>
                    <th>Monto inicial (S/.)</th>
                    <th>Monto inicial ($)</th>
                    <th>Monto final (S/.)</th>
                    <th>Monto final ($)</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($registros as $item)
                    <tr>
                        <td>{{ str_pad($item->idarqueo_caja,7,0,STR_PAD_LEFT) }}</th>
                        <td>{{ now()->parse($item->fecha)->format('d/m/Y') }}</th>
                        <td> S/. {{ number_format($item->monto_inicial_sol,2,'.','') }}</th>
                        <td> $ {{ number_format($item->monto_inicial_dolar,2,'.','') }}</th>
                        <td> S/. {{ number_format($item->monto_final_sol,2,'.','') }}</th>
                        <td> $ {{ number_format($item->monto_final_dolar,2,'.','') }}</th>
                        <td class="text-center">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu-{{$item->idarqueo_caja}}" data-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false">
                                    Seleccione
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu-{{$item->idarqueo_caja}}" data-idarqueo_caja="{{$item->idarqueo_caja}}">
                                    <button class="dropdown-item btnModalVer" type="button"><i class="fa fa-eye"></i> Ver</button>
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
