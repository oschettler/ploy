@extends('app')

@section('content')
<h1>Latest Updates</h1>

<table class="table table-striped">
    <thead>
    <tr>
        <th class="name">Repo</th>
        <th class="name">Branch</th>
        <th class="name">Status</th>
        <th class="updated">Last updated</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($updates as $update)
        <tr>
            <td>
                <a href="{{ route('repos.show', [$update->branch->repo->id]) }}">{{ $update->branch->repo->name }}</a>
            </td>
            <td><a href="{{ route('branches.show', [$update->branch->id]) }}">{{ $update->branch->name }}</a></td>
            <td>{{ $update->status }}</td>
            <td><a href="{{ route('updates.show', [$update->id]) }}">{{ $update->updated_at }}</a></td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination-wrapper">
    {!! $updates->render() !!}
</div>
@stop
