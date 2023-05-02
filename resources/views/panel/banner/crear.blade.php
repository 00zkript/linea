
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



                        <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Ruta del Banner</h3> </div>


                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="tipoRuta">Tipo de ruta dónde mostrar: <span class="text-danger">(*)</span></label>
                                <select id="tipoRuta" name="tipoRuta" class="form-control" title="[---Seleccione---]" required>
                                    <option value="" selected hidden>[---Seleccione---]</option>
                                    @foreach($tiposRuta as $t)
                                        <option value="{{ $t->idtipo_ruta }}" data-content="{{ $t->slug }}-content">{{ $t->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div id="interna-estatica-content" class="col-12 mt-3 tipoRutaContent" style="display:none" >
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

                        <div id="interna-categoria-content" class="col-12 mt-3 tipoRutaContent" style="display: none" >
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

                        <div id="interna-pagina-content" class="col-12 mt-3 tipoRutaContent" style="display: none" >
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

                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <label for="posicion">Posición: <span class="text-danger">(*)</span></label>
                                <select name="posicion" id="posicion" required class="form-control" title="[--- Seleccione ---]">
                                </select>
                            </div>
                        </div>



                        <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Tipo de Banner</h3> </div>

                        <div class="col-12 mt-3">
                            <label for="idbannerTipo">Tipo: <span class="text-danger">(*)</span></label>
                            <select name="idbannerTipo" id="idbannerTipo" class="form-control" required>
                                <option value="" hidden selected>[---Seleccione---]</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->idbanner_tipo }}" data-content="{{ $tipo->slug }}-content">{{ $tipo->nombre }}</option>
                                @endforeach
                            </select>
                        </div>




                        <div id="imagen-content" class="col-12 row m-0 p-0 typeContent" style="display: none;" >


                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Contenido</h3> </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="nombre">Título: </label>
                                    <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Título">
                                </div>
                            </div>



                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="contenido">Contenido: </label>
                                    <textarea  id="contenido" class="contenido"></textarea>
                                </div>
                            </div>




                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Redireccionamiento</h3> </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="botonText">Texo botón de enlace (solo si tiene Contenido): </label>
                                    <input type="text" id="botonText" name="botonText" class="form-control" placeholder="Texto botón">
                                </div>
                            </div>


                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="botonTarget">Tipo de redireccionamiento: </label>
                                    <select name="botonTarget" id="botonTarget" class="form-control" title="[--- Seleccione ---]">
                                        <option value="" selected hidden>[--- Seleccione ---]</option>
                                        <option value="_blank">nueva pestaña</option>
                                        <option value="_self">misma pestaña</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-xl-9 col-lg-9 col-md-9 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="botonLink">Link de redireccionamiento: </label>
                                    <input type="text" id="botonLink" name="botonLink" placeholder="http://example.com" class="form-control">
                                </div>
                            </div>





                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Imagen</h3> </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="imagen" class="d-block">Imagen PC: <span class="text-danger">(*)</span></label>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 1920px * 785px</div>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                    <div class="file-loading">
                                        <input  id="imagen"  name="imagen" type="file" class="file" >
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="imagenMovil" class="d-block">Imagen Móvil: <span class="text-danger">(*)</span></label>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 800px * 884px</div>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: png, jpg</div>
                                    <div class="file-loading">
                                        <input  id="imagenMovil"  name="imagenMovil" type="file" class="file" >
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="video-content" class="col-12 row m-0 p-0 typeContent" style="display: none;" >

                            <div class="col-12 mt-3 bg-blue"> <h3 class="text-center">Video</h3> </div>

                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
                                <div class="form-group">
                                    <label for="video" class="d-block">Video: <span class="text-danger">(*)</span></label>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 1920px * 785px</div>
                                    <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: mp4</div>
                                    <div class="file-loading">
                                        <input  id="video"  name="video" type="file" class="file" accept="video/mp4" >
                                    </div>
                                </div>
                            </div>

                        </div>











                        {{--<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="video">Video: </label>
                                <input type="text" id="video" name="video" class="form-control" placeholder="https://www.youtube.com/embed/">
                            </div>
                        </div>--}}




                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mt-3">
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

