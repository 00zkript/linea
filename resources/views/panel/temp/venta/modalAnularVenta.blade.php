
<div class="modal fade" id="modalAnularVenta" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger">
                <h5 class="modal-title text-white"><i class="fa fa-exclamation-triangle"></i> Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAnularVenta" autocomplete="off">
                    <input type="hidden" name="idventa" required>
                    @csrf
                    <div class="row">
                        <div class="¿ESTA SEGURO DE <b class="text-danger">ANULAR</b> ESTA VENTA?</p>
                            <p>OCURRIRAN LOS SIGUIENTES CAMBIOS:</p>
                            <ul>
                                <li>LOS CANTIDAD DE PRODUCTOS QUE SE DESCONTARON DEL STOCK CUANDO SE REALIZO LA VENTA SE REPONDRAN AUTOMATICAMENTE.</li>
                                <li>ESTA VENTA PASARA A UN ESTADO DE ANULADO.</li>
                                <li>UNA VEZ REALIZADA ESTA ACCIÓN NO SE PODRA REVERTIR.</li>
                            </ul>
                        </div>
                        <div class="        <hr>
                            <button type="submit" class="btn btn-success" ><i class="fa fa-check"></i> Si, acepto</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

