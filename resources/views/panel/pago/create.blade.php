@extends('panel.template.index')
@section('cuerpo')


    <div id="instanceVue">
        <venta-nuevo />
    </div>

@endsection

@push('js')
    {{-- <script>

        const cambioMoneda = "3.82";
        const montoTotal = "350.00";

        const modals = () => {

            $(document).on( 'click', '.cancelarPagoModalSave', function (e) {
                e.preventDefault();
                $('#frmSavePago')[0].reset();
                $('#cancelarPagoModalCenter').modal('hide');
            });

            $(document).on( 'click', '.asegurarPagoModalCenterSave', function (e) {
                e.preventDefault();
                $('#frmSavePago')[0].reset();
                $('#asegurarPagoModalCenter').modal('hide');

                notificacion('success','!Felicidades!','¡El pago se registró con éxito!');

                setTimeout(() => {
                    window.location.href = "{{ route('pago.index') }}";
                }, 1000 * 2);

            });


        }

        const actions = () => {
            $(document).on( 'change', '#moneda', function (e) {
                e.preventDefault();
                const val = $(this).val();

                const selectorMoneda = {
                    1  'monedaSoles',
                    2  'monedaDolares',
                }

                $('.montosToggle').hide();
                $('.'+selectorMoneda[val]).show();


            });

            $(document).on( 'input', '#montoEfectivoDolares, #montoTranferidoDolares', function (e) {
                e.preventDefault();
                const montoEfectivoDolares = Number($('#montoEfectivoDolares').val() ?? 0);
                const montoTranferidoDolares = Number($('#montoTranferidoDolares').val() ?? 0);

                const montoPagar = ( montoEfectivoDolares + montoTranferidoDolares) * cambioMoneda;
                const deuda = montoTotal - montoPagar;

                $('#montoPagar').val(number_format(montoPagar * 0.82,2));
                $('#igv').val(number_format(montoPagar * 0.18,2));
                $('#deuda').val(number_format(deuda,2));

            });

            $(document).on( 'input', '#montoEfectivoSoles, #montoTranferidoSoles', function (e) {
                e.preventDefault();
                const montoEfectivoSoles = Number($('#montoEfectivoSoles').val());
                const montoTranferidoSoles = Number($('#montoTranferidoSoles').val());

                const montoPagar = ( montoEfectivoSoles + montoTranferidoSoles);
                const deuda = montoTotal - montoPagar;

                $('#montoPagar').val(number_format(montoPagar * 0.82,2));
                $('#igv').val(number_format(montoPagar * 0.18,2));
                $('#deuda').val(number_format(deuda,2));

            });


        }

        const init = () => {
            $('#montoTotal').val(montoTotal);
            $('#montoPagar').val('0.00');
            $('#igv').val('0.00');
            $('#deuda').val('0.00');

            $('#moneda').val(1);
            $('#moneda').trigger('change');
        }

        (function () {
            modals();
            actions();
            init();

        })()




    </script> --}}
@endpush

