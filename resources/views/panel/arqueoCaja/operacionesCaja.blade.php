<!-- Modal center -->
<div class="modal fade" id="operacionesCajaModalCenter" tabindex="-1" role="dialog" aria-labelledby="operacionesCajaModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="operacionesCajaModalCenterTitle">¡Atención!</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form onsubmit="reeturn false;">
                    <div class="row">

                        <div class="col-12">
                            <div class="form-group">
                                <label for="tipoOperacion">Tipo de operación:</label>
                                <select class="form-control" name="tipoOperacion" id="tipoOperacion" title="Tipo de operación" >
                                    <option value="" hidden selected >[---Seleccione---]</option>
                                    <option value="1">Ingreso</option>
                                    <option value="2">Egresi</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="name">title:</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="title" >
                            </div>
                        </div>


                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

data-toggle="modal" data-target="#operacionesCajaModalCenter"
