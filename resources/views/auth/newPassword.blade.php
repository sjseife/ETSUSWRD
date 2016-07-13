@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Change Password</div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="/auth/newPassword/">
                            {{ method_field('PATCH') }}
                            {{ csrf_field() }}

                            <input type="hidden" id="email" name="email" value="{{ $user->email }}" >
                            <input type="hidden" id="name" name="name" value="{{ $user->name }}" >


                            <div class="form-group">
                                {{$user['password']}}

                                <label for="oldPassword" class="col-md-4 control-label">Current Password</label>

                                <div class="col-md-6">
                                    <input type="password" id="oldPassword" class="form-control" name="oldPassword">

                                    @if ($errors['oldPassword'] != '')
                                        <span class="help-block">
                                        <strong>{{ $errors['oldPassword']}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password">

                                    @if ($errors['password'] != '')
                                        <span class="help-block">
                                        <strong>{{$errors['password']}}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation">

                                    @if ($errors['password_confirmation'] != '')
                                        <span class="help-block">
                                        <strong>{{$errors['password_confirmation'] }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-btn fa-refresh"></i> Reset Password
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
