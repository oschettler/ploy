@extends('app')

@section('content')
<h1>Active Jobs</h1>

<table class="table table-striped">
    <thead>
    <tr>
        <th class="name">Name</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($jobs as $job)
        <tr>
            <td><?php var_dump($job); ?></td>
        </tr>
    @endforeach
    </tbody>
</table>
@stop
