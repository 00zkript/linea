@extends('panel.template.index')
@section('cuerpo')
@include('panel.cupon.crear')
@include('panel.cupon.editar')
@include('panel.cupon.habilitar')
@include('panel.cupon.inhabilitar')
@include('panel.cupon.eliminar')
@include('panel.cupon.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar cupones</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
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
                                @include('panel.cupon.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script !src="">
        const URL_LISTADO     = "{{ route('cupon.listar') }}";
        const URL_GUARDAR     = "{{ route('cupon.store') }}";
        const URL_VER         = "{{ route('cupon.show','show') }}";
        const URL_EDIT        = "{{ route('cupon.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('cupon.update','update') }}";
        const URL_HABILITAR   = "{{ route('cupon.habilitar') }}";
        const URL_INHABILITAR = "{{ route('cupon.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('cupon.destroy','destroy') }}";

        const filtros = () => {

            $(document).on("click","a.page-link",function(e) {
                e.preventDefault();
                const url = e.target.href;
                const paginaActual = url.split("?pagina=")[1];
                const cantidadRegistros = $("#cantidadRegistros").val();
                const txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual,txtBuscar);
            });

            $(document).on("change", "#cantidadRegistros", function(e) {
                e.preventDefault();
                const paginaActual = $("#paginaActual").val();
                const cantidadRegistros = e.target.value;
                const txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual,txtBuscar);
            });

            $(document).on("submit", "#frmBuscar", function(e) {
                e.preventDefault();
                const txtBuscar = $("#txtBuscar").val();
                const cantidadRegistros = $("#cantidadRegistros").val();
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

            $("#btnModalCrear").on("click",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                $("#fechaExpiracion").datepicker("setDate",null);
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idcupon = $(this).closest('div.dropdown-menu').data('idcupon');
                $("#frmHabilitar input[name=idcupon]").val(idcupon);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idcupon = $(this).closest('div.dropdown-menu').data('idcupon');
                $("#frmInhabilitar input[name=idcupon]").val(idcupon);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idcupon = $(this).closest('div.dropdown-menu').data('idcupon');
                $("#frmEliminar input[name=idcupon]").val(idcupon);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idcupon = $(this).closest('div.dropdown-menu').data('idcupon');


                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idcupon : idcupon} })
                .then(response => {
                    const data = response.data;
                    stop();
                    $("#frmEditar span.error").remove();
                    $("#frmEditar")[0].reset();

                    $("#idcupon").val(data.idcupon);
                    $("#codigoEditar").val(data.codigo);
                    $("#nombreEditar").val(data.nombre);
                    $("#tipoDescuentoEditar").val(data.tipoDescuento);
                    $("#descuentoMontoEditar").val(data.descuentoMonto);
                    $("#descuentoPorcentajeEditar").val(data.descuentoPorcentaje);

                    if (data.tipoDescuento === "monto"){
                        $("#iptDescuentoMontoEditar").show();
                        $("#iptDescuentoPorcentajeEditar").hide();
                    }else{
                        $("#iptDescuentoPorcentajeEditar").show();
                        $("#iptDescuentoMontoEditar").hide();
                    }

                    $("#cantidadEditar").val(data.cantidad);
                    $("#montoMinimoEditar").val(data.montoMinimo);
                    $("#fechaInicioEditar").datepicker("setDate",data.fechaInicioFormat);
                    $("#fechaExpiracionEditar").datepicker("setDate",data.fechaExpiracionFormat);


                    $("#estadoEditar").val(data.estado);

                    $("#modalEditar").modal("show");
                })
                .catch(errorCatch)



            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idcupon = $(this).closest('div.dropdown-menu').data('idcupon');


                cargando('Procesando...');
                axios(URL_VER,{ params: {idcupon : idcupon} })
                    .then(response => {
                        const data = response.data;
                        const moneyFormat = "{{ $monedaGeneral->format('0.00') }}";
                        stop();

                        $("#txtCodigo").html(data.codigo);
                        $("#txtNombre").html(data.nombre);
                        $("#txtTipoDescuento").html(data.tipoDescuento);
                        $("#txtDescuentoMonto").html( moneyFormat.replace('0.00',data.descuentoMonto));
                        $("#txtDescuentoPorcentaje").html(data.descuentoPorcentaje+"%");


                        if (data.tipoDescuento === "monto"){
                            $("#divDescuentoPorcentaje").hide();
                            $("#divDescuentoMonto").show();
                        }else{
                            $("#divDescuentoMonto").hide();
                            $("#divDescuentoPorcentaje").show();
                        }

                        $("#txtMontoMinimo").html( moneyFormat.replace('0.00',data.montoMinimo));
                        $("#txtCantidad").html(data.cantidad);
                        $("#txtFechaInicio").html(data.fechaInicioFormat);
                        $("#txtFechaExpiracion").html(data.fechaExpiracionFormat);


                        if (data.estado){
                            $("#txtEstado").html('<label class="badge badge-success">Habilitado</label>');
                        }else{
                            $("#txtEstado").html('<label class="badge badge-danger">Inhabilitado</label>');
                        }

                        $("#modalVer").modal("show");

                    })
                    .catch(errorCatch)


            });

        }

        const guardar = () => {
            $(document).on("submit","#frmCrear",function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);

                cargando('Procesando...');
                axios.post(URL_GUARDAR,form)
                    .then(response => {
                        const data = response.data;
                        stop();

                        $("#modalCrear").modal("hide");
                        notificacion("success","Registro exitoso",data.mensaje);
                        listado();

                    })
                    .catch(errorCatch)




            });
        }


        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');
                axios.post(URL_MODIFICAR,form)
                    .then(response => {
                        const data = response.data;

                        stop();
                        $("#modalEditar").modal("hide");
                        notificacion("success","Modificación exitosa",data.mensaje);
                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    })
                    .catch(errorCatch)


            });
        }

        const habilitar = () => {
            $(document).on( "submit" ,"#frmHabilitar", function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);
                cargando('Procesando...');

                axios.post(URL_HABILITAR,form)
                    .then( response => {
                        const data = response.data;
                        stop();

                        $("#modalHabilitar").modal("hide");

                        notificacion("success","Habilitado",data.mensaje);

                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    })
                    .catch( errorCatch )


            } )

        }

        const inhabilitar = () => {
            $(document).on( "submit","#frmInhabilitar" , function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');

                axios.post(URL_INHABILITAR,form)
                    .then( response => {
                        const data = response.data;
                        stop();
                        $("#modalInhabilitar").modal("hide");

                        notificacion("success","Inhabilitado",data.mensaje);

                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    } )
                    .catch( errorCatch )

            } )
        }

        const eliminar = () => {
            $(document).on( "submit","#frmEliminar" , function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');

                axios.post(URL_ELIMINAR,form)
                    .then( response => {
                        const data = response.data;
                        stop();
                        $("#modalEliminar").modal("hide");

                        notificacion("success","Eliminado",data.mensaje);

                        listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                    } )
                    .catch( errorCatch )

            } )
        }

        const cmbTipoDescuento = function () {
            $("#tipoDescuento").on("change",function (e) {
                e.preventDefault();
                let tipo = $(this).val();

                $("#descuentoMonto").val(0);
                $("#descuentoPorcentaje").val(0);

                if (tipo === "monto"){
                    $("#iptDescuentoMonto").show();
                    $("#iptDescuentoPorcentaje").hide();
                }else{
                    $("#iptDescuentoPorcentaje").show();
                    $("#iptDescuentoMonto").hide();
                }

            });

            $("#tipoDescuentoEditar").on("change",function (e) {
                e.preventDefault();
                let tipo = $(this).val();

                $("#descuentoMontoEditar").val(0);
                $("#descuentoPorcentajeEditar").val(0);
                if (tipo === "monto"){
                    $("#iptDescuentoMontoEditar").show();
                    $("#iptDescuentoPorcentajeEditar").hide();
                }else{
                    $("#iptDescuentoPorcentajeEditar").show();
                    $("#iptDescuentoMontoEditar").hide();
                }

            });
        }




        $(function () {
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();
            cmbTipoDescuento();

            $('#fechaInicio,#fechaExpiracion').datepicker({
                language: 'es',
                autoclose:true,
                format:'dd/mm/yyyy',
            });
            $('#fechaInicioEditar,#fechaExpiracionEditar').datepicker({
                language: 'es',
                autoclose:true,
                format:'dd/mm/yyyy',
            });


        });


    </script>
@endpush
