
<div class="modal fade" id="modalChangeComprobante" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center rounded-4 bg-primary">
                <h3 class="modal-title text-white fw-bold">Subir Comprobante</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmChangeComprobante" autocomplete="off">
                    <input type="hidden" name="idventa" required>
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h3>CÓDIGO DE VENTA : <span class="codigo">0000000</span>  </h3>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="comprobante">Comprobante:</label>
                                <input type="file" name="comprobante" id="comprobante" class="fileinput">
                            </div>
                        </div>
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <hr>
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modficar</button>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

