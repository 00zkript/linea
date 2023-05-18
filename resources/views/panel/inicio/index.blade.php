@extends('panel.template.index')
@push('css')

@endpush


@section('cuerpo')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header" style="background-color: #2a3f54">
                        <p style="font-size: 20px" class="card-title text-center text-white mb-0"> Inicio</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <h3 class="text-center">Alumnos matriculados 2023</h3>
                                <div class="chart-container position-relative" style="width: 100%;">
                                    <canvas id="alumnosMatricualdosChar" ></canvas>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <h3 class="text-center">Ganancias 2023</h3>
                                <div class="chart-container " style="width: 50%;left: 25%;position: relative;">
                                    <canvas id="gananciasChar" ></canvas>
                                </div>
                            </div>

                            {{-- <div class="col-md-6 mb-5">
                                <h3 class="position-relative">Top 10 productos más vendidos en el mes de <span class="thisMonth"></span></h3>
                                <div class="chart-container position-relative" style="width: 100%;">
                                    <canvas id="productsMostSelled" ></canvas>
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-6 mb-5">
                                <h3 class="position-relative">Ventas del mes de <span class="thisMonth"></span> </h3>
                                <div class="chart-container position-relative" style="width: 100%;">
                                    <canvas id="salesForMonth"></canvas>
                                </div>
                            </div> --}}

                            {{-- <div class="col-md-12 mb-5">
                                <h3 class="position-relative">Ventas del año <span class="thisYear"></span> vs <span class="lastYear"></span></h3>
                                <div class="d-flex">


                                    <p class="d-flex flex-column">
                                        <span class="text-bold text-lg font-weight-bold" id="salesForYear"></span>
                                        <span id="">Ventas a lo largo del tiempo</span>
                                    </p>
                                    <p class="ml-auto d-flex flex-column text-right">
                                        <span class="text-success">
                                            <i class="fas fa-arrow-up" id="rateIncremnt"></i>
                                        </span>
                                        <span class="text-muted">Desde el mes pasado</span>
                                    </p>
                                </div>


                                <div class="chart-container position-relative" style="width: 100%;">
                                    <canvas id="comparativeSalesTheYearCurrentToYearOld"></canvas>
                                </div>

                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('js')

    <script src="{{ asset('panel/js/chart.js') }}"></script>

    <script type="module">

        {{-- // const URL_PRODUCTSMOSTSELLED = "{{ route('inicio.getproductMostSelled') }}"; --}}
        {{-- // const URL_SALESOVERTIME = "{{ route('inicio.getSalesForYearVsYearOld') }}"; --}}
        {{-- // const URL_SALESFORMONTH = "{{ route('inicio.salesForMonth') }}"; --}}

        const moneyFormat = "{{ $monedaGeneral->format('0.00') }}";
        const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
        const monthsAbr = ['ENE', 'FEB', 'MAR', 'ABR', 'MAY', 'JUN', 'JUL', 'AGO', 'SET', 'OCT', 'NOV', 'DIC']
        const date     = new Date();
        const thisYear = date.getFullYear();
        const lastYear = thisYear - 1;

        const ticksStyle = { fontColor: "#495057", fontStyle: "bold" };
        const mode       = "index";
        const intersect  = true;

        const getMonthCurrent = () => months[date.getMonth()];

        const styleScaleY = ( value ) => {
            if (1000000 > value && value >= 1000) {
                value /= 1000;
                value += "k";
            }
            if (value >= 1000000) {
                value /= 1000000;
                value += "M";
            }

            return moneyFormat.replace('0.00',value);
        }

        const alumnosMatricualdosChar = () => {
            return new Chart(
                document.querySelectorAll('#alumnosMatricualdosChar'),
                {
                    type: 'bar',
                    data: {
                        labels: months,
                        datasets: [
                            {
                                label: 'cantidad de matrículas',
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                                data: [
                                    '20',
                                    '10',
                                    '40',
                                    '20',
                                    '30',
                                    '30',
                                    '25',
                                    '20',
                                    '30',
                                    '20',
                                    '20',
                                    '20'
                                ],
                            },
                        ]
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    ...ticksStyle,
                                    beginAtZero: true,
                                    callback: styleScaleY,
                                },
                            },
                        },
                    },
                }
            );

        }
        const gananciasChar = () => {
            return new Chart(
                document.querySelectorAll('#gananciasChar'),
                {
                    type: 'doughnut',
                    data: {
                        labels: [
                            'Academia de natación',
                            'GyM',
                            'Tienda'
                        ],
                        datasets: [{
                            data: [
                                "1800",
                                "1500",
                                "500",
                            ],
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(255, 205, 86)',
                                'rgb(75, 192, 192)',
                                'rgb(153, 102, 255)',
                                'rgb(255, 159, 64)',
                                'rgb(102, 255, 102)',
                                "rgb(80, 80, 80)",
                                "rgb(140, 192, 192)",
                                "rgb(10, 10, 10)",
                            ],
                            hoverOffset: 10
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                ticks: {
                                    ...ticksStyle,
                                    beginAtZero: true,
                                    callback: styleScaleY,
                                },
                            },
                        },
                    },
                }
            );
        }

        /* const productsMostSelled = () => {
            const element = document.getElementById('productsMostSelled');

            axios({
                url : URL_PRODUCTSMOSTSELLED,
                method : 'GET',
            })
            .then(response => {
                const data = response.data ;

                const labels = [];
                const values = [];
                for (const row of data) {
                    labels.push(row.nombre.substr(0, 15));
                    values.push(row.cantidad);
                }


                return new Chart(
                    element,
                    {
                        type: 'doughnut',
                        data: {
                            labels: labels,
                            datasets: [{
                                data: values,
                                backgroundColor: [
                                    'rgb(255, 99, 132)',
                                    'rgb(54, 162, 235)',
                                    'rgb(255, 205, 86)',
                                    'rgb(75, 192, 192)',
                                    'rgb(153, 102, 255)',
                                    'rgb(255, 159, 64)',
                                    'rgb(102, 255, 102)',
                                    "rgb(80, 80, 80)",
                                    "rgb(140, 192, 192)",
                                    "rgb(10, 10, 10)",
                                ],
                                hoverOffset: 10
                            }]
                        },
                        options: {
                            plugins: {
                                legend : {
                                    // display: false,
                                    position : 'bottom',
                                    align : 'left',
                                    labels : {
                                        fontSize : 15
                                    }
                                }
                            },
                        }
                    }
                );
            })
            .catch(error => {
                console.log(error)
            })

        }

        const salesOverTime = () => {

            const element = document.getElementById('comparativeSalesTheYearCurrentToYearOld');
            const salesForYear = document.querySelector('#salesForYear');
            const rateSales = document.querySelector('#rateIncremnt');
            const parentRateales = rateSales.parentElement;


            axios({
                url : URL_SALESOVERTIME,
                method : 'GET',
            })
            .then( response => {
                const data = response.data ;


                salesForYear.innerHTML = moneyFormat.replace('0.00',data.totalSalesThisYear);

                rateSales.innerHTML = data.rate+'%';
                if(data.rate >= 1){
                    parentRateales.classList.add('text-success');
                    parentRateales.classList.remove('text-danger');
                    rateSales.classList.remove('fa-arrow-down');
                    rateSales.classList.add('fa-arrow-up');
                }else{
                    parentRateales.classList.add('text-danger');
                    parentRateales.classList.remove('text-success');
                    rateSales.classList.add('fa-arrow-down');
                    rateSales.classList.remove('fa-arrow-up');
                }

                return new Chart(element, {
                    type: "bar",
                    data: {
                        labels: monthsAbr,
                        datasets: [
                            {
                                label: thisYear,
                                data: data.salesThisYear,
                                backgroundColor: "#007bff",
                                borderColor: "#007bff",
                            },
                            {
                                label: lastYear,
                                data: data.salesLastYear,
                                backgroundColor: "#ced4da",
                                borderColor: "#ced4da",
                            },
                        ],
                    },
                    options: {
                        plugins: {
                            maintainAspectRatio: false,
                            tooltips: { mode: mode, intersect: intersect },
                            hover: { mode: mode, intersect: intersect },
                            legend: {
                                display: true,
                                position: "bottom",
                                align: "end",
                            }
                        },
                        scales: {
                            y: {
                                gridLines: {
                                    display: true,
                                    lineWidth: "4px",
                                    color: "rgba(0, 0, 0, .2)",
                                    zeroLineColor: "transparent",
                                },
                                ticks: {
                                    ...ticksStyle,
                                    beginAtZero: true,
                                    callback: styleScaleY,
                                },
                            },
                            x: {
                                display: true,
                                gridLines: {
                                    display: false
                                },
                                ticks: ticksStyle
                            },
                        },
                    },
                });

            })
            .catch( error => {
                console.log(error)
            })




        }

        const salesForMonth = () => {
            const element = document.getElementById('salesForMonth');

            axios({
                url : URL_SALESFORMONTH,
                method : 'GET',
            })
            .then( response => {
                const data = response.data ;


                return new Chart(
                    element,
                    {
                        type: 'line',
                        data: {
                            labels: data.days,
                            datasets: [
                                {
                                    label: 'Ventas del dia',
                                    backgroundColor: 'rgb(255, 99, 132)',
                                    borderColor: 'rgb(255, 99, 132)',
                                    data: data.sales,
                                },
                            ]
                        },
                        options: {
                            scales: {
                                y: {
                                    ticks: {
                                        ...ticksStyle,
                                        beginAtZero: true,
                                        callback: styleScaleY,
                                    },
                                },
                            },
                        },
                    }
                );

            })
            .catch( error => {
                console.log(error)
            })


        }; */

        (() => {

            // productsMostSelled();
            // salesOverTime();
            // salesForMonth();
            alumnosMatricualdosChar();
            gananciasChar();

            document.querySelectorAll('.thisMonth').forEach(function(el, idx){
                el.innerHTML = getMonthCurrent();
            });

            document.querySelectorAll('.thisYear').forEach(function (el,idx) {
                el.innerHTML = thisYear;
            });

            document.querySelectorAll('.lastYear').forEach(function (el,idx) {
                el.innerHTML = lastYear;
            });

        })()








    </script>

@endpush
