@extends('panel.template.index')
@section('cuerpo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Registros</p>
                    </div>
                    <div class="card-body pl-4 pr-4">

                        <div class="col-md-12 col-12">
                            <div class="form-group">
                                <label for="matricula">Matrícula: <span class="text-danger">(*)</span></label>
                                <input type="text" name="matricula" id="matricula" required class="form-control"  placeholder="Matrícula">
                            </div>
                        </div>

                        <div class="col-md-12 col-12">
                            <h2 class="text-center">Código de matrícula: 456467778</h2>
                        </div>

                        <div class="col-md-10 offset-1 col-12 mt-3">

                            <p>
                                <b>Concepto:</b> Nueva matrícula <br>
                            </p>

                            <p>
                                <b>Alumno:</b> Juan Perez Mancilla <br>
                                <b>Documento </b>identidad: DNi  - 87654321 <br>
                            </p>

                            <p>
                                <b>Temporada:</b>  verano 2023 <br>
                                <b>Programa:</b> niños <br>
                                <b>Piscina:</b> piscina grande <br>
                                <b>Carril </b>: 4 <br>
                                <b>Actividad semanal:</b> L-M-V <br>
                            </p>

                            <p>
                                <b>Caja:</b> caja1 <br>
                                <b>Sucursal:</b> Sucursal 1 <br>
                                <b>Dirección:</b> Lorem ipsum dolor sit amet consectetur adipisicing elit. <br>
                            </p>
                        </div>

                        <div class="col-md-12 col-12 mt-5">
                            <div class="row">

                                <div class="col-md-4 offset-1 col-12">
                                    <div class="row">
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="metodoPago">Método pago:</label>
                                                <select class="form-control" name="metodoPago" id="metodoPago" title="Método pago" >
                                                    <option value="" hidden selected >[---Seleccione---]</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="montoEfectivo">Monto efectivo:</label>
                                                <input type="text" class="form-control" name="montoEfectivo" id="montoEfectivo" placeholder="Monto efectivo" >
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-12">
                                            <div class="form-group">
                                                <label for="montoTranferido">Monto efectivo:</label>
                                                <input type="text" class="form-control" name="montoTranferido" id="montoTranferido" placeholder="Monto efectivo" >
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 offset-1 col-12">
                                    <div class="row">
                                        <div class="col-12">
                                            <p class="fs-12">
                                                <b>Monto Total:</b> S/ 350.00 <br>
                                                <b>Monto a pagar:</b> S/ 127.00 <br>
                                                <b>IGV:</b> S/. 23.00 <br>
                                                <b>Deuda:</b> S/ 250.00
                                            </p>
                                        </div>

                                        <div class="col-12 mt-5">
                                            <button class="btn btn-primary">Pagar</button>
                                            <button class="btn btn-secondary">Cancelar</button>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


