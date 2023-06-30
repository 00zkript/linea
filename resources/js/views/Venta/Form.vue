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
                            <div class="col-12 form-group">
                                <label for="buscarProducto">Buscar producto</label>
                                <div class="input-group">
                                    <input type="text" id="buscarProducto" class="form-control" placeholder="Código/ Nombre/ Descripción" v-model="search.producto.txtBuscar" @keyup.enter="getProductos(1)">
                                    <div class="input-group-append"><span class="btn-primary input-group-text"  @click="getProductos(1)" cursor-pointer ><i class="fa fa-search"></i></span></div>
                                </div>
                            </div>
                            <div class="col-12" v-if="!productsIsEmpty">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><button class="btn btn-primary btn-sm" disabled><i class="fa fa-plus"></i></button></th>
                                            <th class="text-center">Código</th>
                                            <th class="text-center">Nombre</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Stock</th>
                                            <th class="text-center">Precio Unitario</th>
                                            <th class="text-center">Precio total</th>
                                        </tr>
                                    </thead>
                                    <tbody >
                                        <tr v-for="(producto, index) in resources.productos.data" :key="index" >
                                            <td><button class="btn btn-primary btn-sm" type="button" @click="addProductoInDetalle(index)"><i class="fa fa-plus"></i></button></td>
                                            <td>{{ (producto.idproducto).toString().padStart(7,0) }}</td>
                                            <td>{{ producto.nombre }}</td>
                                            <td><input type="number" class="form-control form-control-sm" min="1" step="1" v-model="producto.cantidad" @input="changePrecioTotal(index)"></th>
                                            <td>{{ producto.stock }}</td>
                                            <td><div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                <input type="number" class="form-control" min="0" step="0.01" v-model="producto.precio" @input="changePrecioTotal(index)" >
                                            </div></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                    <input type="number" class="form-control" step="0.01" v-model="producto.precio_total" readonly>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination align="center" :data="resources.productos" @pagination-change-page="getProductos"></pagination>
                            </div>
                            <div class="col-12" v-else>
                                <div class="alert alert-danger">
                                    <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal center  addMatriculaModalCenter-->
        <div class="modal fade" id="addMatriculaModalCenter" tabindex="-1" role="dialog" aria-labelledby="addMatriculaModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addMatriculaModalCenterTitle"><i class="fa fa-plus"></i> Agregar Matrícula</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-md-3 col-12 form-group">
                                        <label for="searchMatriculaFechaInicio">Fecha desde</label>
                                        <input type="date" class="form-control" id="searchMatriculaFechaInicio" v-model="search.matricula.fechaInicio" @change="getMatriculas(1)">
                                    </div>
                                    <div class="col-md-3 col-12 form-group">
                                        <label for="searchMatriculaFechaFin">Fecha hasta</label>
                                        <input type="date" class="form-control" id="searchMatriculaFechaFin" v-model="search.matricula.fechaFin" @change="getMatriculas(1)">
                                    </div>
                                    <div class="col-md-6 col-12 form-group">
                                        <label for="searchMatriculaCodigo">Código</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" id="searchMatriculaCodigo" v-model="search.matricula.txtBuscar" placeholder="Código" @keyup.enter="getMatriculas(1)">
                                            <div class="input-group-append"><span class="btn-primary input-group-text"  @click="getMatriculas(1)" cursor-pointer ><i class="fa fa-search"></i></span></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12" v-if="!servicesIsEmpty">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th><button class="btn btn-primary" disabled="disabled"><i class="fa fa-plus"></i></button></th>
                                            <th>Código</th>
                                            <th>Descripción</th>
                                            <th>Lapso</th>
                                            <th>Costo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(matricula, index) in resources.matriculas.data" :key="index" >
                                            <td><button class="btn btn-primary" type="button" @click="addMatriculaInDetalle(index)"><i class="fa fa-plus"></i></button></td>
                                            <td>{{ (matricula.idmatricula).toString().padStart(7,0) }}</td>
                                            <td><input type="text" class="form-control" v-model="matricula.descripcion"></td>
                                            <td>{{ matricula.fecha_inicio }} - {{ matricula.fecha_fin }}</td>
                                            <td>S/. {{ matricula.monto_total }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <pagination align="center" :data="resources.matriculas" @pagination-change-page="getMatriculas"></pagination>
                            </div>
                            <div class="col-12" v-else>
                                <div class="alert alert-danger">
                                    <p class="text-center mb-0"><i class="fa fa-exclamation-circle"></i> No hay registros encontrados para mostrar.</p>
                                </div>
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
                                <div class="col-12 form-group">
                                    <label for="serchCarrito">Código matrícula</label>
                                    <input type="text" class="form-control" name="serchCarrito" id="serchCarrito" placeholder="Código matrícula" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-12 form-group">
                                    <label for="tipoFacturacion">Tipo Facturación</label>
                                    <select class="form-control form-control-sm" name="tipoFacturacion" id="tipoFacturacion" title="Tipo Facturación" v-model="cabecera.idtipo_facturacion" @change="getSerie()" >
                                        <option value="" hidden selected >[---Seleccione---]</option>
                                        <option
                                            v-for="(item, index) in resources.tipoFacturacion" :key="index"
                                            :value="item.idtipo_facturacion"
                                            v-text="item.nombre"
                                            >
                                        </option>
                                    </select>
                                </div>
                                <div class="col-md-4 col-12 form-group">
                                    <label for="serie">Serie</label>
                                    <input type="text" class="form-control form-control-sm" name="serie" id="serie" placeholder="Serie" :value="cabecera.serie" readonly>
                                </div>
                                <div class="col-md-4 col-12 form-group">
                                    <label for="numero">Numero</label>
                                    <input type="text" class="form-control form-control-sm" name="numero" id="numero" placeholder="Numero" :value="cabecera.numero" readonly >
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 col-12 form-group">
                                    <label for="modoPago">Modo pago</label>
                                    <select class="form-control form-control-sm" name="modoPago" id="modoPago" title="Modo pago" >
                                        <option value="" hidden >[---Seleccione---]</option>
                                        <option value="1" selected >Pago efectivo</option>
                                        <option value="2">Pago tranferencia</option>
                                        <option value="3">Ambos</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-12 form-group">
                                    <label for="moneda">Moneda</label>
                                    <select class="form-control form-control-sm" name="moneda" id="moneda" title="Moneda" >
                                        <option value="" hidden>[---Seleccione---]</option>
                                        <option value="1" selected >Soles (S/.)</option>
                                        <option value="2">Dolares ($)</option>
                                    </select>
                                </div>
                                <div class="col-md-2 col-12 form-group">
                                    <label for="fechaPago">Fecha pago</label>
                                    <input type="date" class="form-control form-control-sm" name="fechaPago" id="fechaPago" placeholder="Fecha pago" v-model="cabecera.fechaPago" readonly >
                                </div>

                                <div class="col-md-4 col-12 form-group">
                                    <label for="cliente">Cliente </span></label>
                                    <Autocomplete
                                        name="cliente"
                                        id="cliente"
                                        classInput="form-control form-control-sm"
                                        placeholder="Cliente"
                                        v-model="cliente"
                                        :url="route('venta.resources.clientes')"
                                        @afterSelected="removeMatriculasInDetalle"
                                        >
                                        <template v-slot:item="{ item }">
                                            ({{ item.numero_documento_identidad }}) {{ item.nombres }} {{ item.apellidos }}
                                        </template>
                                    </Autocomplete>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 mt-4 row">
                                    <div class="col-md-4 col-12">
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addProductoModalCenter" ><i class="fa fa-plus"></i>Agregar producto</button>
                                        <button class="btn btn-primary" data-toggle="modal" data-target="#addMatriculaModalCenter" @click="openModelMatricula()" :disabled="clienteIsEmpty" ><i class="fa fa-plus"></i>Agregar matricula</button>
                                    </div>
                                </div>
                                <div class="col-12 mt-4" v-if="!detalleIsEmpty">
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
                                            <tr v-for="(item, index) in detalle" :key="index" >
                                                <td>{{ (index+1) }}</td>
                                                <td><input type="text" class="form-control" v-model="item.nombre" ></td>
                                                <td><input type="number" min="1" step="1" class="form-control" v-model="item.cantidad" :readonly="item.idtipo_articulo === TIPO_ARTICULO_ID.MATRICULA" @input="changeMontoTotalDetalle(index)" ></td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="number" min="0" step="0.01" class="form-control" v-model="item.precio" :readonly="item.idtipo_articulo === TIPO_ARTICULO_ID.MATRICULA" @input="changeMontoTotalDetalle(index)" ></input>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                                        <input type="text" class="form-control" v-model="item.precio_total" readonly ></input>
                                                    </div>
                                                </td>
                                                <td><button class="btn btn-danger" @click="removeItemDetalle(index)"><i class="fa fa-trash"></i></button></td>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>Total (Sin IGV)</b> </td>
                                                <td class="text-center"> <b>S/. {{ detalleMontoTotalSinIGV }}</b> </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>IGV</b> </td>
                                                <td class="text-center"> <b>S/. {{ detalleMontoTotalIGV }}</b> </td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="3"></td>
                                                <td class="text-right"> <b>Total</b> </td>
                                                <td class="text-center"> <b>S/. {{ detalleMontoTotal }}</b> </td>
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
import Autocomplete from '../../components/AutocompleteComponent';
import moment from 'moment';
moment.locale('es-mx');

export default {
    components: {
        Autocomplete
    },
    data() {
        return {
            MONEDA_SYMBOL : 'S/.',
            TIPO_ARTICULO_ID : {
                PRODUCTO: 1,
                MATRICULA: 2,
            },
            resources: {
                tipoFacturacion: [],
                monedas: [],
                productos: {},
                matriculas: {},
            },
            search: {
                producto: {
                    cantidadRegistros: 5,
                    paginaActual: 1,
                    txtBuscar: '',
                },
                matricula: {
                    fechaInicio: null,
                    fechaFin: null,
                    cantidadRegistros: 5,
                    paginaActual: 1,
                    txtBuscar: '',
                },
                cliente: {
                    txtBuscar: '',
                },
            },
            cliente: {},
            cabecera: {
                idtipo_facturacion: '',
                serie: '',
                numero: '',
                idmoneda: '',
                fechaPago: '',
                idmodoPago: '',
                idcliente: '',
                monto_total: '',
            },
            detalle: [],
        }
    },
    computed: {
        productsIsEmpty() {
            const products = this.resources.productos?.data ?? [];
            return products.length === 0
        },
        servicesIsEmpty() {
            const services = this.resources.matriculas?.data ?? [];
            return services.length === 0
        },
        clienteIsEmpty() {
            return Object.keys(this.cliente).length === 0;
        },
        detalleIsEmpty() {
            return this.detalle.length === 0;
        },
        detalleMontoTotal() {
            const sum = this.detalle.reduce( (acc,cur) => {
                return parseFloat(acc)+parseFloat(cur.precio_total);
            },0);
            return number_format( sum, 2, '.', '' );
        },
        detalleMontoTotalSinIGV() {
            return number_format( this.detalleMontoTotal * 0.82, 2, '.', '' );
        },
        detalleMontoTotalIGV() {
            return number_format( this.detalleMontoTotal * 0.18, 2, '.', '' );
        },

    },
    methods: {
        number_format: number_format,
        soloNumeros: soloNumeros,
        soloNumerosPrice: soloNumerosPrice,
        disabledDates( date ) {
            const currentDate = new Date();
            currentDate.setHours(0, 0, 0, 0); // Establecer las horas, minutos, segundos y milisegundos a cero para comparación precisa

            return date < currentDate;
        },
        getResources() {
            return axios.get(route('venta.resources'))
            .then( response => {
                const data = response.data;
                this.resources.tipoFacturacion = data.tipoFacturacion;
            })
        },
        getSerie() {
            const { resources, cabecera } = this;

            const tipoFacturacionID = cabecera.idtipo_facturacion;
            const tipoFacturacion = resources.tipoFacturacion.find( ele => ele.idtipo_facturacion === tipoFacturacionID );

            this.cabecera.serie = tipoFacturacion.serie;
            this.cabecera.numero = tipoFacturacion.numero;

        },
        getProductos( page = 1 ) {
            this.search.producto.paginaActual = page;
            return axios(route('venta.resources.productos'),{
                params: this.search.producto
            })
            .then( response => {
                const data = response.data;
                this.resources.productos = data;
            })
        },
        changePrecioTotal( index ) {
            const producto = this.resources.productos.data[index];
            const cantidad =  producto.cantidad ?? 0;
            const precio =  producto.precio ?? 0;

            this.resources.productos.data[index].precio_total = number_format( cantidad * precio , 2, '.', '');
        },
        addProductoInDetalle( index ) {
            const producto = this.resources.productos.data[index];
            const productoAddedIndex = this.detalle.findIndex(ele => ele.idtipo_articulo === this.TIPO_ARTICULO_ID.PRODUCTO && ele.id === producto.idproducto && ele.precio === producto.precio );

            if ( productoAddedIndex !== -1 ) {
                const productoAdded = this.detalle[productoAddedIndex];
                this.detalle[productoAddedIndex].cantidad = parseInt(productoAdded.cantidad) + parseInt(producto.cantidad);
            }else{
                this.detalle.push({
                    idtipo_articulo: this.TIPO_ARTICULO_ID.PRODUCTO,
                    id: producto.idproducto,
                    nombre: producto.nombre,
                    cantidad: producto.cantidad,
                    precio: producto.precio,
                    precio_total: producto.precio_total,
                })
            }
            $('#addProductoModalCenter').modal('hide');

        },
        openModelMatricula() {
            this.getMatriculas();
        },
        getMatriculas( page = 1 ) {
            this.search.matricula.paginaActual = page;
            return axios(route('venta.resources.matriculas'),{
                params: {
                    ...this.search.matricula,
                    idcliente: this.cliente.idcliente
                }
            })
            .then( response => {
                const data = response.data;
                this.resources.matriculas = data;
            })
        },
        addMatriculaInDetalle( index ) {
            const matricula = this.resources.matriculas.data[index];

            this.detalle.push({
                idtipo_articulo: this.TIPO_ARTICULO_ID.MATRICULA,
                id: matricula.idmatricula,
                nombre: matricula.descripcion,
                cantidad: 1,
                precio: matricula.monto_total,
                precio_total: matricula.monto_total,
            })

            $('#addMatriculaModalCenter').modal('hide');
        },
        removeMatriculasInDetalle() {
            this.detalle = this.detalle.filter( ele => ele.idtipo_articulo !== this.TIPO_ARTICULO_ID.MATRICULA)
        },

        removeItemDetalle( index ) {
            this.detalle = this.detalle.filter( (ele,idx) => idx !== index);
        },
        changeMontoTotalDetalle( index ) {
            const detalleItem = this.detalle[index];
            const { cantidad, precio } = detalleItem;

            this.detalle[index].precio_total = number_format((cantidad ?? 0) * (precio ?? 0), 2, '.', '');
        },
    },
    mounted() {
        this.getResources();
        this.getProductos(1);

        this.cabecera.fechaPago = moment().format('YYYY-MM-DD');

    },
}
</script>
<style>



</style>
