@extends('layouts.app')
@section('title', 'Armado de Caja')

@section('breadcrumb')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="#">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('boxbuilding') }}">Armado de caja</a></li>
    </ol>
@endsection

@section('content')


    <br>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-dark">
                    <div class="row">
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <h3 class="card-title">Productos seleccionados</h3>
                        </div>                        
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            Precio Caja $ <span>{{$box->price}}</span>
                        </div>
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            % Ganancia <span id="spanPercentage"></span>
                        </div>

                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="">
                                Total $ <span id="spanTotal"></span>
                            </div>        
                        </div>
                    </div>

                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead class="bg-success">
                            <tr>
                                <th>Categoría</th>
                                <th>Nombre</th>
                                <th>PU</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="rowsoptions">
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

    <button class="btn btn-success">Guardar Caja</button>

    <br><br>

    <div class="card">

        <div class="card-header" id="categoriaFijo">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <h3 class="card-title">Productos Fijos</h3>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                    <input type="hidden" id="contenerFijo" value="2">
                    Seleccionados: <input type="text"  style="width:50px" readonly id="seleccionadosFijo" value="0"></span>        
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="float-sm-right">
                        <button class="btn btn-xs btn-info" data-toggle="collapse" data-target=".collapseFixed">Ver más</button>
                    </div>        
                </div>
            </div>
            
        </div>

        <div class="card-body collapseFixed collapse out">
            <div class="row">
                @foreach ($fixedcontains as $fixed)
                    <div class="col-sm-4 col-md-3 col-lg-2 text-center">
                        <div class="card card-row card-default" id="{{ $fixed['id'] }}" onclick="addProduct({{ $fixed['id'] }})"
                            data-productid="{{ $fixed['id'] }}" data-price="{{ $fixed['price'] }}"  data-category="Productos Fijos"
                            data-name="{{ $fixed['name'] }}" data-categoryid="Fijo">
                            <div class="card-header bg-primary">
                                <h3 class="card-title" style="font-size: 15px; height:25px;">
                                    {{ $fixed['name'] }}
                                </h3>
                            </div>
                            <div class="card-body" id="body_nuevos">
                                @if (File::exists($fixed['imageUrl']))
                                    <img src="{{ asset($fixed['imageUrl']) }}" class="img-thumbnail"
                                        style="object-fit: cover;width:90px;height:90px">
                                @else
                                    <img src="{{ asset('images/not-found.png') }}" class="img-thumbnail"
                                        style="object-fit: cover;width:90px;height:90px">
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

    </div>

    @foreach ($data as $d)

        @php 
            $elements = 0;

            foreach($d['contains'] as $contain){
                $elements = $elements + $contain['quantity'];
            }

        @endphp

        <div class="card">

            <div class="card-header" id="categoria{{$d['type'][0]['id']}}">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 ">
                        <h3 class="card-title">{{ $d['type'][0]['name'] }} ({{ $elements }}) <h3>        
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        Disponibles: {{ $d['contains'][0]['productCount'] }}
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                        <input type="hidden" id="contener{{$d['type'][0]['id']}}" value="{{ $elements }}"> &nbsp; &nbsp; &nbsp; 
                        Seleccionados: <input type="text"  style="width:50px" readonly id="seleccionados{{$d['type'][0]['id']}}" value="0"></span>        
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 float-sm-right">
                        <div class="float-sm-right">
                            <button class="btn btn-xs btn-info" data-toggle="collapse"
                                data-target=".collapse{{ $d['type'][0]['id'] }}">Ver más</button>
                        </div>        
                    </div>
                </div>


            </div>

            <div class="card-body collapse{{ $d['type'][0]['id'] }} collapse out">
                <div class="row">
                    @foreach ($d['contains'] as $contain)

                        <div class="col-sm-6 col-md-6 col-lg-6 text-center">
                            <div class="card card-row card-default">

                                @if ($contain['productCount'] == 0)
                                    <div class="card-header bg-danger">
                                    @elseif($contain['productCount'] == $contain['quantity'] )
                                        <div class="card-header bg-warning">
                                        @else
                                            <div class="card-header bg-primary">
                                @endif

                                <h3 class="card-title" style="font-size: 15px; height:25px;">
                                    Valor: {{ $contain['value'] }} /

                                    Cantidad: {{ $contain['quantity'] }}

                                    @if (isset($contain['thematic']))
                                        / Temática: {{ $contain['thematic'] }}
                                    @endif
                                </h3>
                            </div>
                            <div class="card-body" id="body_nuevos">
                                <table class="table table-hover">

                                    @foreach ($contain['products'] as $p)
                                        @php
                                            $ticketTime = strtotime($p->expiryDate);
                                            $days = $ticketTime - time();
                                        @endphp

                                        <tr style="text-align: left;" id="{{ $p->id }}"
                                            onclick="addProduct({{ $p->id }})" data-productid="{{ $p->id }}"
                                            data-price="{{ $p->price }}" data-category="{{ $d['type'][0]['name'] }}"
                                            data-name="{{ $p->name }}" data-categoryid="{{$d['type'][0]['id']}}">
                                            <td style="text-align: left;">
                                                @if (File::exists($p->imageUrl))
                                                    <img src="{{ asset($p->imageUrl) }}" class="img-thumbnail"
                                                        style="object-fit: cover;width:50px;height:50px">
                                                @else
                                                    <img src="{{ asset('images/not-found.png') }}" class="img-thumbnail"
                                                        style="object-fit: cover;width:50px;height:50px">
                                                @endif
                                            </td>
                                            <td>{{ $p->name }} ({{ $p->stock }})</td>
                                            <td>${{ $p->price }} </td>
                                            <td>
                                                @if ($p->expiryDate != 1)
                                                    @if (round($days / 86400) < 0)
                                                        <div class="alert alert-danger">
                                                            Caducado hace {{ round(@$days / 86400) }} días
                                                        @elseif(round($days/ 86400) < 60) <div
                                                                class="alert alert-warning">
                                                                ¡Próximo a caducar en {{ round(@$days / 86400) }} días!
                                                    @endif

                            </div>
                    @endif

                    </td>
                    </tr>

    @endforeach
    </table>

    </div>
    </div>
    </div>

    @endforeach
    </div>
    </div>
    </div>
    @endforeach


    {{-- --------------- --}}

