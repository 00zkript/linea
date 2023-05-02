@extends('web.template.index')
@section('titulo','MI PERFIL')
@push('css')
    <style>
        #tablaCompras > thead > tr > th{
            font-size: 0.9em;
            white-space: nowrap;
        }

        #tablaCompras > tbody > tr > td{
            font-size: 0.86em;
            text-align: center;
            vertical-align: middle;
            text-transform: uppercase;
            font-size: 76%;
        }
        #tablaCompras > tbody > tr > td:nth-child(even) { background: #fff;}
        #tablaCompras > tbody > tr > td:nth-child(odd) { background: #fff;}

        .tabla-transparente .table > tbody > tr > td{
            font-size: 0.86em;
        }
        .tabla-transparente .table > thead > tr > th{
            font-size: 0.9em;
        }
        @media(max-width: 767px){
            .tabla-transparente .table > thead > tr > th{
                white-space: normal;
                font-size: 0.8em;
            }
            .tabla-transparente .table > tbody > tr > td {
                white-space: normal;
                font-size: 0.8em;
            }
        }
    </style>

    <link href="{{ asset('panel/fileinput/css/fileinput.min.css') }}" rel="stylesheet">
    <link href="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.css') }}" rel="stylesheet">
    <style>
        .close.fileinput-remove {
            background: #fff;
            border: 0;
        }
    </style>
