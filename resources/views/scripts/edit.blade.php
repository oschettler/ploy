@extends('app')

@section('stylesheets')
<style>
    .ace_editor {
        height: 170px;
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

<h2>Versions</h2>

<ul>
@foreach ($last_versions as $last_version)
    <li>
        <a class="version" href="#">{{ $last_version->updated_at }}</a>
        <script type="field/body">{{ $last_version->getModel()->body }}</script>
    </li>
@endforeach
</ul>

@stop