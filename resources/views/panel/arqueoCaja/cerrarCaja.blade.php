
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


<div class="modal fade" id="cerrarArqueoCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="cerrarArqueoCajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cerrarArqueoCajaModalCenterTitle">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;" id="frmCerrarCaja">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>Cerrar Caja</h2>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="fechaCierre">Fecha de Cierre de caja</label>
                                <input type="date" class="form-control" name="fechaCierre" id="fechaCierre" value="{{ now()->format('Y-m-d') }}" readonly>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoFinalSoles">Ingresos</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control" name="ingresosCaja" id="ingresosCaja" placeholder="ingresos caja" value="400"  readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoFinalSoles">Egresos</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control" name="egresosoCaja" id="egresosoCaja" placeholder="egresos caja" value="500"  readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoFinalSoles">Monto final (Efectivo)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control" name="montoFinalEfectivoSoles" id="montoFinalEfectivoSoles" placeholder="Monto final" value="1800"  required>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$ </span>
                                    </div>
                                    <input type="text" class="form-control" name="montoFinalEfectivoDolares" id="montoFinalEfectivoDolares" placeholder="Monto final" value="1800"  required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoFinalSoles">Monto final (transferencía)</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control" name="montoFinalTransferenciaSoles" id="montoFinalTranferenciaSoles" placeholder="Monto final" value="1800"  required>
                                </div>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$ </span>
                                    </div>
                                    <input type="text" class="form-control" name="montoFinalTransferenciaDolares" id="montoFinalTransferenciaDolares" placeholder="Monto final" value="1800"  required>
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="resetCerrarArqueoCaja" >Cancelar</button>
                <button type="button" class="btn btn-primary" id="openAdevertenciaCerrarAqueoCaja" >Guardar</button>
            </div>
        </div>
    </div>
</div>

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


