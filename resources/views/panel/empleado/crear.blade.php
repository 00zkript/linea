
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

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="codigo">Código:</label>
                                <input type="text" class="form-control" name="codigo" id="codigo" >
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="tipoEmpleado">Tipo empleado:</label>
                                <select class="form-control" name="tipoEmpleado" id="tipoEmpleado" >
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach ($tiposDeEmpleados as $item )
                                        <option value="{{ $item->idtipo_empleado }}">{{ $item->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nombres">Nombres: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombres" id="nombres" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="apellidos">Apellidos: <span class="text-danger">(*)</span></label>
                                <input type="text" name="apellidos" id="apellidos" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="correo">Correo: <span class="text-danger">(*)</span></label>
                                <input type="email" name="correo" id="correo" required class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="telefono">Teléfono: <span class="text-danger">(*)</span></label>
                                <input type="text" name="telefono" id="telefono" required class="form-control soloNumeros">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="tipoDocumentoIdentidad">Documento de identidad: <span class="text-danger">(*)</span></label>
                                <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" required>
                                    <option value="" hidden selected>[--Seleccione--]</option>
                                    @foreach($tipoDocumentoIdentidad as $item)
                                        <option value="{{ $item->idtipo_documento_identidad }}">
                                            {{ $item->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="numeroDocumentoIdentidad">N° de Documento: <span class="text-danger">(*)</span></label>
                                <input type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" required class="form-control soloNumeros"  minlength="8" maxlength="8">
                            </div>
                        </div>



                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="fechaIngreso">Fecha Ingreso:</label>
                                <input type="date" class="form-control" name="fechaIngreso" id="fechaIngreso" >
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="fechaCulminacion">Fecha Culminacion:</label>
                                <input type="date" class="form-control" name="fechaCulminacion" id="fechaCulminacion" >
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="sexo">Sexo: </label>
                                <select class="form-control" name="sexo" id="sexo" >
                                    <option value="" hidden selected>[---Seleccione---]</option>
                                    <option value="hombre">Hombre</option>
                                    <option value="mujer">Mujer</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="imagen">Imagen: </label>
                                <input type="file" class="form-control" name="imagen" id="imagen" >
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

