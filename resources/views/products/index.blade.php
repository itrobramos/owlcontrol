@extends('layouts.app')
@section('title', 'Productos')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
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
                <th>Marca</th>
                <th>Categoría</th>
                <th>Nombre</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($products as $c)
                    <tr>
                        <td>{{$c->category->brand->name}}</td>
                        <td>{{$c->category->name}}</td>
                        <td>{{$c->name}}</td>
                        <td>

                            {{-- <a class="btn btn-primary btn-sm" href="{{ route('products.show', ['id'=>$c->id]) }}">
                                <i class="fas fa-folder">
                                </i>
                                Detalle
                            </a> --}}

                            <a class="btn btn-info btn-sm" href="{{ route('products.edit', ['id'=>$c->id]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Editar
                            </a>
                            

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('products.destroy',['id'=>$c->id]) }}"
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
                  {{ $products->links() }}
              </div>
          </div>


    </div>
    

    <div class="card-footer">
        
    </div>
</div>
@endsection
