@extends('layouts.plane')

@section('body')
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('') }}">ETSU Department of Social Work</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                @if(!Auth::guest())
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="{{ url ('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                @else
                    <li><a href="{{url('/login')}}"><i class="fa fa-key" aria-hidden="true"></i> Login</a></li>
                @endif
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        @if(!Auth::guest())
                        <li {{ (Request::is('/') ? 'class="active"' : '') }}>
                            <a href="{{ url ('') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        <li {{ (Request::is('*resources') ? 'class="active"' : '') }}>
                            <a href="{{ url ('resources') }}"><i class="fa fa-bar-chart-o fa-fw"></i> Resources</a>
                            <!-- /.nav-second-level -->
                        </li>
                        <li {{ (Request::is('*users') ? 'class="active"' : '') }}>
                            <a href="{{ url ('users') }}"><i class="fa fa-table fa-fw"></i> Users</a>
                        </li>
                        <li {{ (Request::is('*contact') ? 'class="active"' : '') }}>
                            <a href="{{ url ('contact') }}"><i class="fa fa-envelope"></i>  Contacts</a>
                        </li>
                        <li {{ (Request::is('*category') ? 'class="active"' : '') }}>
                            <a href="{{ url ('category') }}"><i class="fa fa-edit fa-fw"></i> Categories</a>
                        </li>
                        @endif
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="container">
                @yield('section')
                @if (Session::has('flash_message'))
                    <div class="alert alert-success">
                        {{ Session::get('flash_message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    </div>
                @endif
                @yield('content')
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@stop
