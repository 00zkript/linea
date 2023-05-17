
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
                    <input type="hidden" name="idcategoria" id="idcategoria" required>
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nivelEditar">Nivel: <span class="text-danger">(*)</span></label>
                                <select  name="nivelEditar" id="nivelEditar" required class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="parienteEditar">Pariente: </label>
                                <select  name="parienteEditar" id="parienteEditar" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control" maxlength="250">
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="ordenEditar">Orden: <span class="text-danger">(*)</span></label>
                                <select  name="ordenEditar" id="ordenEditar" required class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="colorEditar">Color: </label>
                                <input type="color" name="colorEditar" id="colorEditar" class="form-control" required value="#000000">
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12" style="display: none">
                            <div class="form-group">
                                <label for="marcaEditar">Marcas relaciondas: </label>
                                <select  name="marcaEditar[]" id="marcaEditar" multiple class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    @foreach($marcas AS $m)
                                        <option data-tokens="{{ $m->nombre}}" value="{{ $m->idmarca}}">{{ $m->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="descripcionEditar">Descripción:</label>
                                <textarea  id="descripcionEditar" class="descripcionEditar"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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

