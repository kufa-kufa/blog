@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ trans('form.Comments') }}

                            <a href="{{ url('admin/comments/create') }}" class="btn btn-default pull-right">{{ trans('form.Create_New') }}</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('form.Post') }}</th>
                                    <th>{{ trans('form.Comment') }}</th>
                                    <th>{{ trans('form.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comments as $comment)
                                    <tr>
                                        <td>{{ $comment->post->title }}</td>
                                        <td>{!! $comment->body !!}</td>
                                        <td>
                                            <a href="{{ url("/admin/comments/{$comment->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="{{ trans('form.Are_you_sure') }}" class="btn btn-xs btn-danger">{{ trans('form.Delete') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">{{ trans('form.No_comment_available') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $comments->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
