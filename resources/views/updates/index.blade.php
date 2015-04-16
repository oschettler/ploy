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
            <td>{{ $update->branch->repo->name }}</td>
            <td>{{ $update->branch->name }}</td>
            <td>{{ $update->status }}</td>
            <td>{{ $update->updated_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>

<div class="pagination-wrapper">
    {!! $updates->render() !!}
</div>
@stop
