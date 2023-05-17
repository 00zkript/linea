@extends('panel.template.index')
@section('cuerpo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Reporte de ventas</p>
                    </div>
                    <div class="card-body">
                        <div class="row my-2" id="divProgressBarReporte" style="display: none">
                            <p>Generando reporte...</p>
                            <div class="col-12" style="border: 1px solid grey;border-radius: 10px;padding-right: 0px!important;padding-left: 0px!important;">
                                <div id="progressBarReporte" style="width: 1%;border-radius: 10px" class="bg-success">
                                    <p id="textProgressBarReporte" class="text-black-50 text-nowrap text-center mb-0">1%</p>
                                </div>

                            </div>
                        </div>
                        <form onsubmit="return false;" id="frmReporteVentas">
                            <div class="row">

                                <div class="col-12">
                                    <p class="font-weight-bold">APLICAR FILTROS</p>
                                    <hr>
                                </div>
                                <div class="col-12 text-right">
                                    <button type="reset" class="btn btn-info btn-round btn-lg"><i class="fa fa-refresh"></i></button>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="idmetodo_pago">Método de pago:</label>
                                        <select name="idmetodo_pago" id="idmetodo_pago" class="form-control ">
                                            <option value="" hidden selected>[--Seleccion--]</option>
                                            @foreach($metodosPago AS $m)
                                                <option value="{{ $m->idmetodo_pago}}">{{ $m->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="idestado_envio">Estado de envio:</label>
                                        <select name="idestado_envio" id="idestado_envio" class="form-control ">
                                            <option value="" hidden selected>[--Seleccion--]</option>
                                            @foreach($estadosEnvio AS $e)
                                                <option value="{{ $e->idestado_envio}}">{{ $e->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="idestado_pago">Estado de pago:</label>
                                        <select name="idestado_pago" id="idestado_pago" class="form-control ">
                                            <option value="" hidden selected>[--Seleccion--]</option>
                                            @foreach($estadosPago AS $p)
                                                <option value="{{ $p->idestado_pago}}">{{ $p->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="idestado_control_venta">Estado de venta:</label>
                                        <select name="idestado_control_venta" id="idestado_control_venta" class="form-control ">
                                            <option value="" hidden selected>[--Seleccion--]</option>
                                            @foreach($estadosControlVenta AS $p)
                                                <option value="{{ $p->idestado_control_venta}}">{{ $p->nombre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="desde">Desde:</label>
                                        <input value="" required data-mask="00/00/0000" placeholder="00/00/0000" type="text" name="desde" id="desde" class="form-control  datepicker">
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <label for="hasta">Hasta:</label>
                                        <input value="" required data-mask="00/00/0000" placeholder="00/00/0000" type="text" name="hasta" id="hasta" class="form-control  datepicker">
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <button type="button" id="btnGenerarPdf" class="btn btn-danger btn-block">
                                    <i class="fa fa-file-pdf-o"></i> GENERAR PDF
                                </button>
                            </div>
                            <div class="col-12">
                                <hr>
                            </div>
                            <div class="col-12">
                                <button type="button" id="btnGenerarExcel" class="btn btn-success btn-block">
                                    <i class="fa fa-file-excel-o"></i> GENERAR EXCEL
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')

    <script type="module">
        const URL_PDF = '{{ route('reporteVentas.generarPdfVentas') }}';
        const URL_EXCEL = '{{ route('reporteVentas.generarExcelVentas') }}';

        let progressInterval = null;
        const barProgress = (accion = 'init') => {

            if (accion == 'init'){
                let contador = 1;
                $("#divProgressBarReporte").show();
                progressInterval = setInterval(function (){
                    if (contador < 100){
                        contador++;
                        $("#progressBarReporte").css('width',contador+'%')
                        $("#textProgressBarReporte").text(contador+"%");
                    }
                },1500);

            }

            if (accion == "end"){
                clearInterval(progressInterval);
                $("#progressBarReporte").css('width','100%')
                $("#textProgressBarReporte").text("100%");
                setTimeout(function (){
                    $("#divProgressBarReporte").hide();
                    $("#progressBarReporte").css('width','1%')
                    $("#textProgressBarReporte").text('1%');
                },1000);

            }

        }


        const generarPdf = () => {

            $("#btnGenerarPdf").on("click", function (e) {
                e.preventDefault();
                $("#btnGenerarPdf").prop("disabled",true);

                const form =  new FormData($("#frmReporteVentas")[0]);

                barProgress();

                axios({
                    method : 'POST',
                    url : URL_PDF,
                    data : form,
                    responseType: 'blob',
                })
                .then( response => {
                    const data = response.data;

                    let objUrl = URL.createObjectURL(data);
                    const a = document.createElement("a");
                    a.href = objUrl;
                    a.download = "reporte_ventas_generado_" + '{{now()->format('d/m/Y') }}' + '.pdf';
                    a.click();
                    notificacion("success","En hora buena","El reporte se genero con exito.");
                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;
                    notificacion("error","Error","Ocurrió un error al generar el reporte.");

                })
                .then( _ => {
                    barProgress('end');
                    $("#btnGenerarPdf").prop("disabled",false);
                })

            })
        }

        const generarExcel = () => {
            $("#btnGenerarExcel").on("click", function (e) {
                e.preventDefault();
                $("#btnGenerarExcel").prop("disabled",true);

                const form =new FormData($("#frmReporteVentas")[0]);
                barProgress();

                $("#btnGenerarExcel").prop("disabled",true);
                axios({
                    method : 'POST',
                    url : URL_EXCEL,
                    data : form,
                    responseType: 'blob',
                })
                .then( response => {
                    const data = response.data;

                    let objUrl = URL.createObjectURL(data);
                    const a = document.createElement("a");
                    a.href = objUrl;
                    a.download = "reporte_ventas_generado_" + '{{now()->format('d/m/Y') }}' + '.xlsx';
                    a.click();
                    notificacion("success","En hora buena","El reporte se genero con exito.");

                })
                .catch( error => {
                    const response = error.response;
                    const data = response.data;
                    notificacion("error","Error","Ocurrió un error al generar el reporte.");

                })
                .then( _ => {
                    barProgress('end');
                    $("#btnGenerarExcel").prop("disabled",false);
                })




            })
        }



        $(function () {
            generarPdf();
            generarExcel();

            $('#desde').datepicker({
                language: 'es',
                autoclose: true,
                format: 'dd/mm/yyyy',
            });

            $('#hasta').datepicker({
                language: 'es',
                autoclose: true,
                format: 'dd/mm/yyyy',
            });


        });



    </script>

@endpush
