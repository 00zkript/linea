
<!-- Modal center -->
<div class="modal fade" id="advertenciaCerrarCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="advertenciaCerrarCajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="advertenciaCerrarCajaModalCenterTitle">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeAdevertenciaCerrarCaja">No</button>
                <button type="button" class="btn btn-primary" id="storeCerrarCaja">Si</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="cerrarCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="cerrarCajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cerrarCajaModalCenterTitle">¡Atención!</h5>
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
                <button type="button" class="btn btn-secondary" id="resetCerrarCaja" >Cancelar</button>
                <button type="button" class="btn btn-primary" id="openAdevertenciaCerrarCaja" >Guardar</button>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script>
        const modalesCerrarCaja = () => {
            $(document).on( 'click', '#openAdevertenciaCerrarCaja', function (e) {
                e.preventDefault();
                $('#cerrarCajaModalCenter').modal('hide');
                $('#advertenciaCerrarCajaModalCenter').modal('show');
            });

            $(document).on( 'click', '#closeAdevertenciaCerrarCaja', function (e) {
                e.preventDefault();
                $('#cerrarCajaModalCenter').modal('show');
                $('#advertenciaCerrarCajaModalCenter').modal('hide');
            });

        }

        const storeCerrarCaja = () => {
            $(document).on( 'click', '#resetCerrarCaja', function (e) {
                e.preventDefault();
                // $('#frmCerrarCaja')[0].reset();
                $('#cerrarCajaModalCenter').modal('hide');
            });

            $(document).on( 'click', '#storeCerrarCaja', function (e) {
                e.preventDefault();
                console.log('cerrar caja....');
                $('#advertenciaCerrarCajaModalCenter').modal('hide');
            });

        }

        (() => {
            modalesCerrarCaja();
            storeCerrarCaja();
        })()



    </script>
@endpush


