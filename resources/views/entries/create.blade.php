@extends('layouts.app')
@section('title', 'Crear Entrada')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('entries.index') }}">Entrada</a></li>
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
            <form action="{{ route('entries.store') }}" method="post" enctype="multipart/form-data">


                <div class="row">


                    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-6">
                        <label for="exampleInputEmail1">Proveedor</label>
                        <select name="supplierId" id="" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach ($suppliers as $c => $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-6">
                        <label for="exampleInputEmail1">Fecha</label>
                        <input type="date" name="date" class="form-control">
                    </div>


                    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-6">
                        <label for="exampleInputEmail1">Moneda</label>
                        <select name="currencyId" id="" class="form-control">
                            <option value="">Seleccione</option>
                            @foreach ($currencies as $c => $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-6 col-lg-3 col-sm-6 col-xs-6">
                        <label for="exampleInputFile">Imagen</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" name="image">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                            </div>
                        </div>
                    </div>

                </div>

                <br><br><br>


                <div class="row">
                    <div class="col-3">
                        <h3>Agregar Producto</h3>
                    </div>

                    <div class="col-6">
                        <select id="cmbProducts" class="form-control select2">
                            <option value="">Seleccione</option>
                            @foreach ($products as $c => $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-2">
                        <button type="button" onclick="addItemToEntry(this)"
                            class="btn-md btn btn-success m-btn m-btn--icon m-btn--pill">
                            <span>
                                <i class="fa fa-check"></i>
                            </span>
                        </button>
                    </div>

                </div>



                <br><br>


                <table class="table table-bordered" id="tbl_parent_options">
                    <thead>
                        <tr class="bg-secondary color-palette">
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Costo unitario</th>
                            <th>Envío</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="rowsoptions">






                    </tbody>
                </table>




                <br>

                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('entries.index') }}" class="btn btn-danger">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Guardar</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="card-footer">

        </div>
    </div>
@endsection


@section('extra-js')

    <script>
        $('.select2').select2();

        function addItemToEntry(x) {
            var id = $("#cmbProducts").val();

            var productText = $("#cmbProducts option:selected").text();

            var timestamp = Date.now();
            html = getTemplate(timestamp, productText, id);
            $("#rowsoptions").append(html);

            $("#cmbProducts option:selected").remove();
        }


        function getTemplate(i, productText, productId) {
            var html = `
            <tr id="${i}" class="bg-light color-palette">
                    <td id="product${i}">${productText}
                      <input type="hidden" id="productText${i}" class="form-control"  value="${productText}">
                      <input type="hidden" id="productId${i}" class="form-control" name="product[${i}][productId]" value="${productId}">
                    </td>
                    <td id="product${i}">
                        <input type="number" step="any" class="form-control" name="product[${i}][quantity]"
                            id="quantity_${i}" required value="1">
                    </td>
                    <td>
                        <input type="number" step="any" class="form-control" name="product[${i}][unitPrice]"
                            id="extraCost_${i}" required value="0">
                    </td>
                    <td>
                        <input type="number" step="any" class="form-control" name="product[${i}][shipCost]"
                            id="ship_${i}" required value="0">
                    </td>
                    <td>
                        <button data-repeater-delete="" onclick="deletetemplate(${i})"
                            class="btn-md btn btn-danger m-btn m-btn--icon m-btn--pill">
                            <span>
                                <i class="fa fa-trash"></i>
                            </span>
                        </button>
                    </td>
                </tr>

              `;

            return html;
        }



        function deletetemplate(i) {
            var RecoveredId = $("#productId" + i).val();
            var RecoveredText = $("#productText" + i).val();

            var o = new Option(RecoveredText, RecoveredId);
            $(o).html(RecoveredText);
            $("#cmbProducts").append(o);

            $("#" + i).remove();
        }
    </script>

@endsection
