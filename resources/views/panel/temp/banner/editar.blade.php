
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
                    <input type="hidden" name="idbanner" id="idbanner" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>



                        <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Ruta del Banner</h3> </div>


                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="tipoRutaEditar">Tipo de ruta dónde mostrar: <span class="text-danger">(*)</span></label>
                                <select id="tipoRutaEditar" name="tipoRutaEditar" class="form-control" title="[---Seleccione---]" required>
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($tiposRuta as $t)
                                        <option value="{{ $t->idtipo_ruta }}" data-content="{{ $t->slug }}-contentEditar">{{ $t->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div id="interna-estatica-contentEditar" class="col-12 mt-3 tipoRutaContentEditar" style="display:none" >
                            <div class="form-group">
                                <label for="rutaInternaEstaticaEditar">Ruta interna (Estatica): <span class="text-danger">(*)</span></label>
                                <select id="rutaInternaEstaticaEditar" name="rutaInternaEstaticaEditar" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($rutaInterna as $r)
                                        <option style="font-size: 12px" value="{{ $r->key }}">{{ $r->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="interna-categoria-contentEditar" class="col-12 mt-3 tipoRutaContentEditar" style="display: none" >
                            <div class="form-group">
                                <label for="rutaInternaCategoriaEditar">Ruta interna (Categoría): <span class="text-danger">(*)</span></label>
                                <select id="rutaInternaCategoriaEditar" name="rutaInternaCategoriaEditar" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($categorias as $c)
                                        <option style="font-size: 12px" value="{{ $c->key }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div id="interna-pagina-contentEditar" class="col-12 mt-3 tipoRutaContentEditar" style="display: none" >
                            <div class="form-group">
                                <label for="rutaInternaPaginaEditar">Ruta interna (Paginas): <span class="text-danger">(*)</span></label>
                                <select id="rutaInternaPaginaEditar" name="rutaInternaPaginaEditar" class="form-control selectpicker" data-live-search="true">
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($paginas as $c)
                                        <option style="font-size: 12px" value="{{ $c->key }}">{{ $c->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="posicionEditar">Posición: <span class="text-danger">(*)</span></label>
                                <select name="posicionEditar" id="posicionEditar" required class="form-control" title="[--- Seleccione ---]">
                                </select>
                            </div>
                        </div>



                        <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Tipo de Banner</h3> </div>

                        <div class="col-12 mt-3">
                            <label for="idbannerTipoEditar">Tipo: <span class="text-danger">(*)</span></label>
                            <select name="idbannerTipoEditar" id="idbannerTipoEditar" class="form-control" required>
                                <option value="" hidden selected>[---Seleccione---]</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->idbanner_tipo }}" data-content="{{ $tipo->slug }}-contentEditar">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>




                        <div id="imagen-contentEditar" class="col-12 row m-0 p-0 typeContentEditar" style="display: none;" >


                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Contenido</h3> </div>

                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <label for="nombreEditar">Título: </label>
                                    <input type="text" id="nombreEditar" name="nombreEditar" class="form-control" placeholder="Título">
                                </div>
                            </div>



                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <label for="contenidoEditar">Contenido: </label>
                                    <textarea  id="contenidoEditar" class="contenido"></textarea>
                                </div>
                            </div>




                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Redireccionamiento</h3> </div>

                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <label for="botonText">Texo botón de enlace (solo si tiene Contenido): </label>
                                    <input type="text" id="botonTextEditar" name="botonTextEditar" class="form-control" placeholder="Texto botón">
                                </div>
                            </div>


                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="botonTargetEditar">Tipo de redireccionamiento: </label>
                                    <select name="botonTargetEditar" id="botonTargetEditar" class="form-control" title="[--- Seleccione ---]">
                                        <option value="" selected hidden>[--- Seleccione ---]</option>
                                        <option value="_blank">nueva pestaña</option>
                                        <option value="_self">misma pestaña</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="botonLinkEditar">Link de redireccionamiento: </label>
                                    <input type="text" id="botonLinkEditar" name="botonLinkEditar" placeholder="http://example.com" class="form-control">
                                </div>
                            </div>





                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Imagen</h3> </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="imagenEditar" class="d-block">Imagen PC: <span class="text-danger">(*)</span></label>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 1920px * 785px</div>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                    <div class="file-loading">
                                        <input  id="imagenEditar"  name="imagenEditar" type="file" class="file" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mt-3">
                                <div class="form-group">
                                    <label for="imagenMovilEditar" class="d-block">Imagen Móvil: <span class="text-danger">(*)</span></label>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 800px * 884px</div>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                    <div class="file-loading">
                                        <input  id="imagenMovilEditar"  name="imagenMovilEditar" type="file" class="file" >
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="video-contentEditar" class="col-12 row m-0 p-0 typeContentEditar" style="display: none;" >

                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Video</h3> </div>

                            <div class="col-12 mt-3">
                                <div class="form-group">
                                    <label for="videoEditar" class="d-block">Video: <span class="text-danger">(*)</span></label>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 1920px * 785px</div>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: mp4</div>
                                    <div class="file-loading">
                                        <input  id="videoEditar"  name="videoEditar" type="file" class="file" accept="video/mp4" >
                                    </div>
                                </div>
                            </div>

                        </div>











                        {{--<div class="col-12">
                            <div class="form-group">
                                <label for="video">Video: </label>
                                <input type="text" id="video" name="video" class="form-control" placeholder="https://www.youtube.com/embed/">
                            </div>
                        </div>--}}





                        <div class="col-12 mt-3">
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

