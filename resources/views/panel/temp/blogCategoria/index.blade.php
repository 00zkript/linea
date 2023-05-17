@extends('panel.template.index')
@section('cuerpo')
@include('panel.blogCategoria.crear')
@include('panel.blogCategoria.editar')
@include('panel.blogCategoria.habilitar')
@include('panel.blogCategoria.inhabilitar')
@include('panel.blogCategoria.eliminar')
@include('panel.blogCategoria.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar categorias de blogs</p>
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
                                @include('panel.blogCategoria.listado')
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

        const URL_LISTADO     = "{{ route('blogCategoria.listar') }}";
        const URL_GUARDAR     = "{{ route('blogCategoria.store') }}";
        const URL_VER         = "{{ route('blogCategoria.show','show') }}";
        const URL_EDIT        = "{{ route('blogCategoria.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('blogCategoria.update','update') }}";
        const URL_HABILITAR   = "{{ route('blogCategoria.habilitar') }}";
        const URL_INHABILITAR = "{{ route('blogCategoria.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('blogCategoria.destroy','destroy') }}";

        const modales = () => {

            $("#btnModalCrear").on("click",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
                CKEDITOR.instances.descripcion.setData('');
                $("#frmCrear")[0].reset();
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idblog_categoria  = $(this).closest('div.dropdown-menu').data('idblog_categoria');
                $("#frmHabilitar input[name=idblog_categoria]").val(idblog_categoria);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idblog_categoria  = $(this).closest('div.dropdown-menu').data('idblog_categoria');
                $("#frmInhabilitar input[name=idblog_categoria]").val(idblog_categoria);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idblog_categoria = $(this).closest('div.dropdown-menu').data('idblog_categoria');
                $("#frmEliminar input[name=idblog_categoria]").val(idblog_categoria);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idblog_categoria = $(this).closest('div.dropdown-menu').data('idblog_categoria');

                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idblog_categoria : idblog_categoria} })
                .then(response => {
                    const data = response.data;
                    let blogCategoria = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar span.error").remove();


                    $("#idblog_categoria").val(blogCategoria.idblog_categoria);
                    $("#nombreEditar").val(blogCategoria.nombre);

                    CKEDITOR.instances.descripcionEditar.setData(blogCategoria.descripcion);


                    $("#estadoEditar").val(blogCategoria.estado);

                    $("#modalEditar").modal("show");



                })
                .catch(errorCatch)


            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idblog_categoria = $(this).closest('div.dropdown-menu').data('idblog_categoria');

                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idblog_categoria : idblog_categoria} })
                .then(response => {
                    const data = response.data;
                    let blogCategoria = response.data;

                    stop();

                    $("#txtNombre").html(blogCategoria.nombre);
                    $("#txtDescripcion").html(blogCategoria.descripcion);
                    if (blogCategoria.estado){
                        $("#txtEstado").html('<label class="badge badge-success">Habilitado</label>');
                    }else{
                        $("#txtEstado").html('<label class="badge badge-danger">Inhabilitado</label>');
                    }
                    $("#modalVer").modal("show");



                })
                .catch(errorCatch)




            });

        }

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


        const guardar = () => {
            $(document).on("submit","#frmCrear",function(e){
                e.preventDefault();
                var form = new FormData($(this)[0]);
                form.append('descripcion',CKEDITOR.instances.descripcion.getData());
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

            CKEDITOR.replace('descripcion',{
                height : 300
            });

            CKEDITOR.replace('descripcionEditar',{
                height : 300
            });

        });




    </script>
@endpush
