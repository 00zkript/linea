
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
                    <input type="hidden" name="idcliente" id="idcliente" required>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>




                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombresEditar">Nombres: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombresEditar" id="nombresEditar" required class="form-control"  placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="apellidosEditar">Apellidos: <span class="text-danger">(*)</span></label>
                                <input type="text" name="apellidosEditar" id="apellidosEditar" required class="form-control"  placeholder="Apellidos">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="correoEditar">Correo: <span class="text-danger">(*)</span></label>
                                <input type="email" name="correoEditar" id="correoEditar" required class="form-control"  placeholder="Correo">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="telefonoEditar">Teléfono: <span class="text-danger">(*)</span></label>
                                <input type="text" name="telefonoEditar" id="telefonoEditar" required class="form-control soloNumeros"  placeholder="Teléfono">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="tipoDocumentoIdentidadEditar">Documento de identidad: <span class="text-danger">(*)</span></label>
                                <select name="tipoDocumentoIdentidadEditar" id="tipoDocumentoIdentidadEditar" class="form-control" required>
                                    <option value="" hidden selected>[--Seleccione--]</option>
                                    @foreach($tipoDocumentoIdentidad as $item)
                                        <option value="{{ $item->idtipo_documento_identidad }}">
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="numeroDocumentoIdentidadEditar">N° de Doucmento: <span class="text-danger">(*)</span></label>
                                <input type="text" name="numeroDocumentoIdentidadEditar" id="numeroDocumentoIdentidadEditar" required class="form-control soloNumeros"  placeholder="N° de Doucmento" minlength="8" maxlength="8">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="estadoEditar">Estado: <span class="text-danger">(*)</span></label>
                                <select name="estadoEditar" id="estadoEditar" class="form-control" required>
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

