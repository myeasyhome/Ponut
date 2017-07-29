<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>@yield('page_title')</title>
    <meta name="description" content="description here">
    <meta name="keywords" content="keywords, here">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/ico" href="{{ asset('assets/img/favicon.ico') }}" />
    @include('partials.header')
    @include('partials.extra_header')
</head>

<body class="light-skin blank">
    @yield('content')
    @include('partials.footer')
    @include('partials.extra_footer')
</html>