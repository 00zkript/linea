
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
                    <input type="hidden" name="idusuario" id="idusuario" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="rolEditar">Rol: <span class="text-danger">(*)</span></label>
                                <select name="rolEditar" id="rolEditar" class="form-control" required>
                                    <option value="" hidden selected disabled>[--Seleccione--]</option>
                                    @foreach($roles AS $r)
                                        <option value="{{ $r->idrol}}" >{{ $r->cargo}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="usuarioEditar">Usuario: <span class="text-danger">(*)</span></label>
                                <input type="text" name="usuarioEditar" id="usuarioEditar" required class="form-control" maxlength="50">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="claveEditar">Clave: </label>
                                <input type="password" name="claveEditar" id="claveEditar" class="form-control" maxlength="20">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nombresEditar">Nombres: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombresEditar" id="nombresEditar" required class="form-control" maxlength="250">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="apellidosEditar">Apellidos: <span class="text-danger">(*)</span></label>
                                <input type="text" name="apellidosEditar" id="apellidosEditar" required class="form-control" maxlength="250">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="correoEditar">Correo: <span class="text-danger">(*)</span></label>
                                <input type="email" name="correoEditar" id="correoEditar" required class="form-control" maxlength="250">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="fotoEditar" >Foto:</label>
                                <div class="file-loading">
                                    <input  id="fotoEditar" name="fotoEditar" type="file" class="file" >
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
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

