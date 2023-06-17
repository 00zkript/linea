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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close" >No</button>
                    <button type="button" class="btn btn-primary" id="storeForm">Si</button>
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

                        <div class="col-12 form-group">
                            <label for="fechaCierreCaja">Fecha de cierre de caja</label>
                            <input type="date" class="form-control" name="fechaCierreCaja" id="fechaCierreCaja" value="{{ $fecha }}" readonly>
                        </div>


                        <div class="row ml-0 mr-0 pl-0 pr-0">
                            <div class="col-md-6 col-12 row ml-0 mr-0 pl-0 pr-0">
                                <div class="col-12"> <hr> <h3>Soles (S/.)</h3> <hr> </div>
                                <div class="col-12 row ml-0 mr-0 pl-0 pr-0">
                                    <div class="col-12 form-group">
                                        <label for="ingresosSol">Ingresos</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control" name="ingresosSol" id="ingresosSol" placeholder="ingresos caja" value="{{ number_format($ingresosSol,2,'.','') }}"  readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="egresosSol">Egresos</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control" name="egresosSol" id="egresosSol" placeholder="egresos caja" value="{{ number_format($egresosSol,2,'.','') }}"  readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="montoFinalSolEfectivo">Monto final (Efectivo)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalSolEfectivo" id="montoFinalSolEfectivo" value="{{ number_format($montoFinalSolEfectivo,2,'.','') }}"  required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="montoFinalSolTransferido">Monto final (Transferencía)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalSolTransferido" id="montoFinalSolTransferido" value="{{ number_format($montoFinalSolTransferido,2,'.','') }}"  required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="montoFinalSolFaltante">Monto faltante</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalSolFaltante" id="montoFinalSolFaltante" value="0.00"  required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="montoFinalSolSobrante">Monto sobrante</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalSolSobrante" id="montoFinalSolSobrante" value="0.00"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12 row ml-0 mr-0 pl-0 pr-0">
                                <div class="col-12"> <hr> <h3>Dolares ($)</h3> <hr> </div>
                                <div class="col-12 row ml-0 mr-0 pl-0 pr-0">
                                    <div class="col-12 form-group">
                                        <label for="ingresosDolar">Ingresos</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control" name="ingresosDolar" id="ingresosDolar" placeholder="ingresos caja" value="{{ number_format($ingresosDolar,2,'.','') }}"  readonly>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="egresosDolar">Egresos</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">S/. </span> </div>
                                            <input type="text" class="form-control" name="egresosDolar" id="egresosDolar" placeholder="egresos caja" value="{{ number_format($egresosDolar,2,'.','') }}"  readonly>
                                        </div>
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="montoFinalDolarEfectivo">Monto final (Efectivo)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalDolarEfectivo" id="montoFinalDolarEfectivo" value="{{ number_format($montoFinalDolarEfectivo,2,'.','') }}"  required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="montoFinalDolarTransferido">Monto final (Transferencía)</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalDolarTransferido" id="montoFinalDolarTransferido" value="{{ number_format($montoFinalDolarTransferido,2,'.','') }}"  required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="montoFinalDolarFaltante">Monto faltante</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalDolarFaltante" id="montoFinalDolarFaltante" value="0.00"  required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="montoFinalDolarSobrante">Monto sobrante</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend"> <span class="input-group-text">$ </span> </div>
                                            <input type="text" class="form-control format-number-price" name="montoFinalDolarSobrante" id="montoFinalDolarSobrante" value="0.00"  required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="reset" class="btn btn-secondary"><i class="fa fa-refresh"></i> Limpiar</button>
                                <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardaar</button>
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

        const validateForm = () => {
            const errors = [];

            const fields = [
                $('#montoFinalSolEfectivo').val(),
                $('#montoFinalSolTransferido').val(),
                $('#montoFinalDolarEfectivo').val(),
                $('#montoFinalDolarTransferido').val(),
            ]

            if ( fields.every(item => !item ||  parseFloat(item) === 0) ) {
                errors.push("Debes agregar al menos un monto válido.");
            }

            return errors;
        }

        const storeCerrarArqueoCaja = () => {
            $(document).on( 'submit', '#frmCerrarCaja', function (e) {
                e.preventDefault();
                $('#advertenciaArqueoCerrarCajaModalCenter').modal('show');
            });

            $(document).on( 'click', '#storeForm', function (e) {
                e.preventDefault();

                const errors  = validateForm();

                if ( errors.length > 0 ) {
                    notificacion('error','Errores encontrado', listErrorsForm(errors));
                    return;
                }

                const form = new FormData(document.querySelector('#frmCerrarCaja'));

                axios.post("{{ route('arqueoCaja.cerrarStore') }}",form)
                .then( response => {
                    const data = response.data;
                    $('#advertenciaArqueoCerrarCajaModalCenter').modal('hide');

                })
                .catch( errorCatch )

            });



        }

        (() => {
            storeCerrarArqueoCaja();
        })()



    </script>
@endpush


