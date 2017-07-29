@extends('layouts.dialog')

@section('page_title', $page_title)

@section('content')
    <div class="login-container">
        <br/><br/>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>{{ trans('messages.setup_form_3_title') }}</h3>
                </div>
                <div class="hpanel">
                    <div class="panel-body">
                        <form method="post" action="{{ route('api.setup.action.third_step') }}" id="third_setup_step">
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.setup_form_3_username') }}</label>
                                <input type="text" required="required" placeholder="admin" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.setup_form_3_email') }}</label>
                                <input type="email" required="required" placeholder="admin@ponut.com" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.setup_form_3_password') }}</label>
                                <input type="password" required="required" placeholder="********" name="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success btn-block ladda-button" disabled="disabled" data-style="slide-up"><span class="ladda-label">{{ trans('messages.setup_form_3_finish_button') }}</span></button>
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
