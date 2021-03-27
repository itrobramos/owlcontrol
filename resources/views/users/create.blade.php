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
           
        </div>
    </div>

    
    <div class="card-body">
        <form action="{{ route('users.store') }}" method="post" enctype="multipart/form-data" >

            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input name="name" class="form-control" value="{{ old('name')}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Apellido</label>
              <input name="lastName" class="form-control" value="{{ old('lastName')}}">
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">Email</label>
              <input name="email" class="form-control" value="{{ old('email')}}">
            </div>
 
            <div class="form-group">
                <label for="">Role</label>
                <select name="roleId" id="roleId" class="form-control">
                    @foreach ($roles as $k => $rol)
                        <option value="{{ $k }}">{{$rol}}</option>   
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Sucursal</label>
                <select class="select2" multiple="multiple" data-placeholder="Selecciona sucursal" style="width: 100%;" name="Filials[]" id="Filials">
                    @foreach ($filials as $k => $filial)
                        <option value="{{ $k }}">{{$filial}}</option>   
                    @endforeach
                </select>
            </div>



            <div class="form-group">
                <label for="exampleInputEmail1">Contraseña</label>
                <input name="password" type="password" class="form-control">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Confirmar contraseña</label>
                <input name="password_confirmation" type="password" class="form-control">
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('users.index') }}" class="btn btn-danger">Cancelar</a>
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </div>
        </form>
    </div>
    

    <div class="card-footer">
        
    </div>
</div>
@endsection

@section('extra-js')

    <script>
        $(function(){
            $('.select2').select2();
        })
    </script>
@endsection
