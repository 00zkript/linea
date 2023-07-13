@extends('panel.template.index')
@section('cuerpo')
    @include('panel.sucursal.crear')
    @include('panel.sucursal.editar')
    @include('panel.sucursal.habilitar')
    @include('panel.sucursal.inhabilitar')
    @include('panel.sucursal.eliminar')
    @include('panel.sucursal.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar sucursales</p>
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
                                @include('panel.sucursal.listado')
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script >


        const URL_LISTADO     = "{{ route('sucursal.listar') }}";
        const URL_GUARDAR     = "{{ route('sucursal.store') }}";
        const URL_VER         = "{{ route('sucursal.show',':id') }}";
        const URL_EDIT        = "{{ route('sucursal.edit',':id') }}";
        const URL_MODIFICAR   = "{{ route('sucursal.update',':id') }}";
        const URL_HABILITAR   = "{{ route('sucursal.habilitar',':id') }}";
        const URL_INHABILITAR = "{{ route('sucursal.inhabilitar',':id') }}";
        const URL_ELIMINAR    = "{{ route('sucursal.destroy',':id') }}";





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
                const idsucursal = $(this).closest('div.dropdown-menu').data('idsucursal');
                $("#frmHabilitar input[name=idsucursal]").val(idsucursal);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idsucursal = $(this).closest('div.dropdown-menu').data('idsucursal');
                $("#frmInhabilitar input[name=idsucursal]").val(idsucursal);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                const idsucursal = $(this).closest('div.dropdown-menu').data('idsucursal');
                $("#frmEliminar input[name=idsucursal]").val(idsucursal);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                const idsucursal = $(this).closest('div.dropdown-menu').data('idsucursal');

                cargando('Procesando...');
                axios.get(URL_EDIT.replace(':id',idsucursal))
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idsucursal]").val(data.idsucursal);


                    $("#nombreEditar").val(data.nombre);

                    $('#descripcionEditar').val(data.descripcion);
                    CKEDITOR.instances.contenidoEditar.setData(data.contenido);
                    $('#departamentoEditar').val(data.iddepartamento);
                    getProvincias({
                        iddepartamento: data.iddepartamento,
                        selectProvincia: '#provinciaEditar',
                        selectDistrito: '#distritoEditar',
                        currentValue: data.idprovincia,
                    });
                    getDistritos({
                        idprovincia: data.idprovincia,
                        selectDistrito: '#distritoEditar',
                        currentValue: data.iddistrito
                    });
                    $('#direccionEditar').val(data.direccion);
                    $('#horarioAtencionEditar').val(data.horario_atencion);
                    $('#estadoEditar').val(data.estado);






                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idsucursal = $(this).closest('div.dropdown-menu').data('idsucursal');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idsucursal))
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#nombreShow").html(data.nombre);
                    $('#descripcionShow').html(data.descripcion);
                    $("#contenidoShow").html(data.contenido);
                    $('#departamentoShow').html(data.departamento.nombre);
                    $('#provinciaShow').html(data.provincia.nombre);
                    $('#distritoShow').html(data.distrito.nombre);
                    $('#direccionShow').html(data.direccion);
                    $('#horarioAtencionShow').html(data.horario_atencion);



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

                const idsucursal = $("#frmEditar input[name=idsucursal]").val();
                const form = new FormData($(this)[0]);
                form.append('contenidoEditar',CKEDITOR.instances.contenidoEditar.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idsucursal),form)
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
                const idsucursal = $("#frmHabilitar input[name=idsucursal]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idsucursal))
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
                const idsucursal = $("#frmInhabilitar input[name=idsucursal]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idsucursal))
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
                const idsucursal = $("#frmEliminar input[name=idsucursal]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idsucursal))
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

        const filledSelect = ({ select, data, optionLabel = 'name', optionValue = 'id', currentValue = null}) => {
            $(select).empty();
            $(select).append(`<option value="" hidden>[---Seleccione---]</option>`);
            for (const item of data) {
                $(select).append(`<option value="${ item[optionValue] }" >${ item[optionLabel] }</option>`);
            }

            if (currentValue) {
                $(select).val(currentValue)
            }else{
                $(select).val('');
            }


        }

        const getProvincias = ({ iddepartamento, currentValue = null, selectProvincia }) => {
            return axios("{{ route('sucursal.ubigeo') }}",{
                params: {
                    case: 'provincias',
                    iddepartamento: iddepartamento,
                }
            })
            .then( response => {
                const data = response.data;

                filledSelect({
                    select: selectProvincia,
                    data: data,
                    currentValue: currentValue,
                    optionValue: 'idprovincia',
                    optionLabel: 'nombre'
                })

            })
            .catch( errorCatch );
        }

        const getDistritos = ({ idprovincia, currentValue = null, selectDistrito }) => {
            return axios("{{ route('sucursal.ubigeo') }}",{
                params: {
                    case: 'distritos',
                    idprovincia: idprovincia,
                }
            })
            .then( response => {
                const data = response.data;

                filledSelect({
                    select: selectDistrito,
                    data: data,
                    currentValue: currentValue,
                    optionValue: 'iddistrito',
                    optionLabel: 'nombre'
                })

            })
            .catch( errorCatch );
        }

        const changeUbigeo = () => {
            $(document).on( 'change', '#departamento', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getProvincias({ iddepartamento: val, selectProvincia: '#provincia' })
                .then( _ => {
                    filledSelect({ select: '#distrito', data: [], })
                });

            });
            $(document).on( 'change', '#provincia', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getDistritos({ idprovincia: val, selectDistrito: '#distrito' });
            });


            $(document).on( 'change', '#departamentoEditar', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getProvincias({ iddepartamento: val, selectProvincia: '#provinciaEditar', selectDistrito: '#distritoEditar' })
                .then( _ => {
                    filledSelect({ select: '#distritoEditar', data: [], })
                });
            });
            $(document).on( 'change', '#provinciaEditar', function (e) {
                e.preventDefault();
                const val = $(this).val();
                getDistritos({ idprovincia: val, selectDistrito: '#distritoEditar' });
            });
        }






        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            changeUbigeo();

            CKEDITOR.replace('contenido',{ height : 200 });
            CKEDITOR.replace('contenidoEditar',{ height : 200 });

        });


    </script>
@endpush
