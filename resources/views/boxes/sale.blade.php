@extends('layouts.app')
@section('title', 'Vender Caja')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('builtboxes') }}">Cajas armadas</a></li>
    </ol>
@endsection

@section('extra-css')
@endsection


@section('content')
    <div class="card">
        <div class="card-header">
            <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#content" data-toggle="tab">Contenido</a></li>
                <li class="nav-item"><a class="nav-link" href="#client" data-toggle="tab">Cliente</a></li>
                <li class="nav-item"><a class="nav-link" href="#expenses" data-toggle="tab">Otros Gastos</a>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="tab-content">
                        <div class="tab-pane active" id="content">
                            <div class="row">
                                <div class="col-md-4">
                                    Nombre <input type="text" class="form-control" readonly value="{{ $object->name }}">
                                </div>

                                <div class="col-md-4">
                                    Monto invertido $<input type="text" class="form-control" readonly
                                        value="{{ $object->money }}">
                                </div>
                            </div>

                            <br>

                            <h4>Contenido</h4>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-responsive table-hover table-striped">
                                        <tr>
                                            <td>Imagen</td>
                                            <td>Categoría</td>
                                            <td>Producto</td>
                                            <td>Precio</td>
                                        </tr>

                                        @foreach ($object->filledBoxDetails as $detail)
                                            <tr>
                                                <td>
                                                    @if (File::exists($detail->product->imageUrl))
                                                        <img src="{{ asset($object->imageUrl) }}"
                                                            style="max-width: 90px; max-height: 60px;">
                                                    @else
                                                        <img src="{{ asset('images/not-found.png') }}"
                                                            style="max-width: 90px; max-height: 60px;">
                                                    @endif
                                                </td>
                                                <td>{{ $detail->product->type->name }}</td>
                                                <td>{{ $detail->product->name }}</td>
                                                <td>$ {{ $detail->price }}</td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="client">
                            <form action="{{ route('boxes.clientStore' ,['id'=>$object->id ]) }}" method="post" enctype="multipart/form-data">

                                <h4>Datos generales</h4>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Nombre*</label>
                                        <input name="name" class="form-control">
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Apellido</label>
                                        <input name="lastName" class="form-control">
                                    </div>
                                </div>

                                <div class="row">



                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Origen de la venta</label>
                                        <select id="cmbExpenseType" class="form-control" name="origin">
                                            <option value="">Seleccione</option>
                                            @foreach ($saleOrigins as $origin)
                                                <option value="{{ $origin->id }}">{{ $origin->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>


                                <br>
                                <h4>Datos de venta</h4>

                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Precio Venta*</label>
                                        <input name="price" class="form-control" value="">
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                      <label for="exampleInputEmail1">Fecha*</label>
                                      <input name="date" type="date" class="form-control" value="">
                                  </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
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


                                <br>
                                <h4>Contacto</h4>

                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Teléfono</label>
                                        <input name="phone" class="form-control" value="">
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input name="email" class="form-control" value="">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">FB</label>
                                        <input name="fb" class="form-control" value="">
                                    </div>

                                    <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                        <label for="exampleInputEmail1">Instagram</label>
                                        <input name="instagram" class="form-control" value="">
                                    </div>
                                </div>

                                <br>
                                <h4>Envío</h4>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <textarea name="delivery"class="form-control"></textarea>
                                    </div>
                                </div>

                                <br>
                                <h4>Comentarios</h4>
                                <div class="row">
                                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                        <textarea name="comments" class="form-control"></textarea>
                                    </div>
                                </div>

                                <br>

                                <button type="submit" class="btn btn-success">Guardar Cliente</button>
                            </form>
                        </div>

                        <div class="tab-pane" id="expenses">

                            <h4>Gastos de venta</h4>
                            <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6">
                                <label for="exampleInputEmail1">Tipo Gasto</label>
                                <select id="cmbExpenseType" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($expensesTypes as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <br>

                            <div class="row">
                              <div class="col-md-12">
                                <table class="table table-responsive table-hover table-striped">
                                  <thead>
                                    <td>Gasto</td>
                                    <td>Cantidad</td>
                                  </thead>
    
                                  <tr>
                                    <td>Decoración</td>
                                    <td>$ 15</td>
                                  </tr>
    
                                  <tr>
                                    <td>Envío</td>
                                    <td>$ 100</td>
                                  </tr>
    
                                </table>
    
                              </div>
                            </div>
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


@section('extra-js')

@endsection
