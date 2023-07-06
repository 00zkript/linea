
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
                    <input type="hidden" name="idprograma" id="idprograma" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>

                        <div class="col-12 form-group">
                            <label for="nivelEditar">Niveles: <span class="text-danger">(*)</span></label>
                            <select class="form-control selectpicker" data-size="5" name="nivelEditar[]" id="nivelEditar" title="Niveles" multiple required>
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->idnivel }}">{{ $nivel->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control"  placeholder="Nombre">
                        </div>
                        <div class="col-12 form-group">
                            <label for="posicionEditar">Posición: <span class="text-danger">(*)</span></label>
                            <select class="form-control" name="posicionEditar" id="posicionEditar" title="Posición" required>
                                <option value="" hidden selected >[---Seleccione---]</option>
                            </select>
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

