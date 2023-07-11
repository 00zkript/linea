
<div class="modal fade" id="modalAnular" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-danger"><i class="fa fa-exclamation-triangle"></i> Alerta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmAnular" autocomplete="off">
                    <input type="hidden" name="idventa" id="idventa" required>
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-12">
                            ¿Esta seguro de quere <b class="text-danger">anular</b> esta venta?, Tenga en cuenta que al anular esta venta no podra retractarse ni modifcar la venta.
                        </div>
                        <div class="col-12 text-right">
                            <hr>
                            <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Si, acepto</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                        </div>


                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
