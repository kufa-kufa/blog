@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ trans('form.Create_Comment') }}

                            <a href="{{ url('admin/comments') }}" class="btn btn-default pull-right">{{ trans('form.Go_Back') }}</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        {!! Form::open(['url' => '/admin/comments', 'class' => 'form-horizontal', 'role' => 'form']) !!}

                        @include('admin.comments._form')

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-2">
                                <button type="submit" class="btn btn-primary">
                                    {{ trans('form.Create') }}
                                </button>
                            </div>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
