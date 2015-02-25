@extends('app')

@section('content')
<p><a href="{{ URL::to('scripts/create') }}">Create a Script</a></p>
<div class="container">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($scripts as $script)
            <tr>
                <td>{{ $script->name }}</td>
                <td>
                    {!! Form::open(['url' => 'scripts/destroy/' . $script->id, 'class' => 'pull-right', 'method' => 'POST']) !!}
                        {!! Form::submit('Delete this Script', array('class' => 'btn btn-warning')) !!}
                    {!! Form::close() !!}
                    <a class="btn btn-small btn-success" href="{{ URL::to('scripts/' . $script->id) }}">
                        Show this Script
                    </a>
                    <a class="btn btn-small btn-info" href="{{ URL::to('scripts/edit/' . $script->id) }}">
                        Edit this Script
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
