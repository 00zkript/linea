@extends('panel.template.index')
@section('cuerpo')
@include('panel.usuario.crear')
@include('panel.usuario.editar')
@include('panel.usuario.habilitar')
@include('panel.usuario.inhabilitar')
@include('panel.usuario.eliminar')
@include('panel.usuario.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar usuarios</p>
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
                                @include('panel.usuario.listado')
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

        const URL_LISTADO     = "{{ route('usuario.listar') }}";
        const URL_GUARDAR     = "{{ route('usuario.store') }}";
        const URL_VER         = "{{ route('usuario.show',':id') }}";
        const URL_EDIT        = "{{ route('usuario.edit',':id') }}";
        const URL_MODIFICAR   = "{{ route('usuario.update',':id') }}";
        const URL_HABILITAR   = "{{ route('usuario.habilitar', ':id') }}";
        const URL_INHABILITAR = "{{ route('usuario.inhabilitar', ':id') }}";
        const URL_ELIMINAR    = "{{ route('usuario.destroy',':id') }}";
        const URL_CARPETA     = BASE_URL+"/panel/img/usuarios/";


        const resources = {
            tipoDocumentoIdentidad : @json($tipoDocumentoIdentidad)
        }


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

            $("#btnModalCrear").on("click",function(e){
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');
                $("#frmHabilitar input[name=idusuario]").val(idusuario);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');
                $("#frmInhabilitar input[name=idusuario]").val(idusuario);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');
                $("#frmEliminar input[name=idusuario]").val(idusuario);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');

                cargando('Procesando...');
                axios(URL_EDIT.replace(':id',idusuario),{ params: {idusuario : idusuario} })
                .then(response => {
                    const data = response.data;
                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar span.error").remove();

                    $('#frmEditar input[name=idusuario]').val(data.idusuario);
                    $("#sucursalEditar").val(data.idsucursal);
                    $("#rolEditar").val(data.idrol);
                    $("#correoEditar").val(data.correo);
                    $("#usuarioEditar").val(data.usuario);
                    $("#nombresEditar").val(data.nombres);
                    $("#apellidosEditar").val(data.apellidos);
                    $('#tipoDocumentoIdentidadEditar').val( data.idtipo_documento_identidad );
                    const tipoDocumentoSelected = resources.tipoDocumentoIdentidad.find(ele => ele.idtipo_documento_identidad == data.idtipo_documento_identidad) ?? resources.tipoDocumentoIdentidad[0];
                    const { caracteres_length }  = tipoDocumentoSelected;
                    $('#numeroDocumentoIdentidadEditar').val( data.numero_documento_identidad );
                    $('#numeroDocumentoIdentidadEditar').attr( 'minLength', caracteres_length).attr( 'maxLength', caracteres_length);
                    $("#cargoEditar").val(data.cargo);

                    $("#fotoEditar").fileinput('destroy').fileinput({
                        theme: 'fa',
                        language: 'es',
                        //uploadUrl: "#",
                        uploadAsync:false,
                        uploadExtraData:false,
                        overwriteInitial: true,
                        dropZoneTitle:'Arrastre la fotografía aquí',
                        // dropZoneEnabled: false,
                        //maxImageWidth: 1200,
                        //maxImageHeight: 630,
                        showUpload:false,
                        showDrag :false,
                        // required:true,
                        validateInitialCount: true,
                        initialPreviewAsData: true,
                        previewFileType: "image",
                        showRemove: false,
                        allowedFileTypes: ['image'],
                        allowedFileExtensions: ['jpg', 'png', 'jpeg'],
                        removeFromPreviewOnError:true,
                        maxFileSize: 20000,
                        maxFileCount:1,
                        autoReplace:true,
                        //minFileCount: 1,
                        initialPreview:[ !empty(data.imagen) ? URL_CARPETA+data.imagen : "{{ asset('panel/default/foto_defecto.jpg') }}" ],
                        fileActionSettings: {
                            showRemove: false,
                            showUpload: false,
                            showZoom: false,
                            showDrag: false,
                        },
                    });



                    $("#estadoEditar").val(data.estado);

                    $("#modalEditar").modal("show");
                })
                .catch(errorCatch)

            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idusuario = $(this).closest('div.dropdown-menu').data('idusuario');

                cargando('Procesando...');
                axios(URL_VER.replace(':id',idusuario))
                .then(response => {
                    const data = response.data;
                    stop();

                    $("#rolShow").html(data.rol.name);
                    $("#sucursalShow").html(data.sucursal.nombre);
                    $("#correoShow").html(data.correo);
                    $("#usuarioShow").html(data.usuario);
                    $("#nombresShow").html(data.nombres);
                    $("#apellidosShow").html(data.apellidos);
                    $("#tipoDocumentoIdentidadShow").html(data.tipo_documento_identidad.nombre);
                    $("#numeroDocumentoIdentidadShow").html(data.numero_documento_identidad);


                    if (!empty(data.imagen)){
                        $("#imagenShow").attr('src',URL_CARPETA+data.imagen);
                    }else{
                        $("#imagenShow").attr('src',"{{ asset('panel/default/foto_defecto.jpg') }}");
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

                const idusuario = $('#frmEditar input[name=idusuario]').val();
                const form = new FormData($(this)[0]);

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idusuario),form)
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
                const idusuario = $("#frmHabilitar input[name=idusuario]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idusuario))
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
                const idusuario = $("#frmInhabilitar input[name=idusuario]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idusuario))
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
                const idusuario = $("#frmEliminar input[name=idusuario]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idusuario))
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

        const changeTipoDocumentoIdentidad = () => {
            $(document).on( 'change', '#tipoDocumentoIdentidad', function (e) {
                e.preventDefault();
                const val = $(this).val();
                const tipoDocumentoSelected = resources.tipoDocumentoIdentidad.find(ele => ele.idtipo_documento_identidad == val);
                const { caracteres_length }  = tipoDocumentoSelected;

                const value = $('#numeroDocumentoIdentidad').val();

                $('#numeroDocumentoIdentidad').val( value.slice(0,caracteres_length))
                $('#numeroDocumentoIdentidad').attr( 'minLength', caracteres_length).attr( 'maxLength', caracteres_length);

            });

            $(document).on( 'change', '#tipoDocumentoIdentidadEditar', function (e) {
                e.preventDefault();
                const val = $(this).val();
                const tipoDocumentoSelected = resources.tipoDocumentoIdentidad.find(ele => ele.idtipo_documento_identidad == val);
                const { caracteres_length }  = tipoDocumentoSelected;

                const value = $('#numeroDocumentoIdentidadEditar').val();

                $('#numeroDocumentoIdentidadEditar').val( value.slice(0,caracteres_length))
                $('#numeroDocumentoIdentidadEditar').attr( 'minLength', caracteres_length).attr( 'maxLength', caracteres_length);

            });
        }



        $("#foto").fileinput({
            theme: 'fa',
            language: 'es',
            //uploadUrl: "#",
            uploadAsync:false,
            uploadExtraData:false,
            overwriteInitial: true,
            dropZoneTitle:'Arrastre la fotografía aquí',
            // dropZoneEnabled: false,
            //maxImageWidth: 1200,
            //maxImageHeight: 630,
            showUpload:false,
            showDrag :false,
            // required:true,
            validateInitialCount: true,
            initialPreviewAsData: true,
            previewFileType: "image",
            showRemove: false,
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg'],
            removeFromPreviewOnError:true,
            maxFileSize: 20000,
            maxFileCount: 1,
            //minFileCount: 1,
            fileActionSettings: {
                showRemove: true,
                showUpload: false,
                showZoom: false,
                showDrag: false,
            },
        });


        $(function () {
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();
            changeTipoDocumentoIdentidad();
        });


    </script>
@endpush
