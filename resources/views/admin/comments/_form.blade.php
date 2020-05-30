
<div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
    {!! Form::label('post_id', trans('Post'), ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::select('post_id', $posts, null, ['class' => 'form-control', 'required']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('post_id') }}</strong>
        </span>
    </div>
</div>
<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
    {!! Form::label('body', trans('form.Body'), ['class' => 'col-md-2 control-label']) !!}

    <div class="col-md-8">
        {!! Form::textarea('body', null, ['class' => 'form-control', 'required', 'autofocus']) !!}

        <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong>
        </span>
    </div>
</div>
