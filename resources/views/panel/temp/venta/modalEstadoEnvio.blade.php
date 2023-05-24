
<div class="modal fade" id="modalEstadoEnvio" tabindex="-1" role="dialog"  aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title text-white"><i class="fa fa-refresh"></i> MODIFICAR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frmEstadoEnvio" autocomplete="off">
                    <input type="hidden" name="idventa" required>
                    @csrf
                    <div class="row">
                        <div class="v class="form-group">
                                <label for="idventa_envio_estado">ESTADO DE ENVIO:</label>
                                <select name="idestado_envio" id="idestado_envio" class="form-control" required>
                                    <option value="" selected hidden>[--SELECCION--]</option>
                                    @foreach($estadosEnvio AS $e)
                                        <option value="{{ $e->idestado_envio}}">{{ $e->nombre}}</option>
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

