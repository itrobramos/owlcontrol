@extends('layouts.app')
@section('title', 'Armado de Caja')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('boxbuilding') }}">Armado de caja</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    
    <div class="card-body">
        <table class="table table-striped table-bordered">
            <thead>
              <tr>
                <th style="width:40px;"></th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Temática</th>
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
                        <td>{{$object->price}}</td>
                        <td>{{$object->thematic->name}}</td>
                        <td>
                            <a class="btn btn-dark btn-sm" href="{{ route('boxbuildingstep2', ['id'=>$object->id]) }}">
                                <i class="fas fa-check-square">
                                </i>
                                Armar
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
