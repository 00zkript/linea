
<div class="modal fade" id="modalCrear" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
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
                                <label for="nivel">Nivel: <span class="text-danger">(*)</span></label>
                                <select  name="nivel" id="nivel" required class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
col-md-6
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="pariente">Pariente: </label>
                                <select  name="pariente" id="pariente" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombre">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombre" id="nombre" required class="form-control" maxlength="250">
                            </div>
                        </div>


                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="orden">Orden: <span class="text-danger">(*)</span></label>
                                <select  name="orden" id="orden" required class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="color">Color: </label>
                                <input type="color" name="color" id="color" class="form-control" required value="#000000">
                            </div>
                        </div>

                        <div class="col-12" style="display: none">
                            <div class="form-group">
                                <label for="marca">Marcas relaciondas: </label>
                                <select  name="marca[]" id="marca" multiple class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    @foreach($marcas AS $m)
                                        <option data-tokens="{{ $m->nombre}}" value="{{ $m->idmarca}}">{{ $m->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea  id="descripcion" class="descripcion"></textarea>
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

