@extends('panel.template.index')
@section('cuerpo')


    <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color #2a3f54">
                             <p style="font-size 20px" class="card-title text-center text-white mb-0">Nueva Ventas</p>
                        </div>
                        <div class="card-body pl-4 pr-4" >
                            <div id="instanceVue">
                                <venta-form :carrito_id="{{ $carritoID }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

@push('js')
@endpush

