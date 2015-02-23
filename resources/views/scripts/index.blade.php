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
                    <a class="btn btn-small btn-success" href="{{ URL::to('scripts/' . $script->id) }}">
                        Show this Script
                    </a>
                    <a class="btn btn-small btn-info" href="{{ URL::to('scripts/edit/' . $value->id) }}">
                        Edit this Script
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@stop
