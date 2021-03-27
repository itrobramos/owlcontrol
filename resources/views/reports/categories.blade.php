@extends('layouts.app')
@section('title', 'Reportes')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('reports') }}">Reportes</a></li>
        <li class="breadcrumb-item"><a href="{{ route('reports.categories') }}">Categorías</a></li>
    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">

            <div class="row">
                <div class="col-12" align="center">
                    <h2>Reporte por categorías</h2>
                </div>
            </div>
            <br>
        </div>

        <div class="card-body" >
        

            <form action="{{url('reports/categories')}}" method="POST" >
                <div class="row justify-content-center">

                    <div class="col-md-3">
                        <input type="date" class="form-control" id="txtFechaInicio" name="FechaInicio" value="{{isset($Parameters['FechaInicio'])?$Parameters['FechaInicio']:'' }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="txtFechaFin" name="FechaFin" value="{{isset($Parameters['FechaFin'])?$Parameters['FechaFin']:'' }}">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-success btn-md" type="submit">Buscar</button>
                    </div>
                </div>
            </form>
        
            <br>
            <br>
            <br>

            <div class="row">

                <div class="col-6">
                    <div class="chart">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <div class="chart tab-pane active" id="sales-chart" style="position: relative; height: 300px;">
                            <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-6">
                    <table class="table table-striped table-bordered">
                        <thead>
                          <tr class="bg-dark">
                            <th>Categoría</th>
                            <th>Total</th>
                          </tr>
                        </thead>
                        <tbody>
                            @php $total = 0 @endphp
                            @foreach ($SalesGraph as $s)
                                <tr>
                                    <td>{{$s->name}}</td>
                                    <td>$ {{floatval($s->total)}}</td>
                                    @php $total = $total + $s->total @endphp
                                </tr>
                            @endforeach
                            <tr class="bg-dark">
                                <td>Total</td>
                                <td>$ {{floatval($total)}}</td>
                            </tr>
                        </tbody>
                      </table>
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


$(function () {
    
    var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
    var pieData        = {
        labels: [
        @foreach($SalesGraph as $P)
        '{{$P->name}}',
        @endforeach
    ],
    datasets: [
      {
        data: [
          @foreach($SalesGraph as $P)
          '{{$P->total}}',
          @endforeach
        ],
        backgroundColor : [
          @foreach($SalesGraph as $P)
             getRandomColor(),
          @endforeach
        ],
      }
    ]
    }
    var pieOptions = {
    legend: {
        display: true
    },
    maintainAspectRatio : false,
    responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions      
    });

    function getRandomColor() {
            var letters = '0123456789ABCDEF'.split('');
            var color = '#';
            for (var i = 0; i < 6; i++ ) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
                }
})


</script>

@endsection
