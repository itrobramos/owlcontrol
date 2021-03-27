@extends('layouts.app')
@section('title', 'Reportes')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reports') }}">Reportes</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reports.products') }}">Más vendidos</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">

        <div class="row">
            <div class="col-12" align="center">
                <h2>Reporte Más vendidos</h2>
            </div>
        </div>
        <br>
    </div>
    
    <div class="card-body">
     
        <form action="{{url('reports/products')}}" method="POST">
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

        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                
                <h2>Más vendidos</h2>

                <table class="table table-striped table-bordered">
                    <thead>
                      <tr class="bg-secondary">
                        <th>Producto</th>
                        <th>Unidades Ventas</th>
                        <th>Monto Ventas</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $total = 0;
                            $quantity = 0;
                        @endphp
                        
                        @foreach ($TopSales as $s)
                            <tr>
                                <td>{{$s->name}}</td>
                                <td>{{floatval($s->quantity)}}</td>
                                <td>$ {{floatval($s->total)}}</td>
                                @php 
                                    $total = $total + $s->total;
                                    $quantity = $quantity = $s->quantity
                                @endphp
                            </tr>
                        @endforeach
                        <tr class="bg-secondary">
                            <td>Total</td>
                            <td> {{floatval($quantity)}}</td>
                            <td>$ {{floatval($total)}}</td>
                        </tr>
                    </tbody>
                  </table>

            </div>




            <div class="col-md-6 text-center">
                
                <h2>Menos vendidos</h2>

                <table class="table table-striped table-bordered">
                    <thead>
                      <tr class="bg-secondary">
                        <th>Producto</th>
                        <th>Unidades Ventas</th>
                        <th>Monto Ventas</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $total = 0;
                            $quantity = 0;
                        @endphp
                        
                        @foreach ($LessSales as $s)
                            <tr>
                                <td>{{$s->name}}</td>
                                <td>{{floatval($s->quantity)}}</td>
                                <td>$ {{floatval($s->total)}}</td>
                                @php 
                                    $total = $total + $s->total;
                                    $quantity = $quantity = $s->quantity
                                @endphp
                            </tr>
                        @endforeach
                        <tr class="bg-secondary">
                            <td>Total</td>
                            <td> {{floatval($quantity)}}</td>
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
