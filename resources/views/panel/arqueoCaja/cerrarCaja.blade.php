
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
                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoFinalSoles">Monto final:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control" name="montoFinalSoles" id="montoFinalSoles" placeholder="Monto final" value="1800"  required>

                                    <span class="input-group-text"> && </span>

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$ </span>
                                    </div>
                                    <input type="text" class="form-control" name="montoFinalDolares" id="montoFinalDolares" placeholder="Monto final" value="1800"  required>

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


