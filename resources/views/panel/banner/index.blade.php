@extends('panel.template.index')
@section('cuerpo')
@include('panel.banner.crear')
@include('panel.banner.editar')
@include('panel.banner.habilitar')
@include('panel.banner.inhabilitar')
@include('panel.banner.eliminar')
@include('panel.banner.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Banners</p>
                    </div>
                    <div class="card-body">
                        <div class="row align-items-end">
                            <div class="col-12 text-right">
                                <button id="btnModalCrear" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</button>
                            </div>
                            <div class="col-xl-3 col-lg-3 col-12">
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
                            <div class="col-xl-9 col-lg-9 col-12 my-2">
                                <form id="frmBuscar">
                                    @csrf
                                    <div class="form-group mb-0">
                                        <div class="input-group mb-0">
                                            <input type="text" id="txtBuscar" name="txtBuscar" class="form-control" placeholder="Buscar...">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary m-0"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12" id="listado">
                                @include('panel.banner.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script type="module">

        const URL_LISTADO     = "{{ route('banner.listar') }}";
        const URL_GUARDAR     = "{{ route('banner.store') }}";
        const URL_VER         = "{{ route('banner.show','show') }}";
        const URL_EDIT        = "{{ route('banner.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('banner.update','update') }}";
        const URL_HABILITAR   = "{{ route('banner.habilitar') }}";
        const URL_INHABILITAR = "{{ route('banner.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('banner.destroy','destroy') }}";
        const URL_ELIMINAR_IMAGEN = "{{ route('banner.removerImagen') }}";
        const URL_POSICION     = "{{ route('banner.getPosicion') }}";

        const TIPO_RUTA_SIN_RUTA_ID          = 1;
        const TIPO_RUTA_EXTERNO_ID           = 2;
        const TIPO_RUTA_INTERNO_ID           = 3;
        const TIPO_RUTA_INTERNO_CATEGORIA_ID = 4;
        const TIPO_RUTA_INTERNO_PAGINA_ID    = 5;
        const TIPO_RUTA_INTERNO_PRODUCTO_ID  = 6;

        const modales = () => {

            $(document).on("click", "#btnModalCrear", function(e){
                e.preventDefault();
                $("#frmCrear")[0].reset();
                $(".selectpicker").selectpicker("refresh")

                $("#frmCrear span.error").remove();

                $('.tipoRutaContent').hide();
                $('.tipoRutaContent input').removeAttr('required');

                getPosition("crear",'inicio');

                $('.typeContent').hide();
                $('.typeContent input[type=file]').fileinput('clear')
                $('.typeContent input[type=file]').fileinput('refresh',{ required: false });

                CKEDITOR.instances.contenido.setData('');

                $("#modalCrear").modal("show");

            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $("#frmHabilitar input[name=idbanner]").val(idbanner);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $("#frmInhabilitar input[name=idbanner]").val(idbanner);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');
                $("#frmEliminar input[name=idbanner]").val(idbanner);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');

                cargando('Procesando...')
                axios(URL_EDIT,{ params : { idbanner: idbanner } })
                .then( response => {
                    const data = response.data;

                    $("#frmEditar")[0].reset();
                    $("#frmEditar span.error").remove();


                    $("#idbanner").val(data.idbanner);
                    $("#tipoRutaEditar").val(data.idtipo_ruta);

                    $('.tipoRutaContent').hide();

                    if(data.tipo_ruta.slug === 'interna-estatica'){
                        $('#interna-estatica-contentEditar').show();
                        $('#rutaInternaEstaticaEditar').selectpicker('val',data.ruta);
                    }

                    if(data.tipo_ruta.slug === 'interna-categoria'){
                        $('#interna-categoria-contentEditar').show();
                        $('#rutaInternaCategoriaEditar').selectpicker('val',data.ruta);
                    }

                    if(data.tipo_ruta.slug === 'interna-pagina'){
                        $('#interna-pagina-contentEditar').show();
                        $('#rutaInternaPaginaEditar').selectpicker('val',data.ruta);
                    }

                    getPosition("editar",data.ruta,data.posicion);


                    $("#idbannerTipoEditar").val(data.idbanner_tipo);
                    $('.typeContentEditar').hide();
                    if (data.tipo.slug === 'imagen') {
                        $('#imagen-contentEditar').show();
                    }

                    if (data.tipo.slug === 'video') {
                        $('#video-contentEditar').show();
                    }


                    $("#tituloEditar").val(data.titulo);
                    $("#subtituloEditar").val(data.subtitulo);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);

                    $("#linkEditar").val(data.link);
                    $("#targetEditar").val(data.target);


                    let imagen = {
                        dropZoneTitle: 'Arrastre la imagen aquí',
                    };

                    if (!empty(data.imagen)) {
                        imagen = {
                            dropZoneTitle: 'Arrastre la imagen aquí',
                            initialPreview : [ BASE_URL+'/panel/img/banner/'+data.imagen ],
                        };
                    }

                    $("#imagenEditar").fileinput('destroy').fileinput(imagen);



                    let imagen_movil = {
                        dropZoneTitle: 'Arrastre la imagen aquí',
                    };

                    if (!empty(data.imagen_movil)) {
                        imagen_movil = {
                            dropZoneTitle: 'Arrastre la imagen aquí',
                            initialPreview : [ BASE_URL+'/panel/img/banner/'+data.imagen ]
                        };
                    }

                    $("#imagenMovilEditar").fileinput('destroy').fileinput(imagen_movil);



                    let video = {
                        dropZoneTitle:'Arrastre el video aquí',
                        allowedFileTypes: ['video'],
                        allowedFileExtensions: ['mp4'],
                    };

                    if (!empty(data.video)) {
                        imagen_movil = {
                            dropZoneTitle:'Arrastre el video aquí',
                            allowedFileTypes: ['video'],
                            allowedFileExtensions: ['mp4'],
                            initialPreview: [ BASE_URL+'/panel/img/banner/'+data.video ],
                            initialPreviewConfig: [
                                {
                                    caption: "banner.mp4",
                                    url: video,
                                    width : "120px",
                                    height : "120px",
                                    type: "video",
                                    filetype: "video/mp4",
                                    key: 1,
                                    // size: 375000,
                                    // description: "<h5>The Video</h5> This is a representative description number three for this file.",
                                    // downloadUrl: 'https://kartik-v.github.io/bootstrap-fileinput-samples/samples/small.mp4', // override url
                                    // filename: 'banner-video.mp4' // override download filename
                                }
                            ],

                        };
                    }

                    $("#videoEditar").fileinput('destroy').fileinput(video);




                    $("#estadoEditar").val(data.estado);

                    $("#modalEditar").modal("show");

                })
                // .catch(errorCatch)
                .finally( _ => {
                    stop();
                })



            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idbanner = $(this).closest('div.dropdown-menu').data('idbanner');

                cargando('Procesando...');
                axios(URL_VER,{ params: {idbanner : idbanner} })
                .then(response => {
                    const data = response.data;

                    $("#tituloShow").html(data.titulo);
                    $("#subtituloShow").html(data.subtitulo);
                    $("#contenidoShow").html(data.contenido);
                    $("#rutaShow").html(data.ruta_completa);
                    $("#posicionShow").html(data.posicion);
                    // $("#videoShow").html(data.video);


                    const imagen = !empty(data.imagen)
                        ? BASE_URL+'/panel/img/banner/'+data.imagen
                        : BASE_URL+'/panel/vacio_img.jpg';

                    $("#imagenShow").attr('src',imagen);

                    const imagen_movil = !empty(data.imagen_movil)
                        ? BASE_URL+'/panel/img/banner/'+data.imagen_movil
                        : BASE_URL+'/panel/vacio_img.jpg';

                    $("#imagenMovilShow").attr('src',imagen_movil);




                    if (data.estado){
                        $("#estadoShow").html('<label class="badge badge-success">Habilitado</label>');
                    }else{
                        $("#estadoShow").html('<label class="badge badge-danger">Inhabilitado</label>');
                    }


                    $("#modalVer").modal("show");


                })
                // .catch(errorCatch)
                .finally( _ => {
                    stop();
                })



            });

        }

        const filtros = () => {

            $(document).on("click", "a.page-link", function(e) {
                e.preventDefault();
                var url = e.target.href;
                var paginaActual = url.split("?pagina=")[1];
                var cantidadRegistros = $("#cantidadRegistros").val();
                var txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual);
            });

            $(document).on("change", "#cantidadRegistros", function(e) {
                e.preventDefault();
                var paginaActual = $("#paginaActual").val();
                var cantidadRegistros = e.target.value;
                var txtBuscar = $("#txtBuscar").val();

                listado(cantidadRegistros,paginaActual);
            });

            $(document).on("submit", "#frmBuscar", function(e) {
                e.preventDefault();
                var txtBuscar = $("#txtBuscar").val();
                var cantidadRegistros = $("#cantidadRegistros").val();
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

                let ruta;
                if ($("#tipoRuta").val() == 1) ruta = 'javascript:void(0);';
                if ($("#tipoRuta").val() == 2) ruta = $('#rutaExterna').val();
                if ($("#tipoRuta").val() == 3) ruta = $('#rutaInternaEstatica').val();
                if ($("#tipoRuta").val() == 4) ruta = $('#rutaInternaCategoria').val();
                if ($("#tipoRuta").val() == 5) ruta = $('#rutaInternaPagina').val();

                const form = new FormData($(this)[0]);
                form.append('contenido',CKEDITOR.instances.contenido.getData());
                form.append('ruta',ruta);
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

                let ruta;
                if ($("#tipoRutaEditar").val() == 1) ruta = 'javascript:void(0);';
                if ($("#tipoRutaEditar").val() == 2) ruta = $('#rutaExternaEditar').val();
                if ($("#tipoRutaEditar").val() == 3) ruta = $('#rutaInternaEstaticaEditar').val();
                if ($("#tipoRutaEditar").val() == 4) ruta = $('#rutaInternaCategoriaEditar').val();
                if ($("#tipoRutaEditar").val() == 5) ruta = $('#rutaInternaPaginaEditar').val();

                const form = new FormData($(this)[0]);
                form.append('contenidoEditar',CKEDITOR.instances.contenidoEditar.getData());
                form.append('rutaEditar',ruta);
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

        const getPosition = (accion , ruta = null, valorActual = null) => {


            let orderSelector = accion == "editar" ? "posicionEditar" : "posicion";


            $("#"+orderSelector+" option").remove();

            $("#"+orderSelector).append(`<option ${empty(valorActual) ? 'selected' : '' } value="" hidden>[--- Seleccione ---]</option>`);
            axios.get(URL_POSICION,{
                params: {
                    ruta : ruta
                }
            })
            .then(response => {
                const data = response.data;
                const posicion_maxima = data.posicion_maxima;
                const valor = valorActual == null ? posicion_maxima : valorActual;

                for (let i = 1; i <= posicion_maxima ; i++) {
                    $("#"+orderSelector).append("<option "+ ( i == valor ? 'selected' : '') +" value="+i+">"+i+"</option>");
                };

                // $("#"+orderSelector).selectpicker("refresh");
            })
            .catch(e => console.log(e))





        }

        const changeTypeRoute = () => {

            $(document).on("change","#tipoRuta",function(e){
                e.preventDefault();
                const el = this;
                const selectedIndex = el.selectedIndex;
                const content = el.options[selectedIndex].dataset.content;

                $('.tipoRutaContent').hide();
                $('#'+content).show();

                $('.tipoRutaContent select').removeAttr('required');
                $('#'+content+' select').attr('required',true);

            })

            $(document).on("change","#tipoRutaEditar",function(e){
                e.preventDefault();
                const el = this;
                const selectedIndex = el.selectedIndex;
                const content = el.options[selectedIndex].dataset.content;

                $('.tipoRutaContentEditar').hide();
                $('#'+content).show();

                $('.tipoRutaContentEditar select').removeAttr('required');
                $('#'+content+' select').attr('required',true);

            })

            $(document).on("change","#rutaInternaEstatica,#rutaInternaDinamica",function(e){
                e.preventDefault()
                const ruta = $(this).val();
                getPosition("crear",ruta);
            })
            $(document).on("change","#rutaInternaEstaticaEditar,#rutaInternaDinamicaEditar",function(e){
                e.preventDefault()
                const ruta = $(this).val();
                getPosition("editar",ruta);
            })

        }



        const changeType = () => {

            $(document).on( 'change', '#idbannerTipo', function (e) {
                e.preventDefault();

                const el = this;
                const selectedIndex = el.selectedIndex;
                const content = el.options[selectedIndex].dataset.content;

                $('.typeContent').hide();
                $('#'+content).show();

                $('.typeContent input[type=file]').fileinput('refresh',{ required: false });
                $('#'+content+' input[type=file]').fileinput('refresh',{ required: true });
                $('.typeContent input[type=file]').fileinput('clear')

            });

            $(document).on( 'change', '#idbannerTipoEditar', function (e) {
                e.preventDefault();

                const el = this;
                const selectedIndex = el.selectedIndex;
                const content = el.options[selectedIndex].dataset.content;

                $('.typeContentEditar').hide();
                $('#'+content).show();

                // $('.typeContentEditar input[type=file]').fileinput('refresh',{ required: false });
                // $('#'+content+' input[type=file]').fileinput('refresh',{ required: true });
                // $('.typeContentEditar input[type=file]').fileinput('reset')

            });

        }



        $("#video").fileinput({
            dropZoneTitle:'Arrastre el video aquí',
            allowedFileTypes: ['video'],
            allowedFileExtensions: ['mp4'],
        });


        $("#imagen").fileinput({
            dropZoneTitle:'Arrastre la imagen aquí',
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg'],
        });

        $("#imagenMovil").fileinput({
            dropZoneTitle:'Arrastre la imagen aquí',
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg'],
        });

        /* {
            theme: 'fa',
            language: 'es',
            //uploadUrl: "#",
            uploadAsync:false,
            uploadExtraData:false,
            overwriteInitial: true,
            dropZoneTitle:'Arrastre la imagen aquí',
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
            autoReplace: true,
            //minFileCount: 1,
            fileActionSettings: {
                showRemove: false,
                showUpload: false,
                showZoom: false,
                showDrag: false,
            },
        } */




        $(function () {
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();
            changeTypeRoute();
            changeType();


            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });


        });



    </script>
@endpush
