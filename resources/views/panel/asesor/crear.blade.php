
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombres">Nombres: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombres" id="nombres"  class="form-control" maxlength="250" required>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="correo">Correo: <span class="text-danger">(*)</span></label>
                                <input type="email" name="correo" id="correo"  class="form-control" maxlength="250" required>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="celular">Celular: <span class="text-danger">(*)</span></label>
                                <input type="text" name="celular" id="celular"  class="form-control" maxlength="250" placeholder="000000000" required>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="whatsapp">Whatsapp:</label>
                                <input type="text" name="whatsapp" id="whatsapp"  class="form-control" maxlength="250" placeholder="000000000">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="telegram">Telegram:</label>
                                <input type="text" name="telegram" id="telegram"  class="form-control" maxlength="250" placeholder="username">
                            </div>
                        </div>


                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="contactoRapido">Mostrar en Whatsapp flotante: </label>
                                <select name="contactoRapido" id="contactoRapido" class="form-control" required>
                                    <option value="1">SI</option>
                                    <option value="0" selected>NO</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="foto" class="d-block">Foto: <span class="text-danger">(*)</span></label>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 400px * 361px</div>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jp</div>
                                <div class="file-loading">
                                    <input  id="foto" name="foto" type="file" class="file"  required>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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

