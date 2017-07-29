@extends('layouts.dialog')

@section('page_title', $page_title)

@section('content')
    <div class="error-container">
        <i class="pe-7s-way text-success big-icon"></i>
        <h1>503</h1>
        <strong>{{ trans('messages.error_503_head') }}</strong>
        <p>{{ trans('messages.error_503_main') }}</p>
        <a href="index.html" class="btn btn-xs btn-success">{{ trans('messages.error_503_button') }}</a>
    </div>
@endsection