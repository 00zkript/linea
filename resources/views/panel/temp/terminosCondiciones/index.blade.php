@extends('panel.template.index')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="idterminos_condiciones" id="idterminos_condiciones" value="{{ $terminosCondiciones->idterminos_condiciones}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #2a3f54">
                            <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Términos y Condiciones</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <button type="submit" class="btn btn-success btn-lg"><i class="fa fa-refresh"></i> Modificar</button>
                                    <hr>
                                </div>


                                <div class="col-12">

                                    <div class="row">



                                        <div class="             <div class="form-group">
                                                <label for="contenido">Contenido:</label>
                                                <textarea class="form-control" id="contenido" name="contenido">{{ $terminosCondiciones->contenido}}</textarea>
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

        const URL_MODIFICAR   = "{{ route('terminos-condiciones.update','update') }}";


        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();

                var form = new FormData($(this)[0]);
                form.append('contenido',CKEDITOR.instances.contenido.getData());

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


        $(function () {
            modificar();

            CKEDITOR.replace('contenido',{
                height : 300
            });

        });








    </script>
@endpush
