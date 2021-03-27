@extends('layouts.app')
@section('title', 'Editar Plataforma')

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
        <form action="{{  route('users.edit', ['id'=>$user->id])}}" method="post" enctype="multipart/form-data" >
            
            <div class="form-group">
              <label for="exampleInputEmail1">Nombre</label>
              <input name="name" class="form-control" value="{{ $user->name }}">
            </div>

            <div class="form-group">
                <label for="exampleInputEmail1">Apellidos</label>
                <input name="lastName" class="form-control" value="{{ $user->lastName }}">
            </div>
  
            {{-- <div class="form-group">
                <label for="exampleInputEmail1">Email</label>
                <input name="name" class="form-control" value="{{ $user->email }}">
            </div> --}}

            <div class="form-group">
                <label for="">Role</label>
                <select name="roleId" id="roleId" class="form-control">
                    @foreach ($roles as $k => $rol)
                        <option value="{{ $k }}" {{ ($user->roleId == $k)?'selected':'' }} >{{$rol}}</option>   
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="">Sucursal</label>
                <select class="select2" multiple="multiple" data-placeholder="Selecciona sucursal" style="width: 100%;" name="Filials[]" id="Filials">
                    @foreach ($filials as $k => $filial)
                        <option value="{{ $k }}" {{ ( in_array($k,$userFilials ) )?'selected':''  }}  >{{$filial}}</option>   
                    @endforeach
                </select>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="" class="btn btn-danger">Cancelar</a>
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

    <script>
        $(function(){
            $('.select2').select2();
        })
    </script>
@endsection
