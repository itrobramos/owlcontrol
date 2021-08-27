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
<div class="card">
    <div class="card-header">
        <div class="card-tools">
        </div>
    </div>
    
    <div class="card-body">

        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('boxes.configurepost',['id'=>$object->id ]) }}" method="post" >

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
                      <label for="exampleInputEmail1">Cantidad</label>
                      <input name="quantity" class="form-control" value="{{ old('quantity')}}">
                    </div>
        
                    <div class="form-group">
                      <label for="exampleInputEmail1">Valor</label>
                      <input name="value" class="form-control" value="{{ old('value')}}">
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
        
                    <div class="row">
                        <div class="col-12">
                            <a href="{{ route('boxes.index')  }}" class="btn btn-danger">Regresar   </a>
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </div>
        
                </form>
            </div>

            <div class="col-md-4 offset-sm-1" style="border:1px solid white;">
                <h2>Contiene:</h2>
                <div class="row">
                 
                    @foreach($contains as $contain)
                        <div class="col-md-12">
                            <div class="small-box bg-default" >
                                <div class="row justify-content-end" style="padding-right:8px;">

                                    <a class="btn btn-danger btn-sm button-destroy" 
                                        href="{{ route('boxes.configuredestroy',['id'=>$contain->id]) }}"
                                        data-original-title="Eliminar"
                                        data-method="delete"
                                        data-trans-button-cancel="Cancelar"
                                        data-trans-button-confirm="Eliminar"
                                        data-trans-title="¿Está seguro de esta operación?"
                                        data-trans-subtitle="Esta operación eliminará este registro permanentemente">
                                            <i class="fas fa-trash">
                                            </i>
                                    </a>    
                                </div>
                                <div class="inner">
                                    <h5>{{$contain->quantity}} {{$contain->type->name}}</h5>
                                    <p>Valor: {{$contain->value}} </p>
                                    @if(isset($contain->thematic))
                                        <p>Temática: {{$contain->thematic->name}} </p>
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
    
@endsection
