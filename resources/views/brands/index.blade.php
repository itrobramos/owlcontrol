@extends('layouts.app')
@section('title', 'Marcas')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('brands.index') }}">Marcas</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        

        <div class="card-tools">
            <a href="{{ route('brands.create') }} " class="btn btn-primary">Agregar</a>
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
                @foreach ($brands as $brand)
                    <tr>
                        <td class="text-center">
                            @if ( File::exists($brand->imageUrl)  )
                                <img src="{{ asset($brand->imageUrl) }}"  style="width: 90px">
                            @else
                                <img src="{{ asset('images/not-found.png') }}"  style="width: 90px">
                            @endif
                        </td>
                        <td>{{$brand->name}}</td>
                        <td>
                            <a class="btn btn-info btn-sm" href="{{ route('brands.edit', ['id'=>$brand->id]) }}">
                                <i class="fas fa-pencil-alt">
                                </i>
                                
                            </a>

                            <a class="btn btn-danger btn-sm button-destroy" href="{{ route('brands.destroy',['id'=>$brand->id]) }}"
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
                  {{ $brands->links() }}
              </div>
          </div>


    </div>
    

    <div class="card-footer">
        
    </div>
</div>
@endsection
