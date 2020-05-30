@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ trans('form.Tags') }}

                            <a href="{{ url('admin/tags/create') }}" class="btn btn-default pull-right">{{ trans('form.Create_New') }}</a>
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('form.Title') }}</th>
                                    <th>{{ trans('form.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($tags as $tag)
                                    <tr>
                                        <td>{{ $tag->name }}</td>
                                        <td>
                                            <a href="{{ url("/admin/tags/{$tag->id}/edit") }}" class="btn btn-xs btn-info">{{ trans('form.Edit') }}</a>
                                            <a href="{{ url("/admin/tags/{$tag->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="{{ trans('form.Are_you_sure') }}" class="btn btn-xs btn-danger">{{ trans('form.Delete') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">{{ trans('form.No_tag_available') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $tags->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
