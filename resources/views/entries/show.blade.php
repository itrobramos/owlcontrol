@extends('layouts.app')
@section('title', 'Entrada de Mercancía')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('entries.index') }}">Entrada de Mercancía</a></li>
    </ol>
@endsection

@section('content')
    <div class="card">

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="invoice p-3 mb-3">
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <address>
                                    <strong>{{ $object->supplier->name }}</strong><br>
                                </address>
                                @if (File::exists($object->supplier->imageUrl))
                                    <img src="{{ asset($object->supplier->imageUrl) }}"
                                        style="max-width: 90px; max-height: 60px;">
                                @else
                                    <img src="{{ asset('images/not-found.png') }}"
                                        style="max-width: 90px; max-height: 60px;">
                                @endif
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 invoice-col">
                                <b>Fecha Pedido:</b> {{@$object->orderDate}}
                                <br>
                                <b>Fecha Entrada:</b> {{@$object->date}}
                                <br>
                                <b>Recibe:</b> {{@$object->user->name}}
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-2 invoice-col">
                                <b>Folio #{{$object->id}}</b>
                                <br>
                                <b>Total:</b> {{$object->totalCost}}
                                <br>
                                <b>Envío:</b> {{$object->shipCost}}
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <br>

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Cantidad</th>
                                            <th>SKU</th>
                                            <th>Producto</th>
                                            <th>Precio Unitario</th>
                                            <th>Subtotal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        @foreach($details as $detail)
                                        <tr>
                                            <td>{{$detail->quantity}}</td>
                                            <td>{{$detail->id}}</td>
                                            <td>{{$detail->product->name}}</td>
                                            <td>${{$detail->unitPrice    }}</td>
                                            <td>${{ number_format((float)$detail->unitPrice * $detail->quantity, 2, '.', '')    }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">
                                    <small class="float-left">Método de Pago: <br> 
                                        @if ( isset($object->paymentMethod->imageUrl) && File::exists($object->paymentMethod->imageUrl))
                                            <img src="{{ asset($object->paymentMethod->imageUrl) }}" style="max-width: 45px; max-height: 30px;">
                                        @else
                                            <img src="{{ asset('images/not-found.png') }}"  style="max-width: 45; max-height: 30px;">
                                        @endif

                                        {{ @$object->paymentMethod->name }}  {{@$object->paymentMethod->property}}
                                    </small>
                                </p>
                            </div>
                            <!-- /.col -->
                            <div class="col-6">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tbody>
                                            <tr>
                                                <th style="width:50%">Subtotal:</th>
                                                <td>$ {{$object->totalCost}}</td>
                                            </tr>
                                            <tr>
                                                <th>Envío:</th>
                                                <td>$ {{$object->shipCost}}</td>
                                            </tr>
                                            <tr>
                                                <th>Total:</th>
                                                <td>$ {{ number_format((float)$object->totalCost  + $object->shipCost, 2, '.', '') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <div class="col-12">
                                <button type="button" class="btn btn-primary float-right"  onclick="window.print();return false;"style="margin-right: 5px;">
                                    <i class="fas fa-download"></i> Imprimir / Guardar PDF
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


        <div class="card-footer">

        </div>
    </div>
@endsection
