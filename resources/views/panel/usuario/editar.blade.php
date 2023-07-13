
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
                    <input type="hidden" name="idusuario" id="idusuario" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>

                        <div class="col-12 form-group">
                            <label for="sucursalEditar">Sucursal:</label>
                            <select class="form-control" name="sucursalEditar" id="sucursalEditar" title="Sucursal" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($sucursales as $sucursal)
                                    <option value="{{ $sucursal->idsucursal }}">{{ $sucursal->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                       <div class="col-12 form-group">
                            <label for="rolEditar">Rol: <span class="text-danger">(*)</span></label>
                            <select name="rolEditar" id="rolEditar" class="form-control" title="Rol" required>
                                <option value="" hidden selected disabled>[--Seleccione--]</option>
                                @foreach($roles AS $r)
                                    <option value="{{ $r->id }}" >{{ $r->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="correoEditar">Correo: <span class="text-danger">(*)</span></label>
                            <input type="email" name="correoEditar" id="correoEditar" required class="form-control" maxlength="250" placeholder="Correo">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="usuarioEditar">Usuario: <span class="text-danger">(*)</span></label>
                            <input type="text" name="usuarioEditar" id="usuarioEditar" required  class="form-control" maxlength="50" placeholder="Usuario">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="claveEditar">Clave: <span class="text-danger">(*)</span></label>
                            <input type="password" name="claveEditar" id="claveEditar" class="form-control" maxlength="250" placeholder="Clave">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="nombresEditar">Nombres: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombresEditar" id="nombresEditar" required class="form-control" maxlength="250" placeholder="Nombres">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="apellidosEditar">Apellidos: <span class="text-danger">(*)</span></label>
                            <input type="text" name="apellidosEditar" id="apellidosEditar" required class="form-control" maxlength="250" placeholder="Nombres">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="tipoDocumentoIdentidadEditar">Tipo documento de identidad:</label>
                            <select class="form-control" name="tipoDocumentoIdentidadEditar" id="tipoDocumentoIdentidadEditar" title="Tipo documento de identidad" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($tipoDocumentoIdentidad as $item)
                                    <option value="{{ $item->idtipo_documento_identidad  }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="numeroDocumentoIdentidadEditar">Número de documento de identidad</label>
                            <input type="text" class="form-control" name="numeroDocumentoIdentidadEditar" id="numeroDocumentoIdentidadEditar" placeholder="Número de documento de identidad" minLength="8" maxLength="8" >
                        </div>

                        <div class="col-12 form-group">
                            <label for="cargoEditar">Cargo</label>
                            <input type="text" class="form-control" name="cargoEditar" id="cargoEditar" placeholder="Cargo" >
                        </div>

                        <div class="col-12 form-group">
                            <label for="fotoEditar" >Imagen:</label>
                            <div class="file-loading">
                                <input  id="fotoEditar" name="fotoEditar" type="file" class="file" >
                            </div>
                        </div>

                        <div class="col-12 form-group">
                            <label for="estadoEditar">Estado: <span class="text-danger">(*)</span></label>
                            <select name="estadoEditar" id="estadoEditar" class="form-control" required>
                                <option value="1" >Habilitado</option>
                                <option value="0" >Inhabilitado</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

