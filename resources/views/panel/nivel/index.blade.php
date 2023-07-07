@extends('panel.template.index')
@section('cuerpo')
    @include('panel.nivel.crear')
    @include('panel.nivel.editar')
    @include('panel.nivel.habilitar')
    @include('panel.nivel.inhabilitar')
    @include('panel.nivel.eliminar')
    @include('panel.nivel.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar niveles</p>
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
                                @include('panel.nivel.listado')
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


        const URL_LISTADO     = "{{ route('nivel.listar') }}";
        const URL_GUARDAR     = "{{ route('nivel.store') }}";
        const URL_VER         = "{{ route('nivel.show',':id') }}";
        const URL_EDIT        = "{{ route('nivel.edit',':id') }}";
        const URL_MODIFICAR   = "{{ route('nivel.update',':id') }}";
        const URL_HABILITAR   = "{{ route('nivel.habilitar',':id') }}";
        const URL_INHABILITAR = "{{ route('nivel.inhabilitar',':id') }}";
        const URL_ELIMINAR    = "{{ route('nivel.destroy',':id') }}";




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
                getPosicion({ el: '#posicion'})
                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                const idnivel = $(this).closest('div.dropdown-menu').data('idnivel');
                $("#frmHabilitar input[name=idnivel]").val(idnivel);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idnivel = $(this).closest('div.dropdown-menu').data('idnivel');
                $("#frmInhabilitar input[name=idnivel]").val(idnivel);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                const idnivel = $(this).closest('div.dropdown-menu').data('idnivel');
                $("#frmEliminar input[name=idnivel]").val(idnivel);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                const idnivel = $(this).closest('div.dropdown-menu').data('idnivel');

                cargando('Procesando...');
                axios.get(URL_EDIT.replace(':id',idnivel))
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#frmEditar")[0].reset();
                    $("#frmEditar input[name=idnivel]").val(data.idnivel);


                    $("#nombreEditar").val(data.nombre);
                    getPosicion({ el: '#posicionEditar', currentValue: data.posicion})



                    $("#frmEditar .selectpicker").selectpicker("render");
                    $("#modalEditar").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idnivel = $(this).closest('div.dropdown-menu').data('idnivel');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idnivel))
                .then(response => {
                    const data = response.data;

                    stop();

                    $("#nombreShow").html(data.nombre);
                    $("#posicionShow").html(data.posicion);

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

                const idnivel = $("#frmEditar input[name=idnivel]").val();
                const form = new FormData($(this)[0]);

                cargando('Procesando...');
                axios.post(URL_MODIFICAR.replace(':id',idnivel),form)
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
                const idnivel = $("#frmHabilitar input[name=idnivel]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idnivel))
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
                const idnivel = $("#frmInhabilitar input[name=idnivel]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idnivel))
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
                const idnivel = $("#frmEliminar input[name=idnivel]").val();
                cargando('Procesando...');

                axios.delete(URL_ELIMINAR.replace(':id',idnivel))
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

        const getPosicion = ({ currentValue = null, el = '#posicion' }) => {
            return axios.get("{{ route('nivel.posicionMaxima') }}")
            .then( response => {
                const data = response.data;
                const posicionMaxima = data.posicion_maxima;

                $(el).empty();
                for (let i = 1; i <= posicionMaxima; i++) {
                    $(el).append(`<option value="${i}">${i}</option>`);
                }

                if (currentValue) {
                    $(el).val(currentValue);
                }else{
                    $(el).val(posicionMaxima);
                }
            })
            .catch(errorCatch)
        }



        $(function () {
            modales();
            filtros();
            guardar();
            modificar();
            habilitar();
            inhabilitar();


        });


    </script>
@endpush
