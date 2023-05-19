{{-- @if(count($registros) > 0)
    <div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Monto</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody>

            @foreach($registros AS $item)
                <tr>
                    <td>{{ $item->monto }}</td>
                    <td>{{ $item->fecha }}</td>
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
@endif --}}

<div class="table-responsive">
        <table class="table table-bordered text-center">
            <thead class="thead-dark">
            <tr class="text-center">
                <th>Monto</th>
                <th>Fecha</th>
            </tr>
            </thead>
            <tbody>
                <tr>
                    <td>S/. 3.82  = $ 1.00</td>
                    <td>01/01/2023</td>
                </tr>
                <tr>
                    <td>S/. 3.82  = $ 1.00</td>
                    <td>02/01/2023</td>
                </tr>
                <tr>
                    <td>S/. 3.82  = $ 1.00</td>
                    <td>03/01/2023</td>
                </tr>
                <tr>
                    <td>S/. 3.82  = $ 1.00</td>
                    <td>04/01/2023</td>
                </tr>
                <tr>
                    <td>S/. 3.82  = $ 1.00</td>
                    <td>05/01/2023</td>
                </tr>

            </tbody>
        </table>
        <p>
            Mostrando del registro 1 al 1 de un total de 5 registros
        </p>

    </div>


