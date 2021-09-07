@php $title = 'Fechas de vigencia de: ' . $object->name  @endphp
@extends('layouts.app')
@section('title', $title)

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
        <li class="breadcrumb-item"><a href="#">Vigencia</a></li>

    </ol>
@endsection

@section('content')
    <div class="card">
        <div class="card-header">


            <div class="card-tools">
                <a href="{{ route('products.create') }} " class="btn btn-primary">Agregar</a>
            </div>
        </div>


        <div class="card-body">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>

                        <th>Restan</th>
                        <th>Fecha Vigencia</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($controlExpiration as $control)
                        @php
                            $ticketTime = strtotime($control->date);
                            $days = $ticketTime - time();
                        @endphp

                        @if (round($days / 86400) < 60)
                            <tr class="bg-warning">
                            @elseif(round($days/ 86400) <0) <tr class="bg-danger">
                                @else
                            <tr class="bg-default">
                        @endif


                        <td>
                            {{ round($days / 86400) }} días
                        </td>
                        <td>{{ $control->date }}</td>
                        <td>
                            <a class="btn btn-primary btn-sm button-destroy"
                                href="{{ route('products.sold', ['id' => $control->id]) }}"
                                data-original-title="Confirmar Vendido" data-method="delete"
                                data-trans-button-cancel="Cancelar" data-trans-button-confirm="Confirmar Venta"
                                data-trans-title="¿Está seguro de esta operación?"
                                data-trans-subtitle="Esta operación eliminará este registro permanentemente">
                                <i class="fas fa-box"> Vendido
                                </i>
                            </a>


                            <a class="btn btn-danger btn-sm button-destroy"
                                href="{{ route('products.merma', ['id' => $control->id]) }}"
                                data-original-title="Confirmar Merma" data-method="delete"
                                data-trans-button-cancel="Cancelar" data-trans-button-confirm="Confirmar Merma"
                                data-trans-title="¿Está seguro de esta operación?"
                                data-trans-subtitle="Esta operación eliminará este registro permanentemente">
                                <i class="fas fa-trash"> Merma
                                </i>
                            </a>

                        </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="row mt-4">
                <div class="col-12">
                    {{ $controlExpiration->links() }}
                </div>
            </div>


        </div>


        <div class="card-footer">

        </div>
    </div>
@endsection
