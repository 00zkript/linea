@extends('panel.template.index')
@section('cuerpo')
@include('panel.section.crear')
@include('panel.section.editar')
@include('panel.section.habilitar')
@include('panel.section.inhabilitar')
@include('panel.section.eliminar')
@include('panel.section.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Secciones</p>
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
                                @include('panel.section.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="module" >


        const URL_LISTADO     = "{{ route('section.listar') }}";
        const URL_GUARDAR     = "{{ route('section.store') }}";
        const URL_VER         = "{{ route('section.show',':id') }}";
        const URL_EDIT        = "{{ route('section.edit',':id') }}";
        const URL_MODIFICAR   = "{{ route('section.update',':id') }}";
        const URL_HABILITAR   = "{{ route('section.habilitar',':id') }}";
        const URL_INHABILITAR = "{{ route('section.inhabilitar',':id') }}";
        const URL_ELIMINAR    = "{{ route('section.destroy',':id') }}";
        const URL_GETCOUNTSECCTION     = "{{ route('section.getCountSection') }}";



        const filtros = () => {


            $(document).on("click","a.page-link", function(e) {
                e.preventDefault();
                const url               = e.target.href;
                const paginaActual      = url.split("?pagina=")[1];
                const cantidadRegistros = $("#cantidadRegistros").val();

                listado(cantidadRegistros,paginaActual);
            } )



            $(document).on("change","#cantidadRegistros", function(e) {
                e.preventDefault();
                const paginaActual      = $("#paginaActual").val();
                const cantidadRegistros = e.target.value;

                listado(cantidadRegistros,paginaActual);

            } )



            $(document).on("submit","#frmBuscar", function(e) {
                e.preventDefault();
                const cantidadRegistros = $("#cantidadRegistros").val();
                const paginaActual      = $("#paginaActual").val();

                listado(cantidadRegistros,1);

            } )

        }

        const listado = async (cantidadRegistros = 10,paginaActual = 1) => {
            cargando();

            const form = {
                cantidadRegistros : cantidadRegistros,
                paginaActual : paginaActual,
                txtBuscar : $("#txtBuscar").val().trim(),
            }

            try{
                const response = await axios.get(URL_LISTADO, {
                    params : form
                });
                const data = response.data;

                stop();
                document.querySelector("#listado").innerHTML = data;


            }catch(error){
                errorCatch(error);
            }


        }

        const modales = () => {

            $(document).on("click","#btnModalCrear", (e) => {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                getCountSection();
                CKEDITOR.instances.contenido.setData('');

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                const idsection = $(this).closest('div.dropdown-menu').data('idsection');
                $("#frmHabilitar input[name=idsection]").val(idsection);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idsection = $(this).closest('div.dropdown-menu').data('idsection');
                $("#frmInhabilitar input[name=idsection]").val(idsection);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                const idsection = $(this).closest('div.dropdown-menu').data('idsection');
                $("#frmEliminar input[name=idsection]").val(idsection);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                const idsection = $(this).closest('div.dropdown-menu').data('idsection');

                cargando('Procesando...');
                axios.get(URL_EDIT.replace(':id',idsection))
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idsection]").val(data.idsection);

                    $("#nombreEditar").val(data.nombre);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);
                    // getCountSection("editar",data.posicion);

                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idsection = $(this).closest('div.dropdown-menu').data('idsection');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idsection))
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#nombreShow").html(data.nombre);
                    $("#contenidoShow").html(data.contenido);

                    if (data.estado){
                        $("#estadoShow").html('<label class="badge badge-success">Habilitado</label>');
                    }else{
                        $("#estadoShow").html('<label class="badge badge-danger">Inhabilitado</label>');
                    }


                    $("#modalVer").modal("show");

                })
                .catch(errorCatch)


            });

        }

        const guardar = () => {
            $(document).on("submit","#frmCrear",function(e){
                e.preventDefault();
                const form = new FormData($(this)[0]);
                form.append('contenido',CKEDITOR.instances.contenido.getData());

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

                const idsection = $("#frmEditar input[name=idsection]").val();
                const form = new FormData($(this)[0]);
                form.append('contenidoEditar',CKEDITOR.instances.contenidoEditar.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idsection),form)
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
                // const form = new FormData($(this)[0]);
                const idsection = $("#frmHabilitar input[name=idsection]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idsection))
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

                // const form = new FormData($(this)[0]);
                const idsection = $("#frmInhabilitar input[name=idsection]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idsection))
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

                // const form = new FormData($(this)[0]);
                const idsection = $("#frmEliminar input[name=idsection]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idsection))
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

        const getCountSection = (accion = '', valorActual = null) => {
            const el = accion != 'editar' ?  $("#posicion") : $("#posicionEditar");

            axios.get(URL_GETCOUNTSECCTION)
            .then( response => {
                const data = response.data;

                el.html('');
                for (let i = 1; i <= data.count; i++) {

                    const val = empty(valorActual) ? 1 : valorActual;
                    const selected = i == val ? 'selected' : '';

                    el.append(`<option value="${ i }" ${ selected } >${ i }</option>`);
                }


            })
            .catch( errorCatch )
        }





        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();

            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });

        });


    </script>
@endpush
