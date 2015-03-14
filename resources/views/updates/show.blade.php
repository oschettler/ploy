@extends('app')

@section('content')
    <h1>
        <div class="actions">
            <a title="rerun this update" href="{{ route('updates.run', $update->id) }}"><i class="glyphicon glyphicon-refresh"></i></a>
        </div>
        Update <em>{{ $update->created_at }}</em></h1>

    <ol class="breadcrumb">
        <li><a href="/home">Repositories</a></li>
        <li><a href="{{ route('repos.show', $update->branch->repo->id) }}">Repo <em>{{ $update->branch->repo->name }}</em></a></li>
        <li><a href="{{ route('branches.show', $update->branch->id) }}">Branch <em>{{ $update->branch->name }}</em></a></li>
        <li class="active">Update <em>{{ $update->created_at }}</em></li>
    </ol>

    @foreach ($update->logs->all() as $log)
        <pre class="log"><span class="timestamp">{{ $log->created_at }}</span>{{ $log->message }}</pre>
    @endforeach
@endsection
