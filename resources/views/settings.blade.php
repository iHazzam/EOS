@extends('layout')

@section('header')
    <section class="content-header">
        <h1>
            Playdale Export Order System<small>Change account settings</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{ url(config('backpack.base.route_prefix', 'admin')) }}">{{ config('backpack.base.project_name') }}</a></li>
            <li class="active">User Settings</li>

        </ol>
    </section>
@endsection


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                <div class="box-header with-border">
                    <div class="box-title">Reset Password</div>
                </div>
                <div class="box-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset/internal') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" hidden>
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{Auth::user()->email}}" hidden>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>

                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-header with-border">
                    <div class="box-title">PlayBot link account</div>
                </div>
                <div class="box-body">
                    <div class="section">
                        <p>
                            To link your account, please send a message to "Playbot" on facebook saying "whoami" without the quotes. This will tell you your app-specific uid to link your account.
                        </p>
                    </div>
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/social/link/account') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('account') ? ' has-error' : '' }}" >
                            <label for="account" class="col-md-4 control-label">Facebook Account ID</label>
                            <div class="col-md-6">
                                <input id="account" type="text" class="form-control" name="account" value="">

                                @if ($errors->has('account'))
                                    <span class="help-block">
                                            <strong>{{ $errors->first('account') }}</strong>
                                        </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Link!
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="box-header with-border">
                    <div class="box-title">Playdale contact details</div>
                </div>
                <div class="box-body">
                    For any other changes to your account, please contact your Playdale account manager by either email (EMAIL_VAL) or phone (PHONE_VAL) and they will be happy to assist you!
                </div>

            </div>
        </div>
    </div>
@endsection
