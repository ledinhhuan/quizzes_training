<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8"/>
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <title>404</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport'/>
    <link href="{{ asset('assets/css/material-kit.css?v=2.0.5') }}" rel="stylesheet"/>
</head>

<body class="{{ route_class() }}-page sidebar-collapse">

@include('partials.home.navbar')

<div class="page-header error-page header-filter" style="background-image: url('{{ asset('assets/img/bg2.jpg') }}'); text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1 class="title">404</h1>
                <h2 class="description">Page not found :(</h2>
                <h4 class="description">Ooooups! Looks like you got lost.</h4>
            </div>
        </div>
    </div>
</div>

@include('partials.home.scripts')
</body>

</html>
