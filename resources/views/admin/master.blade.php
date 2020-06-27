<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>
            Quiz Test - @yield('title')
        </title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta property="og:title" content="LaraQuiz - how well do you know Laravel?" />
        <meta property="og:description" content="Mini-project with Quiz" />
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/components.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/quickadmin-layout.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/quickadmin-theme-default.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/custom.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/jquery-ui.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/admin/js/jquery.dataTables.min.js') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/select.dataTables.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/jquery-ui-timepicker-addon.min.css') }}"/>
        <link rel="stylesheet" href="{{ asset('assets/admin/css/bootstrap-datepicker.standalone.min.css') }}"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body class="page-header-fixed">
        <div class="page-header navbar navbar-fixed-top">
            <div class="page-header-inner">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">@lang('admin.lara_quizz')</a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="clearfix"></div>

        <div class="page-container">
            <div class="page-sidebar-wrapper">
                <div class="page-sidebar-wrapper">
                    <div class="page-sidebar navbar-collapse collapse">
                        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                            <li class="{{ \Request::route()->getName() == 'admin.index' ? 'active' : '' }}">
                                <a href="{{ route('admin.index') }}">
                                    <i class="fa fa-gears"></i>
                                    <span class="title">@lang('admin.dashboard')</span>
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'admin.get.list.topic' ? 'active' : '' }}">
                                <a href="{{ route('admin.get.list.topic') }}">
                                    <i class="fa fa-gears"></i>
                                    <span class="title">@lang('topic.topics')</span>
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'admin.get.list.question' ? 'active' : '' }}">
                                <a href="{{ route('admin.get.list.question') }}">
                                    <i class="fa fa-gears"></i>
                                    <span class="title">@lang('admin.questions')</span>
                                </a>
                            </li>
                            <li class="{{ \Request::route()->getName() == 'admin.get.list.user' ? 'active' : '' }}">
                                <a href="{{ route('admin.get.list.user') }}">
                                    <i class="fa fa-gears"></i>
                                    <span class="title">@lang('admin.users')</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <form method="POST" action="#" accept-charset="UTF-8" style="display:none;" id="logout">
                    @csrf
                    <button type="submit">@lang('Logout')</button>
                </form>
            </div>
        </div>
        <form method="POST" action="#" accept-charset="UTF-8" style="display:none;" id="logout">
            @csrf
            <button type="submit">@lang('Logout')</button>
        </form>
    </div>
@yield('content')

@include('admin.footer')
@yield('script')
</body>
</html>
