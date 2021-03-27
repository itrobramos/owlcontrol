@extends('layouts.app')
@section('title', 'Categorías')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorías</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        

        <div class="card-tools">
            <a href="{{ route('categories.create') }} " class="btn btn-primary">Agregar</a>
        </div>
    </div>

    
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Fecha Creación</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $c)
                    <tr>
                        <td>{{$c->name}}</td>
                        <td>{{$c->created_at}}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('categories.edit', ['id'=>$c->id]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                Editar
                            </a>

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('categories.destroy',['id'=>$c->id]) }}"
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
                  {{ $categories->links() }}
              </div>
          </div>


    </div>
    

    <div class="card-footer">
        
    </div>
</div>
@endsection
