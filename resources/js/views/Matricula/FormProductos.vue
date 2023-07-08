<template lang="">
    <div class="col-12 row pl-0 pr-0">
        <div class="col-12 mt-3 mb-3">
            <button class="btn btn-primary" @click="openModalProductos()"> <i class="fa fa-plus"></i> Agregar Productos</button>
        </div>

        <div class="col-12" v-if="!detalleIsEmpty">
            <table class="table table-sm">
                <thead >
                    <tr>
                        <th class="text-center">#</th>
                        <th class="text-center">Productos adicionales</th>
                        <th class="text-center">Cantidad</th>
                        <th class="text-center">Stock</th>
                        <th class="text-center">Precio unitario (S/)</th>
                        <th class="text-center">Sub total (S/) </th>
                        <th class="text-center">Acciones </th>
                    </tr>
                </thead>
                <thead>
                    <tr v-for="(item, index) in detalle" :key="index" >
                        <td>#{{ (index+1) }}</td>
                        <td><input type="text" class="form-control" v-model="item.nombre" ></td>
                        <td><input type="number" min="1" step="1" :max="item.stock" class="form-control" v-model="item.cantidad" @input="getMontoSubtotalDetalle(index)" ></td>
                        <td>{{ item.stock }}</td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                <input type="number" min="0" step="0.01" class="form-control" v-model="item.precio" @input="getMontoSubtotalDetalle(index)" ></input>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <div class="input-group-prepend"> <span class="input-group-text">S/.</span> </div>
                                <input type="text" class="form-control" v-model="item.subtotal" readonly ></input>
                            </div>
                        </td>
                        <td><button class="btn btn-danger" @click="removeItemDetalle(index)"><i class="fa fa-trash"></i></button></td>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td class="text-right"> <b>Total</b> </td>
                        <td colspan="2" class="text-right"> <b>S/. {{ total }}</b> </td>
                    </tr>
                </tfoot>
            </table>
        </div>

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
                                            <td><input type="number" class="form-control form-control-sm" min="1" step="1" :max="producto.stock" v-model="producto.cantidad" @input="getMontoSubtotalModalProducto(index)"></th>
                                            <td class="text-center">{{ producto.stock }}</td>
                                            <td><div class="input-group">
                                                <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                <input type="number" class="form-control" min="0" step="0.01" v-model="producto.precio" @input="getMontoSubtotalModalProducto(index)" >
                                            </div></td>
                                            <td>
                                                <div class="input-group">
                                                    <div class="input-group-prepend"><span class="input-group-text">S/.</span></div>
                                                    <input type="number" class="form-control" step="0.01" v-model="producto.subtotal" readonly>
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
    </div>
</template>
<script>
export default {
    props: {
        detalle: {
            type: Array,
            default() {
                return [];
            }
        },
    },
    computed: {
        productsIsEmpty() {
            const products = this.resources.productos?.data ?? [];
            return products.length === 0
        },
        detalleIsEmpty() {
            const products = this.detalle;
            return products.length === 0
        },
        total() {
            const sum = this.detalle.reduce( (acc,cur) => {
                return parseFloat(acc)+parseFloat(cur.subtotal);
            },0);
            return number_format( sum, 2, '.', '' );
        }
    },
    data() {
        return {
            TIPO_ARTICULO_ID : {
                PRODUCTO: 1,
                MATRICULA: 2,
            },
            resources: {
                productos: []
            },
            search: {
                producto: {
                    cantidadRegistros: 5,
                    paginaActual: 1,
                    txtBuscar: '',
                },
            },
        }
    },
    methods: {
        catch(error) {
            if ( error.response === undefined) return console.error(error);

            const response = error.response;
            const data = response.data;

            if (response.status == 422){
                return alertModal({ type:'error', content: listErrors(data) });
            }

            if (response.status == 400){
                return alertModal({ type:'error', content: data.mensaje });
            }

            return alertModal({ type:'error', content: 'Error del servidor, contácte con soporte.' });


        },
        openModalProductos() {
            $('#addProductoModalCenter').modal('show');
        },

        getProductos( page = 1 ) {
            this.search.producto.paginaActual = page;
            return axios(route('matricula.resources.productos'),{
                params: this.search.producto
            })
            .then( response => {
                const data = response.data;
                this.resources.productos = data;
            }).catch(this.catch);
        },
        getMontoSubtotalModalProducto( index ) {
            const producto = this.resources.productos.data[index];
            const cantidad =  producto.cantidad ?? 0;
            const precio =  producto.precio ?? 0;

            this.resources.productos.data[index].subtotal = number_format( cantidad * precio , 2, '.', '');
        },
        addProductoInDetalle( index ) {
            const producto = this.resources.productos.data[index];
            const { stock, precio, cantidad } = producto;
            const productoAddedIndex = this.detalle.findIndex(ele => ele.idtipo_articulo === this.TIPO_ARTICULO_ID.PRODUCTO && ele.idarticulo === producto.idproducto && ele.precio === producto.precio );

            if ( productoAddedIndex === -1 ) {
                const newCantidad = cantidad <= stock ? cantidad : stock;

                this.detalle.push({
                    idtipo_articulo: this.TIPO_ARTICULO_ID.PRODUCTO,
                    idarticulo: producto.idproducto,
                    nombre: producto.nombre,
                    cantidad: newCantidad,
                    stock: stock,
                    precio: precio,
                    subtotal: producto.subtotal,
                });
                $('#addProductoModalCenter').modal('hide');

                return;
            }

            const productoAdded = this.detalle[productoAddedIndex];
            const cantidadSum = parseInt(productoAdded.cantidad) + parseInt(producto.cantidad);
            const newCantidad = cantidadSum <= stock ? cantidadSum : stock;


            this.detalle[productoAddedIndex].cantidad = newCantidad;
            this.detalle[productoAddedIndex].subtotal = newCantidad * precio;



            $('#addProductoModalCenter').modal('hide');

        },

        removeItemDetalle( index ) {
            this.detalle = this.detalle.filter( (ele,idx) => idx !== index);
        },
        getMontoSubtotalDetalle( index ) {
            const detalleItem = this.detalle[index];
            const { cantidad, precio } = detalleItem;

            this.detalle[index].subtotal = number_format((cantidad ?? 0) * (precio ?? 0), 2, '.', '');
        },


    },
    mounted() {
        this.getProductos(1);
    }


}
</script>
<style lang="">

</style>
