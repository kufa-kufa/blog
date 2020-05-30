@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('form.Posts') }}</div>
                        <a href="{{ url('/admin/posts') }}">
                            <div class="panel-body" style="text-align: center">
                                <h1>{{ $posts }}</h1>
                            </div>
                        </a>
                </div>
            </div>


            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('form.Comments') }}</div>
                        <a href="{{ url('/admin/comments') }}">
                            <div class="panel-body" style="text-align: center">
                                <h1>{{ $comments }}</h1>
                            </div>
                        </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('form.Tags') }}</div>
                        <a href="{{ url('/admin/tags') }}">
                            <div class="panel-body" style="text-align: center">
                                <h1>{{ $tags }}</h1>
                            </div>
                        </a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ trans('form.Categories') }}</div>
                    <a href="{{ url('/admin/categories') }}">
                        <div class="panel-body" style="text-align: center">
                            <h1>{{ $categories }}</h1>
                        </div>
                    </a>
                </div>
            </div>

            @if (Auth::user()->is_admin)
                <div class="col-md-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ trans('form.Users') }}</div>
                        <a href="{{ url('admin/users') }}">
                            <div class="panel-body" style="text-align: center">
                                <h1>{{ $users }}</h1>
                            </div>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
@endsection
