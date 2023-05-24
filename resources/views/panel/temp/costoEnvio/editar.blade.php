
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
                    <input type="hidden" name="idcosto_envio" id="idcosto_envio" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="iddepartamentoEditar">Departamento: </label>
                                <select  name="iddepartamentoEditar" id="iddepartamentoEditar" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    <option value="">General</option>
                                    @foreach($departamentos AS $d)
                                        <option data-tokens="{{ $d->nombre}}" value="{{ $d->iddepartamento}}">{{ $d->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="idprovinciaEditar">Provincia: </label>
                                <select  name="idprovinciaEditar" id="idprovinciaEditar" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">

                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="iddistritoEditar">Distrito: </label>
                                <select  name="iddistritoEditar" id="iddistritoEditar" class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">

                                </select>
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="precioEditar">Precio:</label>
                                <input id="precioEditar" name="precioEditar" type="number" min="0" step="any" class="form-control" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="descripcionEditar">Descripción:</label>
                                <textarea  id="descripcionEditar" class="descripcionEditar"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="restriccionEditar">Restriccion:</label>
                                <textarea  id="restriccionEditar" class="restriccionEditar"></textarea>
                            </div>
                        </div>

                        <div class="col-12">
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

