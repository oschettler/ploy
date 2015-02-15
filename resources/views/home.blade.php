@extends('app')

@section('content')
<div class="container">
    @include('partials.alert')

	<div class="row">
		<div class="col-md-10 col-md-offset-1">
    		
    		<h1>Repositories</h1>
    		
    		<table class="table table-striped" role="table">
                <thead>
                    <tr><th>Name</th><th>Owner</th><th>Branches</th><th>Script</th></tr>
                </thead>
                <tbody>
                    @foreach ($repos as $repo)
                    <tr>
                        <td>
                            <a href="{{ $repo->ssh_clone_url }}">{{ $repo->name }}</a>
                        </td>
                        <td>
                            <a href="mailto:{{ $repo->owner_email}}">{{ $repo->owner_name}}</a>
                        </td>
                        <td>
                            {{ join(', ', array_map(function ($branch) {
                                return $branch->name;
                            }, $repo->branches->all())) }}
                        </td>
                        <td>
                            <a href="#" data-id="{{ $repo->id }}" class="edit-script" data-toggle="modal" data-target="#edit-script"><i class="glyphicon glyphicon-pencil"></i></a>
                        </td>
                    </tr>
                    <script id="script-{{ $repo->id }}" type="text/plain">{{ $repo->update_script }}</script>
                    @endforeach
                </tbody>
    		</table>
		</div>
	</div>
</div>
<div class="modal fade" id="edit-script">
  <div class="modal-dialog">
    <div class="modal-content">
        {!! Form::open(['method' => 'POST']) !!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Script</h4>
          </div>
          <div class="modal-body">
            {!! Form::textarea('update_script', null, [
                'id' => 'script-text',
                'class' => 'form-control',
                'rows' => 10,
            ]) !!}
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        {!! Form::close() !!}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
