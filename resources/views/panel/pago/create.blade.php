@extends('panel.template.index')
@section('cuerpo')

    <!-- Modal center -->
    <div class="modal fade" id="asegurarPagoModalCenter" tabindex="-1" role="dialog" aria-labelledby="asegurarPagoModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="asegurarPagoModalCenterTitle">¡Atención!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas continuar? Esta acción puede tener implicaciones importantes. Por favor, tómate un momento para reflexionar antes de tomar una decisión.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary asegurarPagoModalCenterSave">Pagar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal center -->
    <div class="modal fade" id="cancelarPagoModalCenter" tabindex="-1" role="dialog" aria-labelledby="cancelarPagoModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cancelarPagoModalCenterTitle">¡Atención!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ¿Está seguro que desea continuar?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary cancelarPagoModalSave">Si</button>
                </div>
            </div>
        </div>
    </div>




    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Registros</p>
                    </div>
                    <div class="card-body pl-4 pr-4">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="form-group">
                                    <label for="matricula">Buscar matrícula: </span></label>
                                    <input type="text" name="matricula" id="matricula" class="form-control"  placeholder="Matrícula" @if($idmatricula) value="(Matrícula - 0000007) Juan Perez Mancilla" readonly @endif>
                                </div>
                            </div>
                            <div class="result">
                                @if ($idmatricula)
                                <div class="col-md-12 col-12">
                                    <h2 class="text-center">Código de matrícula: 0000007 </h2>
                                </div>
                                <div class="col-md-10 offset-1 col-12 mt-3">
                                    <p>
                                        <b>Concepto:</b> Nueva matrícula <br>
                                    </p>
                                    <p>
                                        <b>Alumno:</b> Juan Perez Mancilla <br>
                                        <b>Documento </b>identidad: DNi  - 87654321 <br>
                                    </p>
                                    <p>
                                        <b>Temporada:</b>  verano 2023 <br>
                                        <b>Programa:</b> niños <br>
                                        <b>Piscina:</b> piscina grande <br>
                                        <b>Carril </b>: 4 <br>
                                        <b>Actividad semanal:</b> L-M-V <br>
                                    </p>
                                    <p>
                                        <b>Caja:</b> caja1 <br>
                                        <b>Sucursal:</b> Sucursal 1 <br>
                                        <b>Dirección:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
                                    </p>
                                </div>
                                @endif
                            </div>
                        </div>

                        <form onsubmit="return false;" id="frmSavePago" style="{{ $idmatricula ? '': 'display: none;' }}">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-md-10 col-12 mt-5">
                                    <div class="row">
                                        <div class="col-md-6 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="modoPago">Modo pago:</label>
                                                        <select class="form-control" name="modoPago" id="modoPago" title="Modo pago" >
                                                            <option value="" hidden selected >[---Seleccione---]</option>
                                                            <option value="1">Pago efectivo</option>
                                                            <option value="2">Pago tranferencia</option>
                                                            <option value="3">Ambos</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="moneda">Moneda:</label>
                                                        <select class="form-control" name="moneda" id="moneda" title="Moneda" >
                                                            <option value="" selected hidden>[---Seleccione---]</option>
                                                            <option value="1">Soles (S/.)</option>
                                                            <option value="2">Dolares ($)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12 montosToggle monedaSoles" style="display: none;" >
                                                    <div class="form-group">
                                                        <label for="montoEfectivoSoles">Monto efectivo:</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">S/.</span>
                                                            </div>
                                                            <input type="text" class="form-control format-number-price" name="montoEfectivoSoles" id="montoEfectivoSoles" placeholder="Monto efectivo" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 montosToggle monedaSoles" style="display: none;" >
                                                    <div class="form-group">
                                                        <label for="montoTranferidoSoles">Monto Tranferido:</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">S/.</span>
                                                            </div>
                                                            <input type="text" class="form-control format-number-price" name="montoTranferidoSoles" id="montoTranferidoSoles" placeholder="Monto efectivo" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 montosToggle monedaDolares" style="display: none;" >
                                                    <div class="form-group">
                                                        <label for="montoEfectivoDolares">Monto efectivo </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" class="form-control format-number-price" name="montoEfectivoDolares" id="montoEfectivoDolares" placeholder="Monto efectivo" >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 montosToggle monedaDolares" style="display: none;" >
                                                    <div class="form-group">
                                                        <label for="montoTranferidoDolares">Monto Tranferido:</label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">$</span>
                                                            </div>
                                                            <input type="text" class="form-control format-number-price" name="montoTranferidoDolares" id="montoTranferidoDolares" placeholder="Monto efectivo" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="row-">
                                                <div class="col-12 form-group row">
                                                    <label for="montoTotal" class="col-md-4 col-form-label" >Monto Total</label>
                                                    <div class="col-md-8 input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">S/.</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="montoTotal" value="350.00" placeholder="Monto Total" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 form-group row">
                                                    <label for="montoPagar" class="col-md-4 col-form-label" >Monto a pagar</label>
                                                    <div class="col-md-8 input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">S/.</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="montoPagar" value="0.00" placeholder="Monto a pagar" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 form-group row">
                                                    <label for="igv" class="col-md-4 col-form-label" >IGV</label>
                                                    <div class="col-md-8 input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">S/.</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="igv" value="0.00 " placeholder="IGV" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 form-group row">
                                                    <label for="deuda" class="col-md-4 col-form-label" >Deuda</label>
                                                    <div class="col-md-8 input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">S/.</span>
                                                        </div>
                                                        <input type="text" class="form-control" id="deuda" value="0.00" placeholder="Deuda" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-12 mt-5 d-flex justify-content-center">
                                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#cancelarPagoModalCenter">Cancelar</button>
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#asegurarPagoModalCenter">Pagar</button>
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
        </div>
    </div>

