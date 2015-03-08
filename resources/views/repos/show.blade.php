@extends('app')

@section('content')

    <h1>Branches for Repo <em>{{ $repo->name }}</em></h1>

    <ol class="breadcrumb">
        <li><a href="/home">Repositories</a></li>
        <li class="active">Repo <em>{{ $repo->name }}</em></li>
    </ol>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Branch</th>
            <th>Last build</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($repo->branches->all() as $branch)
            <tr>
                <td><span class="label label-{{ $branch->lastUpdate()->status or 'default' }}">{{ $branch->name }}</span></td>
                <td>{{ $branch->lastUpdate()->created_at or '' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
