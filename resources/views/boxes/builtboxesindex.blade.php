@extends('layouts.app')
@section('title', 'Cajas')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('builtboxes') }}"> Cajas Armadas</a></li>
</ol>
@endsection

@section('content')
<div class="card">

    
    <div class="card-body">
        <table class="table table-striped table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($objects as $object)
                    <tr>
                        <td>{{$object->name}}</td>
                        <td>${{$object->money}}</td>

                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('boxes.sale', ['id'=>$object->id]) }}">
                                Vender
                            </a>

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('boxes.destroy',['id'=>$object->id]) }}"
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
