
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
                            <label for="nivel">Niveles: <span class="text-danger">(*)</span></label>
                            <select class="form-control selectpicker" data-size="5" name="nivel[]" id="nivel" title="Niveles" multiple required>
                                @foreach ($niveles as $nivel)
                                    <option value="{{ $nivel->idnivel }}">{{ $nivel->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="nombre">Nombre: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombre" id="nombre" required class="form-control"  placeholder="Nombre">
                        </div>


                        <div class="col-12 form-group">
                            <label for="posicion">Posición: <span class="text-danger">(*)</span></label>
                            <select class="form-control" name="posicion" id="posicion" title="Posición" required>
                                <option value="" hidden selected >[---Seleccione---]</option>
                            </select>
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

