@extends('layouts.app')
@section('title', 'Proveedores')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('suppliers.index') }}">Proveedores</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        

        <div class="card-tools">
            <a href="{{ route('suppliers.create') }} " class="btn btn-primary">Agregar</a>
        </div>
    </div>

    
    <div class="card-body">
        <table class="table table-striped table-bordered table-responsive-sm">
            <thead>
              <tr>
                <th style="width:40px;">Logo</th>
                <th>Nombre</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td class="text-center">
                            @if ( File::exists($supplier->imageUrl)  )
                                <img src="{{ asset($supplier->imageUrl) }}"  style="max-width: 90px; max-height: 60px;">
                            @else
                                <img src="{{ asset('images/not-found.png') }}"  style="max-width: 90px; max-height: 60px;">
                            @endif
                        </td>
                        <td>{{$supplier->name}}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('suppliers.edit', ['id'=>$supplier->id]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </a>

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('suppliers.destroy',['id'=>$supplier->id]) }}"
                                data-original-title="Eliminar"
                                data-method="delete"
                                data-trans-button-cancel="Cancelar"
                                data-trans-button-confirm="Eliminar"
                                data-trans-title="??Est?? seguro de esta operaci??n?"
                                data-trans-subtitle="Esta operaci??n eliminar?? este registro permanentemente">
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
                  {{ $suppliers->links() }}
              </div>
          </div>


    </div>
    

    <div class="card-footer">
        
    </div>
</div>
@endsection
