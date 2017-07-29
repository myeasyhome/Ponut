@extends('layouts.dialog')

@section('page_title', $page_title)

@section('content')
    <div class="login-container">
        <br/><br/>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>{{ trans('messages.login_form_title') }}</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form method="post" action="{{ route('api.login.action') }}" id="login_form">
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.login_form_username_email') }}</label>
                                <input type="text" placeholder="Username or Email" required="required" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.login_form_password') }}</label>
                                <input type="password" placeholder="******" required="required" name="password" class="form-control">
                            </div>
                            <div class="checkbox">
                                <input type="checkbox" class="i-checks" name="remember_me"> {{ trans('messages.login_form_remember_me') }}
                            </div>
                            <button type="submit" class="btn btn-success btn-block ladda-button" disabled="disabled" data-style="slide-up"><span class="ladda-label">{{ trans('messages.login_form_login_button') }}</span></button>
                            <a class="btn btn-default btn-block" href="{{ route('home.forgot_password.render') }}">{{ trans('messages.login_form_forgot_password_button') }}</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                {{ trans('messages.copyrights') }}
            </div>
        </div>
    </div>
@endsection
