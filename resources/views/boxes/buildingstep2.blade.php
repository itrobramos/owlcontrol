@extends('layouts.app')
@section('title', 'Armado de Caja')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('boxbuilding') }}">Armado de caja</a></li>
    </ol>
@endsection

@section('content')

    <div class="card">

        <div class="card-header">
            <h3 class="card-title">Productos Fijos</h3>
            <div class="float-sm-right">
                <button class="btn btn-xs btn-info" data-toggle="collapse" data-target=".collapseFixed">Ver más</button>
            </div>
        </div>

        <div class="card-body collapseFixed collapse out">
            <div class="row">
                @foreach ($fixedcontains as $fixed)
                    <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                        <div class="card card-row card-default">
                            <div class="card-header bg-primary">
                                <h3 class="card-title" style="font-size: 15px; height:25px;">
                                    {{ $fixed->product->name }}
                                </h3>
                            </div>
                            <div class="card-body" id="body_nuevos">
                                @if (File::exists($fixed->product->imageUrl))
                                    <img src="{{ asset($fixed->product->imageUrl) }}" class="img-thumbnail"
                                        style="object-fit: cover;width:90px;height:90px">
                                @else
                                    <img src="{{ asset('images/not-found.png') }}" class="img-thumbnail"
                                        style="object-fit: cover;width:90px;height:90px">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    @foreach ($data as $d)

        <div class="card">

            <div class="card-header">
                <h3 class="card-title">{{$d['type']}}  ({{$d['contains'][0]['quantity']}}) | Disponibles: {{$d['contains'][0]['productCount']}}</h3>
                <div class="float-sm-right">
                    <button class="btn btn-xs btn-info" data-toggle="collapse" data-target=".collapse{{$d['type']}}">Ver más</button>
                </div>
            </div>

            <div class="card-body collapse{{$d['type']}} collapse out">
                <div class="row">
                    @foreach ($d['contains'] as $contain)
                        
                        <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                            <div class="card card-row card-default">
                                
                                <div class="card-header bg-primary">
                                    <h3 class="card-title" style="font-size: 15px; height:25px;">
                                        Valor: {{ $contain['value'] }}  /   
                                       
                                        Cantidad: {{$contain['quantity']}}  

                                        @if(isset($contain['thematic']))
                                            / Temática: {{ $contain['thematic'] }}  
                                        @endif
                                    </h3>
                                </div>
                                <div class="card-body" id="body_nuevos">
                                    @foreach($d['contains'][0]['products'] as $product)
                                        {{$product->name}}
                                        @if (File::exists($product->imageUrl))
                                            <img src="{{ asset($product->imageUrl) }}" class="img-thumbnail"
                                            style="object-fit: cover;width:50px;height:50px">
                                        @else
                                            <img src="{{ asset('images/not-found.png') }}" class="img-thumbnail"
                                            style="object-fit: cover;width:50px;height:50px">
                                        @endif
                                        <br>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    @endforeach
                </div>
            </div>

        </div>
    @endforeach






@endsection
