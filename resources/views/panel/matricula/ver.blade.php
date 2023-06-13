
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
                        <div class="col-md-12 col-12 text-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                            <hr>
                        </div>

                        <div class="col-12 mt-5">
                            <table class="table table-bordered">
                                <tr>
                                    <td><b>Código: </b><span id="idmatriculaShow"></span></td>
                                    <td><b>Concepto: </b><span id="conceptoShow"></span></td>
                                    <td colspan="2"><b>Sucursal: </b><span id="sucursalShow"></span></td>
                                </tr>
                                <tr>
                                    <td colspan="4"><b>Estado: </b><span id="estadoShow"></span></td>
                                </tr>

                                <tr>
                                    <td colspan="2"><b>Cliente: </b><span id="clienteShow"></span></td>
                                    <td colspan="2"><b>Cliente documento identidad: </b><span id="clienteIdtipoDocumentoIdentidadShow"></span></td>
                                </tr>

                                <tr>
                                    <td colspan="2" ><b>Empleado: </b><span id="empleadoShow"></span></td>
                                    <td colspan="2" ><b>Empleado documento identidad: </b><span id="empleadoIdtipoDocumentoIdentidadShow"></span></td>
                                </tr>

                                <tr>
                                    <td><b>Temporada: </b><span id="temporadaShow"></span></td>
                                    <td><b>Programa: </b><span id="programaShow"></span></td>
                                    <td><b>Piscina: </b><span id="piscinaShow"></span></td>
                                    <td><b>Carril: </b><span id="carrilShow"></span></td>
                                </tr>
                                <tr>
                                    <td><b>Periodo: </b><span id="periodoShow"></span></td>
                                    <td><b>Actividad semanal: </b><span id="actividadSemanalShow"></span></td>
                                    <td><b>Cantidad clases: </b><span id="cantidadClasesShow"></span></td>
                                    <td><b>Monto total: </b><span id="montoTotalShow"></span></td>
                                </tr>
                            </table>

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="2" class="text-center">Horario</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Dia</th>
                                        <th class="text-center">Hora</th>
                                    </tr>
                                </thead>
                                <tbody id="horarioShow">
                                </tbody>
                            </table>
                        </div>




                    </div>

            </div>

        </div>
    </div>
</div>

