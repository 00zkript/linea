
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
                    <input type="hidden" name="idfrecuencia" id="idfrecuencia" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-12 form-group">
                            <label for="idprogramaEditar">Programa: <span class="text-danger">(*)</span></label>
                            <select class="form-control selectpicker" name="idprogramaEditar[]" id="idprogramaEditar" title="Carril" data-live-search="true" data-size="5" multiple required >
                                {{-- <option value="" hidden selected >[---Seleccione---]</option> --}}
                                @foreach ($programas as $item)
                                    <option value="{{ $item->idprograma }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12 form-group">
                            <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                            <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control"  placeholder="Nombre">
                        </div>
                        <div class="col-12 form-group">
                            <label for="diasEditar">Días:</label>
                            <select class="form-control selectpicker" multiple name="diasEditar[]" id="diasEditar" title="Días" required data-size="5">
                                {{-- <option value="" hidden selected >[---Seleccione---]</option> --}}
                                <option value="1">Lunes</option>
                                <option value="2">Martes</option>
                                <option value="3">Miércoles</option>
                                <option value="4">Jueves</option>
                                <option value="5">Viernes</option>
                                <option value="6">Sábado</option>
                                <option value="7">Domingo</option>
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

