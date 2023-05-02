<html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <meta name="robots" content="noindex, nofollow">

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@400;600;700;900&display=swap');
            .img-logo{
                height: 50px;
                width: auto;
            }
            .mt-3{
                margin-top: 3rem;
            }
            .mb-3{
                margin-bottom: 3rem;
            }
            .ms-3{
                /*margin-left: 3rem;*/
            }
            .me-3{
                /*margin-right: 3rem;*/
            }
            .fs-1{
                font-size: 2rem;
            }
            .ul-first {
                padding-left: 24px;
            }
            .text-uppercase{
                text-transform: uppercase !important;
            }

            .head-tabla{
                background: #019fa1;
                color: #fff;
            }

            *, ::after, ::before {
                box-sizing: border-box;
            }
            body{
                font-family: 'Source Sans Pro';
                font-size: 0.9rem;
                font-weight: 400;
                line-height: 1.5;
                color: #000;
                margin: 0;
            }
            .body{
                background: #f8fbfd;
                width: 100%;
            }
            .im {
                /*color: #000000 !important;*/
            }
            a{
                text-decoration: none !important;
            }
            hr {
                /*margin: 0.8rem 0;*/
                margin: 10px 0;
                color: inherit;
                background-color: currentColor;
                border-top: 0;
                border-left: 0;
                border-right: 0;
                opacity: .25;
                border-bottom: 1px solid #cccc;
            }
            .h1, h1 {
                font-size: calc(1.375rem + 1.5vw);
            }
            .h2, h2 {
                font-size: calc(1.325rem + .9vw);
            }
            .h3, h3 {
                font-size: calc(1.3rem + .6vw);
            }
            .h4, h4 {
                font-size: calc(1.275rem + .3vw);
            }
            .h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6 {
                margin-top: 0;
                margin-bottom: 0.5rem;
                font-weight: 600;
                line-height: 1.2;
            }
            .h5, h5 {
                font-size: 1.1rem;
            }
            .h6, h6 {
                font-size: 0.8rem;
            }
            p {
                font-size: 0.9rem;
                margin-top: 0;
                margin-bottom: 0rem;
            }
            .text-nowrap{
                white-space: nowrap !important;
            }
            .text-start{
                text-align: left !important;
            }
            .tabla{
                margin: 0 auto;
                text-align: left;
                border: 2px solid #23b4b7;
                border-radius: 6px;
                padding: 10px;
                word-break: break-word;
            }
            .tabla td{
                vertical-align: middle;
            }
            .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
                padding: 5px 10px;
                line-height: 1.42857143;
                vertical-align: top;
                border: 1px solid #ddd;
                font-size: 10pt;
            }
            .table > thead > tr > th{
                border: 0px solid #ddd;
            }
            .table-striped>tbody>tr:nth-of-type(odd) {
                background: #f2f2f2;
            }
            .fs-3 {
                font-size: 1.75rem!important;
            }
            .fs-4 {
                font-size: 1.5rem!important;
            }
            .fs-5 {
                font-size: 1.25rem!important;
            }
            .fs-6 {
                font-size: 1rem!important;
            }
            .fs-7 {
                font-size: 0.9rem!important;
            }
            .fs-8 {
                font-size: 0.7rem!important;
            }
            .bg-dark {
                background-color: #212529!important;
            }
            .bg-white{
                background-color: white !important;
            }
            .bg-info{
                background-color: #e5f5ff !important;
            }
            .bg-informacion{
                border: 2px solid #23b4b7;
                display: inline-block;
                border-radius: 8px;
                display: flex;
                width: 30%;
                margin: 0 auto;
                overflow-wrap: break-word;
            }
            .bg-informacion figure{
                width: 20%;
                margin: 5% 0;
                padding: 4px;
            }
            .bg-informacion figure img{
                height: 24px;
            }
            .bg-informacion span{
                width: 80%;
                padding: 6px;
            }
            .bg-informacion span i{
                display: block;
                margin-bottom: 4px;
            }
            .bg-informacion span b{
                font-size: 18px;
                line-height: 1.2;
                word-break: break-word;
            }
            .text-verde{
                color: #019fa1 !important;
            }
            .btn {
                display: inline-block;
                font-weight: 400;
                line-height: 1.5;
                color: #212529;
                text-align: center;
                text-decoration: none;
                vertical-align: middle;
                cursor: pointer;
                -webkit-user-select: none;
                -moz-user-select: none;
                user-select: none;
                background-color: transparent;
                border: 1px solid transparent;
                padding: 0.375rem 0.75rem;
                font-size: 15px;
                border-radius: 0.25rem;
                transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
            }
            .btn-outline-dark {
                color: #212529 !important;
                border-color: #212529;
            }
            .btn-outline-dark:hover {
                color: #fff !important;
                background-color: #212529;
                border-color: #212529;
            }
            .btn-dark {
                color: #fff !important;
                background-color: #212529;
                border-color: #212529;
            }
            .card-compra {
                /*background: #f8fbfd;*/
                background-color: white;
                text-align: center;
                height: 100%;
            }
            .card-compra i {
                font-size: 45px;
            }
            .container {
                /*width: 80%;*/
                /*margin: 0 auto;*/
            }
            .container-fluid {
                width: 100%;
                padding-left: 15px;
                padding-right: 15px;
                margin-right: auto;
                margin-left: auto;
            }
            .container:before, .container:after, .container-fluid:before, .container-fluid:after, .row:before, .row:after{
                display: table;
                content: " ";
                clear: both;
            }
            .row {
                /*--bs-gutter-x: 1.5rem;
                --bs-gutter-y: 0;
                display: flex;
                flex-wrap: wrap;*/
                margin-right: -15px;
                margin-left: -15px;
                overflow: hidden;
            }
            .row>* {
                /*flex-shrink: 0;
                width: 100%;
                max-width: 100%;*/
                padding-right: 15px;
                padding-left: 15px;
                position: relative;
                float: left;
            }
            .justify-content-center {
                justify-content: center!important;
            }
            div {
                display: block;
            }
            .col-lg-12 {
                flex: 0 0 auto;
                width: 100%;
            }
            .col-12 {
                flex: 0 0 auto;
                width: 100%;
            }
            .col-2 {
                flex: 0 0 auto;
                width: 16.66666667%;
            }
            .col-4 {
                flex: 0 0 auto;
                width: 33.33333333%;
            }
            .col-6 {
                flex: 0 0 auto;
                width: 50%;
            }
            .text-start {
                text-align: left!important;
            }
            .text-center {
                text-align: center!important;
            }
            .text-end {
                text-align: right!important;
            }
            .text-secondary {
                color: #6c757d!important;
            }
            .text-white {
                color: #fff!important;
            }
            .fw-bold {
                font-weight: 700!important;
            }
            .rounded-2 {
                border-radius: 0.25rem!important;
            }
            .border {
                border: 1px solid #dee2e6!important;
            }
            .img-fluid {
                max-width: 100%;
                height: auto;
            }
            img, svg {
                vertical-align: middle;
            }
            .pt-1 {
                padding-top: 0.25rem!important;
            }
            .p-2 {
                padding: 0.5rem!important;
            }
            .p-3 {
                padding: 1rem!important;
            }
            .p-4 {
                padding: 1.5rem!important;
            }
            .pb-1 {
                padding-bottom: 0.25rem!important;
            }
            .pt-1 {
                padding-top: 0.25rem!important;
            }
            .pb-3 {
                padding-bottom: 1rem!important;
            }
            .pt-3 {
                padding-top: 1rem!important;
            }
            .pb-4 {
                padding-bottom: 1.5rem!important;
            }
            .pt-4 {
                padding-top: 1.5rem!important;
            }
            .pb-5 {
                padding-bottom: 3rem!important;
            }
            .pt-5 {
                padding-top: 3rem!important;
            }
            .ps-0 {
                padding-left: 0!important;
            }
            .pe-0 {
                padding-right: 0!important;
            }
            .ps-3 {
                padding-left: 1rem!important;
            }
            .pe-3 {
                padding-right: 1rem!important;
            }
            .px-0 {
                padding-right: 0!important;
                padding-left: 0!important;
            }
            .py-0 {
                padding-top: 0!important;
                padding-bottom: 0!important;
            }
            .px-3 {
                padding-right: 1rem!important;
                padding-left: 1rem!important;
            }
            .px-4 {
                padding-right: 1.5rem!important;
                padding-left: 1.5rem!important;
            }
            .m-0 {
                margin: 0!important;
            }
            .mt-0 {
                margin-top: 0!important;
            }
            .mb-0 {
                margin-bottom: 0!important;
            }
            .mt-1 {
                margin-top: 0.25rem!important;
            }
            .mb-1 {
                margin-bottom: 0.25rem!important;
            }
            .mb-2 {
                margin-bottom: 0.5rem!important;
            }
            .mt-2 {
                margin-top: 0.5rem!important;
            }
            .mb-3 {
                margin-bottom: 1rem!important;
            }
            .mt-3 {
                margin-top: 1rem!important;
            }
            .mb-4 {
                margin-bottom: 1.5rem!important;
            }
            .mt-4 {
                margin-top: 1.5rem!important;
            }
            .mb-5 {
                margin-bottom: 3rem!important;
            }
            .mt-5 {
                margin-top: 3rem!important;
            }
            .centrado{
                margin: 0 auto;
                float: none !important;
            }
            .container{
                padding-left: 3rem;
                padding-right: 3rem;
            }

            /*media querys*/
            @media(max-width: 992px){
                .bg-informacion{
                    width: 70%;
                }
            }
            @media(max-width: 768px){
                .container{
                    width: 100%;
                }
                .bg-informacion span{
                    padding: 10px 12px;
                }
            }
            @media (max-width: 480px) {
                .container{
                    padding-left: 50px;
                    padding-right: 50px;
                }
                body{
                    margin-left: 0px;
                    margin-right: 0px;
                    font-size: 16pt;
                }
            }

            @media (min-width: 768px){
                .col-md-10 {
                    flex: 0 0 auto;
                    width: 83.33333333%;
                }
                .col-md-8 {
                    flex: 0 0 auto;
                    width: 66.66666667%;
                }
                .col-md-5 {
                    flex: 0 0 auto;
                    width: 41.66666667%;
                }
                .col-md-4 {
                    flex: 0 0 auto;
                    width: 33.33333333%;
                }
                .p-md-5 {
                    padding: 3rem!important;
                }
                .pb-md-2 {
                    padding-bottom: 0.5rem!important;
                }
                .pt-md-2 {
                    padding-top: 0.5rem!important;
                }
                .mt-md-4 {
                    margin-top: 1.5rem!important;
                }
                .ps-md-4 {
                    padding-left: 1.5rem!important;
                }
                .pe-md-4 {
                    padding-right: 1.5rem!important;
                }
            }
            @media (min-width: 992px){
                .col-lg-10 {
                    flex: 0 0 auto;
                    width: 83.33333333%;
                }
                .col-lg-8 {
                    flex: 0 0 auto;
                    width: 66.66666667%;
                }
                .col-lg-6 {
                    flex: 0 0 auto;
                    width: 50%;
                }
                .col-lg-5 {
                    flex: 0 0 auto;
                    width: 41.66666667%;
                }
                .col-lg-4 {
                    flex: 0 0 auto;
                    width: 33.33333333%;
                }

                .pb-lg-2 {
                    padding-bottom: 0.5rem!important;
                }
                .pt-lg-2 {
                    padding-top: 0.5rem!important;
                }
                .mt-lg-0 {
                    margin-top: 0!important;
                }
                .mb-lg-0 {
                    margin-bottom: 0!important;
                }
                /**/
                .body{
                    background: #f8fbfd;
                    width: 85%;
                    margin: 0 auto;
                    padding: 20px;
                }
            }
            @media (min-width: 1200px){
                .h1, h1 {
                    font-size: 2.5rem;
                }
                .h2, h2 {
                    font-size: 2rem;
                }
                .h3, h3 {
                    font-size: 1.75rem;
                }
                .h4, h4 {
                    font-size: 1.5rem;
                }

            }
        </style>

    </head>
    <body>

        <div class="container-fluid px-0">
            <div class="col-lg-12 col-md-12 col-12 pt-4 pb-4 px-4" style="background: #019fa1;">
                <div class="row">
                    <div class="col-lg-12 text-white text-center">
                        <h1 class="fw-bold text-white fs-1">¡GRACIAS POR TU COMPRA!</h1>
                    </div>
                </div>
            </div>
        </div>
        <div class="container text-center pt-3 pb-3">
            <img src="{{ asset($empresaGeneral->logo ? 'panel/img/empresa/'.$empresaGeneral->logo : 'panel/default/logo.png') }}" alt="logo" style="height: 50px;">
        </div>

        <div class="container ms-3 me-3">
            <div class="row">
                <div class="col-md-12 col-12">
                    <h5 class="fw-bold mb-1 mt-1 text-dark">DATOS GENERALES DE LA VENTA:</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Estado de la venta:</span>
                        <span id="txtEstado">{{ $venta->estadoControlVenta->nombre }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Código:</span>
                        <span id="txtIdVenta">{{ str_pad($venta->idventa,7,0,STR_PAD_LEFT) }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Fecha y hora de registro:</span>
                        <span id="txtFechaHora">{{ now()->parse($venta->fecha_venta)->format("d/m/Y H:i:s A") }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Método de pago:</span>
                        <span id="txtMetodoPago">{{ $venta->metodoPago->descripcion }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Estado de envío:</span>
                        <span id="txtEstadoEnvio">{{ $venta->estadoEnvio->nombre }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p><span class="fw-bold text-verde">Estado de pago:</span> <span id="txtEstadoPago">{{ $venta->estadoPago->nombre }}</span></p>
                </div>





                <div class="col-md-12 col-12">
                    <hr>
                    <h5 class="fw-bold mb-1 mt-1 text-dark">DATOS DE CLIENTE:</h5>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Apellidos y nombres:</span>
                        <span id="txtApellidos">{{ $venta->apellidos }}</span>
                        <span id="txtNombres">{{ $venta->nombres }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Documento:</span>
                        <span id="txtTipoDocumento">{{ $venta->tipoDocumentoIdentidad->nombre }}</span> - <span id="txtNumDocumento">{{ $venta->numero_documento_identidad }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Correo electrónico:</span>
                        <span id="txtCorreo">{{ $venta->correo }}</span>
                    </p>
                </div>
                <div class="col-lg-6 col-md-6 col-6">
                    <p>
                        <span class="fw-bold text-verde">Teléfono:</span>
                        <span id="txtTelefono">{{ $venta->telefono }}</span>
                    </p>
                </div>





                <div class="col-md-12 col-12">
                    <hr>
                    <h5 class="fw-bold mb-1 mt-1 text-dark">DATOS DE DESPACHO:</h5>
                </div>
                <div class="col-md-12 col-12">
                    <p>
                        <span class="fw-bold mb-1 mt-1 text-verde">Modalidad de despacho:</span>
                        <span id="txtModalidadDespacho">{{ $venta->metodoEntrega->nombre }}</span>
                    </p>
                </div>
                @if( $venta->idmetodo_entrega == 1 )
                    <div class="col-md-6 col-6">
                        <p>
                            <span class="fw-bold mb-1 mt-1 text-verde">Departamento / Provincia / Distrito:</span>
                            <span id="txtDepartamento">{{ $venta->departamento->nombre }}</span> / <span id="txtProvincia">{{ $venta->provincia->nombre }}</span> / <span id="txtDistrito">{{ $venta->distrito->nombre }}</span>
                        </p>
                    </div>
                    <!-- <div class="col-md-6 col-6">
                        <p><span class="fw-bold text-verde">Provincia:</span> <span id="txtProvincia">Lima</span></p>
                    </div>
                    <div class="col-md-6 col-6">
                        <p><span class="fw-bold text-verde">Distrito:</span> <span id="txtDistrito">Rímac</span></p>
                    </div> -->
                    <div class="col-md-6 col-6">
                        <p>
                            <span class="fw-bold text-verde">Dirección:</span>
                            <span id="txtDireccion">{{ $venta->direccion }}</span>
                        </p>
                    </div>
                    <div class="col-md-6 col-6">
                        <p>
                            <span class="fw-bold text-verde">Referencía:</span>
                            <span id="txtReferencia">{{ $venta->referencia }}</span>
                        </p>
                    </div>
                @endif



                <div class="col-md-12 col-12">
                    <hr>
                    <h5 class="fw-bold mb-1 mt-1 text-dark">RECOGERÁ EL PEDIDO:</h5>
                </div>
                <div class="col-md-12 col-12">
                    <p>
                        <span class="fw-bold mb-1 mt-1 text-verde">Nombres y apellidos:</span>
                        <span id="txtNomApeDest">{{ $venta->otro_receptor ?: $venta->nombres." ".$venta->apellidos }}</span>
                    </p>
                </div>





                <div class="col-md-12 col-12">
                    <hr>
                    <h5 class="fw-bold mb-1 mt-1 text-dark">DATOS PARA LA FACTURACIÓN:</h5>
                </div>
                <div class="col-md-12 col-12">
                    <p>
                        <span class="fw-bold text-verde">Tipo de comprobante:</span>
                        <span id="txtTipoComprobante">{{ $venta->facturacion->nombre }}</span>
                    </p>
                </div>
                @if($venta->facturacion_idcomprobante == 2)
                    <div class="col-md-6 col-6 tipoComprobante">
                        <p>
                            <span class="fw-bold text-verde">Razon social:</span>
                            <span id="txtRazonSocial">{{ $venta->facturacion_razon_social }}</span>
                        </p>
                    </div>
                    <div class="col-md-6 col-6 tipoComprobante">
                        <p>
                            <span class="fw-bold text-verde">Ruc:</span>
                            <span id="txtRuc">{{ $venta->facturacion_ruc }}</span>
                        </p>
                        <!-- <hr> -->
                    </div>
                @endif

                <div class="col-md-12 col-12 mt-3 mb-0">
                    <table class="table" border="0" cellpadding="0" cellspacing="0" style="width: 100%;">
                        <thead class="head-tabla">
                            <tr>
                                <th>PRODUCTOS ( {{ count($ventaDetalle) }} )</th>
                                <th>PRECIO</th>
                                <th class="text-center">CANTIDAD</th>
                                <th class="text-end">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($ventaDetalle as $vd)
                                <tr>
                                    <td class="cart-nombre">
                                        <h5 class="mb-0" style="font-size: 10pt;font-weight: 100;">
                                            <span>{{ $vd->producto->nombre }}</span>
                                            <i class="text-secondary mt-1 mb-2" style="display:block;font-size: 8pt;">Código: {{ $vd->producto->codigo }}</i>
                                        </h5>
                                    </td>
                                    <td class="cart-precio">
                                        <span style="white-space: nowrap;">{{ $venta->moneda->format($vd->precio_producto * $venta->precio_cambio,2,".","") }}</span>
                                    </td>
                                    <td class="cart-cantidad text-center">
                                        <span style="white-space: nowrap;">{{ $vd->cantidad }}</span>
                                    </td>
                                    <td class="space-nowrap text-end cart-total ws-nowrap">
                                        <span style="white-space: nowrap;">{{ $venta->moneda->format($vd->subtotal * $venta->precio_cambio,2,".","") }}</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="fw-bold text-uppercase">Descuento</td>
                                <td class="fw-bold text-end" style="white-space: nowrap;">- {{ $venta->moneda->format($venta->descuento_alt,2,".","") }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold text-uppercase">Costo de envío</td>
                                <td class="fw-bold text-end" style="white-space: nowrap;">+ {{ $venta->moneda->format($venta->precio_envio_alt,2,".","") }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold text-uppercase">Monto del pedido</td>
                                <td class="fw-bold text-end" style="white-space: nowrap;">{{ $venta->moneda->format($venta->total_alt * $empresaGeneral->neto_porcentaje,2,".","") }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold text-uppercase">IGV ({{ number_format($empresaGeneral->igv,0,".","") }}%)</td>
                                <td class="fw-bold text-end" style="white-space: nowrap;">{{ $venta->moneda->format($venta->total_alt * $empresaGeneral->igv_porcentaje,2,".","") }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="fw-bold text-uppercase">Total</td>
                                <td class="fw-bold text-end" style="white-space: nowrap;">{{ $venta->moneda->format($venta->total_final_alt,2,".","") }}</td>
                            </tr>
                        </tfoot>
                    </table>

                </div>
            </div>
            <br>

    </body>
</html>
