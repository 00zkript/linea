
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
                    <input type="hidden" name="idsucursal" id="idsucursal" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>



                        <div class="col-12 form-group">
                            <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control"  placeholder="Nombre">
                        </div>

                        <div class="col-12 form-group">
                            <label for="descripcionEditar">Descripción: </label>
                            <textarea class="form-control" name="descripcionEditar" id="descripcionEditar" placeholder="Descripción" rows="5" ></textarea>
                        </div>

                        <div class="col-12 form-group">
                            <label for="contenidoEditar">Contenido:</label>
                            <textarea class="form-control" name="contenidoEditar" id="contenidoEditar" placeholder="Contenido" rows="5" ></textarea>
                        </div>

                        <div class="col-12 form-group">
                            <label for="departamentoEditar">Departamento:</label>
                            <select class="form-control" name="departamentoEditar" id="departamentoEditar" title="Departamento" >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($departamentos as $item)
                                    <option value="{{ $item->iddepartamento }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="provinciaEditar">Provincia:</label>
                            <select class="form-control" name="provinciaEditar" id="provinciaEditar" title="Provincia" >
                                <option value="" hidden selected >[---Seleccione---]</option>

                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="distritoEditar">Distrito:</label>
                            <select class="form-control" name="distritoEditar" id="distritoEditar" title="Distrito" >
                                <option value="" hidden selected >[---Seleccione---]</option>

                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="direccionEditar">Dirección</label>
                            <textarea class="form-control" name="direccionEditar" id="direccionEditar" placeholder="Dirección" rows="5" ></textarea>
                        </div>

                        <div class="col-12 form-group">
                            <label for="horarioAtencionEditar">Horario atención</label>
                                <textarea class="form-control" name="horarioAtencionEditar" id="horarioAtencionEditar" placeholder="Horarion atención" rows="5" ></textarea>
                        </div>








                        <div class="col-12 form-group">
                            <label for="estadoEditar">Estado: <span class="text-danger">(*)</span></label>
                            <select name="estadoEditar" id="estadoEditar" class="form-control" required>
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

