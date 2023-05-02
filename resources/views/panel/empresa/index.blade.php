@extends('panel.template.index')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="idempresa" id="idempresa" value="{{ $empresa->idempresa}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #2a3f54">
                            <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Información de la empresa</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-refresh"></i> Modificar</button>
                                    <hr>
                                </div>


                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="nombre" >Nombre empresa:</label>
                                                <input placeholder="Nombre empresa" type="text" class="form-control" name="nombre" id="nombre" value="{{ $empresa->nombre}}">
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="ruc" >Ruc:</label>
                                                <input placeholder="RUC" type="text" class="form-control" name="ruc" id="ruc"  value="{{ $empresa->ruc}}">
                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="igv" >IGV (%):</label>
                                                <input placeholder="18" type="text" class="form-control" name="igv" id="igv"  value="{{ $empresa->igv}}">
                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="idmoneda" >Moneda por defecto:</label>
                                                <select class="form-control" name="idmoneda" id="idmoneda">
                                                    @foreach($monedas as $m)
                                                        <option value="{{ $m->idmoneda }}" {{ $empresa->idmoneda == $m->idmoneda ? 'selected' : '' }}>{{ $m->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>



                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="cuentaBancaria">Cuentas Bancarias:</label>
                                               <textarea class="form-control" id="cuentaBancaria" name="cuentaBancaria">{{ $empresa->cuenta_bancaria}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="informacionAdicional">Información adicional:</label>
                                                <textarea class="form-control" id="informacionAdicional" name="informacionAdicional">{{ $empresa->informacion_adicional}}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="favicon" class="d-block">Favicon:</label>
                                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 250px * 250px</div>
                                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: jpg, png, ico</div>
                                                <div class="file-loading">
                                                    <input  id="favicon" name="favicon" type="file" class="file" >
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <div class="form-group">
                                                <label for="logo" class="d-block">Logo:</label>
                                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Medida: 384px * 134px</div>
                                                <div class="bg-mensaje p-2 rounded text-white mb-1 d-inline-block">Formato: jpg, png, jpg</div>
                                                <div class="file-loading">
                                                    <input  id="logo" name="logo" type="file" class="file" >
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                    <hr>
                                </div>




                            </div>



                            <hr>
                        </div>


                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection
@push('js')

    <script !src="">

        const URL_MODIFICAR   = "{{ route('empresa.update','update') }}";

        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);
                form.append('cuentaBancaria',CKEDITOR.instances.cuentaBancaria.getData());
                form.append('informacionAdicional',CKEDITOR.instances.informacionAdicional.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR,form)
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#modalEditar").modal("hide");
                    notificacion("success","Modificación exitosa",data.mensaje);
                    // listado($("#cantidadRegistros").val(),$("#paginaActual").val());

                })
                .catch(errorCatch)


            });
        }


        $("#favicon").fileinput({
            theme: 'fa',
            language: 'es',
            //uploadUrl: "#",
            uploadAsync:false,
            uploadExtraData:false,
            overwriteInitial: true,
            dropZoneTitle:'Arrastre la imagen aquí',
            // dropZoneEnabled: false,
            //maxImageWidth: 1200,
            //maxImageHeight: 630,
            showUpload:false,
            showDrag :false,
            // required:true,
            initialPreview: [
                '{{ !empty($empresa->favicon) ? asset('panel/img/empresa/'.$empresa->favicon) : asset('panel/vacio_img.jpg') }}',
            ],
            validateInitialCount: true,
            initialPreviewAsData: true,
            //initialPreviewShowDelete:true,
            previewFileType: "image",
            showRemove: false,
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg','ico'],
            removeFromPreviewOnError:true,
            // maxFileSize: 10000,
            maxFileCount: 1,
            autoReplace: true,
            //minFileCount: 1,
            fileActionSettings: {
                showRemove: false,
                showUpload: false,
                showZoom: false,
                showDrag: false,
            },
        });

        $("#logo").fileinput({
            theme: 'fa',
            language: 'es',
            //uploadUrl: "#",
            uploadAsync:false,
            uploadExtraData:false,
            overwriteInitial: true,
            dropZoneTitle:'Arrastre la imagen aquí',
            // dropZoneEnabled: false,
            //maxImageWidth: 1200,
            //maxImageHeight: 630,
            showUpload:false,
            showDrag :false,
            // required:true,
            initialPreview: [
                '{{ !empty($empresa->logo) ? asset('panel/img/empresa/'.$empresa->logo) : asset('panel/vacio_img.jpg') }}',
            ],
            validateInitialCount: true,
            initialPreviewAsData: true,
            //initialPreviewShowDelete:true,
            previewFileType: "image",
            showRemove: false,
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg','ico'],
            removeFromPreviewOnError:true,
            // maxFileSize: 10000,
            maxFileCount: 1,
            autoReplace: true,
            //minFileCount: 1,
            fileActionSettings: {
                showRemove: false,
                showUpload: false,
                showZoom: false,
                showDrag: false,
            },
        });


        $(function () {
            modificar();

            CKEDITOR.replace('cuentaBancaria',{height : 300});

            CKEDITOR.replace('informacionAdicional',{height : 300});

        });











    </script>
@endpush
