@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ trans('form.Users') }}
                            <a href="{{ url('/home') }}" class="btn btn-default pull-right">{{ trans('form.Go_Back') }}</a>
                        </h2>

                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ trans('form.Name') }}</th>
                                    <th>{{ trans('form.E-Mail_Address') }}</th>
                                    <th>{{ trans('form.Admin') }}?</th>
                                    <th>{{ trans('form.No_of_Posts') }}</th>
                                    <th>{{ trans('form.Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ ($user->is_admin)?'Yes':'No' }}</td>
                                        <td>{{ $user->posts_count }}</td>
                                        <td>
                                            <a href="{{ url("/admin/users/{$user->id}") }}" data-method="DELETE" data-token="{{ csrf_token() }}" data-confirm="{{ trans('form.Are_you_sure') }}" class="btn btn-xs btn-danger">{{ trans('form.Delete') }}</a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2">{{ trans('form.No_user_available') }}</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                        {!! $users->links() !!}

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
