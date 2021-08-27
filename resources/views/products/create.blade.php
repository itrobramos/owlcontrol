@extends('layouts.app')
@section('title', 'Crear Producto')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Producto</a></li>
</ol>
@endsection


@section('extra-css')
  
@endsection


@section('content')
<div class="card">
    <div class="card-header">
        

        <div class="card-tools">
           
        </div>
    </div>

    
    <div class="card-body">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" >
    
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input name="name" class="form-control" value="{{ old('name')}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Nombre Interno</label>
              <input name="internal_name" class="form-control" value="{{ old('internal_name')}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Descripción</label>
              <input name="description" class="form-control" value="{{ old('description')}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Stock</label>
              <input type="number" name="stock" class="form-control" value="{{ old('stock')}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Valor</label>
              <input type="number" name="value" class="form-control" value="{{ old('value')}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Tipo Producto</label>
              <select name="productTypeId" id="" class="form-control">
                  <option value="">Seleccione</option>
                  @foreach ($types as $c=>$item)
                      <option value="{{ $item->id }}">{{ $item->name}}</option>
                  @endforeach
              </select>
            </div>    

            <div class="form-group">
              <label for="exampleInputEmail1">Temática</label>
              <select name="thematicId" id="" class="form-control">
                  <option value="">Seleccione</option>
                  @foreach ($thematics as $c=>$item)
                      <option value="{{ $item->id }}">{{ $item->name}}</option>
                  @endforeach
              </select>
            </div> 


            <div class="form-group">
                <label for="exampleInputFile">Imagen</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="image"  >
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
            </div>
  

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('products.index')  }}" class="btn btn-danger">Cancelar</a>
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
    
@endsection
