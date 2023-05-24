
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




                        <div class="col-12">
                            <div class="form-group">
                                <label for="titulo">Título: <span class="text-danger">(*)</span></label>
                                <input type="text" name="titulo" id="titulo" required class="form-control">
                            </div>
                        </div>




                        <div class="col-12">
                            <div class="form-group">
                                <label for="fecha">Fecha: </label>
                                <input type="date" name="fecha" id="fecha" class="form-control">
                            </div>
                        </div>

                        <div class="col-12" style="display:none;">
                            <div class="form-group">
                                <label for="descripcion">Descripción: <span class="text-danger">(*)</span></label>
                                <textarea id="descripcion" name="descripcion" cols="30" rows="10" class="form-control" placeholder="Descripcion"></textarea>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="contenido">Contenido: <span class="text-danger">(*)</span></label>
                                <textarea id="contenido" cols="30" rows="10" class="form-control" placeholder="Contenido"></textarea>
                            </div>
                        </div>



                        <div class="col-12">
                            <div class="form-group">
                                <label for="imagen" class="d-block">Imagen:</label>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                <div class="file-loading">
                                    <input  id="imagen" name="imagen" type="file" class="file" >
                                </div>
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

