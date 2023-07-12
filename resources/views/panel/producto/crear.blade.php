
    <div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
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




                        <div class="col-12 form-group">
                            <label for="nombre">Nombre: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombre" id="nombre" required class="form-control"  placeholder="Nombre">
                        </div>


                        <div class="col-12 form-group">
                            <label for="descripcion">Descripción: <span class="text-danger">(*)</span></label>
                            <textarea id="descripcion" name="descripcion" rows="4" class="form-control" placeholder="Descripción"></textarea>
                        </div>

                        <div class="col-12 form-group">
                            <label for="stock">Stock</label>
                            <input type="number" class="form-control" min="0" step="1" name="stock" id="stock" placeholder="Stock" >
                        </div>
                        <div class="col-12 form-group">
                            <label for="precio">Precio</label>
                            <input type="number" class="form-control" min="0" step="0.0001" name="precio" id="precio" placeholder="Precio" >
                        </div>




                        <div class="col-12 form-group">
                            <label for="imagen" >Imagen:</label>
                            <div class="file-loading">
                                <input  id="imagen" name="imagen[]" type="file" class="file" multiple  >
                            </div>
                        </div>





                        <div class="col-12 form-group">
                            <label for="estado">Estado: <span class="text-danger">(*)</span></label>
                            <select name="estado" id="estado" class="form-control" required>
                                <option value="1" selected>Habilitado</option>
                                <option value="0" >Inhabilitado</option>
                            </select>
                        </div>

                    </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

