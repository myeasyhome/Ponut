@extends('layouts.dialog')

@section('page_title', $page_title)

@section('content')
    <div class="login-container">
        <br/><br/>
        <div class="row">
            <div class="col-md-12">
                <div class="text-center m-b-md">
                    <h3>{{ trans('messages.setup_form_2_title') }}</h3>
                </div>
                <div class="ppanel">
                    <div class="panel-body">
                        <form method="post" action="{{ route('api.action.setup.options') }}" id="second_setup_step">
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.setup_form_2_site_title') }}</label>
                                <input type="text" required="required" placeholder="Ponut" name="site_title" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.setup_form_2_site_email') }}</label>
                                <input type="email" required="required" placeholder="hello@ponut.com" name="site_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="control-label">{{ trans('messages.setup_form_2_site_url') }}</label>
                                <input type="url" required="required" placeholder="http(s)://ponut.com" name="site_url" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-success btn-block ladda-button" disabled="disabled" data-style="slide-up"><span class="ladda-label">{{ trans('messages.setup_form_2_next_button') }}</span></button>
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
