@extends('layouts.app')
@section('title', 'Usuarios')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('users.index') }}">Usuarios</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <div class="card-tools">
            <a href="{{ route('users.create') }} " class="btn btn-primary">Agregar</a>
        </div>
    </div>

    
    <div class="card-body">
        <table class="table table-striped table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Fecha Creación</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $u)
                    <tr>
                        <td>{{ $u->name }} </td>
                        <td>{{ $u->lastName }} </td>
                        <td>{{ $u->email }} </td>
                        <td>{{ $u->created_at }} </td>


                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('users.edit', ['id'=>$u->id]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </a>

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('users.destroy',['id'=>$u->id]) }}"
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


    </div>
    

    <div class="card-footer">
        
    </div>
</div>

@endsection
