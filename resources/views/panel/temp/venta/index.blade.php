@extends('panel.template.index')
@section('cuerpo')
    @include('panel.venta.modalDetalle')
    @include('panel.venta.modalAnularVenta')
    @include('panel.venta.modalEstadoEnvio')
    @include('panel.venta.modalEstadoPago')
    @include('panel.venta.modalDetalleVoucher')
    @include('panel.venta.modalPDF')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar ventas</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right" style="display: none">
                                <button id="btnModalCrear" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</button>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="cantidadRegistros">Cantidad de registros</label>
                                    <select name="cantidadRegistros" id="cantidadRegistros" class="form-control form-control-sm">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="9999999">Todos</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 my-2">
                                <form id="frmBuscar">
                                    @csrf
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" id="txtBuscar" name="txtBuscar" class="form-control" placeholder="Buscar...">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12" id="listado">
                                @include('panel.venta.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')

    <script type="module">



        const URL_LISTADO                        = "{{ route('ventas.listar') }}";
        const URL_DETALLEVENTA                   = "{{ route('ventas.detalleVenta') }}";
        const URL_MODIFICAR_ESTADO_ENVIO         = "{{ route('ventas.modificarEstadoEnvio') }}";
        const URL_MODIFICAR_ESTADO_PAGO          = "{{ route('ventas.modificarEstadoPago') }}";
        const URL_ANULAR_VENTA                   = "{{ route('ventas.anularVenta') }}";
        const URL_MODIFICAR_ESTADO_CONTROL_VENTA = "{{ route('ventas.modificarEstadoControlVenta') }}";
        const URL_PDF                            = "{{ route('ventas.pdf','idventa') }}";
        const URL_BASE_PRODUCTO = "{{ asset('panel/img/producto') }}"+"/";



        const filtros = () => {

            $(document).on("click","a.page-link",function(e) {
                e.preventDefault();
                var url = e.target.href;
                var paginaActual = url.split("?pagina=")[1];
                var cantidadRegistros = $("#cantidadRegistros").val();

                listado(cantidadRegistros,paginaActual);
            });

            $(document).on("change","#cantidadRegistros",(e)=>{
                e.preventDefault();
                var paginaActual = $("#paginaActual").val();
                var cantidadRegistros = e.target.value;

                listado(cantidadRegistros,paginaActual);
            });

            $(document).on("submit","#frmBuscar",(e)=>{
                e.preventDefault();
                var cantidadRegistros = $("#cantidadRegistros").val();
                listado(cantidadRegistros,1);
            });

        }

        const listado = async (cantidadRegistros = 10,paginaActual = 1) => {
            cargando();

            const form = {
                cantidadRegistros : cantidadRegistros,
                paginaActual : paginaActual,
                txtBuscar : $("#txtBuscar").val().trim(),
            }

            try{
                const response = await axios.post(URL_LISTADO, form );
                const data = response.data;

                stop();
                document.querySelector("#listado").innerHTML = data;


            }catch(error){
                errorCatch(error);
            }


        }

        const modales = () => {

            $(document).on("click",".btnModalEstadoEnvio",function (e) {

                e.preventDefault();

                var idventa = $(this).data('idventa');
                var idestado_envio = $(this).data('idestado_envio');

                $("#frmEstadoEnvio input[name=idventa]").val(idventa);
                $("#frmEstadoEnvio select[name=idestado_envio]").val(idestado_envio);

                $("#modalEstadoEnvio").modal('show');
            });

            $(document).on("click",".btnModalEstadoPago",function (e) {

                e.preventDefault();

                var idventa = $(this).data('idventa');
                var idestado_pago = $(this).data('idestado_pago');

                $("#frmEstadoPago input[name=idventa]").val(idventa);
                $("#frmEstadoPago select[name=idestado_pago]").val(idestado_pago);

                $("#modalEstadoPago").modal('show');
            });

            $(document).on("click",".btnModalAnularVenta",function (e) {

                e.preventDefault();

                var idventa = $(this).closest('div.dropdown-menu').data('idventa');

                $("#frmAnularVenta input[name=idventa]").val(idventa);

                $("#modalAnularVenta").modal('show');
            });

            $(document).on("click",".btnModalDetalleVenta",function (e) {

                e.preventDefault();

                var idventa = $(this).closest('div.dropdown-menu').data('idventa');
                cargando('Procesando...')

                axios({
                    url: URL_DETALLEVENTA,
                    method:'POST',
                    data: {
                        idventa:idventa
                    },
                })
                    .then( response => {
                        const data = response.data;
                        const venta = data.venta;
                        const ventaDetalle = data.ventaDetalle;

                        let estadoControlVenta = `<span class="badge badge-info">${venta.estado_control_venta.nombre}</span>`;
                        if (venta.idestado_control_venta == 2){
                            estadoControlVenta = `<span class="badge badge-success">${venta.estado_control_venta.nombre}</span>`;
                        }
                        if (venta.idestado_control_venta == 3){
                            estadoControlVenta = `<span class="badge badge-danger">${venta.estado_control_venta.nombre}</span>`;
                        }

                        $("#txtEstadoControlVenta").html(estadoControlVenta);

                        $("#txtIdVenta").html(str_pad(venta.idventa,7,0,STR_PAD_LEFT));

                        $("#txtFechaHora").html(reformatDateTime(venta.fecha_venta));


                        $("#txtMetodoPago").html(venta.metodo_pago.descripcion);
                        $("#txtEstadoEnvio").html(venta.estado_envio.nombre);
                        $("#txtEstadoPago").html(venta.estado_pago.nombre);



                        $("#txtApellidos").html(venta.apellidos);
                        $("#txtNombres").html(venta.nombres);
                        $("#txtTipoDocumento").html(venta.tipo_documento_identidad.nombre);
                        $("#txtNumDocumento").html(venta.numero_documento_identidad);
                        $("#txtCorreo").html(venta.correo);
                        $("#txtTelefono").html(venta.telefono);


                        $("#txtModalidadDespacho").html(venta.metodo_entrega.nombre);

                        $('.modalidadDespacho').hide();
                        $("#txtPuntoVenta").parent().hide();
                        $("#txtFechaEntrega").html(reformatDateTime(venta.fecha_entrega));
                        if (venta.idmetodo_entrega == 1){
                            $("#txtDepartamento").html(venta.departamento.nombre);
                            $("#txtProvincia").html(venta.provincia.nombre);
                            $("#txtDistrito").html(venta.distrito.nombre);
                            $("#txtDireccion").html(venta.direccion);
                            $("#txtReferencia").html(venta.referencia);
                            $('.modalidadDespacho').show();
                        }else{
                            if(!empty(venta.punto_venta)){
                                const punto = venta.punto_venta.nombre+" - "+str_pad(venta.punto_venta.idpunto_venta,7,0,STR_PAD_LEFT) ;
                                $("#txtPuntoVenta").html(punto);
                                $("#txtPuntoVenta").parent().show();
                            }
                        }
                        // $("#txtInfoEnvio").html(venta.infoEnvio);


                        if (!empty(venta.otro_receptor)){
                            $("#txtNomApeDest").html(venta.otro_receptor);
                        }else{
                            $("#txtNomApeDest").html(venta.nombres+" "+venta.apellidos);
                        }
                        // $("#txtNumDocumentoDest").html(venta.numDocumentoDest);


                        $("#txtTipoComprobante").html(venta.facturacion.nombre);
                        $('.tipoComprobante').hide();
                        if(venta.facturacion_idcomprobante == 2){
                            $("#txtRazonSocial").html(venta.facturacion_razon_social);
                            $("#txtRuc").html(venta.facturacion_ruc);
                            $('.tipoComprobante').show();

                        }


                        //tabla detalle de venta
                        $("#tblDetalleVenta tbody").html('');


                        $.each(ventaDetalle, function(index, vd) {
                            const producto = vd.producto;

                            const row = `
                                <tr>
                                    <td class="text-center">${ str_pad(producto.idproducto,7,0,STR_PAD_LEFT) }</td>
                                    <td>
                                        <img style="width:100px;height:80px" class="img-thumbnail" src="${ URL_BASE_PRODUCTO+producto.imagen }" alt="">
                                        ${ producto.nombre }
                                    </td>
                                    <td class="text-right">${ venta.moneda.simbolo }  ${ number_format(vd.precio_producto * venta.precio_cambio,2,".","") }</td>
                                    <td class="text-center">${ vd.cantidad }</td>
                                    <td class="text-right">${ venta.moneda.simbolo }  ${ number_format(vd.subtotal * venta.precio_cambio,2,".","") }</td>
                                </tr>
                            `;

                            $("#tblDetalleVenta tbody").append(row);

                        });


                        //fin

                        const cantidadDetalle = ventaDetalle.reduce( (acc,vd) => vd.cantidad, 0);
                        $("#txtCantidadProductoVendidos").html(cantidadDetalle);

                        $("#txtSubtotal").html(venta.moneda.simbolo+" "+venta.total_alt);
                        // $("#txtIgv").html(venta.igv);
                        $("#txtCuponDescuento").html("- "+venta.moneda.simbolo+" "+(!empty(venta.descuento_alt) ? venta.descuento_alt :  '0.00'));
                        $("#txtCostoEnvio").html("+ "+venta.moneda.simbolo+" "+venta.precio_envio_alt);
                        $("#txtTotal").html(venta.moneda.simbolo+" "+venta.total_final_alt);



                        $("#modalDetalleVenta").modal("show");
                    })
                    .catch( errorCatch )
                    .then( _ => {
                        stop();
                    })

            });

            $(document).on("click",".btnModalPDF",function (e) {
                e.preventDefault();

                const idventa = $(this).closest('div.dropdown-menu').data('idventa');

                $('#pdf_generate').attr('src',URL_PDF.replace('idventa',idventa));

                $('#modalPDF').modal('show');



            });


        }


        const modificarEstadoEnvio = () => {

            $(document).on("submit","#frmEstadoEnvio",function (e) {

                e.preventDefault();

                const form = new FormData($(this)[0]);

                cargando('Modificando...')

                axios({
                    url: URL_MODIFICAR_ESTADO_ENVIO,
                    method:'POST',
                    data: form,
                })
                .then( response => {
                    const data = response.data;
                    notificacion('success','Exito',data.mensaje);
                })
                .catch( errorCatch )
                .then( () => {
                    stop();
                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    $("#modalEstadoEnvio").modal('hide');
                })

            });
        }

        const modificarEstadoPago = () => {

            $(document).on("submit","#frmEstadoPago",function (e) {

                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Modificando...')

                axios({
                    url: URL_MODIFICAR_ESTADO_PAGO,
                    method:'POST',
                    data: form,
                })
                .then( response => {
                    const data = response.data;
                    notificacion('success','Exito',data.mensaje);

                })
                .catch( errorCatch )
                .then( _ => {
                    stop();
                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    $("#modalEstadoPago").modal('hide');
                })

            });
        }

        const modificarEstadoControlVenta = () => {

            $(document).on("click",".btnModalProcesarVenta",function (e) {

                e.preventDefault();

                var idventa = $(this).closest('div.dropdown-menu').data('idventa');

                cargando('Procesando...')

                axios({
                    url: URL_MODIFICAR_ESTADO_CONTROL_VENTA,
                    method:'POST',
                    data: {
                        idventa : idventa,
                        idestado_control_venta : 1,
                    },
                })
                    .then( response => {
                        const data = response.data;
                        notificacion('success','Exito',data.mensaje);
                    })
                    .catch( errorCatch )
                    .then( _ => {
                        stop();
                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    })

            });

            $(document).on("click",".btnModalFinalizarVenta",function (e) {

                e.preventDefault();

                var idventa = $(this).closest('div.dropdown-menu').data('idventa');

                cargando('Finalizando...')

                axios({
                    url: URL_MODIFICAR_ESTADO_CONTROL_VENTA,
                    method:'POST',
                    data: {
                        idventa : idventa,
                        idestado_control_venta : 2,
                    },
                })
                    .then( response => {
                        const data = response.data;
                        notificacion('success','Exito',data.mensaje);
                    })
                    .catch( errorCatch )
                    .then( _ => {
                        stop();
                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    })

            });

            $(document).on("submit","#frmAnularVenta",function (e) {

                e.preventDefault();

                const form = new FormData($(this)[0]);

                cargando('Anulando...')

                axios({
                    url: URL_ANULAR_VENTA,
                    method:'POST',
                    data: form,
                 })
                .then( response => {
                    const data = response.data;
                    notificacion('success','Exito',data.mensaje);
                })
                .catch( errorCatch )
                .then( _ => {
                    stop();
                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());
                    $("#modalAnularVenta").modal('hide');
                })

            });
        }





        $(function () {
            filtros();
            modales();
            modificarEstadoControlVenta();
            modificarEstadoEnvio();
            modificarEstadoPago();
        });

    </script>

@endpush
