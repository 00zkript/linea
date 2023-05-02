
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="iddepartamento">Departamento: </label>
                                <select  name="iddepartamento" id="iddepartamento" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    <option value="">General</option>
                                    @foreach($departamentos AS $d)
                                        <option data-tokens="{{ $d->nombre}}" value="{{ $d->iddepartamento}}">{{ $d->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="idprovincia">Provincia: </label>
                                <select  name="idprovincia" id="idprovincia" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">

                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="iddistrito">Distrito: </label>
                                <select  name="iddistrito" id="iddistrito" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">

                                </select>
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="precio">Precio:</label>
                                <input id="precio" name="precio" type="number" min="0" step="any" class="form-control" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea  id="descripcion" class="descripcion"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="restriccion">Restriccion:</label>
                                <textarea  id="restriccion" class="restriccion"></textarea>
                            </div>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
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

