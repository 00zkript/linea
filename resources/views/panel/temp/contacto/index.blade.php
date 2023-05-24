@extends('panel.template.index')
@section('cuerpo')

    <div class="container-fluid">
        <form id="frmEditar">
            @csrf
            @method('PUT')
            <input type="hidden" name="idcontacto" id="idcontacto" value="{{ $contacto->idcontacto}}">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header" style="background-color: #2a3f54">
                            <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Contacto con la empresa</p>
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
                                                <label for="correo" >Correo:</label>
                                                <input type="email" name="correo" id="correo" class="form-control" value="{{ $contacto->correo }}">
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="celular" >Celular:</label>
                                                <textarea name="celular" id="celular" rows="3" class="form-control">{{ $contacto->celular}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="whatsapp" >Mensaje general Whatsapp:</label>
                                                <textarea name="whatsapp" id="whatsapp" rows="3" class="form-control">{{ $contacto->whatsapp}}</textarea>
                                            </div>
                                        </div>

                                         <div class="col-12">
                                            <div class="form-group">
                                                <label for="telefono" >Teléfono:</label>
                                                <textarea name="telefono" id="telefono" rows="3" class="form-control">{{ $contacto->telefono}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="facebook" >Link Facebook:</label>
                                                <textarea name="facebook" id="facebook" rows="3" class="form-control">{{ $contacto->facebook}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="instagram" >Link Instagram:</label>
                                                <textarea name="instagram" id="instagram" rows="3" class="form-control">{{ $contacto->instagram}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="twitter" >Link Twitter:</label>
                                                <textarea name="twitter" id="twitter" rows="3" class="form-control">{{ $contacto->twitter}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="youtube" >Link Youtube:</label>
                                                <textarea name="youtube" id="youtube" rows="3" class="form-control">{{ $contacto->youtube}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="linkendin" >Link Linkendin:</label>
                                                <textarea name="linkendin" id="linkendin" rows="3" class="form-control">{{ $contacto->linkendin}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="direccion" >Dirección:</label>
                                                <textarea name="direccion" id="direccion" rows="3" class="form-control">{{ $contacto->direccion}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="google_maps" >Script Google Maps:</label>
                                                <textarea name="google_maps" id="google_maps" rows="6" class="form-control">{{ $contacto->google_maps}}</textarea>
                                            </div>
                                        </div>




                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="horario" >Horario de atencíon:</label>
                                                <textarea id="horario"  class="form-control">{{ $contacto->horario}}</textarea>
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

        const URL_MODIFICAR = "{{ route('contacto.update','update') }}";

        const modificar = () => {
            $(document).on("submit","#frmEditar",function(e){
                e.preventDefault();



                var form = new FormData($(this)[0]);
                form.append('horario',CKEDITOR.instances.horario.getData());

                cargando('Procesando...');
                axios.post(URL_MODIFICAR,form)
                .then(response => {
                    const data = response.data;
                    stop();
                    notificacion("success","Modificación exitosa",data.mensaje);

                })
                .catch(errorCatch)
        })


        }


        $(function () {
            modificar();

             CKEDITOR.replace('horario',{
                 height : 300
             });

        });






    </script>
@endpush
