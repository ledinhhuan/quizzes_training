<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>
        @yield('title')
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    <link href="{{ asset('assets/css/material-kit.css?v=2.0.5') }}" rel="stylesheet"/>
    @toastr_css
</head>

<body class="{{ route_class() }}-page sidebar-collapse">

@include('partials.home.navbar')

@yield('content')

@include('partials.home.scripts')
@toastr_js
@toastr_render
@yield('scripts')
</body>

</html>
