<div class="reply-form">
    <h4>{{ trans('form.Write_your_comment') }}</h4>
    {!! Form::open(['url' => "posts/{$post->id}/comment"]) !!}
        <div class="row">
        </div>
        <div class="row">
            <div class="col form-group">
                {!! Form::textarea('comment', null, ['class' => 'form-control', 'rows' => 3, 'required', 'placeholder'=>trans('form.Your_Comment')]) !!}
            </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ trans('form.Post_Comment') }}</button>

    {!! Form::close() !!}

</div>
