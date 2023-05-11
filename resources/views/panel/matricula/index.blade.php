@extends('panel.template.index')
@push('css')
@endpush
@section('cuerpo')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Matricula</p>
                    </div>
                    <div class="card-body">
                        <div id="instanceVue">
                            <Matricula/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        /* $(document).ready(function() {

            $('.step-title').click(function() {
                var currentStep = $(this).closest('.step');
                if (!currentStep.hasClass('active')) {
                    $('.step').removeClass('active');
                    currentStep.addClass('active');
                    $('.step-content').hide();
                    currentStep.find('.step-content').show();
                }
            });

            $('.next-step').click(function() {
                var currentStep = $(this).closest('.step');
                var nextStep = currentStep.next('.step');

                currentStep.removeClass('active').addClass('completed');
                // currentStep.find('.step-status').html('<i class="fas fa-check"></i>');

                nextStep.addClass('active');
                $('.step-content').hide();
                nextStep.find('.step-content').show();
            });

        }); */


    </script>
@endpush
