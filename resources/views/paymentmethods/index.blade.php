@extends('layouts.app')
@section('title', 'Métodos de Pago')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('paymentmethods.index') }}">Métodos de Pago</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        

        <div class="card-tools">
            <a href="{{ route('paymentmethods.create') }} " class="btn btn-primary">Agregar</a>
        </div>
    </div>

    
    <div class="card-body">
        <table class="table table-striped table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th style="width:40px;">Logo</th>
                <th>Nombre</th>
                <th>Propiedad</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td class="text-center">
                            @if ( File::exists($object->imageUrl)  )
                                <img src="{{ asset($object->imageUrl) }}"  style="max-width: 90px; max-height: 60px;">
                            @else
                                <img src="{{ asset('images/not-found.png') }}"  style="max-width: 90px; max-height: 60px;">
                            @endif
                        </td>
                        <td>{{$object->name}}</td>
                        <td>{{$object->property}}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('paymentmethods.edit', ['id'=>$object->id]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </a>

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('paymentmethods.destroy',['id'=>$object->id]) }}"
                                data-original-title="Eliminar"
                                data-method="delete"
                                data-trans-button-cancel="Cancelar"
                                data-trans-button-confirm="Eliminar"
                                data-trans-title="¿Está seguro de esta operación?"
                                data-trans-subtitle="Esta operación eliminará este registro permanentemente">
                                    <i class="fas fa-trash">
                                    </i>
                                    
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
          </table>

          <div class="row mt-4">
              <div class="col-12">
                  {{ $objects->links() }}
              </div>
          </div>


    </div>
    

    <div class="card-footer">
        
    </div>
</div>
@endsection
