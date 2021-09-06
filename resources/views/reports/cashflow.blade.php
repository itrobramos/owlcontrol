@extends('layouts.app')
@section('title', 'Reportes')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('reports') }}">Reportes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('reports.cashflow') }}">Flujo de efectivo</a></li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-12" align="center">
                    <h2>Reporte por mes</h2>
                </div>
            </div>
            <br>

        </div>

        <div class="card-body">


            <form action="{{ url('reports/cashflow') }}" method="POST">
                <div class="row">

                    <div class="col-md-3">
                        <input type="date" class="form-control" id="txtFechaInicio" name="FechaInicio"
                            value="{{ isset($Parameters['FechaInicio']) ? $Parameters['FechaInicio'] : '' }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="txtFechaFin" name="FechaFin"
                            value="{{ isset($Parameters['FechaFin']) ? $Parameters['FechaFin'] : '' }}">
                    </div>
                    <div class="col-md-3">
                        <button class="btn btn-success btn-md" type="submit">Buscar</button>
                    </div>

                </div>
            </form>

            <br>
            <br>

            <div class="row">

                <div class="col-12">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class="___class_+?21___"></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class="___class_+?23___"></div>
                            </div>
                        </div>
                        <canvas id="barChart"
                            style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%; display: block; width: 604px;"
                            width="604" height="250" class="chartjs-render-monitor"></canvas>
                    </div>
                </div>

            </div>
        </div>


        <div class="card-footer">

        </div>
    </div>
@endsection


@section('extra-js')

    <script src="../js/Chart.min.js"></script>
    <script>
        $(function() {

            var areaChartData = {
                labels: [
                    @foreach ($CashFLowGraph as $sale)
                        '{{ $sale->year }}-{{ $sale->month }}',
                    @endforeach
                ],
                datasets: [
                    // {
                        // barPercentage: 0.5,
                        // barThickness: 40,
                        // maxBarThickness: 30,
                        // minBarLength: 10,

                        // label: 'Ingresos',
                        // backgroundColor: 'rgba(40, 159, 28 ,0.9)',
                        // borderColor: 'rgba(40, 159, 28 ,0.8)',
                        // pointRadius: false,
                        // pointColor: '#3b8bba',
                        // pointStrokeColor: 'rgba(60,141,188,1)',
                        // pointHighlightFill: '#fff',
                        // pointHighlightStroke: 'rgba(60,141,188,1)',
                        // data: [
                        //     @foreach ($CashFLowGraph as $sale)
                        //         '{{ $sale->total }}',
                        //     @endforeach
                        // ]
                    // },
                    {
                        barPercentage: 0.9,
                        barThickness: 40,
                        maxBarThickness: 30,
                        minBarLength: 10,

                        label: 'Egresos',
                        backgroundColor: 'rgba(217, 57, 28 ,0.9)',
                        borderColor: 'rgba(217, 57, 28 ,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: [
                            @foreach ($CashFLowGraph2 as $sale)
                                '{{ $sale->total }}',
                            @endforeach
                        ]
                    }
                ]
            }

            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            barChartData.datasets[0] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }

            var barChart = new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })


        })
    </script>

@endsection
