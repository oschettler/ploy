@extends('app')

@section('content')

    <h1>Update <em>{{ $update->created_at }}</em></h1>

    <ol class="breadcrumb">
        <li><a href="/home">Repositories</a></li>
        <li><a href="{{ route('repos.show', $update->branch->repo->id) }}">Repo <em>{{ $update->branch->repo->name }}</em></a></li>
        <li><a href="{{ route('branches.show', $update->branch->id) }}">Branch <em>{{ $update->branch->name }}</em></a></li>
        <li class="active">Update <em>{{ $update->created_at }}</em></li>
    </ol>

    @foreach ($update->logs->all() as $log)
        <pre>{{ $log->message }}</pre>
    @endforeach
@endsection