@endsection


@section('extra-js')
    <script>
        total = 0;
        boxPrice = {{$box->price}};

        function addProduct(x) {

            var id = $("#" + x).data('productid');
            var price = $("#" + x).data('price');
            var name = $("#" + x).data('name');
            var category = $("#" + x).data('category');
            var categoryid = $("#" + x).data('categoryid');


            var timestamp = Date.now();


            html = getTemplate(timestamp, id, price, name, category, categoryid);

            $("#rowsoptions").append(html);

            total = parseFloat(total) + parseFloat(price);
            total = total.toFixed(2);

            $("#spanTotal").text(total);
            percentage = ((total / boxPrice - 1) * - 1 )* 100;
            $("#spanPercentage").text(percentage.toFixed(2));

            var seleccionados = $("#seleccionados" + categoryid).val();
            seleccionados = parseFloat(seleccionados) + 1;
            $("#seleccionados" + categoryid).val(seleccionados);

            var contener = $("#contener" + categoryid).val();

            if(parseFloat(seleccionados) == parseFloat(contener)){
                $("#categoria" + categoryid).addClass("bg-success");
            }


        }

        function getTemplate(i, id, price, name, category, categoryid) {
            var html = `
                <tr id="${i}" class="bg-light color-palette">
                    <td>${category}</td>                
                    <td>${name}</td>
                    <td>$ ${price}</td>
                    <td><button data-repeater-delete="" onclick="deletetemplate(${i}, ${price}, '${categoryid}')"
                            class="btn-md btn btn-danger m-btn m-btn--icon m-btn--pill">
                            <span>
                                <i class="fa fa-trash"></i>
                            </span>
                        </button>
                    </td>
                </tr>`;



            return html;
        }

        function deletetemplate(i, price, categoryid) {
        
            $("#" + i).remove();
            total = parseFloat(total) - parseFloat(price);
            total = total.toFixed(2);

            $("#spanTotal").text(total);
            percentage = ((total / boxPrice - 1) * - 1 )* 100;
            $("#spanPercentage").text(percentage.toFixed(2));

            var seleccionados = $("#seleccionados" + categoryid).val();
            seleccionados = parseFloat(seleccionados) - 1;
            $("#seleccionados" + categoryid).val(seleccionados);

            var contener = $("#contener" + categoryid).val();

            if(parseFloat(seleccionados) < parseFloat(contener)){
                $("#categoria" + categoryid).removeClass("bg-success");
            }
        }


    </script>
@endsection
