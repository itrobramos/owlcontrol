@php $title = 'Editar contenido de:    ' . $object->name  @endphp
@extends('layouts.app')
@section('title', $title)

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('boxes.index') }}">Cajas</a></li>
        <li class="breadcrumb-item"><a href="#">Configuración</a></li>
    </ol>
@endsection


@section('extra-css')

@endsection


@section('content')

<style>
    .select2-selection__rendered {
        line-height: 31px !important;
    }

    .select2-container .select2-selection--single {
        height: 35px !important;
    }

    .select2-selection__arrow {
        height: 34px !important;
    }

</style>


    <div class="card">
        <div class="card-header">
            <div class="card-tools">
            </div>
        </div>

        <div class="card-body">

            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('boxes.configurepost', ['id' => $object->id]) }}" method="post">

                        <div class="form-group">
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="rdbEspecifico" name="configurationType" value="especifico"
                                        onchange="configureProduct();" checked="">
                                    <label class="form-check-label">Producto Especifico</label>
                                </div>

                                <div class="form-check">
                                    <input class="form-check-input" type="radio" id="rdbVariable" name="configurationType" value="variante"
                                        onchange="configureProduct();">
                                    <label class="form-check-label">Producto Variable</label>
                                </div>

                            </div>
                        </div>

                        <div id="productEspecifico">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Producto específico:</label>
                                <select id="cmbProducts" class="form-control select2" name="productId">
                                    <option value="">Seleccione</option>
                                    @foreach ($products as $c => $item)
                                        <option value="{{ $item->id }}" data-expiry="{{ $item->expiryDate }}">
                                            {{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div id="productVariante" style="display:none;">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Tipo Producto</label>
                                <select name="productTypeId" id="" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($types as $c => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Cantidad</label>
                                <input name="quantity" class="form-control" value="{{ old('quantity') }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Valor</label>
                                <input name="value" class="form-control" value="{{ old('value') }}">
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Temática</label>
                                <select name="thematicId" id="" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($thematics as $c => $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-12">
                                <a href="{{ route('boxes.index') }}" class="btn btn-danger">Regresar </a>
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                        </div>

                    </form>
                </div>

                <div class="col-md-4 offset-sm-1" style="border:1px solid white;">
                    <h2>Contiene:</h2>
                    <div class="row">

                        @foreach ($contains as $contain)
                            <div class="col-md-12">
                                <div class="small-box bg-default">
                                    <div class="row justify-content-end" style="padding-right:8px;">

                                        <a class="btn btn-danger btn-sm button-destroy"
                                            href="{{ route('boxes.configuredestroy', ['id' => $contain->id]) }}"
                                            data-original-title="Eliminar" data-method="delete"
                                            data-trans-button-cancel="Cancelar" data-trans-button-confirm="Eliminar"
                                            data-trans-title="¿Está seguro de esta operación?"
                                            data-trans-subtitle="Esta operación eliminará este registro permanentemente">
                                            <i class="fas fa-trash">
                                            </i>
                                        </a>
                                    </div>
                                    <div class="inner">
                                        @if (isset($contain->productId))
                                            <h4>{{ $contain->product->name}}</h4>
                                            @if ( File::exists($contain->product->imageUrl)  )
                                                <img src="{{ asset($contain->product->imageUrl) }}"  style="max-width: 90px; max-height: 60px;">
                                            @else
                                                <img src="{{ asset('images/not-found.png') }}"  style="max-width: 90px; max-height: 60px;">
                                            @endif
                                        @endif
                                        <h5>{{ $contain->quantity }} {{ $contain->type->name }}</h5>
                                        <p>Valor: {{ $contain->value }} </p>
                                        @if (isset($contain->thematic))
                                            <p>Temática: {{ $contain->thematic->name }} </p>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach

                    </div>


                </div>
            </div>
        </div>

        <div class="card-footer">

        </div>
    </div>
@endsection


@section('extra-js')

    <script>
        $('.select2').select2();

        function configureProduct() {

            if ($('#rdbVariable').is(':checked')) {
                $("#productEspecifico").hide();
                $("#productVariante").show();
            }

            if ($('#rdbEspecifico').is(':checked')) {
                $("#productVariante").hide();
                $("#productEspecifico").show();
            }

        }
    </script>

@endsection
