@extends('app')

@section('content')
<div class="container">
    <h1>Create a Script</h1>

    {!! HTML::ul($errors->all()) !!}

    {!! Form::open(array('url' => 'scripts/store')) !!}

    <div class="form-group">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', Input::old('name'), array('class' => 'form-control')) !!}
    </div>

    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', Input::old('description'), ['class' => 'form-control', 'rows' => 4]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('body', 'Body') !!}
        {!! Form::textarea('body', Input::old('body'), ['class' => 'form-control']) !!}
    </div>

    <div class="buttons">
        {!! Form::submit('Create the Script!', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
</div>
@stop