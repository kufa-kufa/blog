@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h2>
                            {{ trans('form.Profile') }}
                        </h2>
                    </div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th colspan="2">{{ trans('form.User_Information') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ trans('form.Name') }}</td>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('form.E-Mail_Address') }}</td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('form.Registered') }}</td>
                                    <td>{{ $user->created_at->format('d-m-Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('form.Is_Admin') }}</td>
                                    <td>{{ $user->is_admin ? trans('form.Yes') : trans('form.No') }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('form.API_Token') }}</td>
                                    <td>{{ $user->api_token }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('form.No_of_Posts') }}</td>
                                    <td>{{ $user->posts_count }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('form.Number_of_Comments') }}</td>
                                    <td>{{ $user->comments_count }}</td>
                                </tr>
                                <tr>
                                    <td>{{ trans('form.Avatar') }}</td>
                                    <td><img src="/avatars/{{ $user->avatar }}" style="width: 150px;"></img></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
