@extends('layouts.app')
@section('title', 'Detalle Producto')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        

    </div>

    
    <div class="card-body">
      
        <div class="row">
            <div class="col-md-12">
                <div class="card">


                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Información</a></li>
                      <li class="nav-item"><a class="nav-link" href="#prices" data-toggle="tab">Precios</a></li>
                      <li class="nav-item"><a class="nav-link" href="#ingredients" data-toggle="tab">Ingredientes</a></li>
                      <li class="nav-item"><a class="nav-link" href="#variants" data-toggle="tab">Variantes</a></li>
                      <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Galería</a></li>
                    </ul>
                  </div>


                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane active" id="information">

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input name="name" class="form-control" value="{{$product->name}}" readonly>
                            </div>      
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Descripción</label>
                                <textarea name="description" class="form-control" readonly>{{$product->name}}</textarea>
                            </div>      
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Categoría</label>
                                <input name="name" class="form-control" value="{{$product->category->name}}" readonly>
                            </div>    
                        </div>

                        
                      </div>
                      
                      <div class="tab-pane" id="prices">
                            @foreach($product->platforms as $platform)
                                
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="exampleInputEmail1">{{$platform->name}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number"  class="form-control"  im-insert="true" value="{{$platform->pivot->price}}" readonly>
                                      </div>
                                </div>      
                            </div>

                            @endforeach
                      </div>

                      <div class="tab-pane" id="ingredients">

                      


                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Unidad Medida</th>
                                <th>Notas</th>
                              </tr>
                            </thead>
                            <tbody id="">
                               @foreach ($product->ingredients as $ingredient)
                                   <tr>
                                       <td>{{$ingredient->name}}</td>
                                       <td>{{$ingredient->pivot->quantity}}</td>
                                       <td>{{$measurementUnits[$ingredient->pivot->measurementUnitId]  }}</td>
                                       <td>{{$ingredient->pivot->notes}}</td>
                                   </tr>
                               @endforeach
                            </tbody>
                          </table>


                      </div>
                      

                      <div class="tab-pane" id="variants">

                       
                       

                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Variante</th>
                                <th>Opción</th>
                                <th>Costo Extra</th>
                              </tr>
                            </thead>
                            <tbody id="rowsoptions">
                               @foreach ($product->options as $opt)
                                   <tr>
                                       <td>{{ $opt->variant->name }}</td>
                                       <td>{{ $opt->name }}</td>
                                       <td>${{ $opt->pivot->extraCost }}</td>
                                   </tr>
                               @endforeach
                            </tbody>
                          </table>
                      </div>
                      

                      <div class="tab-pane" id="gallery">

                        <div class="row">
                            @foreach ($product->images as $item)
                                <div class="col-md-3 text-center">
                                    <img src="{{ asset($item->imageUrl) }}" alt="" class="img-thumbnail" style="object-fit: cover;width:250px;height:250px">                                    
                                </div>
                            @endforeach
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
