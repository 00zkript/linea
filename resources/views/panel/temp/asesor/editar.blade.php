
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
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
                    <input type="hidden" name="idasesor" id="idasesor" required>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>



                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombresEditar">Nombres: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombresEditar" id="nombresEditar"  class="form-control" maxlength="250" placeholder="Nombres" required>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="correoEditar">Correo: <span class="text-danger">(*)</span></label>
                                <input type="email" name="correoEditar" id="correoEditar"  class="form-control" maxlength="250" placeholder="Ejemplo@correo.com" required>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="celularEditar">Celular: <span class="text-danger">(*)</span></label>
                                <input type="text" name="celularEditar" id="celularEditar"  class="form-control" maxlength="250" placeholder="000000000" required>
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="whatsappEditar">Whatsapp:</label>
                                <input type="text" name="whatsappEditar" id="whatsappEditar"  class="form-control" maxlength="250" placeholder="000000000">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="telegramEditar">Telegram:</label>
                                <input type="text" name="telegramEditar" id="telegramEditar"  class="form-control" maxlength="250" placeholder="username">
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="contactoRapidoEditar">Mostrar en Whatsapp flotante: </label>
                                <select name="contactoRapidoEditar" id="contactoRapidoEditar" class="form-control" required>
                                    <option value="1">SI</option>
                                    <option value="0" selected>NO</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="fotoEditar" class="d-block">Foto: <span class="text-danger">(*)</span></label>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 400px * 361px</div>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                <div class="file-loading">
                                    <input  id="fotoEditar" name="fotoEditar" type="file" class="file" >
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="estadoEditar">Estado: <span class="text-danger">(*)</span></label>
                                <select name="estadoEditar" id="estadoEditar" class="form-control" required>
                                    <option value="1" >Habilitado</option>
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

