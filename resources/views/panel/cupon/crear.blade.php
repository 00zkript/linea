
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
                                <label for="codigo">Código: <span class="text-danger">(*)</span></label>
                                <input type="text" name="codigo" id="codigo" required class="form-control" maxlength="250">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" maxlength="250">
                            </div>
                        </div>


                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="tipoDescuento">Tipo de descuento: <span class="text-danger">(*)</span></label>
                                <select name="tipoDescuento" id="tipoDescuento" class="form-control" required>
                                    <option value="" hidden selected>[--Seleccione--]</option>
                                    <option value="monto" >Monto</option>
                                    <option value="porcentaje" >Porcentaje</option>
                                </select>
                            </div>
                        </div>



                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" style="display: none" id="iptDescuentoMonto">
                            <div class="form-group">
                                <label for="descuentoMonto">Descuento Monto:</label>
                                <input type="number" name="descuentoMonto" id="descuentoMonto" value="0" step="any" class="form-control" min="0" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" style="display: none" id="iptDescuentoPorcentaje">
                            <div class="form-group">
                                <label for="descuentoPorcentaje">Descuento Porcentaje:</label>
                                <input type="number" name="descuentoPorcentaje" id="descuentoPorcentaje" value="0" step="any" class="form-control" min="0" placeholder="%">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
                            <div class="form-group">
                                <label for="cantidad">Cantidad de cupones: <span class="text-danger">(*)</span></label>
                                <input type="number" name="cantidad" id="cantidad" required value="1" class="form-control" min="0" placeholder="Cantidad">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12" >
                            <div class="form-group">
                                <label for="montoMinimo">Monto minimo para que se aplique el cupón:</label>
                                <input type="number" name="montoMinimo" id="montoMinimo" value="0" step="any"  class="form-control" min="0" placeholder="{{ $monedaGeneral->format('0.00') }}">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="fechaInicio">Fecha Inicio:  <span class="text-danger">(*)</span></label>
                                <input value="{{ now()->format('d/m/Y') }}" required data-mask="00/00/0000" placeholder="00/00/0000" type="text" name="fechaInicio" id="fechaInicio" class="form-control  datepicker">
                            </div>
                        </div>

                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="form-group">
                                <label for="fechaExpiracion">Fecha Expiración:  <span class="text-danger">(*)</span></label>
                                <input required data-mask="00/00/0000" placeholder="00/00/0000" type="text" name="fechaExpiracion" id="fechaExpiracion" class="form-control  datepicker">
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

