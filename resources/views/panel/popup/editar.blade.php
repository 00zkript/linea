
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
                    <input type="hidden" name="idpopup" id="idpopup" required>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="display: none">
                            <div class="form-group">
                                <label for="paginaEditar">Página: <span class="text-danger">(*)</span></label>
                                <select name="paginaEditar" id="paginaEditar" required class="form-control">
                                    {{--<option value="" hidden >[--Selecione--]</option>--}}
                                    <option value="inicio" selected>Inicio</option>
                                    {{--<option hidden value="contacto">Contacto</option>--}}
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="ordenEditar">Orden: <span class="text-danger">(*)</span></label>
                                <select name="ordenEditar" id="ordenEditar" required class="form-control">
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="enlaceEditar">Enlace: </label>
                                <input type="text" id="enlaceEditar" name="enlaceEditar" class="form-control" placeholder="https://">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="imagenEditar" class="d-block">Imagen: </label>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                <div class="file-loading">
                                    <input  id="imagenEditar"  name="imagenEditar" type="file" class="file" >
                                </div>
                            </div>
                        </div>

                        {{--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="videoEditar">Video: </label>
                                <textarea  id="videoEditar" rows="6" name="videoEditar" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="contenidoEditar">Contenido: </label>
                                <textarea  id="contenidoEditar" class="contenidoEditar"></textarea>
                            </div>
                        </div>--}}

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

