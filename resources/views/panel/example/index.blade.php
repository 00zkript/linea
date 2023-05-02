@extends('panel.template.index')
@section('cuerpo')
@include('panel.carpeta.crear')
@include('panel.carpeta.editar')
@include('panel.carpeta.habilitar')
@include('panel.carpeta.inhabilitar')
@include('panel.carpeta.eliminar')
@include('panel.carpeta.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Registros</p>
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
                                @include('panel.carpeta.listado')
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


        const URL_LISTADO     = "{{ route('example.listar') }}";
        const URL_GUARDAR     = "{{ route('example.store') }}";
        const URL_VER         = "{{ route('example.show',':id') }}";
        const URL_EDIT        = "{{ route('example.edit',':id') }}";
        const URL_MODIFICAR   = "{{ route('example.update',':id') }}";
        const URL_HABILITAR   = "{{ route('example.habilitar',':id') }}";
        const URL_INHABILITAR = "{{ route('example.inhabilitar',':id') }}";
        const URL_ELIMINAR    = "{{ route('example.destroy',':id') }}";
        const URL_CARPETA     = BASE_URL+"/panel/img/carpeta/";

        const URL_FILE_STORE   = "{{ route('example.file.store') }}";
        const URL_FILE_UPDATE  = "{{ route('example.file.update') }}";
        const URL_FILE_DESTROY = "{{ route('example.file.destroy') }}";
        const URL_FILE_SORT    = "{{ route('example.file.sort') }}";




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
                CKEDITOR.instances.contenido.setData('');

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                const idregistro = $(this).closest('div.dropdown-menu').data('idregistro');
                $("#frmHabilitar input[name=idregistro]").val(idregistro);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idregistro = $(this).closest('div.dropdown-menu').data('idregistro');
                $("#frmInhabilitar input[name=idregistro]").val(idregistro);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                const idregistro = $(this).closest('div.dropdown-menu').data('idregistro');
                $("#frmEliminar input[name=idregistro]").val(idregistro);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                const idregistro = $(this).closest('div.dropdown-menu').data('idregistro');

                cargando('Procesando...');
                axios.get(URL_EDIT.replace(':id',idregistro))
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idregistro]").val(data.idregistro);


                    $("#nombreEditar").val(data.nombre);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);


                    $("#imagenEditar").fileinput('destroy').fileinput({
                        dropZoneTitle : 'Arrastre la imagen aquí',
                        initialPreview : [ URL_CARPETA+data.imagen ],
                        initialPreviewConfig : { caption : data.imagen , width: "120px", height : "120px" },
                        // fileActionSettings : { showRemove : false, showUpload : false, showZoom : true, showDrag : false},
                        // uploadUrl : URL_FILE_UPDATE,
                        // uploadExtraData : _ => {
                        // },
                        // deleteUrl : URL_FILE_DESTROY,
                        // deleteExtraData : _ => {
                        // },
                    });





                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idregistro = $(this).closest('div.dropdown-menu').data('idregistro');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idregistro))
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
                form.append('contenido',CKEDITOR.instances.contenido.getData());

                cargando('Procesando...');
                axios.post(URL_GUARDAR,form)
                .then(response => {
                    const data = response.data;
                    stop();
                    // $("#imagen").fileinput("upload");
                    // $("#manual").fileinput("upload");

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

                const idregistro = $("#frmEditar input[name=idregistro]").val();
                const form = new FormData($(this)[0]);
                form.append('contenidoEditar',CKEDITOR.instances.contenidoEditar.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idregistro),form)
                .then(response => {
                    const data = response.data;
                    // $("#imagenEditar").fileinput("upload");
                    // $("#manualEditar").fileinput("upload");

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
                const idregistro = $("#frmHabilitar input[name=idregistro]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idregistro))
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
                const idregistro = $("#frmInhabilitar input[name=idregistro]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idregistro))
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
                const idregistro = $("#frmEliminar input[name=idregistro]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idregistro))
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

        const sortFile = () => {

            $("#fileEditar").on('filesorted', function(e, params) {
                e.preventDefault();
                const idregistro = $("#frmEditar input[name=idregistro]").val();
                const stack = params.stack;

                axios.post(URL_FILE_SORT, {
                    stack : JSON.stringify(stack)
                })
                .then( response => {
                    const data = response.data;
                    console.log(data.mensaje);
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;

                    console.log(data);
                })


            });

        }

        $("#imagen").fileinput({
            dropZoneTitle : 'Arrastre la imagen aquí',
            // uploadUrl : URL_FILE_STORE,
        });
        $("#imagenEditar").fileinput({
            dropZoneTitle : 'Arrastre la imagen aquí',
        });





        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();

            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });

        });


    </script>
@endpush
