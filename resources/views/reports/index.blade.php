@extends('layouts.app')
@section('title', 'Reportes')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('reports') }}">Reportes</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        
        
    </div>
    
    <div class="card-body">
        <div class="row">

            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                <div class="card card-row card-default">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title">
                            Flujo Efectivo
                        </h3>
                    </div>
                    <div class="card-body" id="body_nuevos">
                        <a href="{{url('reports/cashflow')}}">
                            <img src="images/presentation.png" alt="" class="" style="object-fit: cover;width:250px;height:250px">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                <div class="card card-row card-default">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title text-justify">
                            Ventas por plataforma (En construcción)
                        </h3>
                    </div>
                    <div class="card-body" id="body_nuevos">
                        <a href="{{url('reports/platforms')}}">
                            <img src="images/platform.png" alt="" class="" style="object-fit: cover;width:250px;height:250px">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                <div class="card card-row card-default">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title">
                            Temáticas  (En construcción)
                        </h3>
                    </div>
                    <div class="card-body" id="body_nuevos">
                        <a href="{{url('reports/categories')}}">
                            <img src="images/calendar.png" alt="" class="" style="object-fit: cover;width:250px;height:250px">
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                <div class="card card-row card-default">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title">
                            Más vendidos  (En construcción)
                        </h3>
                    </div>
                    <div class="card-body" id="body_nuevos">
                        <a href="{{url('reports/products')}}">
                            <img src="images/like.png" alt="" class="" style="object-fit: cover;width:250px;height:250px">
                        </a>
                    </div>
                </div>
            </div>
               

            <div class="col-sm-6 col-md-4 col-lg-3 text-center">
                <div class="card card-row card-default">
                    <div class="card-header bg-secondary">
                        <h3 class="card-title"> 
                            Cuentas  (En construcción)
                        </h3>
                    </div>
                    <div class="card-body" id="body_nuevos">
                        <a href="{{url('reports/accounts')}}">
                            <img src="images/money.png" alt="" class="" style="object-fit: cover;width:250px;height:250px">
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
    

    <div class="card-footer">
        
    </div>
</div>
@endsection
