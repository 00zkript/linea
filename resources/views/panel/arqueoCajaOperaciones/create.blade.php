@extends('panel.template.index')

@section('cuerpo')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <form onsubmit="return false;" id="frmOperaciones">
                    <div class="row">
                        <div class="col-12 form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" name="fecha" id="fecha" value="{{ now()->format('Y-m-d') }}" placeholder="Fecha" readonly >
                        </div>

                        <div class="col-12 form-group">
                            <label for="tipoOperacion">Tipo de operación:</label>
                            <select class="form-control" name="tipoOperacion" id="tipoOperacion" title="Tipo de operación" required >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($tiposDeOperaciones as $item)
                                    <option value="{{ $item->idtipo_operacion }}">{{ $item->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 form-group">
                            <label for="idsupervisor">Revisado por:</label>
                            <select class="form-control" name="idsupervisor" id="idsupervisor" title="Revisado por" required >
                                <option value="" hidden selected >[---Seleccione---]</option>
                                @foreach ($usuarios as $item)
                                    <option value="{{ $item->idusuario }}">{{ $item->nombres }} {{ $item->apellidos }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 pl-0 pr-0">
                            {{-- <div class="col-12 text-center pt-3">
                                <h4>Soles</h4>
                            </div> --}}
                            <div class="col-12 form-group">
                                <label for="montoSolEfectivo">Monto efectivo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">S/. </span></div>
                                    <input type="text" class="form-control format-number-price" name="montoSolEfectivo" id="montoSolEfectivo" placeholder="Monto efectivo"  value="0.00">
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="montoSolTransferido">Monto transferido</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">S/. </span></div>
                                    <input type="text" class="form-control format-number-price" name="montoSolTransferido" id="montoSolTransferido" placeholder="Monto transferido" value="0.00">
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-12 col-md-6 pl-0 pr-0">
                            <div class="col-12 text-center pt-3">
                                <h4>Dolares</h4>
                            </div>
                            <div class="col-12 form-group">
                                <label for="montoDolarEfectivo">Monto efectivo</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$ </span></div>
                                    <input type="text" class="form-control format-number-price" name="montoDolarEfectivo" id="montoDolarEfectivo" placeholder="Monto efectivo" >
                                </div>
                            </div>
                            <div class="col-12 form-group">
                                <label for="montoDolarTransferido">Monto transferido</label>
                                <div class="input-group">
                                    <div class="input-group-prepend"><span class="input-group-text">$ </span></div>
                                    <input type="text" class="form-control format-number-price" name="montoDolarTransferido" id="montoDolarTransferido" placeholder="Monto transferido" >
                                </div>
                            </div>
                        </div> --}}
                    </div>

                    <div class="row ">
                        <div class="col-12">
                            <label for="descripcion">Descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" placeholder="Descripción" rows="3" ></textarea>
                        </div>
                        <div class="col-12 mt-3 text-center">
                            <button type="reset" class="btn btn-secondary"><i class="fa fa-refresh"></i> Limpiar</button>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Guardar</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection


@push('js')
    <script>
        const validateForm = () => {
            const errors = [];

            const tipoOperacion = $('#tipoOperacion').val();
            const fields = [
                { value: $('#montoSolEfectivo').val(), name: 'Monto en soles efectivo' },
                { value: $('#montoSolTransferido').val(), name: 'Monto en soles transferido' },
                { value: $('#montoDolarEfectivo').val(), name: 'Monto en dólares efectivo' },
                { value: $('#montoDolarTransferido').val(), name: 'Monto en dólares transferido' }
            ];

            if (!tipoOperacion) {
                errors.push("Por favor, selecciona un tipo de operación.");
            }

            if ( fields.every(field => !field.value || parseFloat(field.value) === 0 ) ) {
                errors.push("Debes agregar al menos un monto válido.");
            }

            return errors;
        }



        const storeForm = () => {
            $(document).on( 'submit', '#frmOperaciones', function (e) {
                e.preventDefault();

                const errors  = validateForm();

                if ( errors.length > 0 ) {
                    notificacion('error','Errores encontrado', listErrorsForm(errors));
                    return;
                }

                const form = new FormData(this);

                axios.post("{{ route('arqueoCajaOperacion.store') }}", form)
                .then( response => {
                    const data = response.data;
                    notificacion('success','Felicidades!','La operación se guardó con éxito');
                    location.reload()
                })
                .catch( errorCatch );



            });
        }


        (() => {
            storeForm();
        })()



    </script>
@endpush