@endpush
@section('contenido')
    @include('web.usuario.modalDetalleVenta')
    @include('web.usuario.modalChangeComprobante')

    <section class="fondo-plomo pt-2 pb-2">
        <div class="container">
            <ul class="linkeables">
                <li><a href="{{ url('/') }}"><i class="fa-solid fa-house-chimney"></i>Inicio</a></li>
                <li><a href="#">Mi Perfil</a></li>
            </ul>
        </div>
    </section>
    <div class="container mt-5 mb-md-6 mb-4">
        <h2 class="fw-bold text-center text-uppercase">¡Hola, {{ auth()->user()->usuario ?: 'Usuario' }}!</h2>
        <p class="text-center mb-4">Bienvenido a tu cuenta, aquí podrás administrar todos los datos necesarios para comprar en
            {{ $empresaGeneral->nombre }}.</p>

        <h4 class="fw-bold numerador"><i>1</i> <span>Mis compras</span></h4>

        <div class="row mt-md-5 mt-4">
            <div class="col-lg-12 col-md-12 col-12">

                <div class="row">
                    <div class="col-md-4 col-sm-6 col-12">
                        <div class="row text-liston align-items-center">
                            <label class="col-md-7 col-7 col-form-label fw-bold text-uppercase py-0" for="cantidadRegistros">Cantidad de registros</label>
                            <div class="col-md-5 col-5">
                                <aside>
                                    <select name="cantidadRegistros" id="cantidadRegistros" class="form-control form-control-sm">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                        <option value="9999999">Todos</option>
                                    </select>
                                    <i class="fa-solid fa-sort-down"></i>
                                </aside>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-6 col-12">
                        <form id="frmBuscar" onsubmit="return false;">
                            @csrf
                            <div class="input-group mb-3">
                              <input type="text" id="txtBuscar" name="txtBuscar" class="form-control" placeholder="Buscar por codigo..." aria-label="Recipient's username" aria-describedby="basic-addon2">
                              <span class="input-group-text btn-primary" id="basic-addon2"><i class="fa-regular fa-magnifying-glass"></i></span>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default panelCarrito">
                    <div class="table-responsive scroll" id="listado">
                        @include('web.usuario.listadoVentas')
                    </div>
                </div>

            </div>
        </div>

        <h4 class="fw-bold numerador"><i>2</i> <span>Mis datos</span></h4>

        <div class="row mt-md-5 mt-4">
            <div class="col-lg-12 col-md-12 col-12">
                <form id="frmMisDatos" onsubmit="return false;">
                    <div class="row">
                        @csrf

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="nombres" class="fw-bold mb-2">NOMBRES <span class="text-danger">*</span></label>
                                <input value="{{ $cliente->nombres }}" type="text" id="nombres" name="nombres" placeholder="Nombres" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="apellidos" class="fw-bold mb-2">APELLIDOS <span class="text-danger">*</span></label>
                                <input value="{{ $cliente->apellidos }}" type="text" id="apellidos" name="apellidos" placeholder="Apellidos" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="tipoDocumentoIdentidad" class="fw-bold mb-2">TIPO DOCUMENTO <span class="text-danger">*</span></label>
                                <aside>
                                    <select  name="tipoDocumentoIdentidad" id="tipoDocumentoIdentidad" class="form-control mb-3" required>
                                        <option value="" hidden selected>[--Seleccione--]</option>
                                        @foreach($tipoDocumentoIdentidad as $item)
                                            <option value="{{ $item->idtipo_documento_identidad }}"{{ (!$cliente->idtipo_documento_identidad && $loop->iteration == 1 ) || $cliente->idtipo_documento_identidad == $item->idtipo_documento_identidad ? 'selected' : '' }}>
                                                {{ $item->nombre }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <i class="fa-solid fa-sort-down"></i>
                                </aside>
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="numeroDocumentoIdentidad" class="fw-bold mb-2">N° DOCUMENTO <span class="text-danger">*</span></label>
                                <input value="{{ $cliente->numero_documento_identidad }}" type="text" name="numeroDocumentoIdentidad" id="numeroDocumentoIdentidad" required class="form-control soloNumeros mb-3"  minlength="{{ $cliente->idtipo_documento_identidad == 1 || $cliente->idtipo_documento_identidad === null ? 8 : 12  }}" maxlength="{{ $cliente->idtipo_documento_identidad == 1 ? 8 : 12  }}" placeholder="#">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="telefono" class="fw-bold mb-2">TELÉFONO <span class="text-danger">*</span></label>
                                <input value="{{ $cliente->telefono }}" type="text" name="telefono" id="telefono" required class="form-control soloNumeros mb-3" maxlength="15" placeholder="#">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="correo" class="fw-bold mb-2">CORREO <span class="text-danger">*</span></label>
                                <input value="{{ $cliente->correo }}" type="email" id="correo" name="correo" placeholder="Ejemplo@correo.com" required class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="clave" class="fw-bold mb-2">CAMBIAR CONTRASEÑA <span style="font-weight: normal">(Opcional)</span></label>
                                <input type="password" id="clave" name="clave" placeholder="*******"  class="form-control mb-3" maxlength="250">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-12 col-12">
                            <div class="form-group text-liston">
                                <label for="clave_confirmation" class="fw-bold mb-2">CONFIRMAR CONTRASEÑA</label>
                                <input type="password" id="clave_confirmation" name="clave_confirmation" placeholder="*******"  class="form-control mb-3" maxlength="250">
                            </div>
                        </div>


                        <div class="col-lg-4 offset-lg-1 col-md-5 col-12 mt-4 mb-4">
                            <button type="submit" class="btn btn-primary w-100 p-3"><i class="fa-solid fa-arrows-rotate"></i>&nbsp;&nbsp; ACTUALIZAR MI INFORMACIÓN</button>
                        </div>


                        <div class="col-lg-4 offset-lg-2 col-md-5 col-12 mt-4 mb-4">
                            <a href="{{ route('web.login.salir') }}" class="btn btn-danger w-100 p-3 text-uppercase"><i class="fa-solid fa-circle-xmark"></i>&nbsp;&nbsp; Cerrar Session</a>
                        </div>

                    </div>
                </form>
            </div>
        </div>


    </div>
@endsection
@push('js')
    <script src="{{ asset('panel/fileinput/js/fileinput.min.js') }}"></script>
    <script src="{{ asset('panel/fileinput/js/plugins/sortable.min.js') }}"></script>
    <script src="{{ asset('panel/fileinput/js/locales/es.js') }}"></script>
    <script src="{{ asset('panel/fileinput/themes/explorer-fa/theme.min.js') }}"></script>
    <script src="{{ asset('panel/fileinput/themes/fa/theme.min.js') }}"></script>

    <script type="module">


        const BASE_URL = "{{ url('/') }}";


        const listado = () => {

            $(document).on("click","a.page-link",function(e) {
                e.preventDefault();
                const url = e.target.href;
                const paginaActual = url.split("?pagina=")[1];
                const cantidadRegistros = $("#cantidadRegistros").val();

                ajaxListado(cantidadRegistros,paginaActual);
            });

            $(document).on('change', '#cantidadRegistros',function(e) {
                e.preventDefault();
                const paginaActual = $("#paginaActual").val();
                const cantidadRegistros = e.target.value;

                ajaxListado(cantidadRegistros,paginaActual);
            });

            $(document).on('submit', '#frmBuscar',function(e) {
                e.preventDefault();
                const cantidadRegistros = $("#cantidadRegistros").val();
                ajaxListado(cantidadRegistros,1);
            });

            $(document).on('click', '#basic-addon2',function(e) {
                e.preventDefault();
                const cantidadRegistros = $("#cantidadRegistros").val();
                ajaxListado(cantidadRegistros,1);
            });

        }

        const ajaxListado = (cantidadRegistros = 10,paginaActual = 1) => {

            $('body').waitMe(waitMeEffectBounce);
            axios.post("{{ route('web.usuario.listadoVentas') }}",{
                cantidadRegistros:cantidadRegistros,
                paginaActual:paginaActual,
                txtBuscar: $("#txtBuscar").val().trim(),
            })
            .then( response => {
                const data = response.data;

                $("#listado").html(data);
            })
            .catch( error => {
                const response = error.response;
                const data = response.data;
                console.log(data);
            })
            .then( _ => {
                stop();
            })


        }


        const modales = function () {

            $(document).on("click",".btnModalDetalleVenta",function (e) {
                e.preventDefault();

                const idventa = $(this).data('idventa');

                $('body').waitMe(waitMeEffectBounce);
                axios.post("{{ route('web.usuario.detalleVenta') }}",{
                    idventa : idventa
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
                                    <td class="cart-figure">
                                        <figure class="border border-1 rounded-2 overflow-hidden text-center">
                                            <img src="${ BASE_URL+'/panel/img/producto/'+producto.imagen }" class="img-carrito-compras-pag" alt="${ producto.nombre }" title="${ producto.nombre }">
                                        </figure>
                                    </td>
                                    <td class="cart-nombre">
                                        <h5 class="ps-3 mb-0" style="font-size: 10pt;">
                                            <span>${ producto.nombre }</span>
                                            <i class="text-secondary fw-light mt-2 mb-2 d-block fs-7 fst-normal">Código: ${ producto.codigo }</i>
                                        </h5>
                                    </td>
                                    <td class="cart-precio">
                                        <span class="cart-item-oculto hidden-lg hidden-md hidden-sm">Precio</span>
                                        <span class="ps-md-0 ps-3 ws-nowrap">${ venta.moneda.simbolo } ${ number_format(vd.precio_producto * venta.precio_cambio,2,".","") }</span>
                                    </td>
                                    <td class="cart-cantidad text-md-center">
                                        <span class="cart-item-oculto hidden-lg hidden-md hidden-sm">Cantidad</span>
                                        <span class="ps-md-0 ps-3">${ vd.cantidad }</span>
                                    </td>
                                    <td class="space-nowrap text-md-end cart-total ws-nowrap">
                                        <span class="cart-item-oculto hidden-lg hidden-md hidden-sm">Total</span>
                                        <span class="ps-md-0 ps-3">${ venta.moneda.simbolo } ${ number_format(vd.subtotal * venta.precio_cambio,2,".","") }</span>
                                    </td>
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
                // .catch( error => {
                //     const response = error.response;
                //     const data = response.data;
                //     // console.log(data);


                //     if (response.status == 422){
                //         toast('error',listErrors(data),"Errores:");
                //         return false;
                //     }

                //     if (response.status == 400){
                //         toast('error',data.mensaje);
                //         return false;
                //     }

                //     toast('error','Error del servidor, contácte con soporte.');

                // })
                .finally( _ => {
                    stop();
                })


            });

            $(document).on("click",".btnModalChangeComprobante",function (e) {
                e.preventDefault();

                const idventa = $(this).data('idventa');
                const comprobante = $(this).data('comprobante');

                $('body').waitMe(waitMeEffectBounce);


                $('#frmChangeComprobante')[0].reset();
                $('#frmChangeComprobante input[name=idventa]').val(idventa);
                $('.codigo').html(str_pad(idventa,7,0,STR_PAD_LEFT));
                let config = settingComprobante ;
                config.required = true;

                if (!empty(comprobante)) {

                    config = {
                        ...settingComprobante,
                        required : false,
                        initialPreview : [ BASE_URL+'/panel/img/comprobante/'+idventa+'/'+comprobante ],
                        initialPreviewConfig : { caption : comprobante , width : "120px", height : "120px", },
                        // uploadUrl : URL_UPDATE_IMAGEN,
                        // uploadExtraData : { idventa  : idventa },
                        // deleteUrl : URL_REMOVE_IMAGE,
                    }

                }

                $('#comprobante').fileinput('destroy').fileinput( config );




                stop();
                $("#modalChangeComprobante").modal("show");
            });

        }

        const actionsComprobante = () => {
            $(document).on('submit','#frmChangeComprobante',function (e) {
                e.preventDefault();
                const form = new FormData(this);

                $('body').waitMe(waitMeEffectBounce);

                axios.post("{{ route('web.usuario.updateComprobante') }}",form)
                .then( response => {
                    const data = response.data;

                    const paginaActual = $("#paginaActual").val();
                    const cantidadRegistros = $("#cantidadRegistros").val();

                    toast("success",data.mensaje);

                    ajaxListado(
                        cantidadRegistros,
                        paginaActual
                    );
                    $("#modalChangeComprobante").modal("hide");

                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;
                    // console.log(data);


                    if (response.status == 422){
                        toast('error',listErrors(data),"Errores:");
                        return false;
                    }

                    if (response.status == 400){
                        toast('error',data.mensaje);
                        return false;
                    }

                    toast('error','Error del servidor, contácte con soporte.');

                })
                .finally( _ => {
                    stop();
                })

            })
        }

        const actionsUser = function () {

            $("#frmMisDatos input").on("keyup",function (e) {
                e.preventDefault();
                $(this).removeClass('input-error');
            })


            $("#frmMisDatos").on("submit",function(e){
                e.preventDefault();

                if ($('#clave').val() != ''){

                    if ($('#clave').val().length <= 5 ){
                        toast("error","La contraseña debe tener una longitud minima de 6 carácteres.");
                        return false;
                    }

                    if ( $('#clave').val() !== $('#clave_confirmation').val()){
                        toast("error","La contraseña no coincide. Intente nuevamente.");
                        $('#clave').focus()
                        return false;
                    }

                }

                const form = new FormData($(this)[0]);

                $('body').waitMe(waitMeEffectBounce);
                $("#frmMisDatos button[type=submit]").prop('disabled',true);

                axios.post("{{ route('web.usuario.modificarDatos') }}",form)
                .then( response => {
                    const data = response.data;

                    toast("success",data.mensaje);
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;
                    console.log(data);


                    if (response.status == 422){
                        toast('error',listErrors(data),"Errores:");
                        return false;
                    }

                    if (response.status == 400){
                        toast('error',data.mensaje);
                        return false;
                    }

                    toast('error','Error del servidor, contácte con soporte.');
                })
                .then( _ => {
                    stop();
                    $("#frmMisDatos button[type=submit]").prop('disabled',false);
                })



            });
        }

        const changeTipoDocumentoIdentidad = () => {
            $(document).on('change','#tipoDocumentoIdentidad', function(e){
                e.preventDefault();

                const val = $(this).val();

                if (val == 1){
                    $('#numeroDocumentoIdentidad').attr('minLength',8);
                    $('#numeroDocumentoIdentidad').attr('maxLength',8);
                    $('#numeroDocumentoIdentidad').val($('#numeroDocumentoIdentidad').val().substring(0,8));
                }

                if (val == 2){
                    $('#numeroDocumentoIdentidad').attr('minLength',12);
                    $('#numeroDocumentoIdentidad').attr('maxLength',12);
                    $('#numeroDocumentoIdentidad').val($('#numeroDocumentoIdentidad').val().substring(0,12));
                }

                if (val == 3){
                    $('#numeroDocumentoIdentidad').attr('minLength',12);
                    $('#numeroDocumentoIdentidad').attr('maxLength',12);
                    $('#numeroDocumentoIdentidad').val($('#numeroDocumentoIdentidad').val().substring(0,12));

                }
            })
        }


        const settingComprobante = {
            dropZoneTitle:'Arrastre el comprobante aquí',
            theme : 'fa',
            language : 'es',
            uploadAsync : false,
            showUpload : false,
            allowedFileTypes : ["image"],
            // allowedFileExtensions : ['jpg', 'png', 'jpeg','gif','webp','tiff','tif','svg','bmp','mp4']
            overwriteInitial : false,
            initialPreviewAsData : true,
            removeFromPreviewOnError : true,
            fileActionSettings : {
                showRemove  : false,
                showUpload  : false,
                showZoom    : true,
                showDrag    : false
            },
        }

        $('#comprobante').fileinput(settingComprobante);


        $(function () {
            actionsComprobante();
            actionsUser();
            listado();
            modales();
            changeTipoDocumentoIdentidad();

            $('.soloNumeros').on('keypress',validarSoloNumeros);
            $(document).on('click','.btn-close',function(e){
                e.preventDefault();
                $(this).closest('.modal').modal('hide')
            })
        });

    </script>
@endpush
