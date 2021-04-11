@extends('layouts.app')
@section('title', 'Crear Producto')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('products.index') }}">Productos</a></li>
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
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data" >

           
            <div class="col-md-12">
                <div class="card">
                  <div class="card-header p-2">
                    <ul class="nav nav-pills">
                      <li class="nav-item"><a class="nav-link active" href="#information" data-toggle="tab">Información</a></li>
                      <li class="nav-item"><a class="nav-link" href="#prices" data-toggle="tab">Precios</a></li>
                      <li class="nav-item"><a class="nav-link" href="#gallery" data-toggle="tab">Galería</a></li>
                    </ul>
                  </div>

                  <div class="card-body">
                    <div class="tab-content">

                      <div class="tab-pane active" id="information">

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="exampleInputEmail1">Nombre</label>
                                <input name="name" class="form-control" value="{{ old('name')}}">
                            </div>      
                        </div>
                       
                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Descripción</label>
                                <textarea name="description" class="form-control">{{old('description')}}</textarea>
                            </div>      
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                <label for="exampleInputEmail1">Código</label>
                                <input name="code" class="form-control" value="{{ old('code')}}">
                            </div>      
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Marca</label>
                                <select name="brandId" id="brand" class="form-control">
                                    @foreach ($brands as $b=>$item)
                                        <option value="{{ $item->id }}">{{ $item->name}}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Categoría</label>
                                <select name="categoryId" id="category" class="form-control">
                                </select>
                            </div>    
                        </div>

                        
                      </div>
                      
                      <div class="tab-pane" id="prices">
                            

                      </div>
               

                      <div class="tab-pane" id="gallery">

                        <div class="form-group">
                            <label for="exampleInputFile">File input</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile" name="images[]" multiple>
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text" id="">Upload</span>
                              </div>
                            </div>
                          </div>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{ route('products.index')  }}" class="btn btn-danger">Cancelar</a>
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
       

        $('#brand').change(function(e){

        var id = $('#brand').val();

            $.ajax({
                type: "GET",
                url: "/categories/getCategories/"+id,
                data: {} ,
                dataType: 'json',
                success: function (data) {
                        e.preventDefault();
                        $('#category').html("");
                            var html;
                            $.each(data.data,function(k,category){
                                html += `<option value="${category.id}"> ${category.name} </option>`; 
                            })
                            $('#category').append(html);
                },
                error: function () {
                    alert(2);
                }
            });

            $.ajax({
                type: "GET",
                url: "/getPriceTags/"+id,
                data: {} ,
                dataType: 'json',
                success: function (data) {
                        e.preventDefault();
                        $('#prices').html("");
                            var html;
                            $.each(data.data,function(k,priceTag){
                                html += `                            
                                        <div class="row">
                                            <div class="form-group col-4">
                                                <label for="exampleInputEmail1"> ${priceTag['name']} </label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                                    </div>
                                                    <input type="number" name="prices[${priceTag['id']}]" class="form-control" step="any"  im-insert="true">
                                                </div>
                                            </div>      
                                        </div> `; 
                            })
                            $('#prices').append(html);
                },
                error: function () {
                    alert(2);
                }
            });

        })

    })


 



</script>
@endsection
