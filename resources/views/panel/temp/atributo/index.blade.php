@extends('panel.template.index')
@section('cuerpo')
@include('panel.atributo.crear')
@include('panel.atributo.editar')
@include('panel.atributo.habilitar')
@include('panel.atributo.inhabilitar')
@include('panel.atributo.eliminar')
@include('panel.atributo.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Atributos</p>
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
                                @include('panel.atributo.listado')
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


        const URL_LISTADO     = "{{ route('atributo.listar') }}";
        const URL_GUARDAR     = "{{ route('atributo.store') }}";
        const URL_VER         = "{{ route('atributo.show',':id') }}";
        const URL_EDIT        = "{{ route('atributo.edit',':id') }}";
        const URL_MODIFICAR   = "{{ route('atributo.update',':id') }}";
        const URL_HABILITAR   = "{{ route('atributo.habilitar',':id') }}";
        const URL_INHABILITAR = "{{ route('atributo.inhabilitar',':id') }}";
        const URL_ELIMINAR    = "{{ route('atributo.destroy',':id') }}";


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

            $(document).on("click","#btnModalCrear", function (e) {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                const idatributo = $(this).closest('div.dropdown-menu').data('idatributo');
                $("#frmHabilitar input[name=idatributo]").val(idatributo);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idatributo = $(this).closest('div.dropdown-menu').data('idatributo');
                $("#frmInhabilitar input[name=idatributo]").val(idatributo);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                const idatributo = $(this).closest('div.dropdown-menu').data('idatributo');
                $("#frmEliminar input[name=idatributo]").val(idatributo);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                const idatributo = $(this).closest('div.dropdown-menu').data('idatributo');

                cargando('Procesando...');
                axios.get(URL_EDIT.replace(':id',idatributo))
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idatributo]").val(data.idatributo);


                    $("#nombreEditar").val(data.nombre);


                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idatributo = $(this).closest('div.dropdown-menu').data('idatributo');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idatributo))
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#nombreShow").html(data.nombre);
                    $("#contenidoShow").html(data.contenido);



                    if(data.imagen){
                        const img = `<img src="${ URL_CARPETA+data.imagen }" style ="width: 200px;" >`;
                        $("#imagenShow").html(img);
                    }


                    if(data.pdf){
                        const pdf = `<a href="${ URL_CARPETA+data.pdf }" target="_blank">Ver PDF</a>`;
                        $("#pdfShow").html(pdf);
                    }

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

                const idatributo = $("#frmEditar input[name=idatributo]").val();
                const form = new FormData($(this)[0]);

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idatributo),form)
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
                const idatributo = $("#frmHabilitar input[name=idatributo]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idatributo))
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
                const idatributo = $("#frmInhabilitar input[name=idatributo]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idatributo))
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
                const idatributo = $("#frmEliminar input[name=idatributo]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idatributo))
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
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();


        });


    </script>
@endpush
