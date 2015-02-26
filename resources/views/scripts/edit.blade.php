@extends('app')

@section('content')
    <div class="container">
        <h1>Edit {{ $script->name }}</h1>

        {!! HTML::ul($errors->all()) !!}

        {!! Form::model($script, ['route' => ['scripts.update', $script->id], 'method' => 'POST']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Description') !!}
            {!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 4]) !!}
        </div>

        <div class="form-group">
            {!! Form::label('body', 'Body') !!}
            {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
        </div>

        <div class="buttons">
            {!! Form::submit('Edit the Script!', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>
@stop