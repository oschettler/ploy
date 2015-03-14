@extends('app')

@section('content')

    <h1>Branches for Repo <em>{{ $repo->name }}</em></h1>

    <ol class="breadcrumb">
        <li><a href="/home">Repositories</a></li>
        <li class="active">Repo <em>{{ $repo->name }}</em></li>
    </ol>

    <?php
    $branches = $repo->paginatedBranches();
    ?>

    <table class="table table-striped">
        <thead>
        <tr>
            <th>Branch</th>
            <th>Status</th>
            <th>Last build</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($branches as $branch)
            <?php
            $last_update = $branch->lastUpdate();
            $status = $last_update ? $last_update->status : 'default';
            ?>
            <tr>
                <td><a href="{{ route('branches.show', $branch->id) }}">{{ $branch->name }}</a></td>
                <td><span class="label label-{{ $status }}">{{ $status }}</span></td>
                <td>{{ $last_updated->created_at or '' }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {!! $branches->render() !!}
    </div>
@endsection
