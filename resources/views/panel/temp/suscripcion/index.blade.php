@extends('panel.template.index')
@section('cuerpo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Lista de suscripciones</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            {{--<div class="col-12 text-right">
                                <button id="btnModalCrear" class="btn btn-primary btn-lg"><i class="fa fa-plus"></i> Nuevo registro</button>
                            </div>--}}
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
                            <div class="col-md-6 col-md-12">
                                <div class="form-group">
                                    <button type="button" class="btn btn-success btnDownloadExcel"><i class="fa fa-file-excel"></i></button>
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
                                @include('panel.suscripcion.listado')
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

        const URL_LISTADO = "{{ route('suscripcion.listar') }}";
        const URL_EXCEL = "{{ route('suscripcion.downloadExcel') }}";

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
                txtBuscar : document.querySelector("#txtBuscar").value.trim(),
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

        const generarExcel = () => {
            $(".btnDownloadExcel").on("click", function (e) {
                e.preventDefault();

                $(".btnDownloadExcel").prop("disabled",true);
                axios({
                    method : 'GET',
                    url : URL_EXCEL,
                    responseType: 'blob',
                })
                .then( response => {
                    const data = response.data;

                    let objUrl = URL.createObjectURL(data);
                    const a = document.createElement("a");
                    a.href = objUrl;
                    a.download = "lista_suscripciones_" + '{{now()->format('d/m/Y') }}' + '.xlsx';
                    a.click();
                    notificacion("success","En hora buena","El reporte se genero con exito.");

                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;
                    notificacion("error","Error","Ocurrió un error al generar el reporte.");

                })
                .then( _ => {
                    // barProgress('end');
                    $(".btnDownloadExcel").prop("disabled",false);
                })




            })
        }




        $(function () {
            filtros();
            generarExcel();
        });


    </script>
@endpush
