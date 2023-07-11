
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


                        <div class="col-md-6 col-12 form-group">
                            <label for="nombres">Nombres: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombres" id="nombres" required class="form-control">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="apellidos">Apellidos: <span class="text-danger">(*)</span></label>
                            <input type="text" name="apellidos" id="apellidos" required class="form-control">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="correo">Correo: </label>
                            <input type="email" name="correo" id="correo" class="form-control">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="telefono">Teléfono: </label>
                            <input type="text" name="telefono" id="telefono" class="form-control soloNumeros">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="tipoDocumentoIdentidad">Documento de identidad: </label>
                            <select name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control" >
                                <option value="" hidden selected>[--Seleccione--]</option>
                                @foreach($tipoDocumentoIdentidad as $item)
                                    <option value="{{ $item->idtipo_documento_identidad }}">
                                        {{ $item->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="numeroDocumentoIdentidad">N° de Documento: </label>
                            <input type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad"  class="form-control soloNumeros"  minlength="8" maxlength="8">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="fechaNacimiento">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" name="fechaNacimiento" id="fechaNacimiento" placeholder="Fecha de nacimiento" >
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="sexo">Sexo:</label>
                            <select class="form-control" name="sexo" id="sexo" >
                                <option value="" hidden >[---Seleccione---]</option>
                                <option value="hombre">Hombre</option>
                                <option value="mujer">Mujer</option>
                                <option value="Otro">Otro</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="departamento">Departamento:</label>
                            <select class="form-control" name="departamento" id="departamento" title="Departamento" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($departamentos as $item)
                                    <option value="{{ $item->iddepartamento }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="provincia">Provincia:</label>
                            <select class="form-control" name="provincia" id="provincia" title="Provincia" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                            </select>
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="distrito">Distrito:</label>
                            <select class="form-control" name="distrito" id="distrito" title="Distrito" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="direccion">Direción:</label>
                            <textarea class="form-control" name="direccion" id="direccion" placeholder="Direción" rows="2" ></textarea>
                        </div>

                        <div class="col-12 mt-3 mb-3">
                            <h3>Apoderado o persona de referencia</h3>
                        </div>

                         <div class="col-md-6 col-12 form-group">
                            <label for="apoderadoNombres">Nombres: <span class="text-danger">(*)</span></label>
                            <input type="text" name="apoderadoNombres" id="apoderadoNombres" required class="form-control">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="apoderadoApellidos">Apellidos: <span class="text-danger">(*)</span></label>
                            <input type="text" name="apoderadoApellidos" id="apoderadoApellidos" required class="form-control">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="apoderadoCorreo">Correo: </label>
                            <input type="email" name="apoderadoCorreo" id="apoderadoCorreo" class="form-control">
                        </div>

                        <div class="col-md-6 col-12 form-group">
                            <label for="apoderadoTelefono">Teléfono: </label>
                            <input type="text" name="apoderadoTelefono" id="apoderadoTelefono" class="form-control soloNumeros">
                        </div>




                        <div class="col-12 form-group">
                            <label for="nota">Nota:</label>
                            <textarea class="form-control" name="nota" id="nota" placeholder="Nota" rows="4" ></textarea>
                        </div>


                        <div class="col-12 form-group">
                            <label for="imagen">Imagen:</label>
                            <input type="file" id="imagen" name="imagen">
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

