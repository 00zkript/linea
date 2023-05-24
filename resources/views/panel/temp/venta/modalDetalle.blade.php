<div data-keyboard="false" data-backdrop="static" class="modal fade" id="modalDetalleVenta" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fa fa-eye"></i> Detalles de venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 text-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-times"></i> Cerrar</button>
                        <hr>
                    </div>



                    <div class="col-12">
                        <p style="font-size: 18px" class="font-weight-bold">DATOS GENERALES DE LA VENTA:</p>
                    </div>
                    <div class="col-xl-12 col-lg-12-md-12 col-sm-12 col-12">
                        <p>
                            <span class="font-weight-bold text-muted">ESTADO DE VENTA:</span>
                            <span id="txtEstadoControlVenta"></span>
                        </p>
                    </div>
                    <div class="col-xl-12 col-lg-12-md-12 col-sm-12 col-12">
                        <p>
                            <span class="font-weight-bold text-muted">CÓDIGO:</span>
                            <span id="txtIdVenta"></span>
                        </p>
                    </div>
                    <div class="col-12">
                        <p>
                            <span class="font-weight-bold text-muted">FECHA Y HORA DE REGISTRO:</span>
                            <span id="txtFechaHora"></span>
                        </p>
                    </div>
                    <div class="col-12">
                        <p>
                            <span class="font-weight-bold text-muted">MÉTODO DE PAGO:</span>
                            <span id="txtMetodoPago"></span>
                        </p>
                    </div>
                    <div class="col-12">
                        <p>
                            <span class="font-weight-bold text-muted">ESTADO DE ENVIO:</span>
                            <span id="txtEstadoEnvio"></span>
                        </p>
                    </div>
                    <div class="col-12">
                        <p>
                            <span class="font-weight-bold text-muted">ESTADO DE PAGO:</span>
                            <span id="txtEstadoPago"></span>
                        </p>
                    </div>





                    <div class="col-12">
                        <hr>
                        <p style="font-size: 18px" class="font-weight-bold">DATOS DE CLIENTE:</p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p><span class="font-weight-bold text-muted">APELLIDOS:</span> <span id="txtApellidos"></span></p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p><span class="font-weight-bold text-muted">NOMBRES:</span> <span id="txtNombres"></span></p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p><span class="font-weight-bold text-muted">TIPO DE DOCUMENTO:</span> <span id="txtTipoDocumento"></span></p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p><span class="font-weight-bold text-muted">NUMERO DE DOCUMENTO:</span> <span id="txtNumDocumento"></span></p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p><span class="font-weight-bold text-muted">CORREO:</span> <span id="txtCorreo"></span></p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p><span class="font-weight-bold text-muted">TELEFONO:</span> <span id="txtTelefono"></span></p>
                    </div>




                    <div class="col-12">
                        <hr>
                        <p style="font-size: 18px" class="font-weight-bold">DATOS DE DESPACHO:</p>
                    </div>
                    <div class="col-12">
                        <p><span class="font-weight-bold text-muted">MODALIDAD DESPACHO:</span> <span id="txtModalidadDespacho"></span></p>
                    </div>
                    <div class="col-md-4 col-12 modalidadDespacho">
                        <p><span class="font-weight-bold text-muted">DEPARTAMENTO:</span> <span id="txtDepartamento"></span></p>
                    </div>
                    <div class="col-md-4 col-12 modalidadDespacho">
                        <p><span class="font-weight-bold text-muted">PROVINCIA:</span> <span id="txtProvincia"></span></p>
                    </div>
                    <div class="col-md-4 col-12 modalidadDespacho">
                        <p><span class="font-weight-bold text-muted">DISTRITO:</span> <span id="txtDistrito"></span></p>
                    </div>
                    <div class="col-12 modalidadDespacho">
                        <p><span class="font-weight-bold text-muted">DIRECCION:</span> <span id="txtDireccion"></span></p>
                    </div>
                    <div class="col-12 modalidadDespacho">
                        <p><span class="font-weight-bold text-muted">REFERENCÍA:</span> <span id="txtReferencia"></span></p>
                    </div>
                    <div class="col-12 ">
                        <p><span class="font-weight-bold text-muted">Fecha y hora de entrega (referencial):</span> <span id="txtFechaEntrega"></span></p>
                    </div>
                    <div class="col-12">
                        <p><span class="font-weight-bold text-muted">PUNTO DE VENTA:</span> <span id="txtPuntoVenta"></span></p>
                    </div>
                    {{-- <div class="col-12" style="display: none">
                        <p><span class="font-weight-bold text-muted">INFORMACION DE ENVIO:</span> <span id="txtInfoEnvio"></span></p>
                    </div> --}}





                    <div class="col-12">
                        <p style="font-size: 18px" class="font-weight-bold">RECOGERÁ EL PEDIDO:</p>
                    </div>
                    <div class="col-12">
                        <p><span class="font-weight-bold text-muted">NOMBRES Y APELLIDOS:</span> <span id="txtNomApeDest"></span></p>
                    </div>




                    <div class="col-12">
                        <hr>
                        <p style="font-size: 18px" class="font-weight-bold">DATOS PARA LA FACTURACIÓN:</p>
                    </div>
                    <div class="col-12">
                        <p><span class="font-weight-bold text-muted">TIPO DE COMPROBANTE:</span> <span id="txtTipoComprobante"></span></p>
                    </div>
                    <div class="col-12 tipoComprobante">
                        <p><span class="font-weight-bold text-muted">RAZON SOCIAL:</span> <span id="txtRazonSocial"></span></p>
                    </div>
                    <div class="col-12 tipoComprobante">
                        <p><span class="font-weight-bold text-muted">RUC:</span> <span id="txtRuc"></span></p>
                    </div>





                    <div class="col-12">
                        {{-- <h4 class="mb-4">Su compra tiene (<span id="txtCantidadProductoVendidos"></span> Items)</h4> --}}
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover" id="tblDetalleVenta" style="font-size: 13px;">
                                <thead class="thead-dark">
                                    <tr class="text-center">
                                        <th>CODIGO</th>
                                        <th>PRODUCTO (cantidad : <span id="txtCantidadProductoVendidos">0</span>)</th>
                                        <th>PRECIO UNITARIO</th>
                                        <th>CANTIDAD</th>
                                        <th>TOTAL PARCIAL</th>
                                    </tr>
                                </thead>
                                <tbody >
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="4">SUBTOTAL</td>
                                        <td colspan="1" class="text-right" id="txtSubtotal">$ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">COSTO DE ENVÍO</td>
                                        <td colspan="1" class="text-right" id="txtCostoEnvio">$ 0.00</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4">DESCUENTO</td>
                                        <td colspan="1" class="text-right" id="txtCuponDescuento">$ 0.00</td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="4">CANTIDAD DE PRODUCTOS VENDIDOS</td>
                                        <td colspan="1" class="text-right" id="txtCantidadProductoVendidos">0</td>
                                    </tr> --}}
                                    <tr>
                                        <td colspan="4">TOTAL</td>
                                        <td colspan="1" class="text-right" id="txtTotal">$ 0.00</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <hr>
                    </div>



                </div>
            </div>
        </div>
    </div>

</div>

