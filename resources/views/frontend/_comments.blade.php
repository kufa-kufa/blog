<div class="blog-comments">
    <h4 class="comments-count">{{ trans('form.Comments') }} {{ $post->comments->count() > 0 ? $post->comments->count(): '' }} </h4>
    @forelse ($post->comments as $comment)
        <div id="comment-1" class="comment clearfix">
            <img src="/avatars/{{ $comment->user->avatar }}" class="comment-img  float-left" alt="">
            <h5><a href="">{{ $comment->user->name }}</a></h5>
            <time datetime="{{ $comment->created_at->diffForHumans() }}">{{ $comment->created_at->diffForHumans() }}</time>
            {!! $comment->body !!}
        </div><!-- End comment #1 -->
    @empty
        <div class="panel panel-default">
            <div class="panel-heading">{{ trans('form.Not_Found')}}!!</div>

            <div class="panel-body">
                <p>{{ trans('form.Sorry_No_comment_found_for_this_post') }}</p>
            </div>
        </div>
    @endforelse
</div><!-- End blog comments -->




