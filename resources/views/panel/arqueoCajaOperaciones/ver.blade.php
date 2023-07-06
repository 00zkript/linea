
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


                        <table class="table table-bordered">
                            <tr>
                                <td><b>Usuario</b></td>
                                <td id="usuario"></td>
                            </tr>
                            <tr>
                                <td><b>Fecha</b></td>
                                <td id="fecha"></td>
                            </tr>
                            <tr>
                                <td><b>Tipo Operacion</b></td>
                                <td id="tipoOperacion"></td>
                            </tr>
                            <tr>
                                <td><b>Revisado por</b></td>
                                <td id="supervisor"></td>
                            </tr>
                            <tr>
                                <td><b>Monto Efectivo (S/.)</b></td>
                                <td id="montoSolEfectivo"></td>
                            </tr>
                            <tr>
                                <td><b>Monto Transferido (S/.)</b></td>
                                <td id="montoSolTransferido"></td>
                            </tr>
                            {{-- <tr>
                                <td><b>Monto Efectivo ($)</b></td>
                                <td id="montoDolarEfectivo"></td>
                            </tr>
                            <tr>
                                <td><b>Monto Transferido ($)</b></td>
                                <td id="montoDolarTransferido"></td>
                            </tr> --}}
                            <tr>
                                <td><b>Descripcion</b></td>
                                <td id="descripcion"></td>
                            </tr>
                        </table>




                    </div>

            </div>

        </div>
    </div>
</div>

