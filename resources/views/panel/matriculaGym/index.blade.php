@extends('panel.template.index')
@push('css')
@endpush
@section('cuerpo')
    @include('panel.matriculaGym.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Incripciones GyM</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('matriculaGym.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</a>
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
                                @include('panel.matriculaGym.listado')
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


        const URL_LISTADO     = "{{ route('matriculaGym.listar') }}";
        {{-- // const URL_GUARDAR     = "{{ route('matriculaGym.store') }}"; --}}
        {{-- // const URL_VER         = "{{ route('matriculaGym.show',':id') }}"; --}}
        {{-- // const URL_EDIT        = "{{ route('matriculaGym.edit',':id') }}"; --}}
        {{-- // const URL_MODIFICAR   = "{{ route('matriculaGym.update',':id') }}"; --}}
        {{-- // const URL_HABILITAR   = "{{ route('matriculaGym.habilitar',':id') }}"; --}}
        {{-- // const URL_INHABILITAR = "{{ route('matriculaGym.inhabilitar',':id') }}"; --}}
        {{-- // const URL_ELIMINAR    = "{{ route('matriculaGym.destroy',':id') }}"; --}}




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
            // cargando();

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

            /* $(document).on("click","#btnModalCrear", function (e) {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();
                CKEDITOR.instances.contenido.setData('');

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            }); */

            /* $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                const idmatriculaGym = $(this).closest('div.dropdown-menu').data('idmatriculaGym');
                $("#frmHabilitar input[name=idmatriculaGym]").val(idmatriculaGym);
                $("#modalHabilitar").modal("show");
            }); */

            /* $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idmatriculaGym = $(this).closest('div.dropdown-menu').data('idmatriculaGym');
                $("#frmInhabilitar input[name=idmatriculaGym]").val(idmatriculaGym);
                $("#modalInhabilitar").modal("show");
            }); */

            /* $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                const idmatriculaGym = $(this).closest('div.dropdown-menu').data('idmatriculaGym');
                $("#frmEliminar input[name=idmatriculaGym]").val(idmatriculaGym);
                $("#modalEliminar").modal("show");
            }); */

            /* $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                const idmatriculaGym = $(this).closest('div.dropdown-menu').data('idmatriculaGym');

                cargando('Procesando...');
                axios.get(URL_EDIT.replace(':id',idmatriculaGym))
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idmatriculaGym]").val(data.idmatriculaGym);

                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            }); */

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idmatriculaGym = $(this).closest('div.dropdown-menu').data('idmatriculaGym');


                /* cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idmatriculaGym))
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#nombreShow").html(data.nombre);
                    $("#contenidoShow").html(data.contenido);

                    if (data.estado){
                        $("#estadoShow").html('<label class="badge badge-success">Habilitado</label>');
                    }else{
                        $("#estadoShow").html('<label class="badge badge-danger">Inhabilitado</label>');
                    }


                    $("#modalVer").modal("show");

                })
                .catch(errorCatch) */
                $("#modalVer").modal("show");


            });

        }

        /* const guardar = () => {
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
        } */

        /* const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                const idmatriculaGym = $("#frmEditar input[name=idmatriculaGym]").val();
                const form = new FormData($(this)[0]);
                form.append('contenidoEditar',CKEDITOR.instances.contenidoEditar.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idmatriculaGym),form)
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
        } */

        /* const habilitar = () => {
            $(document).on( "submit" ,"#frmHabilitar", function(e){
                e.preventDefault();
                // const form = new FormData($(this)[0]);
                const idmatriculaGym = $("#frmHabilitar input[name=idmatriculaGym]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idmatriculaGym))
                .then( response => {
                    const data = response.data;
                    stop();

                    $("#modalHabilitar").modal("hide");

                    notificacion("success","Habilitado",data.mensaje);

                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                })
                .catch( errorCatch )


            } )

        } */

        /* const inhabilitar = () => {
            $(document).on( "submit","#frmInhabilitar" , function(e){
                e.preventDefault();

                // const form = new FormData($(this)[0]);
                const idmatriculaGym = $("#frmInhabilitar input[name=idmatriculaGym]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idmatriculaGym))
                .then( response => {
                    const data = response.data;
                    stop();
                    $("#modalInhabilitar").modal("hide");

                    notificacion("success","Inhabilitado",data.mensaje);

                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                } )
                .catch( errorCatch )

            } )
        } */

        /* const eliminar = () => {
            $(document).on( "submit","#frmEliminar" , function(e){
                e.preventDefault();

                // const form = new FormData($(this)[0]);
                const idmatriculaGym = $("#frmEliminar input[name=idmatriculaGym]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idmatriculaGym))
                .then( response => {
                    const data = response.data;
                    stop();
                    $("#modalEliminar").modal("hide");

                    notificacion("success","Eliminado",data.mensaje);

                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                } )
                .catch( errorCatch )

            } )
        } */


        $(function () {
            modales();
            filtros();
            // guardar();
            // modificar();
            // habilitar();
            // inhabilitar();

        });


    </script>
@endpush
