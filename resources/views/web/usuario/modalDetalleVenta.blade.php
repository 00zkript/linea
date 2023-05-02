<div data-keyboard="false" data-backdrop="static" tabindex="-1" class="modal fade" id="modalDetalleVenta" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header justify-content-center rounded-4 bg-primary">
                <h3 class="modal-title text-white fw-bold">DETALLES DE LA COMPRA</h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body pt-0 text-dark">
                <div class="row">
                    <div class="col-md-12 col-12">
                        <h5 class="fw-bold mb-4 mt-4 text-verde">DATOS GENERALES DE LA VENTA:</h5>
                    </div>
                    <div class="col-md-12 col-12" style="display: none">
                        <p style="font-size: 10pt;">
                            <span class="fw-bold">Estado de la venta:</span>
                            <span id="txtEstado"></span>
                        </p>
                    </div>
                    <div class="col-md-12 col-12">
                        <p style="font-size: 10pt;">
                            <span class="fw-bold">Código:</span>
                            <span id="txtIdVenta"></span>
                        </p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p style="font-size: 10pt;">
                            <span class="fw-bold">Fecha y hora de registro:</span>
                            <span id="txtFechaHora"></span>
                        </p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p style="font-size: 10pt;">
                            <span class="fw-bold">Método de pago:</span>
                            <span id="txtMetodoPago"></span>
                        </p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p style="font-size: 10pt;">
                            <span class="fw-bold">Estado de envío:</span>
                            <span id="txtEstadoEnvio"></span>
                        </p>
                    </div>
                    <div class="col-md-6 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Estado de pago:</span> <span id="txtEstadoPago"></span></p>
                    </div>





                    <div class="col-md-12 col-12">
                        <hr>
                        <h5 class="fw-bold mb-4 mt-4 text-verde">DATOS DE CLIENTE:</h5>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Apellidos:</span> <span id="txtApellidos"></span></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Nombres:</span> <span id="txtNombres"></span></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Tipo de documento:</span> <span id="txtTipoDocumento"></span></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Número de documento:</span> <span id="txtNumDocumento"></span></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Correo electrónico:</span> <span id="txtCorreo"></span></p>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Teléfono:</span> <span id="txtTelefono"></span></p>
                    </div>
                    <div class="col-md-12 col-12">
                        <hr>
                        <h5 class="fw-bold mb-4 mt-4 text-verde">DATOS DE DESPACHO:</h5>
                    </div>





                    <div class="col-md-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold mb-4 mt-4">Modalidad de despacho:</span> <span id="txtModalidadDespacho"></span></p>
                        <hr>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 modalidadDespacho">
                        <p style="font-size: 10pt;"><span class="fw-bold mb-4 mt-4">Departamento:</span> <span id="txtDepartamento"></span></p>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 modalidadDespacho">
                        <p style="font-size: 10pt;"><span class="fw-bold">Provincia:</span> <span id="txtProvincia"></span></p>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 modalidadDespacho">
                        <p style="font-size: 10pt;"><span class="fw-bold">Distrito:</span> <span id="txtDistrito"></span></p>
                    </div>
                    <div class="col-md-12 col-12 modalidadDespacho">
                        <p style="font-size: 10pt;"><span class="fw-bold">Dirección:</span> <span id="txtDireccion"></span></p>
                    </div>
                    <div class="col-md-12 col-12 modalidadDespacho">
                        <p style="font-size: 10pt;"><span class="fw-bold">Referencía:</span> <span id="txtReferencia"></span></p>
                    </div>

                    <div class="col-md-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Fecha y hora de entrega (referencial):</span> <span id="txtFechaEntrega"></span></p>
                    </div>

                    <div class="col-md-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Punto de venta:</span> <span id="txtPuntoVenta"></span></p>
                    </div>
                    {{-- <div class="col-md-12 col-12 " style="display: none">
                        <p style="font-size: 10pt;"><span class="fw-bold">Información de envío:</span> <span id="txtInfoEnvio">Enviado por la empresa</span></p>
                    </div> --}}




                    <div class="col-md-12 col-12">
                        <h5 class="fw-bold mb-4 mt-4 text-verde">RECOGERÁ EL PEDIDO:</h5>
                    </div>
                    <div class="col-md-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold mb-4 mt-4">Nombres y apellidos:</span> <span id="txtNomApeDest"></span></p>
                    </div>
                    {{--<div class="col-md-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold mb-4 mt-4">DNI/CE:</span> <span id="txtNumDocumentoDest"></span></p>
                    </div>--}}




                    <div class="col-md-12 col-12">
                        <hr>
                        <h5 class="fw-bold mb-4 mt-4 text-verde">DATOS PARA LA FACTURACIÓN:</h5>
                    </div>
                    <div class="col-md-12 col-12">
                        <p style="font-size: 10pt;"><span class="fw-bold">Tipo de comprobante:</span> <span id="txtTipoComprobante"></span></p>
                    </div>
                    <div class="col-md-12 col-12 tipoComprobante">
                        <p style="font-size: 10pt;"><span class="fw-bold">Razon social:</span> <span id="txtRazonSocial"></span></p>
                    </div>
                    <div class="col-md-12 col-12 tipoComprobante">
                        <p style="font-size: 10pt;"><span class="fw-bold">Ruc:</span> <span id="txtRuc"></span></p>
                    </div>





                    <div class="col-md-12 col-12 mt-4">
                        <h4 class="mb-4">Su compra tiene (<span id="txtCantidadProductoVendidos"></span> Items)</h4>
                        <div class="table-responsive tabla-transparente">
                            <table class="table" id="tblDetalleVenta">
                                <thead>
                                <tr>
                                    <th colspan="2">Producto</th>
                                    <th>Precio</th>
                                    <th class="text-md-center">Cantidad</th>
                                    <th class="text-md-end">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <p class="text-dark m-0 fw-bold text-uppercase">Subtotal</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0" id="txtSubtotal">{{ $monedaGeneral->format('0.00') }}</h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <p class="text-dark m-0 fw-bold text-uppercase">Costo de envío</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0" id="txtCostoEnvio">{{ $monedaGeneral->format('0.00') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <p class="text-dark m-0 fw-bold text-uppercase">Descuento</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0" id="txtCuponDescuento">- {{ $monedaGeneral->format('0.00') }}</h4>
                            </div>
                        </div>
                    </div>

                    {{--
                    <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <p class="text-dark m-0 fw-bold text-uppercase">Valor de la venta</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0" id="txtValorVenta">{{ $monedaGeneral->format('0.00') }}</h4>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <p class="text-dark m-0 fw-bold text-uppercase">IGV (18%)</p>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0" id="txtIgv">{{ $monedaGeneral->format('0.00') }}</h4>
                            </div>
                        </div>
                    </div>
                    --}}

                    <div class="col-12 pb-lg-3 pb-md-3 pt-lg-3 pt-md-3 pb-1 pt-1">
                        <div class="row align-items-center">
                            <div class="col-lg-8 col-md-8 col-6">
                                <h4 class="m-0 fw-bold text-dark text-uppercase">Total</h4>
                            </div>
                            <div class="col-lg-4 col-md-4 col-6 ps-0 text-end">
                                <h4 class="fw-bold fs-6 m-0" id="txtTotal">{{ $monedaGeneral->format('0.00') }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 justify-content-center">
                <button type="button" class="btn btn-danger px-5 py-3" data-bs-dismiss="modal">CERRAR</button>
            </div>
        </div>
    </div>

</div>


