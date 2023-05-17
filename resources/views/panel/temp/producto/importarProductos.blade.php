
<div class="modal fade" id="modalImportarProductos" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-plus"></i> Nuevo registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmImportarProductos" autocomplete="off">
                    @csrf
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Guardar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="excel" >Excel:</label>
                                <div class="alert alert-info">
                                    <p class="my-0">
                                        <i class="fa fa-exclamation-triangle"></i>
                                        Datos a tener encuenta :
                                        <ul>
                                            <li style="padding-bottom: 5px">
                                                El excel debe tener las cabeceras: (<b>
                                                    Código,
                                                    Nombre,
                                                    Precio normal,
                                                    Precio rebajado,
                                                    Stock,
                                                    Marca,
                                                    Categorías,
                                                    Destacado,
                                                    Nuevo,
                                                    Liquidación,
                                                    Atributos,
                                                    Descripción corta,
                                                    Descripción,
                                                    Ficha técnica,
                                                    Video,
                                                    Estado,
                                                    Imágenes
                                                </b>) y seguir el orden establecido. <br>
                                                <b>Ejemplo : </b><br>
                                                <b style="padding-left: 15px"><a href="{{ asset('panel/example/example-import.xlsx') }}" style="color: darkblue;"> example-import.xlsx</a></b>
                                            </li>
                                            <li style="padding-bottom: 5px">
                                                Si la categoría es de nivel 2 a más, se debe agregar las categorías padres , y debe ser separado por " > ".<br>
                                                <b>Ejemplo : </b><br>
                                                <b style="padding-left: 15px">"Categoría nivel 1 > Categoría nivel 2 > Categoría nivel 3 ..."</b>
                                            </li>
                                            <li style="padding-bottom: 5px">
                                                Si son más de una imagen debe ser separado por coma.<br>
                                                <b>Ejemplo : </b> <br>
                                                <b style="padding-left: 15px">"http://example.com/imagen-1, http://example.com/imagen-2, ..."</b>
                                            </li>

                                        </ul>

                                    </p>
                                </div>
                                <div class="file-loading">
                                    <input  id="excel" name="excel" type="file"  class="file" >
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

