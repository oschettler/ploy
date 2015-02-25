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

    {!! Form::submit('Create the Script!', array('class' => 'btn btn-primary')) !!}

    {!! Form::close() !!}
</div>
@stop