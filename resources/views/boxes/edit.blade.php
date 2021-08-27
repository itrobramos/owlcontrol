@extends('layouts.app')
@section('title', 'Editar Temática')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('boxes.index') }}">Temáticas</a></li>
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
        <form action="{{ route('boxes.update',['id'=>$object->id ]) }}" method="post" enctype="multipart/form-data" >
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input name="name" class="form-control" value="{{ $object->name}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Precio</label>
              <input name="price" class="form-control" value="{{ $object->price}}">
            </div>


            <div class="form-group">
                  <label for="exampleInputEmail1">Temática</label>
                  <select name="thematicId" id="" class="form-control">
                      <option value="">Seleccione</option>
                      @foreach ($thematics as $c=>$item)
                          @if($item->id == $object->thematicId)
                            <option value="{{ $item->id }}" selected>{{ $item->name}}</option>
                          @else
                            <option value="{{ $item->id }}">{{ $item->name}}</option>

                          @endif
                      @endforeach
                  </select>
              </div>    
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
                    <a href="{{ route('boxes.index')  }}" class="btn btn-danger">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Editar</button>
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
