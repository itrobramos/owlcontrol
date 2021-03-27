@extends('layouts.app')
@section('title', 'titulo de ejemplo')

@section('breadcrumb')
<ol class="breadcrumb float-sm-right">
    <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item"><a href="#">Layout</a></li>
</ol>
@endsection

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">titulo</h3>

        <div class="card-tools">

        </div>
    </div>

    
    <div class="card-body">
        contenido
    </div>
    

    <div class="card-footer">
        footer
    </div>
</div>
@endsection
