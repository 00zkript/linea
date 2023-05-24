@extends('panel.template.index')
@section('cuerpo')
@include('panel.puntoVenta.crear')
@include('panel.puntoVenta.editar')
@include('panel.puntoVenta.habilitar')
@include('panel.puntoVenta.inhabilitar')
@include('panel.puntoVenta.eliminar')
@include('panel.puntoVenta.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar puntos de venta</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <button id="btnModalCrear" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</button>
                            </div>
                            <div class="col-md-6 col-md-12">
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
                                @include('panel.puntoVenta.listado')
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


        const URL_LISTADO     = "{{ route('puntoVentas.listar') }}";
        const URL_GUARDAR     = "{{ route('puntoVentas.store') }}";
        const URL_VER         = "{{ route('puntoVentas.show','show') }}";
        const URL_EDIT        = "{{ route('puntoVentas.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('puntoVentas.update','update') }}";
        const URL_HABILITAR   = "{{ route('puntoVentas.habilitar') }}";
        const URL_INHABILITAR = "{{ route('puntoVentas.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('puntoVentas.destroy','destroy') }}";


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
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idpunto_venta  = $(this).closest('div.dropdown-menu').data('idpunto_venta');
                $("#frmHabilitar input[name=idpunto_venta]").val(idpunto_venta);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idpunto_venta  = $(this).closest('div.dropdown-menu').data('idpunto_venta');
                $("#frmInhabilitar input[name=idpunto_venta]").val(idpunto_venta);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idpunto_venta = $(this).closest('div.dropdown-menu').data('idpunto_venta');
                $("#frmEliminar input[name=idpunto_venta]").val(idpunto_venta);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idpunto_venta = $(this).closest('div.dropdown-menu').data('idpunto_venta');

                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idpunto_venta : idpunto_venta} })
                .then(response => {
                    const data = response.data;
                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar span.error").remove();
                    $("#idpunto_venta").val(data.idpunto_venta);
                    $("#nombreEditar").val(data.nombre);
                    $("#direccionEditar").val(data.direccion);
                    $("#telefonoEditar").val(data.telefono);
                    $("#whatsappEditar").val(data.whatsapp);
                    $("#correoEditar").val(data.correo);
                    $("#estadoEditar").val(data.estado);

                    $("#modalEditar").modal("show");
                })
                .catch(errorCatch)


            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idpunto_venta = $(this).closest('div.dropdown-menu').data('idpunto_venta');

                cargando('Procesando...');
                axios(URL_VER,{ params: {idpunto_venta : idpunto_venta} })
                .then(response => {
                    const data = response.data;
                    stop();
                    $("#txtNombre").html(data.nombre);
                    $("#txtTelefono").html(data.telefono);
                    $("#txtDireccion").html(data.direccion);
                    $("#txtWhatsapp").html(data.whatsapp);
                    $("#txtCorreo").html(data.correo);

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


        $(function () {
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();

        });


    </script>
@endpush
