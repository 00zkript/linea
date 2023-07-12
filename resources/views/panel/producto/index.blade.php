@extends('panel.template.index')
@section('cuerpo')
    @include('panel.producto.crear')
    @include('panel.producto.editar')
    @include('panel.producto.habilitar')
    @include('panel.producto.inhabilitar')
    @include('panel.producto.eliminar')
    @include('panel.producto.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Productos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <button id="btnModalCrear" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</button>
                            </div>
                            <div class="col-md-6 col-12 form-group">
                                <label for="cantidadRegistros">Cantidad de registros</label>
                                <select name="cantidadRegistros" id="cantidadRegistros" class="form-control form-control-sm">
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="9999999">Todos</option>
                                </select>
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
                                @include('panel.producto.listado')
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


        const URL_LISTADO     = "{{ route('producto.listar') }}";
        const URL_GUARDAR     = "{{ route('producto.store') }}";
        const URL_VER         = "{{ route('producto.show',':id') }}";
        const URL_EDIT        = "{{ route('producto.edit',':id') }}";
        const URL_MODIFICAR   = "{{ route('producto.update',':id') }}";
        const URL_HABILITAR   = "{{ route('producto.habilitar',':id') }}";
        const URL_INHABILITAR = "{{ route('producto.inhabilitar',':id') }}";
        const URL_ELIMINAR    = "{{ route('producto.destroy',':id') }}";
        const URL_CARPETA     = BASE_URL+"/panel/img/producto/";

        const URL_FILE_STORE   = "{{ route('producto.file.store') }}";
        const URL_FILE_UPDATE  = "{{ route('producto.file.update') }}";
        const URL_FILE_DESTROY = "{{ route('producto.file.destroy') }}";
        const URL_FILE_SORT    = "{{ route('producto.file.sort') }}";




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
                // CKEDITOR.instances.descripcion.setData('');

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                const idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmHabilitar input[name=idproducto]").val(idproducto);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmInhabilitar input[name=idproducto]").val(idproducto);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                const idproducto = $(this).closest('div.dropdown-menu').data('idproducto');
                $("#frmEliminar input[name=idproducto]").val(idproducto);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                const idproducto = $(this).closest('div.dropdown-menu').data('idproducto');

                cargando('Procesando...');
                axios.get(URL_EDIT.replace(':id',idproducto))
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idproducto]").val(data.idproducto);


                    $("#nombreEditar").val(data.nombre);
                    $("#descripcionEditar").val(data.descripcion);
                    $("#stockEditar").val(data.stock);
                    $("#precioEditar").val(data.precio);
                    // CKEDITOR.instances.descripcionEditar.setData(data.descripcion);


                    const {urls, settings } = allFilesData( URL_CARPETA, data.imagenes );

                    $("#imagenEditar").fileinput('destroy').fileinput({
                        dropZoneTitle : 'Arrastre la imagen aquí',
                        initialPreview : urls,
                        initialPreviewConfig : settings,
                        fileActionSettings : { showRemove : true, showUpload : false, showZoom : true, showDrag : true},
                        uploadUrl : URL_FILE_UPDATE,
                        uploadExtraData : _ => {
                            return {
                                idproducto: data.idproducto
                            }
                        },
                        deleteUrl : URL_FILE_DESTROY,
                        deleteExtraData : _ => {
                            return {
                                idproducto: data.idproducto
                            }
                        },
                    });





                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idproducto = $(this).closest('div.dropdown-menu').data('idproducto');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idproducto))
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#nombreShow").html(data.nombre);
                    $("#descripcionShow").html(data.descripcion);
                    $("#stockShow").html(data.stock);
                    $("#precioShow").html('S/.'+data.precio);



                    $("#imagenShow").empty();
                    if(data.imagenes){
                        for (const img of data.imagenes) {
                            $("#imagenShow").append(`<img src="${ URL_CARPETA+img.nombre }" style ="width: 200px;" >`);
                        }
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
                // form.append('descripcion',CKEDITOR.instances.descripcion.getData());

                cargando('Procesando...');
                axios.post(URL_GUARDAR,form)
                .then(response => {
                    const data = response.data;
                    stop();
                    $("#imagen").fileinput("upload");

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

                const idproducto = $("#frmEditar input[name=idproducto]").val();
                const form = new FormData($(this)[0]);
                // form.append('descripcionEditar',CKEDITOR.instances.descripcionEditar.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idproducto),form)
                .then(response => {
                    const data = response.data;
                    $("#imagenEditar").fileinput("upload");

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
                const idproducto = $("#frmHabilitar input[name=idproducto]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idproducto))
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
                const idproducto = $("#frmInhabilitar input[name=idproducto]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idproducto))
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
                const idproducto = $("#frmEliminar input[name=idproducto]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idproducto))
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

            $("#imagenEditar").on('filesorted', function(e, params) {
                e.preventDefault();
                const idproducto = $("#frmEditar input[name=idproducto]").val();
                const filesConfig = params.stack;
                const filesIds = filesConfig.map( ele => ele.key );

                axios.post(URL_FILE_SORT, {
                    files_ids : filesIds
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
            uploadUrl : URL_FILE_STORE,
            fileActionSettings : { showRemove : true, showUpload : false, showZoom : true, showDrag : true},
        });
        $("#imagenEditar").fileinput({
            dropZoneTitle : 'Arrastre la imagen aquí',
            fileActionSettings : { showRemove : true, showUpload : false, showZoom : true, showDrag : true},
        });





        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            sortFile();

            // CKEDITOR.replace('descripcion',{ height : 200 });
            // CKEDITOR.replace('descripcionEditar',{ height : 200 });

        });


    </script>
@endpush
