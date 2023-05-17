@extends('panel.template.index')
@section('cuerpo')
@include('panel.asesor.crear')
@include('panel.asesor.editar')
@include('panel.asesor.habilitar')
@include('panel.asesor.inhabilitar')
@include('panel.asesor.eliminar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar asesores</p>
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
                                @include('panel.asesor.listado')
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


        const URL_LISTADO     = "{{ route('asesores.listar') }}";
        const URL_GUARDAR     = "{{ route('asesores.store') }}";
        const URL_VER         = "{{ route('asesores.show','show') }}";
        const URL_EDIT        = "{{ route('asesores.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('asesores.update','update') }}";
        const URL_HABILITAR   = "{{ route('asesores.habilitar') }}";
        const URL_INHABILITAR = "{{ route('asesores.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('asesores.destroy','destroy') }}";


        const modales = () => {

            $("#btnModalCrear").on("click",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idasesor = $(this).closest('div.dropdown-menu').data('idasesor');
                $("#frmHabilitar input[name=idasesor]").val(idasesor);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idasesor = $(this).closest('div.dropdown-menu').data('idasesor');
                $("#frmInhabilitar input[name=idasesor]").val(idasesor);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idasesor = $(this).closest('div.dropdown-menu').data('idasesor');
                $("#frmEliminar input[name=idasesor]").val(idasesor);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idasesor = $(this).closest('div.dropdown-menu').data('idasesor');

                cargando('Procesando...');

                axios(URL_EDIT,{ params: {idasesor : idasesor} })
                .then( response => {
                    const data = response.data;
                    let asesor = data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar span.error").remove();
                    $("#idasesor").val(asesor.idasesor);
                    $("#nombresEditar").val(asesor.nombres);
                    $("#correoEditar").val(asesor.correo);
                    $("#celularEditar").val(asesor.celular);
                    $("#telegramEditar").val(asesor.telegram);
                    $("#whatsappEditar").val(asesor.whatsapp);
                    $("#contactoRapidoEditar").val(asesor.contacto_rapido);

                    $("#fotoEditar").fileinput('destroy').fileinput({
                        allowedFileTypes: ['image'],
                        allowedFileExtensions: ['jpg', 'png', 'jpeg'],
                        initialPreview:[ !empty(asesor.foto) ? BASE_URL+'/panel/img/asesores/'+asesor.foto : '{{ asset('panel/img/asesores/foto_defecto.jpg') }}'],
                    });


                    $("#estadoEditar").val(asesor.estado);

                    $("#modalEditar").modal("show");

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



        $("#foto").fileinput({
            dropZoneTitle:'Arrastre la fotografía aquí',
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg'],
        });


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
