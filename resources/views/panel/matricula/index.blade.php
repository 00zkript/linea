@extends('panel.template.index')
@push('css')
@endpush
@section('cuerpo')
    @include('panel.matricula.ver')
    @include('panel.matricula.habilitar')
    @include('panel.matricula.inhabilitar')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Matrículas</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 text-right">
                                <a href="{{ route('matricula.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</a>
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
                                            <input type="text" id="txtBuscar" name="txtBuscar" class="form-control" placeholder="ID / Cliente / Temporada / Programa ">
                                            <div class="input-group-append">
                                                <button class="btn btn-secondary"><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <div class="col-12" id="listado">
                                @include('panel.matricula.listado')
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


        const URL_LISTADO     = "{{ route('matricula.listar') }}";
        const URL_VER         = "{{ route('matricula.show',':id') }}";
        const URL_HABILITAR   = "{{ route('matricula.habilitar',':id') }}";
        const URL_INHABILITAR = "{{ route('matricula.inhabilitar',':id') }}";



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

            $(document).on("click",".btnModalHabilitar",function(e){
                e.preventDefault();
                const idmatricula = $(this).closest('div.dropdown-menu').data('idmatricula');
                $("#frmHabilitar input[name=idmatricula]").val(idmatricula);
                $("#modalHabilitar").modal("show");
            });

            $(document).on("click",".btnModalInhabilitar",function(e){
                e.preventDefault();
                const idmatricula = $(this).closest('div.dropdown-menu').data('idmatricula');
                $("#frmInhabilitar input[name=idmatricula]").val(idmatricula);
                $("#modalInhabilitar").modal("show");
            });

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idmatricula = $(this).closest('div.dropdown-menu').data('idmatricula');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idmatricula))
                .then(response => {
                    const data = response.data;
                    const { matricula, productos_adicionales } = data;

                    stop();


                    $('#idmatriculaShow').html( matricula.idmatricula.toString().padStart(7,0) );
                    $('#sucursalShow').html(matricula.sucursal.nombre+(matricula.sucursal.direccion ? ' - '+matricula.sucursal.direccion : ''));
                    $('#clienteShow').html(matricula.cliente_nombres+' '+matricula.cliente_apellidos);
                    $('#clienteIdtipoDocumentoIdentidadShow').html( matricula.cliente_tipo_documento_identidad.nombre +' - '+ matricula.cliente_numero_documento_identidad);
                    $('#empleadoShow').html(matricula.empleado_nombres+' '+(matricula.empleado_apellidos??''));
                    $('#empleadoIdtipoDocumentoIdentidadShow').html( matricula.empleado_tipo_documento_identidad.nombre +(matricula.empleado_numero_documento_identidad ? ' - '+matricula.empleado_numero_documento_identidad : ''));
                    $('#periodoShow').html(matricula.fecha_inicio+' - '+matricula.fecha_fin);
                    $('#conceptoShow').html(matricula.concepto.nombre);
                    $('#temporadaShow').html(matricula.temporada.nombre);
                    $('#programaShow').html(matricula.programa.nombre);
                    $('#nivelShow').html(matricula.nivel.nombre);
                    $('#carrilShow').html(matricula.carril.nombre);
                    $('#frecuenciaShow').html(matricula.frecuencia.nombre);
                    $('#cantidadClasesShow').html(matricula.cantidad_clases);
                    $('#montoTotalShow').html('S/. '+matricula.monto_total);


                    $('#horarioShow').empty();
                    let detalleHtml = '';
                    matricula.detalle.forEach( detalle => {
                        detalleHtml +=  `
                            <tr>
                                <td class="text-center" >${ detalle.dia_nombre }</td>
                                <td class="text-center" >${ detalle.horario_nombre }</td>
                            </tr>
                        `;
                    });

                    $('#horarioShow').html(detalleHtml);


                    $('#productosAdicionalesShow').empty();
                    let productosadicionalesHtml = '';
                    productos_adicionales.forEach( (producto,idx) => {
                        productosadicionalesHtml +=  `
                            <tr>
                                <td class="text-center">#${ (idx+1) }</td>
                                <td class="text-left">${ producto.nombre }</td>
                                <td class="text-center">${ producto.cantidad }</td>
                                <td class="text-right">S/. ${ number_format(producto.precio,2) }</td>
                                <td class="text-right">S/. ${ number_format(producto.subtotal,2) }</td>
                            </tr>
                        `;
                    });

                    $('#productosAdicionalesShow').html(productosadicionalesHtml);




                    if (matricula.finalizado_at){
                        $("#finalizadoShow").html('<label class="badge badge-primary">Finalizado</label>');
                    }else{
                        $("#finalizadoShow").html('<label class="badge badge-secondary">Sin finalizar</label>');
                    }

                    if (matricula.estado){
                        $("#estadoShow").html('<label class="badge badge-success">Habilitado</label>');
                    }else{
                        $("#estadoShow").html('<label class="badge badge-danger">Inhabilitado</label>');
                    }


                    $("#modalVer").modal("show");

                })
                .catch(errorCatch)


            });

        }

        const habilitar = () => {
            $(document).on( "submit" ,"#frmHabilitar", function(e){
                e.preventDefault();
                // const form = new FormData($(this)[0]);
                const idmatricula = $("#frmHabilitar input[name=idmatricula]").val();
                cargando('Procesando...');

                axios.put(URL_HABILITAR.replace(':id',idmatricula))
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
                const idmatricula = $("#frmInhabilitar input[name=idmatricula]").val();
                cargando('Procesando...');

                axios.put(URL_INHABILITAR.replace(':id',idmatricula))
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



        $(function () {
            modales();
            filtros();
            habilitar();
            inhabilitar();

        });


    </script>
@endpush
