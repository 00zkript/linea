@extends('panel.template.index')
@section('cuerpo')
@include('panel.cliente.crear')
@include('panel.cliente.editar')
@include('panel.cliente.habilitar')
@include('panel.cliente.inhabilitar')
@include('panel.cliente.eliminar')
@include('panel.cliente.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Clientes</p>
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
                                @include('panel.cliente.listado')
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



        const URL_LISTADO     = "{{ route('cliente.listar') }}";
        const URL_GUARDAR     = "{{ route('cliente.store') }}";
        const URL_VER         = "{{ route('cliente.show','show') }}";
        const URL_EDIT        = "{{ route('cliente.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('cliente.update','update') }}";
        const URL_HABILITAR   = "{{ route('cliente.habilitar') }}";
        const URL_INHABILITAR = "{{ route('cliente.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('cliente.destroy','destroy') }}";
        const URL_PROVINCIAS  = "{{ route('cliente.provincias',':id') }}";
        const URL_DISTRITOS   = "{{ route('cliente.distritos',':id') }}";
        const URL_CARPETA     = BASE_URL+"/panel/img/";




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

                // $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idcliente = $(this).closest('div.dropdown-menu').data('idcliente');
                $("#frmHabilitar input[name=idcliente]").val(idcliente);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idcliente = $(this).closest('div.dropdown-menu').data('idcliente');
                $("#frmInhabilitar input[name=idcliente]").val(idcliente);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idcliente = $(this).closest('div.dropdown-menu').data('idcliente');
                $("#frmEliminar input[name=idcliente]").val(idcliente);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idcliente = $(this).closest('div.dropdown-menu').data('idcliente');

                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idcliente : idcliente} })
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idcliente]").val(data.idcliente);



                    $('#codigoEditar').val(data.codigo);

                    $('#nombresEditar').val(data.nombres);
                    $('#apellidosEditar').val(data.apellidos);
                    $('#correoEditar').val(data.correo);
                    $('#telefonoEditar').val(data.telefono);
                    $('#tipoDocumentoIdentidadEditar').val(data.idtipo_documento_identidad);
                    $('#numeroDocumentoIdentidadEditar').val(data.numero_documento_identidad);
                    $('#sexoEditar').val(data.sexo);
                    $('#fechaNacimientoEditar').val(data.fecha_nacimiento);

                    $('#departamentoEditar').val(data.iddepartamento);
                    getProvincia({ selector: '#provinciaEditar', iddepartamento: data.iddepartamento, newValue: data.idprovincia });
                    getDistrito({ selector: '#distritoEditar', idprovincia: data.idprovincia, newValue: data.iddistrito });

                    $('#direccionEditar').val(data.direccion);
                    $('#referenciaEditar').val(data.referencia);
                    $('#notaEditar').val(data.nota);

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



                    // $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idcliente = $(this).closest('div.dropdown-menu').data('idcliente');


                cargando('Procesando...');
                axios(URL_VER,{ params: {idcliente : idcliente} })
                .then(response => {
                    const data = response.data;

                    stop();

                    $('#nombreShow').html(data.nombres);
                    $('#apellidosShow').html(data.apellidos);
                    $('#correoShow').html(data.correo);
                    $('#telefonoShow').html(data.telefono);
                    $('#tipoDocumentoIdentidadShow').html(data.tipo_documento_identidad.nombre+" - "+data.numero_documento_identidad);
                    $('#fechaNacimientoShow').html(data.fecha_nacimiento);
                    $('#notaShow').html(data.nota);
                    $('#direccionShow').html(data.direccion+" "+ data.distrito.nombre+" / "+data.provincia.nombre+" / "+data.departamento.nombre);



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

        const changeTipoDocumentoIdentidad = () => {
            const documentoIdentidad = [
                { id: 1, name: 'DNI', caracter_min: 8, caracter_max: 8 },
                { id: 2, name: 'CARNET DE EXTRANJERIA', caracter_min: 12, caracter_max: 12 },
                { id: 3, name: 'RUC', caracter_min: 12, caracter_max: 12 },
                { id: 4, name: 'PASAPORTE', caracter_min: 12, caracter_max: 12 }
            ];

            const handleChange = (selector, inputSelector) => {
                $(document).on('change', selector, function (e) {
                    e.preventDefault();

                    const val = $(this).val();
                    const documento = documentoIdentidad.find(ele => ele.id == val);

                    $(inputSelector).attr('minLength', documento.caracter_min)
                        .attr('maxLength', documento.caracter_max)
                        .val($(inputSelector).val().substring(0, documento.caracter_min));

                });
            };

            handleChange('#tipoDocumentoIdentidad', '#numeroDocumentoIdentidad');
            handleChange('#tipoDocumentoIdentidadEditar', '#numeroDocumentoIdentidadEditar');
        }


        const fillSelect = ({ selector, data, newValue = null }) => {
            $(selector).empty();

            let html = '<option value="" hidden selected >[---Seleccione---]</option>';

            for (const item of data) {
                const keys = Object.keys(item);
                const id =  item[keys[0]];

                html +=  `<option value="${ id }">${ item.nombre }</option>`;
            }
            $(selector).html(html);
            if (newValue) {
                $(selector).val(newValue);
            }

        }


        const getProvincia = ({ selector, iddepartamento, newValue = null }) => {
            return axios.get(URL_PROVINCIAS.replace(':id', iddepartamento))
            .then( response => {
                const data = response.data;
                fillSelect({ selector, data, newValue });
            });
        }

        const getDistrito = ({ selector, idprovincia, newValue = null }) => {
            return axios.get(URL_DISTRITOS.replace(':id', idprovincia))
            .then( response => {
                const data = response.data;
                fillSelect({ selector, data, newValue });
            });
        }

        const ubigeo = () => {

            $(document).on( 'change', '#departamento', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getProvincia({ selector: '#provincia', iddepartamento: val });
            });

            $(document).on( 'change', '#provincia', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getDistrito({ selector: '#distrito', idprovincia: val });
            });


            $(document).on( 'change', '#departamentoEditar', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getProvincia({ selector: '#provinciaEditar', iddepartamento: val });
            });

            $(document).on( 'change', '#provinciaEditar', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getDistrito({ selector: '#distritoEditar', idprovincia: val });
            });


        }



        $("#imagen").fileinput({
            dropZoneTitle : 'Arrastre la imagen aquí',
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
            changeTipoDocumentoIdentidad();
            ubigeo();


        });


    </script>
@endpush
