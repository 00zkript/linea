@extends('panel.template.index')

@section('cuerpo')
    <!-- Modal center -->
    <div class="modal fade" id="advertenciaArqueoCerrarCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="advertenciaArqueoCerrarCajaModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="advertenciaArqueoCerrarCajaModalCenterTitle">¡Atención!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de continuar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeAdevertenciaCerrarArqueoCaja">No</button>
                    <button type="button" class="btn btn-primary" id="storeCerrarArqueoCaja">Si</button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <div class="card-header text-center">
                <h3>Cerrar Caja</h3>
            </div>
            <div class="card-body">
                <form onsubmit="return false;" id="frmCerrarCaja">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="fechaCierreCaja">Fecha de cierre de caja</label>
                                <input type="date" class="form-control" name="fechaCierreCaja" id="fechaCierreCaja" value="{{ $fecha }}" readonly>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="montoFinalSoles">Ingresos</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                    <input type="text" class="form-control" name="ingresosCaja" id="ingresosCaja" placeholder="ingresos caja" value="{{ $ingresos }}"  readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="montoFinalSoles">Egresos</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                    <input type="text" class="form-control" name="egresosoCaja" id="egresosoCaja" placeholder="egresos caja" value="{{ $egresos }}"  readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row ml-0 mr-0 pl-0 pr-0">
                            <div class="col-md-6 col-12 row ml-0 mr-0 pl-0 pr-0">
                                <div class="col-12"> <hr> <h3>Soles (S/.)</h3> <hr> </div>
                                <div class="col-12 row ml-0 mr-0 pl-0 pr-0">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoFinalEfectivoSoles">Monto final (Efectivo)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                                <input type="text" class="form-control" name="montoFinalEfectivoSoles" id="montoFinalEfectivoSoles" value="{{ $arqueoCaja->monto_actual_sol_efectivo }}"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoFinalTransferenciaSoles">Monto final (transferencía)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                                <input type="text" class="form-control" name="montoFinalTransferenciaSoles" id="montoFinalTransferenciaSoles" value="{{ $arqueoCaja->monto_actual_sol_transferido }}"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoFaltanteSoles">Monto faltante</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                                <input type="text" class="form-control" name="montoFaltanteSoles" id="montoFaltanteSoles" value=""  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoSobranteSoles">Monto sobrante</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                                <input type="text" class="form-control" name="montoSobranteSoles" id="montoSobranteSoles" value=""  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 row ml-0 mr-0 pl-0 pr-0">
                                <div class="col-12"> <hr> <h3>Dolares ($)</h3> <hr> </div>
                                <div class="col-12 row ml-0 mr-0 pl-0 pr-0">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoFinalEfectivoSoles">Monto final (Efectivo)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                                <input type="text" class="form-control" name="montoFinalEfectivoSoles" id="montoFinalEfectivoSoles" value="{{ $arqueoCaja->monto_actual_dolar_efectivo }}"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoFinalTransferenciaSoles">Monto final (transferencía)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                                <input type="text" class="form-control" name="montoFinalTransferenciaSoles" id="montoFinalTransferenciaSoles" value="{{ $arqueoCaja->monto_actual_dolar_transferido }}"  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoFaltanteSoles">Monto faltante</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                                <input type="text" class="form-control" name="montoFaltanteSoles" id="montoFaltanteSoles" value=""  required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="montoSobranteSoles">Monto sobrante</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                                <input type="text" class="form-control" name="montoSobranteSoles" id="montoSobranteSoles" value=""  required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>



                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



@push('js')

    <script>
        const modalesCerrarArqueoCaja = () => {
            $(document).on( 'click', '#openAdevertenciaCerrarAqueoCaja', function (e) {
                e.preventDefault();
                $('#cerrarArqueoCajaModalCenter').modal('hide');
                $('#advertenciaArqueoCerrarCajaModalCenter').modal('show');
            });

            $(document).on( 'click', '#closeAdevertenciaCerrarArqueoCaja', function (e) {
                e.preventDefault();
                $('#cerrarArqueoCajaModalCenter').modal('show');
                $('#advertenciaArqueoCerrarCajaModalCenter').modal('hide');
            });

        }

        const storeCerrarArqueoCaja = () => {
            $(document).on( 'click', '#resetCerrarArqueoCaja', function (e) {
                e.preventDefault();
                // $('#frmCerrarCaja')[0].reset();
                $('#cerrarArqueoCajaModalCenter').modal('hide');
            });

            $(document).on( 'click', '#storeCerrarArqueoCaja', function (e) {
                e.preventDefault();
                console.log('cerrar caja....');
                $('#advertenciaArqueoCerrarCajaModalCenter').modal('hide');
            });

        }

        (() => {
            modalesCerrarArqueoCaja();
            storeCerrarArqueoCaja();
        })()



    </script>
@endpush


