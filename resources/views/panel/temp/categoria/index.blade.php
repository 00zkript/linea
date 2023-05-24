@extends('panel.template.index')
@section('cuerpo')
@include('panel.categoria.crear')
@include('panel.categoria.editar')
@include('panel.categoria.habilitar')
@include('panel.categoria.inhabilitar')
@include('panel.categoria.eliminar')
@include('panel.categoria.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar categorias</p>
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
                                @include('panel.categoria.listado')
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


        const URL_LISTADO     = "{{ route('categorias.listar') }}";
        const URL_GUARDAR     = "{{ route('categorias.store') }}";
        const URL_VER         = "{{ route('categorias.show','show') }}";
        const URL_EDIT        = "{{ route('categorias.edit','edit') }}";
        const URL_MODIFICAR   = "{{ route('categorias.update','update') }}";
        const URL_HABILITAR   = "{{ route('categorias.habilitar') }}";
        const URL_INHABILITAR = "{{ route('categorias.inhabilitar') }}";
        const URL_ELIMINAR    = "{{ route('categorias.destroy','destroy') }}";
        const URL_GETPARIENTES    = "{{ route('categorias.getParientes') }}";
        const URL_GETORDEN    = "{{ route('categorias.getOrden') }}";



        const modales = () => {

            $("#btnModalCrear").on("click",(e)=>{
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear .selectpicker").selectpicker("val",null);
                $("#pariente option").remove();
                $("#orden option").remove();
                $("#pariente,#orden").selectpicker("refresh");
                CKEDITOR.instances.descripcion.setData('');
                $("#frmCrear")[0].reset();
                $("#modalCrear").modal("show");
            });

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                var idcategoria = $(this).closest('div.dropdown-menu').data('idcategoria');
                $("#frmHabilitar input[name=idcategoria]").val(idcategoria);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                var idcategoria = $(this).closest('div.dropdown-menu').data('idcategoria');
                $("#frmInhabilitar input[name=idcategoria]").val(idcategoria);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalEliminar",function(e){
                e.preventDefault();
                var idcategoria = $(this).closest('div.dropdown-menu').data('idcategoria');
                $("#frmEliminar input[name=idcategoria]").val(idcategoria);
                $("#modalEliminar").modal("show");
            });

            $(document).on("click",".btnModalEditar",function(e){
                e.preventDefault();
                var idcategoria = $(this).closest('div.dropdown-menu').data('idcategoria');



                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idcategoria : idcategoria} })
                .then(response => {
                    const data = response.data;

                    stop();
                    let categoria = data.categoria;
                    let marcasRelacionadas = data.marcas;

                    $("#frmEditar span.error").remove();
                    $("#frmEditar")[0].reset();
                    getPariente( "editar", categoria.nivel, categoria.pariente);
                    getOrden( "editar", categoria.nivel, categoria.orden );

                    $("#idcategoria").val(categoria.idcategoria);
                    $("#nivelEditar").selectpicker("val",categoria.nivel);
                    $("#nombreEditar").val(categoria.nombre);
                    $("#colorEditar").val(categoria.color ? categoria.color : '#000000');
                    $("#marcaEditar").selectpicker("val",marcasRelacionadas);
                    CKEDITOR.instances.descripcionEditar.setData(categoria.descripcion);


                    $("#estadoEditar").val(categoria.estado);

                    $("#modalEditar").modal("show");


                })
                .catch(errorCatch)



            });


            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                var idcategoria = $(this).closest('div.dropdown-menu').data('idcategoria');


                cargando('Procesando...');
                axios(URL_EDIT,{ params: {idcategoria : idcategoria} })
                .then(response => {
                    const data = response.data;
                    stop();
                    let categoria = data.categoria;
                    let parienteNombre = data.pariente;
                    let marcasRelacionada = data.marcas;

                    $("#txtNivel").html(categoria.nivel);

                    if (!empty(parienteNombre)){
                        $("#txtPariente").html(parienteNombre.nombre);
                    }

                    $("#txtNombre").html(categoria.nombre);
                    $("#txtOrden").html(categoria.orden);

                    $("#txtMarcas li").remove();
                    $.each(marcasRelacionada,function (index,val) {
                        $("#txtMarcas").append('<li>'+val.nombre+'</li>');
                    });

                    $("#txtDescripcion").html(categoria.descripcion);

                    if (categoria.estado){
                        $("#txtEstado").html('<label class="badge badge-success">Habilitado</label>');
                    }else{
                        $("#txtEstado").html('<label class="badge badge-danger">Inhabilitado</label>');
                    }


                    $("#modalVer").modal("show");


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
                form.append('descripcion',CKEDITOR.instances.descripcion.getData());
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
                form.append('descripcionEditar',CKEDITOR.instances.descripcionEditar.getData());
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

        const getPariente = ( accion = "crear", nivel = null, valorActual = null) => {

            const select = accion != "editar" ? 'pariente' : 'parienteEditar';

            axios(URL_GETPARIENTES,{
                params:{
                    nivel: nivel
                }
            })
            .then( response => {
                const data = response.data;

                $("#"+select+" option").remove();


                for (let item of data) {

                    $("#"+select).append(`
                        <option value="${ item.idcategoria }" >
                            ${ (!empty(item.nombrePariente) ? item.nombrePariente+" -> " : "" ) +item.nombre }
                        </option>
                    `);

                    $("#"+select).selectpicker("val",valorActual);

                }


                $("#"+select).selectpicker("refresh");

            })
            .catch( errorCatch )
        }

        const getOrden = ( accion = "crear", nivel = null, valorActual = null ) => {

            const select = accion != "editar" ? 'orden' : 'ordenEditar';

            axios(URL_GETORDEN,{
                params:{
                    nivel: nivel
                }
            })
            .then( response => {
                const data = response.data;

                $("#"+select+" option").remove();
                for (let i = 1; i <= data.maxima_posicion ; i++) {

                    $("#"+select).append(`<option value="${ i }" >${ i }</option>`);

                    $selected  = !empty(valorActual) ? valorActual : data.maxima_posicion;
                    $("#"+select).selectpicker("val",$selected);
                }

                $("#"+select).selectpicker("refresh");

            })
            .catch( errorCatch )
        }



        const getDatosPorNivel = function (){

            $("#nivel").on("change",function (e) {
                e.preventDefault();

                getPariente("crear",$(this).val());
                getOrden("crear",$(this).val());

            })



            $("#nivelEditar").on("change",function (e) {
                e.preventDefault();

                getPariente( "editar", $(this).val());
                getOrden( "editar", $(this).val());


            })

        }






        $(function () {
            filtros();
            modales();
            guardar();
            modificar();
            habilitar();
            inhabilitar();
            eliminar();
            getDatosPorNivel();

            CKEDITOR.replace('descripcion',{
                height : 300
            });

            CKEDITOR.replace('descripcionEditar',{
                height : 300
            });

        });


    </script>
@endpush
