@extends('panel.template.index')
@section('cuerpo')
    @include('panel.venta.ver')
    @include('panel.venta.anular')
    {{-- @include('panel.venta.eliminar') --}}
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
                                <a href="{{ route('venta.create') }}" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo Pago</a>
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
                                @include('panel.venta.listado')
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
        const URL_LISTADO     = "{{ route('venta.listar') }}";
        const URL_VER         = "{{ route('venta.show',':id') }}";
        const URL_ANULAR         = "{{ route('venta.anular',':id') }}";


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

            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idventa = $(this).closest('div.dropdown-menu').data('idventa');

                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idventa))
                .then(response => {
                    const data = response.data;
                    stop();

                    $('#idventaShow').html( (data.idventa).toString().padStart(7,0) );
                    $('#sucursalShow').html( data.sucursal.nombre );
                    $('#clienteShow').html( data.cliente_nombres+" "+data.cliente_apellidos );
                    $('#empleadoShow').html( data.empleado_nombres+" "+data.empleado_apellidos );
                    $('#tipoFacturacionShow').html( data.tipo_facturacion.nombre+" "+data.tipo_facturacion_serie+" - "+data.tipo_facturacion_numero );
                    $('#tipoPagoShow').html( data.tipo_pago.nombre );
                    $('#montoPagadoShow').html( "S/. "+data.monto_pagado );
                    $('#montoFaltanteShow').html( "S/. "+data.monto_faltante );
                    $('#montoTotalShow').html( "S/. "+data.monto_total );
                    $('#fechaPagoShow').html( data.fecha_pago.split('-').reverse().join('/') );

                    $("#modalVer").modal("show");

                })
                .catch(errorCatch)



            });

            $(document).on("click",".btnModalAnular",function(e){
                e.preventDefault();
                const idventa = $(this).closest('div.dropdown-menu').data('idventa');

                $('#frmAnular input[name=idventa]').val( idventa );
                $("#modalAnular").modal("show");

            });

        }


        const actions = () => {
            $(document).on( "submit","#frmAnular" , function(e){
                e.preventDefault();

                const idventa = $("#frmAnular input[name=idventa]").val();
                cargando('Procesando...');

                axios.post(URL_ANULAR.replace(':id',idventa))
                .then( response => {
                    const data = response.data;
                    stop();
                    $("#modalAnular").modal("hide");

                    notificacion("success","Anulado",data.mensaje);

                    listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                } )
                .catch( errorCatch )

            } )
        }

        $(function () {
            modales();
            filtros();
            actions();


        });


    </script>
@endpush
