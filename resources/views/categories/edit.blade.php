@extends('layouts.app')
@section('title', 'Editar categoría')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categorías</a></li>
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
            <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post"
                enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nombre</label>
                    <input name="name" class="form-control" value="{{ $category->name }}">
                </div>

                <div class="form-group">
                    <label for="">Marca</label>
                    <select class="select2 form-control" data-placeholder="Selecciona marca" style="width: 100%;"
                        name="brand" id="brand">
                        @foreach ($brands as $k => $brand)
                            @if($brand->id == $category->brandId)
                              <option value="{{ $brand->id }}" selected>{{ $brand->name }}</option>
                            @else
                              <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="">Categoría Padre</label>
                    <select class="select2 form-control" data-placeholder="Selecciona categoría padre" style="width: 100%;"
                        name="parentCategory" id="parentCategory">

                    </select>
                </div>

                <div class="form-group">
                    <label for="exampleInputFile">Imagen</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-12">
                        <a href="{{ route('categories.index') }}" class="btn btn-danger">Cancelar</a>
                        <button class="btn btn-primary" type="submit">Editar</button>
                    </div>
                </div>
            </form>
        </div>


        <div class="card-footer">

        </div>
    </div>
@endsection


@section('extra-js')

@endsection
