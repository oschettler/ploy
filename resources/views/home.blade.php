@extends('app')

@section('scripts')
<script>
    jQuery(function ($)
    {
        $('a.repo-script').click(function (e)
        {
            var $button = $('a.dropdown-toggle span.name', $(this).parents('.dropdown')),
                script_name = $(this).data('script-name'),
                csrf_token = $('meta[name="csrf-token"]').attr('content');

            e.preventDefault();

            $.post($(this).attr('href'), {
                _token: csrf_token,
                script_id: $(this).data('script-id')
            }, function (data)
            {
                $button.text(script_name);
            });
        });
    });
</script>
@endsection

@section('content')
        <h1>Repositories</h1>

        <table class="table table-striped" role="table">
            <thead>
                <tr><th>Name</th><th>Clone URL</th><th>Branches</th><th>Owner</th><th>Script</th></tr>
            </thead>
            <tbody>
                @foreach ($repos as $repo)
                    <tr>
                        <td>
                            <a href="{{ route('repos.show', $repo->id) }}">{{ $repo->name }}</a>
                        </td>
                        <td>
                            <a href="{{ $repo->ssh_clone_url }}">{{ $repo->ssh_clone_url }}</a>
                        </td>
                        <td>
                            @foreach ($repo->branches->all() as $branch)
                                <span class="label label-success">{{ $branch->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <a href="mailto:{{ $repo->owner_email}}">{{ $repo->owner_name}}</a>
                        </td>
                        <td class="dropdown">
                            <a class="dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                <span class="name">{{ $repo->script->name or 'Select script' }}</span>
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdown-scripts">
                                @foreach ($scripts as $script)
                                    <li role="presentation">
                                        <a class="repo-script" data-script-id="{{ $script->id }}" data-script-name="{{ $script->name }}" role="menuitem" tabindex="-1" href="{{
                                            route('repos.script', $repo->id)
                                            }}">{{ $script->name }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
@endsection
