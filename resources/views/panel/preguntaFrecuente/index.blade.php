@extends('panel.template.index')
@section('cuerpo')
@include('panel.preguntaFrecuente.crear')
@include('panel.preguntaFrecuente.editar')
@include('panel.preguntaFrecuente.habilitar')
@include('panel.preguntaFrecuente.inhabilitar')
@include('panel.preguntaFrecuente.eliminar')
@include('panel.preguntaFrecuente.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Preguntas frecuentes</p>
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
                                @include('panel.preguntaFrecuente.listado')
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


        const URL_LISTADO     = "{{ route('preguntas-frecuentes.listar') }}";
        const URL_GUARDAR     = "{{ route('preguntas-frecuentes.store') }}";
        const URL_VER         = "{{ route('preguntas-frecuentes.show','show') }}";
        const URL_EDIT        = "{{ route('preguntas-frecuentes.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('preguntas-frecuentes.update','update') }}";
        const URL_HABILITAR   = "{{ route('preguntas-frecuentes.habilitar') }}";
        const URL_INHABILITAR = "{{ route('preguntas-frecuentes.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('preguntas-frecuentes.destroy','destroy') }}";
        const URL_CARPETA     = BASE_URL+"/panel/img/preguntaFrecuente/";



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
                const response = await axios.post(URL_LISTADO, form );
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
                CKEDITOR.instances.respuesta.setData('');

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idpregunta_frecuente = $(this).closest('div.dropdown-menu').data('idpregunta_frecuente');
                $("#frmHabilitar input[name=idpregunta_frecuente]").val(idpregunta_frecuente);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idpregunta_frecuente = $(this).closest('div.dropdown-menu').data('idpregunta_frecuente');
                $("#frmInhabilitar input[name=idpregunta_frecuente]").val(idpregunta_frecuente);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idpregunta_frecuente = $(this).closest('div.dropdown-menu').data('idpregunta_frecuente');
                $("#frmEliminar input[name=idpregunta_frecuente]").val(idpregunta_frecuente);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idpregunta_frecuente = $(this).closest('div.dropdown-menu').data('idpregunta_frecuente');

                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idpregunta_frecuente : idpregunta_frecuente} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idpregunta_frecuente]").val(data.idpregunta_frecuente);


                    $("#preguntaEditar").val(data.pregunta);
                    CKEDITOR.instances.respuestaEditar.setData(data.respuesta);




                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idpregunta_frecuente = $(this).closest('div.dropdown-menu').data('idpregunta_frecuente');


                cargando('Procesando...');
                axios(URL_VER,{ params: {idpregunta_frecuente : idpregunta_frecuente} })
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#preguntaShow").html(data.pregunta);
                    $("#respuestaShow").html(data.respuesta);


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
                var form = new FormData($(this)[0]);
                form.append('respuesta',CKEDITOR.instances.respuesta.getData());

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
                form.append('respuestaEditar',CKEDITOR.instances.respuestaEditar.getData());

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
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();

            CKEDITOR.replace('respuesta',{ height : 200 });
            CKEDITOR.replace('respuestaEditar',{ height : 200 });

        });


    </script>
@endpush
