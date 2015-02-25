@extends('app')

@section('content')
<div class="container">
    <h1>Showing {{ $script->name }}</h1>

    <div class="jumbotron text-center">
        <p>
            <strong>Description:</strong> {{ $script->description }}<br>
            <strong>Body:</strong> {{ $script->body }}
        </p>
    </div>

</div>
@stop