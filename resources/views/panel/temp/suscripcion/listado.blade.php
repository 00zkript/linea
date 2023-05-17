@if(count($suscripciones) > 0)
    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Código</th>
                <th>Email</th>
                <th>Fecha de registro</th>
            </tr>
            </thead>
            <tbody>

            @foreach($suscripciones AS $item)
                <tr>
                    <td class="text-center" >{{ str_pad($item->idsuscripcion,7,'0000000',STR_PAD_LEFT) }}</td>
                    <td class="text-center" >{{ $item->email }}</td>
                    <td class="text-center" >{{ now()->parse($item->fecha_registro)->format('d / m / Y   ||   h:i A')  }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <p>
            <input type="hidden" name="paginaActual" id="paginaActual" value="{{$suscripciones->currentPage()}}">
            Mostrando del registro {{$suscripciones->firstItem()}} al {{$suscripciones->lastItem()}} de un total de {{$suscripciones->total()}} registros
        </p>

        <div>
            {{$suscripciones->links()}}
        </div>

    </div>
@else
    <div class="alert alert-danger">
        <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
    </div>
@endif

