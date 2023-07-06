

    <div class="modal fade" id="advertenciaAbrirArqueoCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="advertenciaAbrirArqueoCajaModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="advertenciaAbrirArqueoCajaModalCenterTitle">¡Atención!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de continuar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="closeAdevertenciaAbrirArqueoCaja">No</button>
                    <button type="button" class="btn btn-primary" id="storeAbrirArqueoCaja">Si</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="abrirArqueoCajaModalCenter" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="abrirArqueoCajaModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <form onsubmit="return false;" id="frmAbrirCaja">
                        <div class="row">

                            <div class="col-12 text-center mb-3">
                                <h4>Abrir nueva caja</h4>
                            </div>

                            <div class="col-12 form-group">
                                <label for="fechaAbrirCaja">Fecha de inicio de caja</label>
                                <input type="date" class="form-control" name="fechaAbrirCaja" id="fechaAbrirCaja" value="{{ $currentDate }}" readonly>
                            </div>

                            <div class="col-md-12 col-12 form-group">
                                <label for="caja">Caja:</label>
                                <input type="text" class="form-control" name="caja" id="caja" placeholder="Caja" value="{{ $usuario }}" readonly>
                            </div>

                            {{-- <div class="col-12 form-group">
                                <label>Cierre de caja anterior:</label>
                                <div class="row">
                                    <div class="col-md-6 col-12 input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                        <input type="text" class="form-control format-number-price" name="cierreCajaAnteriorSoles" id="cierreCajaAnteriorSoles" placeholder="Cierre anterior soles" value="{{ number_format($arqueoCajaAnterior->monto_final_sol ?? '0.00',2,'.','') }}" readonly >
                                    </div>
                                    <div class="col-md-6 col-12 input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                        <input type="text" class="form-control format-number-price" name="cierreCajaAnteriorDolar" id="cierreCajaAnteriorDolar" placeholder="Cierre anterior dolares" value="{{ number_format($arqueoCajaAnterior->monto_i_finalolar ?? '0.00',2,'.','') }}" readonly >
                                    </div>
                                </div>
                            </div> --}}
                            {{-- <div class="col-12 form-group">
                                <label for="montoCambio">Monto de cambio: </label>
                                <div class="input-group">
                                    <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                    <input type="text" class="form-control format-number-price" name="montoCambio" id="montoCambio" placeholder="Monto de cambio ({{ now()->format('d/m/Y') }})" required >
                                    <div class="input-group-end"> <span class="input-group-text"> = $ 1.00 </span> </div>
                                </div>
                            </div> --}}
                            <div class="col-12 form-group">
                                <label for="montoInicial">Monto inicial: </label>
                                <div class="row">
                                    <div class="col-md-12 col-12 input-group">
                                        <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                        <input type="text" class="form-control format-number-price" name="montoInicialSoles" id="montoInicialSoles" placeholder="Monto inicial soles" required value="0.00" >

                                        {{-- <span class="input-group-text"> && </span>

                                        <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                        <input type="text" class="form-control format-number-price" name="montoInicialDolares" id="montoInicialDolares" placeholder="Monto inicial dolares" required > --}}
                                    </div>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" id="resetAbrirArqueoCaja" >Revertir</button>
                    <button type="submit" class="btn btn-primary" id="openAdevertenciaAbrirArqueoCaja" >Guardar</button>
                </div>
            </div>
        </div>
    </div>

    @push('js')
        <script type="module">

            const abrirArqueoAdvertencia = () => {
                $('#abrirArqueoCajaModalCenter').modal('hide');
                $('#advertenciaAbrirArqueoCajaModalCenter').modal('show');
            }

            const abrirArqueoModal = () => {
                $('#abrirArqueoCajaModalCenter').modal('show');
                $('#advertenciaAbrirArqueoCajaModalCenter').modal('hide');
            }

            const validateArqueoCaja = () => {
                const errors = [];

                // if (!$('#montoCambio').val()) {
                //     errors.push("Por favor, ingresa un monto de cambio.");
                // }
                if (!$('#montoInicialSoles').val()) {
                    errors.push("Por favor, ingresa un monto inicial en soles.");
                }
                // if (!$('#montoInicialDolares').val()) {
                //     errors.push("Por favor, ingresa un monto inicial en dólares.");
                // }

                return errors;
            }

            const modalesAbrirArqueoCaja = () => {
                $(document).on( 'click', '#openAdevertenciaAbrirArqueoCaja', function (e) {
                    e.preventDefault();

                    const errors = validateArqueoCaja();
                    if (errors.length > 0) {
                        notificacion('error','Errores encontrados', listErrorsForm(errors));
                        return;
                    }

                    abrirArqueoAdvertencia();

                });
                $(document).on( 'click', '#closeAdevertenciaAbrirArqueoCaja', function (e) {
                    e.preventDefault();

                    abrirArqueoModal();
                });
            }

            const storeAbrirArqueoCaja = () => {
                $(document).on( 'click', '#resetAbrirArqueoCaja', function (e) {
                    e.preventDefault();
                    $('#frmAbrirCaja')[0].reset();
                });


                let clickDisabledSave = false;
                $(document).on( 'click', '#storeAbrirArqueoCaja', function (e) {
                    e.preventDefault();
                    if (clickDisabledSave) return;
                    clickDisabledSave = true;

                    const form = new FormData(document.querySelector('#frmAbrirCaja'));

                    axios.post("{{ route('arqueoCaja.abrir') }}",form)
                    .then( response => {
                        const data = response.data;
                        notificacion( 'success', '¡Felicidades!', 'Se abrió la caja correctamente.' );

                        $('#advertenciaAbrirArqueoCajaModalCenter').modal('hide');
                    })
                    .catch( error => {
                        clickDisabledSave = false;
                        if ( error.response === undefined) {
                            console.error(error);
                            return;
                        }

                        const response = error.response;
                        const data = response.data;
                        stop();


                        if (response.status == 422){
                            notificacion("error","Error",listErrors(data));
                        }

                        if (response.status == 500 || response.status == 419){
                            notificacion("error","Error","Error del servidor, contácte con soporte.");
                        }

                        if (response.status == 400){
                            notificacion("error","Error",data.mensaje);
                        }

                        console.log(data);
                        return false;

                    } );

                });
            }



            (() => {
                modalesAbrirArqueoCaja();
                storeAbrirArqueoCaja();
                @if (!$arqueoCajaCurrent)
                    abrirArqueoModal();
                @endif
            })()

        </script>
    @endpush


