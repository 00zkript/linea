@extends('panel.template.index')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="idseo" id="idseo" value="{{ $seo->idseo}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #2a3f54">
                            <p style="font-size: 20px" class="card-title text-center text-white mb-0"> SEO de empresa</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-refresh"></i> Modificar</button>
                                    <hr>
                                </div>


                                <div class="col-12">

                                    <div class="row">

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="titulo_general" >Título General:</label>
                                                <input type="text" name="titulo_general" class="form-control" value="{{ $seo->titulo_general }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="autor" >Autor:</label>
                                                <textarea name="autor" id="autor" cols="30" rows="3" class="form-control">{{ $seo->autor}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="descripcion" >Descripción:</label>
                                                <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control">{{ $seo->descripcion}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="keywords" >Keywords:</label>
                                                <textarea name="keywords" id="keywords" cols="30" rows="3" class="form-control">{{ $seo->keywords}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="googleAnalytics" >Google Analytics:</label>
                                                <textarea name="googleAnalytics" id="googleAnalytics" cols="30" rows="3" class="form-control">{{ $seo->googleAnalytics}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="googleTagManager" >Google TagManager:</label>
                                                <textarea name="googleTagManager" id="googleTagManager" cols="30" rows="3" class="form-control">{{ $seo->googleTagManager}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="facebookPixel" >Facebook Pixel:</label>
                                                <textarea name="facebookPixel" id="facebookPixel" cols="30" rows="3" class="form-control">{{ $seo->facebookPixel}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="imagenCompartir" >Imagen para compartir en redes:</label>
                                                <div class="alert alert-info">
                                                    <p class="my-0"><i class="fa fa-exclamation-triangle"></i> Se recomienda imágenes de 1200 x 628 pixeles.</p>
                                                </div>
                                                <div class="file-loading">
                                                    <input  id="imagenCompartir" name="imagenCompartir" type="file" class="file" >
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

        const URL_MODIFICAR   = "{{ route('seo.update','update') }}";


        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);

                cargando('Procesando...');
                axios.post(URL_MODIFICAR,form)
                .then(response => {
                    const data = response.data;

                    stop();
                    $("#modalEditar").modal("hide");
                    notificacion("success","Modificación exitosa",data.mensaje);
                })
                .catch(errorCatch)


            });
        }


        $("#imagenCompartir").fileinput({
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
                '{{ !empty($seo->imagen_compartir) ? asset('panel/img/seo/'.$seo->imagen_compartir) : asset('panel/vacio_img.jpg') }}',
            ],
            validateInitialCount: true,
            initialPreviewAsData: true,
            //initialPreviewShowDelete:true,
            previewFileType: "image",
            showRemove: false,
            allowedFileTypes: ['image'],
            allowedFileExtensions: ['jpg', 'png', 'jpeg'],
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
        });



    </script>
@endpush
