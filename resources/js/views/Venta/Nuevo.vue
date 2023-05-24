<template lang="">
    <div>
        <!-- Modal center asegurarPagoModalCenter-->
        <div class="modal fade" id="asegurarPagoModalCenter" tabindex="-1" role="dialog" aria-labelledby="asegurarPagoModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="asegurarPagoModalCenterTitle">¡Atención!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Estás seguro de que deseas continuar? Esta acción puede tener implicaciones importantes. Por favor, tómate un momento para reflexionar antes de tomar una decisión.
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary asegurarPagoModalCenterSave">Pagar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal center cancelarPagoModalCenter-->
        <div class="modal fade" id="cancelarPagoModalCenter" tabindex="-1" role="dialog" aria-labelledby="cancelarPagoModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="cancelarPagoModalCenterTitle">¡Atención!</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Está seguro que desea continuar?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                        <button type="button" class="btn btn-primary cancelarPagoModalSave" data-dismiss="modal">Si</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal center addProductoModalCenter-->
        <div class="modal fade" id="addProductoModalCenter" tabindex="-1" role="dialog" aria-labelledby="addProductoModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addProductoModalCenterTitle"><i class="fa fa-plus"></i> Agregar producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 row">
                                <div class="col-md-11 col-12">
                                    <div class="form-group">
                                        <label for="">Buscar producto</label>
                                        <input type="text" class="form-control" placeholder="Codígo/ Nombre/ Descripción">
                                    </div>
                                </div>
                                <div class="col-md-1 col-12">
                                    <button class="btn btn-primary mt-4"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><button class="btn btn-primary btn-sm" disabled><i class="fa fa-plus"></i></button></th>
                                            <th class="text-center">Codígo</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Precio Unitario</th>
                                            <th class="text-center">Precio total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></td>
                                            <td>000001</td>
                                            <td>Lorem ipsum dolor sit.</td>
                                            <td><input type="text" class="form-control form-control-sm" value="1"></th>
                                            <td>1500</td>
                                            <td><div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                <input type="text" class="form-control" value="100">
                                            </div></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                    <input type="text" class="form-control" value="100" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></td>
                                            <td>000002</td>
                                            <td>Lorem ipsum dolor sit.</td>
                                            <td><input type="text" class="form-control form-control-sm" value="1"></th>
                                            <td>1500</td>
                                            <td><div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                <input type="text" class="form-control" value="100">
                                            </div></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                    <input type="text" class="form-control" value="100" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></td>
                                            <td>000003</td>
                                            <td>Lorem ipsum dolor sit.</td>
                                            <td><input type="text" class="form-control form-control-sm" value="1"></th>
                                            <td>1500</td>
                                            <td><div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                <input type="text" class="form-control" value="100">
                                            </div></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                    <input type="text" class="form-control" value="100" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></button></td>
                                            <td>000004</td>
                                            <td>Lorem ipsum dolor sit.</td>
                                            <td><input type="text" class="form-control form-control-sm" value="1"></th>
                                            <td>1500</td>
                                            <td><div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                <input type="text" class="form-control" value="100">
                                            </div></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                    <input type="text" class="form-control" value="100" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div> -->
                </div>
            </div>
        </div>

        <!-- Modal center  addServiceModalCenter-->
        <div class="modal fade" id="addServiceModalCenter" tabindex="-1" role="dialog" aria-labelledby="addServiceModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addServiceModalCenterTitle"><i class="fa fa-plus"></i> Agregar Servicio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 row">
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="">Fecha desde</label>
                                        <input type="date" class="form-control" value="2023-01-01">
                                    </div>
                                </div>
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label for="">Fecha hasta</label>
                                        <input type="date" class="form-control" value="2023-05-01">
                                    </div>
                                </div>
                                <div class="col-md-5 col-12">
                                    <div class="form-group">
                                        <label for="">Codígo</label>
                                        <input type="text" class="form-control" value="0000">
                                    </div>
                                </div>
                                <div class="col-md-1 col-12">
                                    <button class="btn btn-primary mt-4"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            <div class="col-12">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th><button class="btn btn-primary" disabled="disabled"><i class="fa fa-plus"></i></button></th>
                                            <th>Codígo</th>
                                            <th>Descripción</th>
                                            <th>Lapso</th>
                                            <th>Costo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><button class="btn btn-primary" ><i class="fa fa-plus"></i></button></td>
                                            <td>0000001</td>
                                            <td><input type="text" class="form-control" value="Nueva matrícula"></td>
                                            <td>01/04/2023 - 01/05/2023</td>
                                            <td>S/. 350.00</td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary" ><i class="fa fa-plus"></i></button></td>
                                            <td>0000002</td>
                                            <td><input type="text" class="form-control" value="Nueva matrícula"></td>
                                            <td>01/03/2023 - 01/04/2023</td>
                                            <td>S/. 350.00</td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary" ><i class="fa fa-plus"></i></button></td>
                                            <td>0000003</td>
                                            <td><input type="text" class="form-control" value="Nueva matrícula"></td>
                                            <td>01/02/2023 - 01/03/2023</td>
                                            <td>S/. 350.00</td>
                                        </tr>
                                        <tr>
                                            <td><button class="btn btn-primary" ><i class="fa fa-plus"></i></button></td>
                                            <td>0000004</td>
                                            <td><input type="text" class="form-control" value="Nueva matrícula"></td>
                                            <td>01/01/2023 - 01/02/2023</td>
                                            <td>S/. 350.00</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary">Guardar</button>
                    </div> -->
                </div>
            </div>
        </div>


        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color #2a3f54">
                             <p style="font-size 20px" class="card-title text-center text-white mb-0"> Ventas</p>
                        </div>
                        <div class="card-body pl-4 pr-4" >
                            <div class="row">
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="tipoFacturacion">Tipo Facturación</label>
                                        <select class="form-control form-control-sm" name="tipoFacturacion" id="tipoFacturacion" title="Tipo Facturación" >
                                            <option value="" hidden >[---Seleccione---]</option>
                                            <option value="1" selected >Boleta</option>
                                            <option value="2">Factura</option>
                                            <option value="3">Nota de credito</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="serie">Serie</label>
                                        <input type="text" class="form-control form-control-sm" name="serie" id="serie" placeholder="Serie" value="001" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="numero">Numero</label>
                                        <input type="text" class="form-control form-control-sm" name="numero" id="numero" placeholder="Numero" value="100" readonly >
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="moneda">Moneda</label>
                                        <select class="form-control form-control-sm" name="moneda" id="moneda" title="Moneda" >
                                            <option value="" hidden>[---Seleccione---]</option>
                                            <option value="1" selected >Soles (S/.)</option>
                                            <option value="2">Dolares ($)</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="fechaPago">Fecha pago</label>
                                        <input type="date" class="form-control form-control-sm" name="fechaPago" id="fechaPago" placeholder="Fecha pago" value="2023-05-23" >
                                    </div>
                                </div>
                                <div class="col-md-2 col-12">
                                    <div class="form-group">
                                        <label for="modoPago">Modo pago</label>
                                        <select class="form-control form-control-sm" name="modoPago" id="modoPago" title="Modo pago" >
                                            <option value="" hidden >[---Seleccione---]</option>
                                            <option value="1" selected >Pago efectivo</option>
                                            <option value="2">Pago tranferencia</option>
                                            <option value="3">Ambos</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label for="cliente">Cliente </span></label>
                                        <!-- <Autocomplete
                                            name="cliente"
                                            id="cliente"
                                            classInput="form-control form-control-sm"
                                            placeholder="Cliente"
                                            v-model="cliente.search"
                                            :suggestions="[
                                                '1 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                                '2 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                                '3 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                                '4 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                                '5 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                                '6 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                                '7 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                                '8 Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quisquam, nesciunt!',
                                            ]"
                                        /> -->
                                        <input type="text" name="cliente" id="cliente" class="form-control form-control-sm"  placeholder="Cliente" value="(87654321) Juan Perez Mancilla" >
                                    </div>
                                </div>
                                <div class="col-12 mt-4 row">
                                    <div class="col-md-4 col-12">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addProductoModalCenter" ><i class="fa fa-plus"></i>Agregar producto</button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addServiceModalCenter" ><i class="fa fa-plus"></i>Agregar servicio</button>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <table class="table table-sm">
                                        <thead >
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Producto / Servicio</th>
                                                <th class="text-center">Cantidad</th>
                                                <th class="text-center">Precio unitario (S/)</th>
                                                <th class="text-center">costo total (S/) </th>
                                                <th class="text-center">Acciones </th>
                                            </tr>
                                        </thead>
                                        <thead>
                                            <tr>
                                                <td>1</td>
                                                <td><input type="text" class="form-control" value="Nueva Matricula enero-2023" ></td>
                                                <td><input type="text" class="form-control" value="1" ></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="text" class="form-control" value="350.00" ></input>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="text" class="form-control" value="350.00" readonly ></input>
                                                    </div>
                                                </td>
                                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td><input type="text" class="form-control" value="Bañador" ></td>
                                                <td><input type="text" class="form-control" value="1" ></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="text" class="form-control" value="100.00" ></input>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="text" class="form-control" value="100.00" readonly ></input>
                                                    </div>
                                                </td>
                                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td><input type="text" class="form-control" value="Lentes de agua" ></td>
                                                <td><input type="text" class="form-control" value="2" ></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="text" class="form-control" value="50.00" ></input>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="text" class="form-control" value="100.00" readonly ></input>
                                                    </div>
                                                </td>
                                                <td><button class="btn btn-danger"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>Total (Sin IGV)</b> </td>
                                                <td class="text-center"> <b>S/. 451.00</b> </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>IGV</b> </td>
                                                <td class="text-center"> <b>S/. 99.00</b> </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>Total</b> </td>
                                                <td class="text-center"> <b>S/. 550.00</b> </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>Monto efectivo</b> </td>
                                                <td class="text-center">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                        <input type="text" class="form-control" name="montoEfectivo" id="montoEfectivo" placeholder="Monto efectivo" >
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>Monto tranferido</b> </td>
                                                <td class="text-center">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                        <input type="text" class="form-control" name="monotTransferido" id="monotTransferido" placeholder="Monto efectivo" >
                                                    </div>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col-12 mt-5 d-flex justify-content-center">
                                    <button class="btn btn-secondary" data-toggle="modal" data-target="#cancelarPagoModalCenter">Cancelar</button>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#asegurarPagoModalCenter">Pagar</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
</template>
<script>
import Autocomplete from '../../components/AutocompleteComponent.vue';

export default {
    components: {
        Autocomplete
    },
    data() {
        return {
            cliente: {
                search: '',
            },
        }
    }


}
</script>
<style>



</style>
