<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>{{ config('app.name') }}</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap3/css/bootstrap.min.css') }}">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/AdminLTE/css/skins/_all-skins.css') }}">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/iCheck/skins/all.css') }}">


    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datepicker/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/timepicker/jquery.timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/calendar/css/jquery-calendar.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @yield('css')
</head>

<body class="skin-purple-light sidebar-mini">
@php
    $avatarUrl = \App\Http\Controllers\ProfileController::getAvatarUrl();
    $lastThreads = \App\Http\Controllers\MessageController::lastThreads();
    $countThreads = \App\Http\Controllers\MessageController::countNotReaded();
@endphp

<div id="app">


    <div class="wrapper">
        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="logo">
                <b>{{ config('app.name') }}</b>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                @if (!Auth::guest())
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope"></i>
                                @if($countThreads > 0)
                                    <span class="label label-info">{{ $countThreads }}</span>
                                @endif
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">Tienes {{ $countThreads }} Mensajes</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu nav">
                                        @if($lastThreads)
                                            @foreach($lastThreads as $thread)
                                                <li class="{{ (auth()->user()->id != $thread->thread->sender->id && !$thread->thread->is_seen )?'active':'' }}"><!-- start message -->
                                                    <a href="{{route('messenger.read', ['id'=>$thread->withUser->id])}}">
                                                        <div class="pull-left">
                                                            <img src="{{ \App\Http\Controllers\ProfileController::getAvatarUrlUser($thread->withUser) }}" class="img-circle" alt="User Image">
                                                        </div>
                                                        <h4>
                                                            {{$thread->withUser->name}}
                                                            <small><i class="fa fa-clock-o"></i> {{ $thread->thread->humans_time }}</small>
                                                        </h4>
                                                        <p>
                                                            @if(auth()->user()->id == $thread->thread->sender->id)
                                                                <span class="fa fa-reply"></span>
                                                            @endif
                                                            <span>{{substr($thread->thread->message, 0, 20)}}</span>
                                                        </p>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                        <!-- end message -->
                                    </ul>
                                </li>
                                <li class="footer"><a href="{{ route('messenger.show') }}">Ver Todos</a></li>
                            </ul>
                        </li>
                        <li class="dropdown notifications-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-bell"></i>
                                <span class="label label-warning">10</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 10 notifications</li>
                                <li>
                                    <!-- inner menu: contains the actual data -->
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-aqua"></i> 5 new members joined today
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
                                                page and may cause design problems
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-users text-red"></i> 5 new members joined
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-shopping-cart text-green"></i> 25 sales made
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user text-red"></i> You changed your username
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">View all</a></li>
                            </ul>
                        </li>
                        <!-- Doctor Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{ $avatarUrl }}"
                                     class="user-image" alt="User Image"/>
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">{!! Auth::user()->name !!} {!! Auth::user()->last_name !!}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{ $avatarUrl }}"
                                         class="img-circle" alt="User Image"/>
                                    <p>
                                        {!! Auth::user()->name !!}
                                        <small>{{ __('member_since') }} {!! Auth::user()->created_at->format('d M. Y') !!}</small>
                                    </p>
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{{ route('profile.index') }}" class="btn btn-default btn-flat">{{ __('profile') }}</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('/logout') !!}" class="btn btn-default btn-flat"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('sign_out') }}
                                        </a>
                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
                @else
                    <ul class="nav navbar-nav navbar-right margin-r-5">
                        <!-- Authentication Links -->
                        <li><a href="{!! url('/login') !!}">Login</a></li>
                        <li><a href="{!! url('/register') !!}">Register</a></li>
                    </ul>
                @endif
            </nav>
        </header>

        <!-- Left side column. contains the logo and sidebar -->
        @include('layouts.sidebar')
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>

        <!-- Main Footer -->
        <footer class="main-footer" style="max-height: 100px;text-align: center">
            {{--<strong>Copyright © 2016 <a href="#">Company</a>.</strong> All rights reserved.--}}
        </footer>

    </div>

</div>
    <!-- jQuery 3.1.1 -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>

    <script src="{{ asset('plugins/bootstrap3/js/bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/moment.min.js') }}"></script>
    <script src="{{ asset('js/moment-with-locales.js') }}"></script>
    <script src="{{ asset('js/jquery.touchSwipe.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('plugins/AdminLTE/js/adminlte.min.js') }}"></script>

    <script src="{{ asset('plugins/iCheck/icheck.min.js') }}"></script>

    <script src="{{ asset('plugins/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('plugins/datepicker/js/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/timepicker/jquery.timepicker.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('plugins/calendar/js/jquery-calendar.min.js') }}"></script>

    <script src="{{ asset('js/app.js') }}"></script>
    <script !src="">
        $(document).ready(function () {
            $('#flash-overlay-modal').modal();
            $('.select2').select2({
                placeholder: "{{ __('select') }}"
            });
            $('.select2-nullable').select2({
                placeholder: "{{ __('select') }}",
                allowClear: true,
            });
            $('input').iCheck({
                checkboxClass: 'icheckbox_flat-green',
                radioClass   : 'iradio_flat-green',
                increaseArea: '20%'
            });
            $('.date').datepicker({
                'format': 'yyyy-m-d',
                'autoclose': true
            });
        });
    </script>
    @yield('scripts')
</body>
</html>
