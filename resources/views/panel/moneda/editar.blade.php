
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-edit"></i> Modificar registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEditar" autocomplete="off">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="idmoneda" id="idmoneda" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>




                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control">
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="monedaEditar">Moneda: <span class="text-danger">(*)</span></label>
                                <input type="text" name="monedaEditar" id="monedaEditar" required class="form-control">
                            </div>
                        </div>




                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="simboloEditar">Símbolo: <span class="text-danger">(*)</span></label>
                                <input type="text" name="simboloEditar" id="simboloEditar" required class="form-control">
                            </div>
                        </div>





                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="cambioEditar"> Cambio: <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroupPrependEditar">{{ $monedaGeneral->format('1.00') }} = </span>
                                    </div>
                                    <input type="number" name="cambioEditar" id="cambioEditar" class="form-control" step="0.0001" max="999999" min="0.0000"  placeholder="0.0000" aria-describedby="inputGroupPrependEditar" required>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="posicionEditar">Símbolo Posición: <span class="text-danger">(*)</span></label>
                                <select name="posicionEditar" id="posicionEditar" class="form-control">
                                    <option value="LEFT" selected>Izquierda</option>
                                    <option value="RIGHT">Derecha</option>
                                </select>
                            </div>
                        </div>




                        <div class="col-12">
                            <div class="form-group">
                                <label for="estadoEditar">Estado: <span class="text-danger">(*)</span></label>
                                <select name="estadoEditar" id="estadoEditar" class="form-control" required>
                                    <option value="1" selected>Habilitado</option>
                                    <option value="0" >Inhabilitado</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

