@extends('panel.template.index')
@section('cuerpo')
@include('panel.costoEnvio.crear')
@include('panel.costoEnvio.editar')
@include('panel.costoEnvio.habilitar')
@include('panel.costoEnvio.inhabilitar')
@include('panel.costoEnvio.eliminar')
@include('panel.costoEnvio.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar costo de envío</p>
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
                                @include('panel.costoEnvio.listado')
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


        const URL_LISTADO     = "{{ route('costo-envio.listar') }}";
        const URL_GUARDAR     = "{{ route('costo-envio.store') }}";
        const URL_VER         = "{{ route('costo-envio.show','show') }}";
        const URL_EDIT        = "{{ route('costo-envio.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('costo-envio.update','update') }}";
        const URL_HABILITAR   = "{{ route('costo-envio.habilitar') }}";
        const URL_INHABILITAR = "{{ route('costo-envio.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('costo-envio.destroy','destroy') }}";
        const URL_GETPROVINCIA    = "{{ route('costo-envio.getProvincia') }}";
        const URL_GETDISTRITO    = "{{ route('costo-envio.getDistrito') }}";


        const filtros = () => {

            $(document).on("click","a.page-link",function(e) {
                e.preventDefault();
                const url = e.target.href;
                const paginaActual = url.split("?pagina=")[1];
                const cantidadRegistros = $("#cantidadRegistros").val();
                const txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual);
            });

            $(document).on("change", "#cantidadRegistros", function(e) {
                e.preventDefault();
                const paginaActual = $("#paginaActual").val();
                const cantidadRegistros = e.target.value;
                const txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual);
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
                $("#frmCrear .selectpicker").selectpicker("val",null);
                $("#idprovincia option").remove();
                $("#iddistrito option").remove();
                $("#idprovincia,#iddistrito").selectpicker("refresh");
                CKEDITOR.instances.descripcion.setData('');
                $("#frmCrear")[0].reset();
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idcosto_envio = $(this).closest('div.dropdown-menu').data('idcosto_envio');
                $("#frmHabilitar input[name=idcosto_envio]").val(idcosto_envio);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idcosto_envio = $(this).closest('div.dropdown-menu').data('idcosto_envio');
                $("#frmInhabilitar input[name=idcosto_envio]").val(idcosto_envio);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idcosto_envio = $(this).closest('div.dropdown-menu').data('idcosto_envio');
                $("#frmEliminar input[name=idcosto_envio]").val(idcosto_envio);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idcosto_envio = $(this).closest('div.dropdown-menu').data('idcosto_envio');


                axios(URL_EDIT,{ params: {idcosto_envio : idcosto_envio} })
                .then(response => {
                    const data = response.data;
                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idcosto_envio]").val(data.idcosto_envio);
                    $("#frmEditar span.error").remove();

                    $("#iddepartamentoEditar").selectpicker("val",data.iddepartamento);
                    getProvincia("editar", data.iddepartamento, data.idprovincia );
                    getDistrito("editar", data.idprovincia, data.iddistrito );
                    $("#precioEditar").val(data.precio);
                    CKEDITOR.instances.descripcionEditar.setData(data.descripcion);
                    $("#estadoEditar").val(data.estado);

                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idcosto_envio = $(this).closest('div.dropdown-menu').data('idcosto_envio');

                cargando('Procesando...');
                axios(URL_VER,{ params: {idcosto_envio : idcosto_envio} })
                .then(response => {
                    stop();
                    const costoEnvio = response.data;
                    const moneyFormat = "{{ $monedaGeneral->format('0.00') }}";

                    $("#txtDepartamento").html(costoEnvio.departamento);
                    $("#txtProvincia").html(costoEnvio.provincia);
                    $("#txtDistrito").html(costoEnvio.distrito);

                    $("#txtPrecio").html( moneyFormat.replace('0.00',costoEnvio.precio) );


                    $("#txtDescripcion").html(costoEnvio.descripcion);

                    if (costoEnvio.estado){
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
                form.append('descripcion',CKEDITOR.instances.descripcion.getData());
                form.append('restriccion',CKEDITOR.instances.restriccion.getData());
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
                form.append('descripcionEditar',CKEDITOR.instances.descripcionEditar.getData());
                form.append('restriccionEditar',CKEDITOR.instances.restriccionEditar.getData());
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


        const changeDepartamento = () => {
             $("#iddepartamento").on("change",function (e) {
                 e.preventDefault();
                 let iddepartamento = $(this).val();

                 $("#idprovincia option").remove();
                 $("#idprovincia").selectpicker('refresh');

                 $("#iddistrito option").remove();
                 $("#iddistrito").selectpicker('refresh');

                 getProvincia("crear",iddepartamento)
             });

            $("#iddepartamentoEditar").on("change",function (e) {
                e.preventDefault();
                let iddepartamento = $(this).val();

                $("#idprovinciaEditar option").remove();
                $("#idprovinciaEditar").selectpicker('refresh');

                $("#iddistritoEditar option").remove();
                $("#iddistritoEditar").selectpicker('refresh');

                getProvincia("editar",iddepartamento)

            })
        }

        const getProvincia = (accion = "crear",iddepartamento = null,valorActual = null) => {
            const select = accion != "editar" ? "idprovincia" : "idprovinciaEditar";

            $("#"+select+" option").remove();
            axios(URL_GETPROVINCIA,{
                params: {
                    iddepartamento : iddepartamento
                }
            })
            .then( response => {
                const data = response.data;

                $("#"+select).append(`<option value="" >General</option>`);
                $.each(data,function (index,val) {
                    $("#"+select).append(`<option value="${ val.idprovincia }" >${ val.nombre }</option>`);
                })

                $("#"+select).selectpicker('refresh');
                $("#"+select).selectpicker("val",valorActual);


            })
            .catch( errorCatch )



        }

        const changeProvincia = () => {

            $("#idprovincia").on("change",function (e) {
                e.preventDefault();
                let idprovincia = $(this).val();
                $("#iddistrito option").remove();
                $("#iddistrito").selectpicker('refresh');
                getDistrito("crear",idprovincia);

            })

            $("#idprovinciaEditar").on("change",function (e) {
                e.preventDefault();
                let idprovincia = $(this).val();
                $("#iddistritoEditar option").remove();
                $("#iddistritoEditar").selectpicker('refresh');
                getDistrito("editar",idprovincia);

            })

        }

        const getDistrito = (accion = "crear",idprovincia = null,valorActual = null) => {
            const select = accion != "editar" ? "iddistrito" : "iddistritoEditar";

            $("#"+select+" option").remove();
            axios(URL_GETDISTRITO,{
                params: {
                    idprovincia : idprovincia
                }
            })
            .then( response => {
                const data = response.data;

                $("#"+select).append(`<option value="" >General</option>`);
                $.each(data,function (index,val) {
                    $("#"+select).append(`<option value="${ val.iddistrito }" >${ val.nombre }</option>`);
                })

                $("#"+select).selectpicker('refresh');
                $("#"+select).selectpicker("val",valorActual);


            })
            .catch( errorCatch )



        }




        $(function () {
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();

            changeDepartamento();
            changeProvincia();

            CKEDITOR.replace('descripcion',{
                height : 300
            });

            CKEDITOR.replace('descripcionEditar',{
                height : 300
            });

            CKEDITOR.replace('restriccion',{
                height : 300
            });

            CKEDITOR.replace('restriccionEditar',{
                height : 300
            });

        });



    </script>
@endpush
