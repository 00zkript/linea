@extends('panel.template.index')
@push('css')
    <style>
        .steps-container {
            display: flex;
            flex-direction: column;
            margin-left: 60px;
        }

        .step {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .step-title{
            display: flex;
            align-items: center
        }
        .step-title h3{
            margin-left: 1rem;
        }

        .step-title .step-number {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
            font-size: 16px;
            background-color: #ddd;
            color: #000;
        }
        .step .step-title .step-number span{
            display: block;
        }
        .step .step-title .step-number i{
            display: none;
        }

        .step-title .step-status {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: none;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            font-weight: bold;
            font-size: 16px;
            background-color: #ddd;
            color: #000;
        }


        .step-content {
            display: none;
            margin-left: 3rem;
        }

        .step.active .step-number {
            background-color: #007bff;
            color: #fff;
        }

        .step.active .step-content {
            display: block;
        }

        .step.completed .step-number {
            background-color: #28a745;
            color: #fff;
        }
        .step.completed .step-title .step-number span{
            display: none;
        }
        .step.completed .step-title .step-number i{
            display: block;
        }





        button {
            margin-top: 10px;
        }
    </style>
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
                        <div class="steps-container">

                            <div class="step active" id="step1">
                                <div class="step-title">
                                    <div class="step-number"><span>1</span><i class="fas fa-check"></i></div>
                                    <h3>Nuevo usuario</h3>
                                </div>
                                <div class="step-content">
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora, architecto eligendi! Deleniti dignissimos et praesentium eius quam architecto porro non libero, perspiciatis sint laboriosam reiciendis! Quos repellendus impedit libero nemo doloremque a laboriosam maiores quia dolorum! Laboriosam, aut? Reiciendis sint fugiat assumenda consectetur quidem ratione sunt id illo architecto aliquid iusto quasi explicabo, impedit quod, quam, officiis dolorem atque repudiandae eveniet ipsum sed. Nesciunt ducimus corporis quidem cum id asperiores rem in repudiandae tempora blanditiis, velit consequatur nostrum, dicta illum corrupti esse veritatis molestiae. Fuga sed pariatur nemo praesentium error nihil, suscipit rerum quod amet, iste earum a atque odit, repudiandae cumque saepe mollitia vel? Fuga, possimus! Labore, illo dolorem. Consectetur nesciunt dolor, itaque nostrum, hic molestias veniam ex, architecto sapiente nulla deleniti repudiandae facere esse quidem incidunt velit commodi obcaecati magni dignissimos laboriosam repellat repellendus debitis alias. Cum error alias dolor amet non totam blanditiis porro architecto in sit! Delectus possimus illo quibusdam accusantium dolore ipsum expedita incidunt quisquam! Necessitatibus delectus excepturi hic! Adipisci et est vel non corrupti praesentium facere nam totam voluptatem ducimus. In aliquid quod fugit assumenda exercitationem aut esse consequatur minima eos. Inventore cumque quidem molestiae necessitatibus eos temporibus cupiditate, vel doloremque perferendis sit voluptatum!
                                    </p>
                                    <button class="btn btn-primary next-step">Siguiente</button>
                                    <button class="btn btn-secondary cancel-step">Cancelar</button>
                                </div>

                            </div>

                            <div class="step" id="step2">
                                <div class="step-title">
                                    <div class="step-number"><span>2</span><i class="fas fa-check"></i></div>
                                    <h3>Paso 2</h3>
                                </div>
                                <div class="step-content">
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora, architecto eligendi! Deleniti dignissimos et praesentium eius quam architecto porro non libero, perspiciatis sint laboriosam reiciendis! Quos repellendus impedit libero nemo doloremque a laboriosam maiores quia dolorum! Laboriosam, aut? Reiciendis sint fugiat assumenda consectetur quidem ratione sunt id illo architecto aliquid iusto quasi explicabo, impedit quod, quam, officiis dolorem atque repudiandae eveniet ipsum sed. Nesciunt ducimus corporis quidem cum id asperiores rem in repudiandae tempora blanditiis, velit consequatur nostrum, dicta illum corrupti esse veritatis molestiae. Fuga sed pariatur nemo praesentium error nihil, suscipit rerum quod amet, iste earum a atque odit, repudiandae cumque saepe mollitia vel? Fuga, possimus! Labore, illo dolorem. Consectetur nesciunt dolor, itaque nostrum, hic molestias veniam ex, architecto sapiente nulla deleniti repudiandae facere esse quidem incidunt velit commodi obcaecati magni dignissimos laboriosam repellat repellendus debitis alias. Cum error alias dolor amet non totam blanditiis porro architecto in sit! Delectus possimus illo quibusdam accusantium dolore ipsum expedita incidunt quisquam! Necessitatibus delectus excepturi hic! Adipisci et est vel non corrupti praesentium facere nam totam voluptatem ducimus. In aliquid quod fugit assumenda exercitationem aut esse consequatur minima eos. Inventore cumque quidem molestiae necessitatibus eos temporibus cupiditate, vel doloremque perferendis sit voluptatum!
                                    </p>
                                    <button class="btn btn-primary next-step">Siguiente</button>
                                    <button class="btn btn-secondary cancel-step">Cancelar</button>
                                </div>

                            </div>

                            <div class="step" id="step3">
                                <div class="step-title">
                                    <div class="step-number"><span>3</span><i class="fas fa-check"></i></div>
                                    <h3>Paso 3</h3>
                                </div>
                                <div class="step-content">
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Tempora, architecto eligendi! Deleniti dignissimos et praesentium eius quam architecto porro non libero, perspiciatis sint laboriosam reiciendis! Quos repellendus impedit libero nemo doloremque a laboriosam maiores quia dolorum! Laboriosam, aut? Reiciendis sint fugiat assumenda consectetur quidem ratione sunt id illo architecto aliquid iusto quasi explicabo, impedit quod, quam, officiis dolorem atque repudiandae eveniet ipsum sed. Nesciunt ducimus corporis quidem cum id asperiores rem in repudiandae tempora blanditiis, velit consequatur nostrum, dicta illum corrupti esse veritatis molestiae. Fuga sed pariatur nemo praesentium error nihil, suscipit rerum quod amet, iste earum a atque odit, repudiandae cumque saepe mollitia vel? Fuga, possimus! Labore, illo dolorem. Consectetur nesciunt dolor, itaque nostrum, hic molestias veniam ex, architecto sapiente nulla deleniti repudiandae facere esse quidem incidunt velit commodi obcaecati magni dignissimos laboriosam repellat repellendus debitis alias. Cum error alias dolor amet non totam blanditiis porro architecto in sit! Delectus possimus illo quibusdam accusantium dolore ipsum expedita incidunt quisquam! Necessitatibus delectus excepturi hic! Adipisci et est vel non corrupti praesentium facere nam totam voluptatem ducimus. In aliquid quod fugit assumenda exercitationem aut esse consequatur minima eos. Inventore cumque quidem molestiae necessitatibus eos temporibus cupiditate, vel doloremque perferendis sit voluptatum!
                                    </p>
                                    <button class="btn btn-primary next-step">Siguiente</button>
                                    <button class="btn btn-secondary cancel-step">Cancelar</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')
    <script>
        $(document).ready(function() {

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

            $('.cancel-step').click(function() {

            });
        });


    </script>
@endpush
