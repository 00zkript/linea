
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
                            <label for="sucursal">Sucursal:</label>
                            <select class="form-control" name="sucursal" id="sucursal" title="Sucursal" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="rol">Rol: <span class="text-danger">(*)</span></label>
                            <select name="rol" id="rol" class="form-control" title="Rol" required>
                                <option value="" hidden selected disabled>[--Seleccione--]</option>
                                @foreach($roles AS $r)
                                    <option value="{{ $r->id }}" >{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="correo">Correo: <span class="text-danger">(*)</span></label>
                            <input type="email" name="correo" id="correo" required class="form-control" maxlength="250" placeholder="Correo">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="usuario">Usuario: <span class="text-danger">(*)</span></label>
                            <input type="text" name="usuario" id="usuario" required  class="form-control" maxlength="50" placeholder="Usuario">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="clave">Clave: <span class="text-danger">(*)</span></label>
                            <input type="password" name="clave" id="clave" required class="form-control" maxlength="250" placeholder="Clave">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="nombres">Nombres: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombres" id="nombres" required class="form-control" maxlength="250" placeholder="Nombres">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="apellidos">Apellidos: <span class="text-danger">(*)</span></label>
                            <input type="text" name="apellidos" id="apellidos" required class="form-control" maxlength="250" placeholder="Nombres">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="tipoDocumentoIdentidad">Tipo documento de identidad:</label>
                            <select class="form-control" name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" title="Tipo documento de identidad" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($tipoDocumentoIdentidad as $item)
                                    <option value="{{ $item->idtipo_documento_identidad  }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="numeroDocumentoIdentidad">Número de documento de identidad</label>
                            <input type="text" class="form-control" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" placeholder="Número de documento de identidad" minLength="8" maxength="8" >
                        </div>

                        <div class="col-12 form-group">
                            <label for="cargo">Cargo</label>
                            <input type="text" class="form-control" name="cargo" id="cargo" placeholder="Cargo" >
                        </div>



                        <div class="col-12 form-group">
                            <label for="foto" >Imagen:</label>
                            <div class="file-loading">
                                <input  id="foto" name="foto" type="file" class="file" >
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

