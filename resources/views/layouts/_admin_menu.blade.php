<ul class="nav navbar-nav">
    <li><a href="{{ url('admin/posts') }}">{{ trans('form.Posts') }}</a></li>
    <li><a href="{{ url('admin/categories') }}">{{ trans('form.Categories') }}</a></li>
    <li><a href="{{ url('admin/comments') }}">{{ trans('form.Comments') }}</a></li>
    <li><a href="{{ url('admin/tags') }}">{{ trans('form.Tags') }}</a></li>

    @if (Auth::user()->is_admin)
        <li><a href="{{ url('admin/users') }}">{{ trans('form.Users') }}</a></li>
    @endif
</ul>
