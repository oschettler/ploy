@extends('app')

@section('content')

    <h1>Branch <em>{{ $branch->name }}</em></h1>

    <ol class="breadcrumb">
        <li><a href="/home">Repositories</a></li>
        <li><a href="{{ route('repos.show', $branch->repo->id) }}">Repo <em>{{ $branch->repo->name }}</em></a></li>
        <li class="active">Branch <em>{{ $branch->name }}</em></li>
    </ol>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Last build</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($branch->updates->all() as $update)
            <tr>
                <td><a href="{{ route('updates.show', $update->id) }}">{{ $update->created_at }}</a></td>
                <td><span class="label label-{{ $update->status }}">{{ $update->status }}</span></td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
