@extends('panel.template.index')
@section('cuerpo')
    @include('panel.arqueoCaja.ver')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                         <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar Registros</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-12 form-group">
                                <label for="cantidadRegistros">Cantidad de registros</label>
                                <select name="cantidadRegistros" id="cantidadRegistros" class="form-control form-control-sm">
                                    <option value="10" selected>10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="9999999">Todos</option>
                                </select>
                            </div>

                            <div class="col-md-8 col-12">
                                <label for="rangoFechaDesde">Rango de Fecha</label>
                                <div class="input-group">
                                    <input type="text" class="form-control datepicker" placeholder="Desde" id="rangoFechaDesde" >
                                    <div class="input-group-addon">-</div>
                                    <input type="text" class="form-control datepicker" placeholder="Hasta" id="rangoFechaHasta" >
                                </div>
                            </div>

                            <div class="col-md-10 col-12 my-2">
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
                            <div class="col-md-2 col-12 my-2">
                                <button class="btn btn-danger" id="reportePdf" title="Reporte PDF" ><i class="fa fa-file-pdf"></i> PDF</button>
                            </div>

                            <div class="col-12" id="listado">
                                @include('panel.arqueoCaja.listado')
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

        const URL_LISTADO     = "{{ route('arqueoCaja.listar') }}";
        const URL_VER         = "{{ route('arqueoCaja.show',':id') }}";




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

            $(document).on("change","#rangoFechaDesde", function(e) {
                e.preventDefault();
                const paginaActual      = $("#paginaActual").val();
                const cantidadRegistros = $("#cantidadRegistros").val();

                listado(cantidadRegistros,paginaActual);

            } )

            $(document).on("change","#rangoFechaHasta", function(e) {
                e.preventDefault();
                const paginaActual      = $("#paginaActual").val();
                const cantidadRegistros = $("#cantidadRegistros").val();

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
                fechaDesde : $('#rangoFechaDesde').val(),
                fechaHasta : $('#rangoFechaHasta').val(),
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
            $(document).on("click",".btnModalVer",function(e){
                e.preventDefault();
                const idarqueo_caja = $(this).closest('div.dropdown-menu').data('idarqueo_caja');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idarqueo_caja))
                .then(response => {
                    const data = response.data;

                    stop();

                    $('#fecha').html(data.fecha);
                    $('#montoCambio').html(data.monto_cambio_moneda);
                    $('#supervisor').html(data.supervisor.nombres+" "+data.supervisor.apellidos);
                    $('#montoInicialSol').html(data.monto_inicial_sol);
                    $('#montoInicialDolar').html(data.monto_inicial_dolar);
                    $('#montoFinalSolEfectivo').html(data.monto_final_sol_efectivo);
                    $('#montoFinalSolTransferido').html(data.monto_final_sol_transferido);
                    $('#montoFinalSolFaltante').html(data.monto_final_sol_faltante);
                    $('#montoFinalSolSobrante').html(data.monto_final_sol_sobrante);
                    $('#montoFinalDolarEfectivo').html(data.monto_final_dolar_efectivo);
                    $('#montoFinalDolarTransferido').html(data.monto_final_dolar_transferido);
                    $('#montoFinalDolarFaltante').html(data.monto_final_dolar_faltante);
                    $('#montoFinalDolarSobrante').html(data.monto_final_dolar_sobrante);

                    $("#modalVer").modal("show");

                })
                .catch(errorCatch)


            });
        }

        const reportes = () => {
            $(document).on("click","#reportePdf",function(e){
                e.preventDefault();

                const form = {
                    txtBuscar : $("#txtBuscar").val().trim(),
                    fechaDesde : $('#rangoFechaDesde').val(),
                    fechaHasta : $('#rangoFechaHasta').val(),
                }

                const params = new URLSearchParams();
                for (const key in form) {
                    params.append(key, form[key]);
                }


                const baseUrl = "{{ route('arqueoCaja.reportePdf') }}";
                const url = `${baseUrl}?${params.toString()}`;


                window.location.href = url;

            });


        }

        $('.datepicker').datepicker();

        $(function () {
            modales();
            filtros();
            reportes();
        });


    </script>
@endpush
