@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ trans('form.Posts') }}

                            <a href="{{ url('admin/posts/create') }}" class="btn btn-default pull-right">{{ trans('form.Create_New') }}</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('form.Title') }}</th>
                                    <th>{{ trans('form.Author') }}</th>
                                    <th>{{ trans('form.Category') }}</th>
                                    <th>{{ trans('form.Tags') }}</th>
                                    <th>{{ trans('form.Published') }}</th>
                                    <th>{{ trans('form.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($posts as $post)
                                    <tr>
                                        <td>{{ $post->title }}</td>
                                        <td>{{ $post->user->name }}</td>
                                        <td>{{ $post->category->name }}</td>
                                        <td>{{ $post->tags->implode('name', ', ') }}</td>
                                        <td>
                                            @if ($post->published == 'Yes')
                                                <a style="color: #1c7430"><i class="icofont-checked"></i></a>
                                            @else
                                                <a style="color: #9c3328"><i class="icofont-close-squared-alt"></i></a>
                                            @endif
                                        </td>

                                        <td>
                                            @if (Auth::user()->is_admin)
                                                @php
                                                    if($post->published == 'Yes') {
                                                        $label = 'Draft';
                                                    } else {
                                                        $label = 'Publish';
                                                    }
                                                @endphp
                                                <a href="{{ url("/admin/posts/{$post->id}/publish") }}" data-method="PUT" data-token="{{ csrf_token() }}" data-confirm="{{ trans('form.Are_you_sure') }}" class="btn btn-xs btn-warning">{{ $post->published == 'Yes'? trans('form.Draft'): trans('form.Publish') }}</a>
                                            @endif
                                             <br/><a href="{{ url("/admin/posts/{$post->id}") }}" ><i class="icofont-eye" title="{{ trans('form.View') }}"></i></a>
                                            <a href="{{ url("/admin/posts/{$post->id}/edit") }}" ><i class="icofont-edit" title="{{ trans('form.Edit') }}"></i></a>
                                            <a href="{{ url("/admin/posts/{$post->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="{{ trans('form.Are_you_sure') }}"><i class="icofont-bin" title="{{ trans('form.Delete') }}"></i></a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5">No post available.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $posts->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
