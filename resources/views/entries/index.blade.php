@extends('layouts.app')
@section('title', 'Entradas')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('entries.index') }}">Entradas</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        

        <div class="card-tools">
            <a href="{{ route('entries.create') }} " class="btn btn-primary">Agregar</a>
        </div>
    </div>

    
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width:40px;"></th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Total</th>
                <th>Envío</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td class="text-center">
                            @if ( File::exists($object->supplier->imageUrl)  )
                                <img src="{{ asset($object->supplier->imageUrl) }}"  style="max-width: 90px; max-height: 60px;">
                            @else
                                <img src="{{ asset('images/not-found.png') }}"  style="max-width: 90px; max-height: 60px;">
                            @endif
                        </td>
                        <td>{{$object->supplier->name}}</td>
                        <td>{{$object->date}}</td>
                        <td>{{$object->totalCost}}</td>
                        <td>{{$object->shipCost}}</td>

                        <td>
                            {{-- <a class="btn btn-info btn-sm" href="{{ route('entries.edit', ['id'=>$object->id]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Editar
                            </a> --}}

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('entries.destroy',['id'=>$object->id]) }}"
                                data-original-title="Eliminar"
                                data-method="delete"
                                data-trans-button-cancel="Cancelar"
                                data-trans-button-confirm="Eliminar"
                                data-trans-title="¿Está seguro de esta operación?"
                                data-trans-subtitle="Esta operación eliminará este registro permanentemente">
                                    <i class="fas fa-trash">
                                    </i>
                                    Eliminar
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
