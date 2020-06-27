<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}"/>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>@yield('title')</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <meta name="viewport" content="width=device-width"/>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet"/>
    <link href="{{ asset('assets/css/material-dashboard.css??v=1.2.1') }}" rel="stylesheet"/>
    @toastr_css
    <style type="text/css">
        ::-webkit-scrollbar { 
            display: none; 
        }
    </style>
</head>

<body>
<div class="wrapper">
    @include('partials.admin.sidebar')
    <div class="main-panel">
        @include('partials.admin.navbar')

        @yield('content')

        @include('partials.admin.footer')
    </div>
</div>
</body>

@include('partials.admin.scripts')
@toastr_render
@yield('scripts')
</html>
