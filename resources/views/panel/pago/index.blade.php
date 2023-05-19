@extends('panel.template.index')
@section('cuerpo')
    @include('panel.pago.ver')
    @include('panel.pago.eliminar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar pagos</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('pago.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo Pago</a>
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
                                @include('panel.pago.listado')
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


        const URL_LISTADO     = "{{ route('pago.listar') }}";
        {{-- // const URL_GUARDAR     = "{{ route('pago.store') }}"; --}}
        {{-- // const URL_VER         = "{{ route('pago.show',':id') }}"; --}}
        {{-- // const URL_EDIT        = "{{ route('pago.edit',':id') }}"; --}}
        {{-- // const URL_MODIFICAR   = "{{ route('pago.update',':id') }}"; --}}
        {{-- // const URL_HABILITAR   = "{{ route('pago.habilitar',':id') }}"; --}}
        {{-- // const URL_INHABILITAR = "{{ route('pago.inhabilitar',':id') }}"; --}}
        {{-- // const URL_ELIMINAR    = "{{ route('pago.destroy',':id') }}"; --}}




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

            $(document).on("click","#btnModalCrear", function (e) {
                e.preventDefault();
                $("#frmCrear span.error").remove();
                $("#frmCrear")[0].reset();

                $("#frmCrear .selectpicker").selectpicker("refresh");
                $("#modalCrear").modal("show");


            });

            /* $(document).on("click",".btnModalHabilitar",function(e){
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



            }); */

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idregistro = $(this).closest('div.dropdown-menu').data('idregistro');

                // cargando('Procesando...');
                // axios.get(URL_VER.replace(':id',idregistro))
                // .then(response => {
                //     const data = response.data;
                //     stop();

                    const data = {
                        idmatricula : 7,
                        sucursal: {
                            nombre: 'sucrusal 1',
                            direccion: 'Lorem ipsum dolor sit amet.',
                            departamento: {
                                nombre: 'Lima'
                            },
                            provincia: {
                                nombre: 'Lima'
                            },
                            distrito: {
                                nombre: 'Lima'
                            },
                        },
                        caja: {
                            nombre: 'caja1'
                        },
                        empleado: {
                            nombres: 'lorenzo',
                            apellidos: 'Perez Mancilla',
                            tipo_documento_identidad: {
                                nombre: 'DNI'
                            },
                            numero_documento_identidad: 87654321,
                        },
                        cliente: {
                            nombres: 'Juan',
                            apellidos: 'Perez Mancilla',
                            tipo_documento_identidad: {
                                nombre: 'DNI'
                            },
                            numero_documento_identidad: 87654321,
                        },
                        pagos: [
                            { monto: 150, created_at : '01/01/2023'  } ,
                            { monto: 100, created_at : '02/01/2023'  } ,
                        ],
                        monto_total: 350,
                        monto_pagado: 250,
                        monto_deuda: 100,
                    }

                    $('#alumnoShow').html( data.cliente.nombres+" "+data.cliente.apellidos );
                    $('#idmatriculaShow').html( data.idmatricula.toString().padStart(7,0) );
                    $('#sucursalShow').html( `${data.sucursal.nombre} - ${data.sucursal.direccion} ${data.sucursal.distrito.nombre} / ${data.sucursal.provincia.nombre} / ${data.sucursal.departamento.nombre} ` );
                    $('#cajaShow').html( data.caja.nombre );
                    $('#empleadoShow').html( data.empleado.nombres+" "+data.empleado.apellidos );
                    $('#montoTotalShow').html( "S/. "+number_format(data.monto_total,2) );
                    $('#montoPagadoShow').html( "S/. "+number_format(data.monto_pagado,2) );
                    $('#montoDeudaShow').html( "S/. "+number_format(data.monto_deuda,2) );

                    $('#pagosShow tbody').empty()
                    data.pagos.forEach((pago,idx) => {
                        $('#pagosShow tbody').append(`
                            <tr>
                                <td>#${idx+1}</td>
                                <td>S/. ${number_format(pago.monto,2)}</td>
                                <td>${pago.created_at}</td>
                            </tr>
                        `);

                    })

                    $("#modalVer").modal("show");

                // })
                // .catch(errorCatch)



            });

        }

        /* const guardar = () => {
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

                const idregistro = $("#frmEditar input[name=idregistro]").val();
                const form = new FormData($(this)[0]);

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
