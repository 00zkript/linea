
<div class="modal fade" id="modalEstadoPago" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white"><i class="fa fa-refresh"></i> MODIFICAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEstadoPago" autocomplete="off">
                    <input type="hidden" name="idventa" required>
                    @csrf
                    <div class="row">
                        <div class="v class="form-group">
                                <label for="idestado_pago">ESTADO DE PAGO:</label>
                                <select name="idestado_pago" id="idestado_pago" class="form-control" required>
                                    <option value="" selected hidden>[--SELECCION--]</option>
                                    @foreach($estadosPago AS $p)
                                        <option value="{{ $p->idestado_pago}}">{{ $p->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="        <hr>
                            <button type="submit" class="btn btn-success"><i class="fa fa-refresh"></i> Modficar</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cancelar</button>

                        </div>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

