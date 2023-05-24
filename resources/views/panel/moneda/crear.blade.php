
    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fa fa-plus"></i> Nuevo registro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="frmCrear" autocomplete="off">
                        @csrf
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>




                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nombre">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombre" id="nombre" required class="form-control">
                            </div>
                        </div>




                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="moneda">Moneda: <span class="text-danger">(*)</span></label>
                                <input type="text" name="moneda" id="moneda" required class="form-control">
                            </div>
                        </div>




                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="simbolo">Símbolo: <span class="text-danger">(*)</span></label>
                                <input type="text" name="simbolo" id="simbolo" required class="form-control">
                            </div>
                        </div>





                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="cambio"> Cambio: <span class="text-danger">(*)</span></label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                      <span class="input-group-text" id="inputGroupPrepend">{{ $monedaGeneral->format('1.00') }} = </span>
                                    </div>
                                    <input type="number" name="cambio" id="cambio" class="form-control" step="0.0001" max="999999" min="0.0000"  placeholder="0.0000" aria-describedby="inputGroupPrepend" required>
                                </div>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="posicion">Símbolo Posición: <span class="text-danger">(*)</span></label>
                                <select name="posicion" id="posicion" class="form-control">
                                    <option value="LEFT" selected>Izquierda</option>
                                    <option value="RIGHT">Derecha</option>
                                </select>
                            </div>
                        </div>




                        <div class="col-12">
                            <div class="form-group">
                                <label for="estado">Estado: <span class="text-danger">(*)</span></label>
                                <select name="estado" id="estado" class="form-control" required>
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

