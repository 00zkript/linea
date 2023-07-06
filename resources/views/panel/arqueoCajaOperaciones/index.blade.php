@extends('panel.template.index')
@section('cuerpo')
    @include('panel.arqueoCajaOperaciones.ver')
    <div class="container">
        <div class="card">
            <div class="card-header" style="background-color: #2a3f54">
                <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Gestionar operaciones</p>
            </div>
            <div class="card-body">
                <div class="row">
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
                    <div class="col-md-6 col-12">
                        <label for="rangoFechaDesde">Rango de Fecha</label>
                        <div class="input-group">
                            <input type="text" class="form-control datepicker" placeholder="Desde" id="rangoFechaDesde" >
                            <div class="input-group-addon">-</div>
                            <input type="text" class="form-control datepicker" placeholder="Hasta" id="rangoFechaHasta" >
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
                        @include('panel.arqueoCajaOperaciones.listado')
                    </div>


                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="module" >


        const URL_LISTADO     = "{{ route('arqueoCajaOperacion.listar') }}";
        const URL_VER         = "{{ route('arqueoCajaOperacion.show',':id') }}";


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
                const idarqueo_caja_operaciones = $(this).closest('div.dropdown-menu').data('idarqueo_caja_operaciones');


                cargando('Procesando...');
                axios.get(URL_VER.replace(':id',idarqueo_caja_operaciones))
                .then(response => {
                    const data = response.data;

                    stop();

                    $('#usuario').html(data.usuario.usuario)
                    $('#fecha').html(data.fecha)
                    $('#tipoOperacion').html(data.tipo_operacion.nombre)
                    $('#supervisor').html(data.supervisor.nombres+' '+data.supervisor.apellidos)
                    $('#montoSolEfectivo').html('S/. '+parseFloat(data.monto_sol_efectivo).toFixed(2))
                    $('#montoSolTransferido').html('S/. '+parseFloat(data.monto_sol_transferido).toFixed(2))
                    // $('#montoDolarEfectivo').html('$ '+parseFloat(data.monto_dolar_efectivo).toFixed(2))
                    // $('#montoDolarTransferido').html('$ '+parseFloat(data.monto_dolar_transferido).toFixed(2))
                    $('#descripcion').html(data.descripcion)

                    $("#modalVer").modal("show");

                })
                .catch(errorCatch)


            });

        }


        $(function () {
            modales();
            filtros();

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                language: 'es',
                orientation: "auto left",
                forceParse: false,
                autoclose: true,
                todayHighlight: false, /*pinta la fecha de hoy*/
                toggleActive: false,
            });
        });


    </script>
@endpush
