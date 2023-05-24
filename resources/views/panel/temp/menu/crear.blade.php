
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



                        <div class="col-12">
                            <div class="form-group">
                                <label for="pariente">Pariente:</label>
                                <select data-size="5" name="pariente" id="pariente" class="form-control selectpicker show-tick" data-live-search="true" title="[--Seleccione--]">
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="nombre">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombre" id="nombre" required class="form-control">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="tipoRuta">Tipo de ruta: <span class="text-danger">(*)</span></label>
                                <select id="tipoRuta" name="tipoRuta" class="form-control" title="[---Seleccione---]" required>
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($tipo_ruta as $t)
                                        <option value="{{ $t->idtipo_ruta }}">{{ $t->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 tipoRutaDiv" style="display:none" >
                            <div class="form-group">
                                <label for="rutaExterna">Ruta Externa: <span class="text-danger">(*)</span></label>
                                <input type="text" name="rutaExterna" id="rutaExterna"  class="form-control"  placeholder="Ruta">
                            </div>
                        </div>

                        <div class="col-12 tipoRutaDiv" style="display:none" >
                            <div class="form-group">
                                <label for="rutaInternaEstatica">Ruta interna (Estatica): <span class="text-danger">(*)</span></label>
                                <select id="rutaInternaEstatica" name="rutaInternaEstatica" class="form-control selectpicker" data-live-search="true">
                                        <option value="" selected hidden>[---Seleccione---]</option>
                                        @foreach($rutaInterna as $r)
                                            <option style="font-size: 12px" value="{{ $r->key }}">{{ $r->name }}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 tipoRutaDiv" style="display: none" >
                            <div class="form-group">
                                <label for="rutaInternaCategoria">Ruta interna (Categoría): <span class="text-danger">(*)</span></label>
                                <select id="rutaInternaCategoria" name="rutaInternaCategoria" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($categorias as $c)
                                        <option style="font-size: 12px" value="{{ $c->key }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="col-12 tipoRutaDiv" style="display: none" >
                            <div class="form-group">
                                <label for="rutaInternaPagina">Ruta interna (Paginas): <span class="text-danger">(*)</span></label>
                                <select id="rutaInternaPagina" name="rutaInternaPagina" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($paginas as $c)
                                        <option style="font-size: 12px" value="{{ $c->key }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>




                        <div class="col-12">
                            <div class="form-group">
                                <label for="posicion">Orden: <span class="text-danger">(*)</span></label>
                                <select required data-size="5" name="posicion" id="posicion" class="form-control selectpicker show-tick"
                                        data-live-search="true" title="[--Seleccione--]">

                                </select>
                            </div>
                        </div>


                        <div class="col-12">
                            <div class="form-group">
                                <label for="icono" class="d-block">Icono:</label>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 32px * 32px</div>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                <div class="file-loading">
                                    <input  id="icono" name="icono" type="file" class="file" >
                                </div>
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

