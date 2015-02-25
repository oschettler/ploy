@extends('app')

@section('content')
    <div class="container">
        <h1>Edit {{ $script->name }}</h1>

        {!! HTML::ul($errors->all()) !!}

        {!! Form::model($script, ['route' => ['scripts.update', $script->id], 'method' => 'POST']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Name') !!}
            {!! Form::text('name', null, array('class' => 'form-control')) !!}
        </div>

        {!! Form::submit('Edit the Script!', array('class' => 'btn btn-primary')) !!}

        {!! Form::close() !!}
    </div>
@stop