@extends('app')

@section('content')
<div class="container">
    <h1>Scripts</h1>

    <table class="table table-striped">
        <thead>
        <tr>
            <th class="name">Name</th>
            <th>Description</th>
            <th class="updated">Last updated</th>
            <th class="actions"><a href="{{ URL::to('scripts/create') }}"><i class="glyphicon glyphicon-plus-sign"></i></a></th>
        </tr>
        </thead>
        <tbody>
        @foreach ($scripts as $script)
            <tr>
                <td>{{ $script->name }}</td>
                <td>{{ $script->description }}</td>
                <td>{{ $script->updated_at }}</td>
                <td class="actions">
                    <a title="edit script" href="{{ URL::to('scripts/edit/' . $script->id) }}">
                        <i class="glyphicon glyphicon-edit"></i>
                    </a>
                    {!! Form::open(['url' => 'scripts/destroy/' . $script->id, 'method' => 'POST']) !!}
                    <a title="delete script" class="submit" href="#"><i class="glyphicon glyphicon-trash"></i></a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
