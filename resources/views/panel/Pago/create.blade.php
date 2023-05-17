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
                            <div class="row">
                                <div class="col-md-12 col-12 mt-5">
                                    <div class="row">
                                        <div class="col-md-4 offset-1 col-12">
                                            <div class="row">
                                                <div class="col-md-12 col-12">
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
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="metodoPago">Método pago:</label>
                                                        <select class="form-control" name="metodoPago" id="metodoPago" title="Método pago" >
                                                            <option value="" hidden selected >[---Seleccione---]</option>
                                                            <option value="1">Mercado pago</option>
                                                            <option value="2">visa</option>
                                                            <option value="3">tranferencia</option>
                                                            <option value="4">tranferencia + efectivo </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="montoEfectivo">Monto efectivo:</label>
                                                        <input type="text" class="form-control format-number-price" name="montoEfectivo" id="montoEfectivo" placeholder="Monto efectivo" >
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-12">
                                                    <div class="form-group">
                                                        <label for="montoTranferido">Monto efectivo:</label>
                                                        <input type="text" class="form-control format-number-price" name="montoTranferido" id="montoTranferido" placeholder="Monto efectivo" >
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 offset-1 col-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <p class="fs-12">
                                                        <b>Monto Total:</b> S/ 350.00 <br>
                                                        <b>Monto a pagar:</b> S/ 127.00 <br>
                                                        <b>IGV:</b> S/. 23.00 <br>
                                                        <b>Deuda:</b> S/ 250.00
                                                    </p>
                                                </div>
                                                <div class="col-12 mt-5">
                                                    <button class="btn btn-primary" data-toggle="modal" data-target="#asegurarPagoModalCenter">Pagar</button>
                                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#cancelarPagoModalCenter">Cancelar</button>
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

        (function () {
            modals();
        })()




    </script>
@endpush

