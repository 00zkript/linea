
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
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                            <ul class="nav nav-tabs">
                                <li class="nav-item">
                                    <a href="#nav-general" class="nav-link active">
                                        GENERAL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-tag" class="nav-link">
                                        ETIQUETAS
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-attributes" class="nav-link">
                                        ESPECIFICACIONES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-images" class="nav-link">
                                        IMÁGENES
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-manual" class="nav-link">
                                        MANUAL
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-description" class="nav-link">
                                        DESCRIPCIÓN CORTA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-description-large" class="nav-link">
                                        DESCRIPCIÓN LARGA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-data-sheet" class="nav-link">
                                        FICHA TÉCNICA
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="#nav-video" class="nav-link">
                                        VIDEO
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row content-create" id="nav-general" >

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="idsection">Sección: </label>
                                <select  name="idsection" id="idsection"  class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    <option value="">Sin sección</option>
                                    @foreach($sections AS $s)
                                        <option value="{{ $s->idsection }}">{{ $s->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="idcategoria">Categoría: </label>
                                <select  name="idcategoria" id="idcategoria"  class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    @foreach($categorias AS $c)
                                        <option data-tokens="{{ $c->parents }}" value="{{ $c->idcategoria }}">{{ $c->parents }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="idmarca">Marca: </label>
                                <select  name="idmarca" id="idmarca"  class="form-control selectpicker show-tick" title="[--Seleccione--]"
                                         data-live-search="true" data-size="5" data-live-search-placeholder="Buscar...">
                                    @foreach($marcas AS $m)
                                        <option data-tokens="{{ $m->nombre}}" value="{{ $m->idmarca}}">{{ $m->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label for="idproductoRelacionado">Productos Relacionados:</label>
                                <select name="idproductoRelacionado[]" id="idproductoRelacionado" class="form-control selectpicker" data-live-search='true' title="[---seleccione---]" multiple>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="codigo">Código: </label>
                                <input type="text" name="codigo" id="codigo"  class="form-control" maxlength="250" placeholder="Código">
                            </div>
                        </div>

                        <div class="col-xl-8 col-lg-8 col-md-7 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombre">Nombre: <span class="text-danger">(*)</span></label>
                                <input type="text" name="nombre" id="nombre" required class="form-control" maxlength="250" placeholder="Nombre">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="precio">Precio: <span class="text-danger">(*)</span></label>
                                <input type="number" name="precio" id="precio" required value="0" class="form-control" min="0" step="any" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="precio_promocional">Precio promocional: </label>
                                <input type="number" name="precio_promocional" id="precio_promocional" value="0" class="form-control" min="0" step="any" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="stock">STOCK: <span class="text-danger">(*)</span></label>
                                <input type="number" name="stock" id="stock" value="1" required class="form-control" min="0" placeholder="#">
                            </div>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-tag" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="font-weight-bolder text-uppercase mt-3 bg-secondary text-white p-2">Etiquetas:</h6>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="destacado">Destacado: </label>
                                <select  name="destacado" id="destacado"  class="form-control">
                                    <option value="0" hidden="" selected>[--Seleccion--]</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="Nuevo">Nuevo: </label>
                                <select  name="Nuevo" id="Nuevo"  class="form-control">
                                    <option value="0" hidden="" selected>[--Seleccion--]</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="liquidacion">En Liquidación: </label>
                                <select  name="liquidacion" id="liquidacion"  class="form-control">
                                    <option value="0" hidden="" selected>[--Seleccion--]</option>
                                    <option value="1">SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="showPrecio">Mostrar precio: </label>
                                <select  name="showPrecio" id="showPrecio"  class="form-control">
                                    <option value="1" selected>SI</option>
                                    <option value="0">NO</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-attributes" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <h6 class="font-weight-bolder text-uppercase mt-3 bg-secondary text-white p-2">Especificaciones de búsqueda adicional:</h6>
                        </div>

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <table class="table table-striped table-compact table-attribute" id="table-attribute">
                                <thead>
                                    <tr>
                                        <th>Atributo</th>
                                        <th>Valor</th>
                                        <th>Opción</th>
                                    </tr>
                                </thead>
                                <tbody data-collect="atributes" ></tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"><button type="button" class="btn btn-primary addAttribute"><i class="fa fa-plus"></i> Agregar Atributo</button></td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-images" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="imagen" class="d-block">Imágenes:</label>
                                {{--<div class="alert alert-info">
                                    <p class="my-0"><i class="fa fa-exclamation-triangle"></i> Se recomienda imágenes de 1200 x 628 pixeles.</p>
                                </div>--}}
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 1535px * 1020px</div>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                <div class="file-loading">
                                    <input  id="imagen" name="imagen[]" multiple type="file" class="file" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-manual" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="manual" class="d-block">Manuales:</label>
                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: pdf</div>
                                <div class="file-loading">
                                    <input  id="manual" name="manual[]" multiple type="file" class="file" >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-description" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="descripcionCorta">Descripción corta:</label>
                                <textarea  id="descripcionCorta" class="descripcionCorta"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-description-large" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea  id="descripcion" class="descripcion"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-data-sheet" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="ficha_tecnica">Ficha Técnica:</label>
                                <textarea  id="ficha_tecnica" class="ficha_tecnica"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row content-create" id="nav-video" >
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="video">Video:</label>
                                <textarea  id="video" class="video"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
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

