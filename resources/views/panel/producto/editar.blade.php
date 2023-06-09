
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
                    <input type="hidden" name="idproducto" id="idproducto" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>




                        <div class="col-12 form-group">
                            <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control"  placeholder="Nombre">
                        </div>

                        <div class="col-12 form-group">
                            <label for="descripcionEditar">Descripción: <span class="text-danger">(*)</span></label>
                            <textarea id="descripcionEditar" name="descripcionEditar" rows="4" class="form-control" placeholder="Descripción"></textarea>
                        </div>

                        <div class="col-12 form-group">
                            <label for="stockEditar">Stock</label>
                            <input type="number" class="form-control" min="0" step="1" name="stockEditar" id="stockEditar" placeholder="Stock" >
                        </div>
                        <div class="col-12 form-group">
                            <label for="precioEditar">Precio</label>
                            <input type="number" class="form-control" min="0" step="0.0001" name="precioEditar" id="precioEditar" placeholder="Precio" >
                        </div>

                        <div class="col-12 form-group">
                            <label for="imagenEditar" >Imagen:</label>
                            <div class="file-loading">
                                <input id="imagenEditar" name="imagenEditar[]" type="file" class="file" multiple >
                            </div>
                        </div>





                        <div class="col-12 form-group">
                            <label for="estadoEditar">Estado: <span class="text-danger">(*)</span></label>
                            <select name="estadoEditar" id="estadoEditar" class="form-control" required>
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