@endsection

@push('js')
    <script>

        const cambioMoneda = "3.82";
        const montoTotal = "350.00";

        const modals = () => {

            $(document).on( 'click', '.cancelarPagoModalSave', function (e) {
                e.preventDefault();
                $('#frmSavePago')[0].reset();
                $('#cancelarPagoModalCenter').modal('hide');
            });

            $(document).on( 'click', '.asegurarPagoModalCenterSave', function (e) {
                e.preventDefault();
                $('#frmSavePago')[0].reset();
                $('#asegurarPagoModalCenter').modal('hide');

                notificacion('success','!Felicidades!','¡El pago se registró con éxito!');

                setTimeout(() => {
                    window.location.href = "{{ route('pago.index') }}";
                }, 1000 * 2);

            });


        }

        const actions = () => {
            $(document).on( 'change', '#moneda', function (e) {
                e.preventDefault();
                const val = $(this).val();

                const selectorMoneda = {
                    1 : 'monedaSoles',
                    2 : 'monedaDolares',
                }

                $('.montosToggle').hide();
                $('.'+selectorMoneda[val]).show();


            });

            $(document).on( 'input', '#montoEfectivoDolares, #montoTranferidoDolares', function (e) {
                e.preventDefault();
                const montoEfectivoDolares = Number($('#montoEfectivoDolares').val() ?? 0);
                const montoTranferidoDolares = Number($('#montoTranferidoDolares').val() ?? 0);

                const montoPagar = ( montoEfectivoDolares + montoTranferidoDolares) * cambioMoneda;
                const deuda = montoTotal - montoPagar;

                $('#montoPagar').val(number_format(montoPagar * 0.82,2));
                $('#igv').val(number_format(montoPagar * 0.18,2));
                $('#deuda').val(number_format(deuda,2));

            });

            $(document).on( 'input', '#montoEfectivoSoles, #montoTranferidoSoles', function (e) {
                e.preventDefault();
                const montoEfectivoSoles = Number($('#montoEfectivoSoles').val());
                const montoTranferidoSoles = Number($('#montoTranferidoSoles').val());

                const montoPagar = ( montoEfectivoSoles + montoTranferidoSoles);
                const deuda = montoTotal - montoPagar;

                $('#montoPagar').val(number_format(montoPagar * 0.82,2));
                $('#igv').val(number_format(montoPagar * 0.18,2));
                $('#deuda').val(number_format(deuda,2));

            });


        }

        const init = () => {
            $('#montoTotal').val(montoTotal);
            $('#montoPagar').val('0.00');
            $('#igv').val('0.00');
            $('#deuda').val('0.00');

            $('#moneda').val(1);
            $('#moneda').trigger('change');
        }

        (function () {
            modals();
            actions();
            init();

        })()




    </script>
@endpush

