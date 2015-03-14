@extends('app')

@section('stylesheets')
<style>
    .ace_editor {
        height: 242px;
    }
</style>
@stop

@section('scripts')
<script src="//cdnjs.cloudflare.com/ajax/libs/ace/1.1.8/ace.js"></script>
<script>
    var editor = ace.edit("body-editor");
    editor.setTheme("ace/theme/dawn");
    editor.getSession().setMode("ace/mode/sh");

    $('#script-form').submit(function ()
    {
        $('#body-field').val(editor.getValue());
        return true;
    });

    $('#script-form').ready(function ()
    {
        editor.setValue($('#body-field').val());
    });

    $('a.version').click(function (e)
    {
        e.preventDefault();
        var body = $(this).siblings('script').html();
        editor.setValue(body);
    });

</script>
@stop

@section('content')
    <h1>{{ $page_title }}</h1>

    {!! HTML::ul($errors->all()) !!}

    {!! $form_tag !!}

        <div class="row">
            <div class="col-md-6 col-sm-6">
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', Input::old('name'), ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description') !!}
                    {!! Form::textarea('description', Input::old('description'), ['class' => 'form-control', 'rows' => 4]) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('reason', 'Reason') !!}
                    {!! Form::text('reason', Input::old('reason'), ['class' => 'form-control']) !!}
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <div class="form-group body">
                    {!! Form::label('body', 'Body') !!}
                    {!! Form::hidden('body', Input::old('body'), ['id' => 'body-field']) !!}
                    <div id="body-editor" class="form-control"></div>
                </div>
            </div>

        </div>

        <div class="buttons">
            <button class="btn btn-default">Cancel</button>
            {!! Form::submit($btn_text, ['name' => 'save', 'class' => 'btn btn-primary']) !!}
        </div>

    {!! Form::close() !!}

    @if (!empty($last_versions))
    <h2>Versions</h2>

    <table class="table table-striped">
        <thead>
            <tr><th style="width:20%">Created</th><th>Reason</th></tr>
        </thead>
        <tbody>
            @foreach ($last_versions as $last_version)
                <tr>
                    <td>
                        <a class="version" href="#">{{ $last_version->updated_at }}</a>
                        <script type="field/body">{{ $last_version->getModel()->body }}</script>
                    </td>
                    <td>{{ $last_version->reason }}</td>
                </tr>
            @endforeach
	    
        </tbody>
    </table>

    <div class="pagination-wrapper">
        {!! $last_versions->render() !!}
    </div>

    @endif

@stop
