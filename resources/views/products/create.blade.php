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
                      <li class="nav-item"><a class="nav-link" href="#ingredients" data-toggle="tab">Ingredientes</a></li>
                      <li class="nav-item"><a class="nav-link" href="#variants" data-toggle="tab">Variantes</a></li>
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
                            <div class="form-group col-6">
                                <label for="exampleInputEmail1">Categoría</label>
                                <select name="categoryId" id="" class="form-control">
                                    @foreach ($categories as $c=>$item)
                                        <option value="{{ $c }}">{{ $item}}</option>
                                    @endforeach
                                </select>
                            </div>    
                        </div>

                        
                      </div>
                      
                      <div class="tab-pane" id="prices">
                            @foreach($client->platforms as $platform)
                                
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="exampleInputEmail1">{{$platform->name}}</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                          <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                                        </div>
                                        <input type="number" name="prices[{{$platform->id}}]" class="form-control"  im-insert="true">
                                      </div>
                                </div>      
                            </div>

                            @endforeach
                      </div>

                      <div class="tab-pane" id="ingredients">

                        <label for="exampleInputEmail1">Agregar Ingrediente</label>
                        <div class="row">
                            <div class="form-group col-4">
                                
                                <select id="cmbIngredients" class="form-control">
                                    @foreach ($ingredients as $i=>$item)
                                        <option value="{{ $i }}">{{ $item}}</option>
                                    @endforeach
                                </select>

                            </div>    
                            <div class="col-2">
                                <button class="btn btn-sm btn-success" id="btnAddIngredient" type="button">+</button>
                            </div>
                        </div>


                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th>Cantidad</th>
                                <th>Unidad Medida</th>
                                <th>Notas</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="rowsingredients">
                               
                            </tbody>
                          </table>


                      </div>
                      

                      <div class="tab-pane" id="variants">

                        <label for="exampleInputEmail1">Agregar Variantes</label>
                        <div class="row">
                            <div class="form-group col-4">
                                
                                <select id="cmbVariants" class="form-control" onchange="loadOptions(this)";>
                                    @foreach ($variants as $variant)
                                        <option value="{{ $variant->id }}">{{ $variant->name}}</option>
                                    @endforeach
                                </select>

                            </div>    
                        </div>

                        <div class="row">
                            <div class="form-group col-4">
                                
                                <select id="cmbOptions" class="form-control">
                                
                                    @foreach ($variants[0]  ->options as $option)
                                        <option value="{{ $option->id }}">{{ $option->name}}</option>
                                    @endforeach
                                
                                </select>

                            </div>    
                            <div class="col-2">
                                <button class="btn btn-sm btn-success" id="btnAddVariant" type="button">+</button>
                            </div>
                        </div>


                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr>
                                <th>Variante</th>
                                <th>Opción</th>
                                <th>Costo Extra</th>
                                <th></th>
                              </tr>
                            </thead>
                            <tbody id="rowsoptions">
                               
                            </tbody>
                          </table>
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
        $("#btnAddIngredient").click(function(){

            var id = $("#cmbIngredients").val();
            var ingredientText = $("#cmbIngredients option:selected").text();

            if(id == null || ingredientText == null){
                return;
            }

            var timestamp = Date.now();
            var html = getIngredientTemplate(timestamp, ingredientText, id)
            $("#rowsingredients").append(html);
            
            $("#cmbIngredients option:selected").remove();            
        });

        $("#btnAddVariant").click(function(){

            var id = $("#cmbOptions").val();
            var variantId = $("#cmbVariants").val();

            var OptionText = $("#cmbOptions option:selected").text();
            var VariantText = $("#cmbVariants option:selected").text();

            if(id == null || OptionText == null){
                return;
            }

            var timestamp = Date.now();
            var html = getOptionTemplate(timestamp, variantId, VariantText, OptionText, id)
            $("#rowsoptions").append(html);
            $("#cmbOptions option:selected").remove();            
        });

    })

    function loadOptions(x){
        var id = $("#cmbVariants").val();

        $("#cmbOptions").html("");

        @foreach($variants as $variant)
            if({{$variant->id}} == id){
                @foreach($variant->options as $option)
                    $("#cmbOptions").append(" <option value='{{ $option->id }}'>{{ $option->name}}</option>");
                @endforeach
            }
        @endforeach
    }

    function getIngredientTemplate(i, name, id){
        var html = `
                <tr id="${i}">
                    <td id='ingredient${i}'><input type="hidden" class="form-control" id="ingredientId${i}" name="ingredient[${i}][ingredientId]" value="${id}">${name}</td>
                    <td><input type="number" class="form-control" name="ingredient[${i}][quantity]" id="quantity_${i}"></td>
                    <td>
                        <select id="measurementUnits" name="ingredient[${i}][measurementUnitId]" class='form-control'>
                            @foreach ($measurementUnits as $i=>$item)
                                <option value="{{$i}}">{{$item}}</option>
                            @endforeach
                        </select>
                    </td>
                    
                    <td>
                        <input type="text" class="form-control" name="ingredient[${i}][notes]" id="notes_${i}">
                    </td>
                    <td>
                        <div data-repeater-delete="" onclick="deletetemplate(${i})"
                                class="btn-md btn btn-danger m-btn m-btn--icon m-btn--pill">
                            <span>
                                <i class="fa fa-trash"></i>
                            </span>
                        </div>
                    </td>
                </tr>`;

        return html;
    }

    function getOptionTemplate(i, variantId, variante, option, optionId){
        var html = `
                <tr id="${i}">
                    <td id='variante${i}'>${variante}<input type="hidden" class="form-control" id="variantId${i}" value="${variantId}"></td>
                    <td id='option${i}'><input type="hidden" class="form-control" id="optionId${i}" name="option[${i}][optionId]" value="${optionId}">${option}</td>
            
                    <td><input type="number" step="any" class="form-control" name="option[${i}][extraCost]" id="extraCost_${i}"></td>
                    
                    <td>
                        <div data-repeater-delete="" onclick="deletetemplateoption(${i})"
                                class="btn-md btn btn-danger m-btn m-btn--icon m-btn--pill">
                            <span>
                                <i class="fa fa-trash"></i>
                            </span>
                        </div>
                    </td>
                </tr>`;

        return html;
    }

    function deletetemplate(i){
        var RecoveredIngredientId =  $("#ingredientId" + i).val(); 
        var RecoveredIngredient = $("#ingredient" + i).text();

        var o = new Option(RecoveredIngredient, RecoveredIngredientId);
        $(o).html(RecoveredIngredient);
        $("#cmbIngredients").append(o);

        $("#" + i).remove();
    }

    function deletetemplateoption(i){
        var Variantid = $("#cmbVariants").val();
        var RecoveredOptionId =  $("#optionId" + i).val(); 
        var RecoveredVariantId =  $("#variantId" + i).val(); 
        var RecoveredOption = $("#option" + i).text();

        if(Variantid == RecoveredVariantId){
            var o = new Option(RecoveredOption, RecoveredOptionId);
            $(o).html(RecoveredOption);
            $("#cmbOptions").append(o);
        }

        $("#" + i).remove();
    }

</script>
@endsection
