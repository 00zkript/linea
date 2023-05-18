<div class="modal fade" id="advertenciaAbrirCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="advertenciaAbrirCajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="advertenciaAbrirCajaModalCenterTitle">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de continuar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeAdevertenciaAbrirCaja">No</button>
                <button type="button" class="btn btn-primary" id="storeAbrirCaja">Si</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="abrirCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="abrirCajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="abrirCajaModalCenterTitle">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false;" id="frmAbrirCaja">
                    <div class="row">
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="caja">Caja:</label>
                                <input type="text" class="form-control" name="caja" id="caja" placeholder="Caja" value="caja 1" readonly>
                            </div>
                        </div>
                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="saldoAnterior">Saldo anterior:</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control format-number-price" name="saldoAnterior" id="saldoAnterior" placeholder="Saldo anterior" value="3500" readonly >
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoInicial">Monto inicial: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control format-number-price" name="montoInicial" id="montoInicial" placeholder="Monto inicial" required >
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="resetAbrirCaja" >Revertir</button>
                <button type="submit" class="btn btn-primary" id="openAdevertenciaAbrirCaja" >Guardar</button>
            </div>
        </div>
    </div>
</div>

@push('js')

    <script type="module">

        if ( localStorage.getItem('showAbrirCaja') != 1) {
            $('#abrirCajaModalCenter').modal('show');
        }

        const modalesAbrirCaja = () => {
            $(document).on( 'click', '#openAdevertenciaAbrirCaja', function (e) {
                e.preventDefault();
                $('#abrirCajaModalCenter').modal('hide');
                $('#advertenciaAbrirCajaModalCenter').modal('show');
            });

            $(document).on( 'click', '#closeAdevertenciaAbrirCaja', function (e) {
                e.preventDefault();
                $('#abrirCajaModalCenter').modal('show');
                $('#advertenciaAbrirCajaModalCenter').modal('hide');
            });

        }


        const storeAbrirCaja = () => {
            $(document).on( 'click', '#resetAbrirCaja', function (e) {
                e.preventDefault();
                $('#frmAbrirCaja')[0].reset();
            });

            $(document).on( 'click', '#storeAbrirCaja', function (e) {
                e.preventDefault();
                console.log('save caja....');
                localStorage.setItem('showAbrirCaja', 1);
                $('#advertenciaAbrirCajaModalCenter').modal('hide');
            });
        }


        (() => {
            modalesAbrirCaja();
            storeAbrirCaja();
        })()

    </script>
@endpush
