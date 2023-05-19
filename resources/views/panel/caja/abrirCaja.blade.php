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

<div class="modal fade" id="abrirCajaModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="abrirCajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="abrirCajaModalCenterTitle">¡Atención!</h5>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
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

                        <div class="col-12">
                            <div class="form-group">
                                <label>Cierre de caja anterior:</label>
                                <div class="row">
                                    <div class="col-md-6 col-12 input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">S/. </span>
                                        </div>
                                        <input type="text" class="form-control format-number-price" name="cierreCajaAnteriorSoles" id="cierreCajaAnteriorSoles" placeholder="Cierre anterior soles" value="" readonly >
                                    </div>
                                    <div class="col-md-6 col-12 input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$ </span>
                                        </div>
                                        <input type="text" class="form-control format-number-price" name="cierreCajaAnteriorDolar" id="cierreCajaAnteriorDolar" placeholder="Cierre anterior dolares" value="" readonly >
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoCambio">Monto de cambio ({{ now()->format('d/m/Y') }}): </label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">S/. </span>
                                    </div>
                                    <input type="text" class="form-control format-number-price" name="montoCambio" id="montoCambio" placeholder="Monto de cambio ({{ now()->format('d/m/Y') }})" required >
                                    <div class="input-group-end">
                                        <span class="input-group-text"> = $ 1.00 </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="montoInicial">Monto inicial: </label>
                                <div class="row">
                                    <div class="col-md-12 col-12 input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">S/. </span>
                                        </div>
                                        <input type="text" class="form-control format-number-price" name="montoInicialSoles" id="montoInicialSoles" placeholder="Monto inicial soles" required >

                                        <span class="input-group-text"> && </span>

                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$ </span>
                                        </div>
                                        <input type="text" class="form-control format-number-price" name="montoInicialDolares" id="montoInicialDolares" placeholder="Monto inicial dolares" required >
                                    </div>
                                    <div class="col-md-6 col-12 input-group">
                                    </div>
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

        const validateNumber = (val, valDefault = 0) => {
            if (val === undefined || val === null || isNaN(parseFloat(val)) || isNaN(val)) {
                return isNaN(Number(valDefault)) ? 0 : Number(valDefault);
            }
            return Number(val);
        }

        const actionsAbrirCaja = () => {
        }


        (() => {
            modalesAbrirCaja();
            storeAbrirCaja();
            actionsAbrirCaja();
        })()

    </script>
@endpush
