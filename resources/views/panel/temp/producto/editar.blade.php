
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
                    <input type="hidden" name="idproducto" id="idproducto" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 mb-3">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#nav-general-editar" class="nav-link active">
                                        GENERAL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-tag-editar" class="nav-link">
                                        ETIQUETAS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-attributes-editar" class="nav-link">
                                        ESPECIFICACIONES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-images-editar" class="nav-link">
                                        IMÁGENES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-manual-editar" class="nav-link">
                                        MANUAL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-description-editar" class="nav-link">
                                        DESCRIPCIÓN CORTA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-description-large-editar" class="nav-link">
                                        DESCRIPCIÓN LARGA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-data-sheet-editar" class="nav-link">
                                        FICHA TÉCNICA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-video-editar" class="nav-link">
                                        VIDEO
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row content-edit" id="nav-general-editar" >
                        <div class="col-12">
                            <div class="form-group">
                                <label for="idsectionEditar">Sección: </label>
                                <select  name="idsectionEditar" id="idsectionEditar"  class="form-control selectpicker show-tick" title="Sin sección"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    <option value="">Sin sección</option>
                                    @foreach($sections AS $s)
                                        <option value="{{ $s->idsection }}">{{ $s->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="idcategoriaEditar">Categoría: </label>
                                <select  name="idcategoriaEditar" id="idcategoriaEditar"  class="form-control selectpicker show-tick" title="Sin categoría"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    @foreach($categorias AS $c)
                                        <option data-tokens="{{ $c->parents }}" value="{{ $c->idcategoria }}">{{ $c->parents }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="idmarcaEditar">Marca: </label>
                                <select  name="idmarcaEditar" id="idmarcaEditar"  class="form-control selectpicker show-tick" title="Sin Marca"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    @foreach($marcas AS $m)
                                        <option data-tokens="{{ $m->nombre}}" value="{{ $m->idmarca}}">{{ $m->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="idproductoRelacionadoEditar">Productos Relacionados:</label>
                                <select name="idproductoRelacionadoEditar[]" id="idproductoRelacionadoEditar" class="form-control selectpicker" data-live-search='true' title="[---seleccione---]" multiple>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="codigoEditar">Código: </label>
                                <input type="text" name="codigoEditar" id="codigoEditar"  class="form-control" maxlength="250" placeholder="Código">
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombreEditar">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombreEditar" id="nombreEditar" required class="form-control" maxlength="250" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="precioEditar">Precio: <span class="text-danger">(*)</span></label>
                                <input step="any" type="number" name="precioEditar" id="precioEditar" required class="form-control" min="0" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="precio_promocionalEditar">Precio promocional: </label>
                                <input step="any" type="number" name="precio_promocionalEditar" id="precio_promocionalEditar" class="form-control" min="0" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label for="stockEditar">STOCK: <span class="text-danger">(*)</span></label>
                                <input type="number" name="stockEditar" id="stockEditar" required class="form-control" min="0" placeholder="#">
                            </div>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-tag-editar" >
                        <div class="col-12">
                            <h6 class="font-weight-bolder text-uppercase mt-3 bg-secondary text-white p-2">Etiquetas:</h6>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="destacadoEditar">Destacado: </label>
                                <select  name="destacadoEditar" id="destacadoEditar"  class="form-control">
                                    <option value="" hidden="">[--Seleccion--]</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="nuevoEditar">Nuevo: </label>
                                <select  name="nuevoEditar" id="nuevoEditar"  class="form-control">
                                    <option value="" hidden="" selected>[--Seleccion--]</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="liquidacionEditar">En Liquidación: </label>
                                <select  name="liquidacionEditar" id="liquidacionEditar"  class="form-control">
                                    <option value="" hidden="" selected>[--Seleccion--]</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="showPrecioEditar">Mostrar precio: </label>
                                <select  name="showPrecioEditar" id="showPrecioEditar"  class="form-control">
                                    <option value="1" selected>SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-attributes-editar" >
                        <div class="col-12">
                            <h6 class="font-weight-bolder text-uppercase mt-3 bg-secondary text-white p-2">Especificaciones de búsqueda adicional:</h6>
                        </div>

                        <div class="col-12">
                            <table class="table table-striped table-compact table-attribute" id="table-attributeEditar">
                                <thead>
                                    <tr>
                                        <th>Atributo</th>
                                        <th>Valor</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody data-collect="attributesEditar"></tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><button type="button" class="btn btn-primary addAttributeEditar"><i class="fa fa-plus"></i> Agregar Atributo</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-images-editar" >
                        <div class="col-12">
                            <div class="form-group">
                                <label for="imagenEditar" class="d-block">Imágenes:</label>
                                {{--<div class="alert alert-info">
                                    <p class="my-0"><i class="fa fa-exclamation-triangle"></i> Se recomienda imágenes de 1200 x 628 pixeles.</p>
                                </div>--}}
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 1535px * 1020px</div>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                <div class="file-loading">
                                    <input  id="imagenEditar" name="imagenEditar[]" multiple type="file" class="file" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-manual-editar" >
                        <div class="col-12">
                            <div class="form-group">
                                <label for="manualEditar" class="d-block">Manuales:</label>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: pdf</div>
                                <div class="file-loading">
                                    <input  id="manualEditar" name="manualEditar[]" multiple type="file" class="file" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-description-editar" >
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descripcionCortaEditar">Descripción corta:</label>
                                <textarea  id="descripcionCortaEditar" class="descripcionCortaEditar"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-description-large-editar" >
                        <div class="col-12">
                            <div class="form-group">
                                <label for="descripcionEditar">Descripción:</label>
                                <textarea  id="descripcionEditar" class="descripcionEditar"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-data-sheet-editar" >
                        <div class="col-12">
                            <div class="form-group">
                                <label for="ficha_tecnicaEditar">Ficha Técnica:</label>
                                <textarea  id="ficha_tecnicaEditar" class="ficha_tecnicaEditar"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row content-edit" id="nav-video-editar" >
                        <div class="col-12">
                            <div class="form-group">
                                <label for="videoEditar">Video:</label>
                                <textarea  id="videoEditar" class="videoEditar"></textarea>
                            </div>
                        </div>
                    </div>



                    <div class="row">
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

