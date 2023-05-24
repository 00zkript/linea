
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
                    <input type="hidden" name="idcupon" id="idcupon" required>
                    <div class="row">
                        <div class="col-12 text-right">
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modificar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>
                            <hr>
                        </div>


                        <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="codigoEditar">Código: <span class="text-danger">(*)</span></label>
                                <input type="text" name="codigoEditar" id="codigoEditar" required class="form-control" maxlength="250">
                            </div>
                        </div>

                        <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombreEditar">Nombre:</label>
                                <input type="text" name="nombreEditar" id="nombreEditar" class="form-control" maxlength="250">
                            </div>
                        </div>


                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="tipoDescuentoEditar">Tipo de descuento: <span class="text-danger">(*)</span></label>
                                <select name="tipoDescuentoEditar" id="tipoDescuentoEditar" class="form-control" required>
                                    <option value="" hidden >[--Seleccione--]</option>
                                    <option value="monto" >Monto</option>
                                    <option value="porcentaje" >Porcentaje</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-md-6 col-12" style="display: none" id="iptDescuentoMontoEditar">
                            <div class="form-group">
                                <label for="descuentoMontoEditar">Descuento Monto:</label>
                                <input type="number" name="descuentoMontoEditar" id="descuentoMontoEditar" value="0" step="any" class="form-control" min="0" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-12" style="display: none" id="iptDescuentoPorcentajeEditar">
                            <div class="form-group">
                                <label for="descuentoPorcentajeEditar">Descuento Porcentaje:</label>
                                <input type="number" name="descuentoPorcentajeEditar" id="descuentoPorcentajeEditar" step="any" value="0" class="form-control" min="0" placeholder="%">
                            </div>
                        </div>

                        <div class="col-md-6 col-12" >
                            <div class="form-group">
                                <label for="cantidadEditar">Cantidad de cupones: <span class="text-danger">(*)</span></label>
                                <input type="number" name="cantidadEditar" id="cantidadEditar" required value="1" class="form-control" min="0" placeholder="Cantidad">
                            </div>
                        </div>

                        <div class="col-md-6 col-12" >
                            <div class="form-group">
                                <label for="montoMinimoEditar">Monto minimo para que se aplique el cupón:</label>
                                <input type="number" name="montoMinimoEditar" id="montoMinimoEditar" value="0" step="any"  class="form-control" min="0" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="fechaInicioEditar">Fecha Inicio:  <span class="text-danger">(*)</span></label>
                                <input value="{{ now()->format('d/m/Y') }}" required data-mask="00/00/0000" placeholder="00/00/0000" type="text" name="fechaInicioEditar" id="fechaInicioEditar" class="form-control  datepicker">
                            </div>
                        </div>

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="fechaExpiracionEditar">Fecha Expiración:  <span class="text-danger">(*)</span></label>
                                <input required data-mask="00/00/0000" placeholder="00/00/0000" type="text" name="fechaExpiracionEditar" id="fechaExpiracionEditar" class="form-control  datepicker">
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

