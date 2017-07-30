@extends('layouts.dialog')

@section('page_title', $page_title)

@section('content')
    <div class="login-container">
        <br/><br/><br/>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>{{ trans('messages.forgot_password_form_title') }}</h3>
                </div>
                <div class="ppanel">
                    <div class="panel-body">
                        <form method="post" action="{{ route('api.forgot_password.action') }}" id="forgot_password_form">
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.forgot_password_form_username_email') }}</label>
                                <input type="text" placeholder="Enter your username or email" required="required" name="username" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success btn-block ladda-button" disabled="disabled" data-style="slide-up"><span class="ladda-label">{{ trans('messages.forgot_password_form_submit_button') }}</span></button>
                            <a class="btn btn-default btn-block" href="{{ route('login') }}">{{ trans('messages.forgot_password_form_login_button') }}</a>
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
