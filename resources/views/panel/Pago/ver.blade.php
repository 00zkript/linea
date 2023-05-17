
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-eye"></i> Ver registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            <hr>
                        </div>

                        <div class="col-12">
                            <p>
                                <b>Alumno:</b>
                                <span id="alumnoShow"></span>
                            </p>
                            <p>
                                <b>Matrícula código:</b>
                                <span id="idmatriculaShow"></span>
                            </p>
                            <p>
                                <b>Sucursal:</b>
                                <span id="sucursalShow"></span>
                            </p>
                            <p>
                                <b>Caja:</b>
                                <span id="cajaShow"></span>
                            </p>
                            <p>
                                <b>Empleado:</b>
                                <span id="empleadoShow"></span>
                            </p>
                            <p>
                                <b>Total:</b>
                                <span id="montoTotalShow"></span>
                            </p>
                            <p>
                                <b>Total pagado:</b>
                                <span id="montoPagadoShow"></span>
                            </p>
                            <p>
                                <b>Total Deuda:</b>
                                <span id="montoDeudaShow"></span>
                            </p>
                        </div>

                        <div class="col-12 col-md-6 offset-md-3">
                            <table class="table table-striped text-center" id="pagosShow">
                                <thead>
                                    <tr>
                                        <th>#N°</th>
                                        <th>Monto pagado</th>
                                        <th>Fecha de pago</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>

                        </div>


                    </div>

            </div>

        </div>
    </div>
</div>

