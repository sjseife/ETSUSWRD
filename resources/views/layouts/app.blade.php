<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/style.css">

    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top" style="background-color:#041E42; height:70px">
        <div class="container">
            {{--This if statement sets up toastr to recieve flash messages from laravel's flash package.--}}
            @if (session()->has('flash_notification.message'))
                <script>
                    @if(session('flash_notification.level') == 'success')
                        toastr.success('{{session('flash_notification.message')}}');
                    @elseif(session('flash_notification.level') == 'danger')
                        toastr.error('{{session('flash_notification.message')}}');
                    @elseif(session('flash_notification.level') == 'info')
                        toastr.info('{{session('flash_notification.message')}}');
                    @endif
                </script>
            @endif
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="/images/header_logo_2014.png" style="width:190px;">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    <!-- Footer -->
    <div class="container_24">
        <img src="/images/mountains.png" alt="Image of Mountains" class="img-responsive center-block">
    </div>
    <aside id="asidelinks">
        <div id="linksblock" class="container_24">
            <article class="grid_6"><!-- com.omniupdate.editor csspath="/_resources14/ou/editor/maincontent.css" cssmenu="/_resources14/ou/editor/maincontent.txt" -->
                <p style="border-bottom: 1px solid #7790ab">
                    Human Services Program <br>Department of Counseling &amp; Human Services<br>PO Box 70701<br>Johnson City, TN 37614 <br>423-439-7692
                </p>
                <p style="padding-top: 20px;">East Tennessee State University<br>
                    PO Box 70300 |  Johnson City, TN 37614<br>
                    423-439-1000 | <a href="mailto:info@etsu.edu">info@etsu.edu</a>
                </p>
            </article>
        </div>
    </aside>
    <footer></div>
        <div class="main">
            <div class="privacy"><span>East Tennessee State University</span>&nbsp;<span id="directedit">
                <!-- com.omniupdate.ob --><a id="de" href="http://a.cms.omniupdate.com/10?skin=etsu&amp;account=east-tennessee-state&amp;site=ETSU_Web_Linux&amp;action=de&amp;path=/coe/chs/humanservices/default.pcf" style="text-decoration:none;">©</a><!-- /com.omniupdate.ob -->
             </span>&nbsp; <span id="year">2016</span>&nbsp; All Rights Reserved &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp; <a href="/etsuhome/documents/webprivacystatement.pdf">Privacy Policy</a>
            </div>
        </div>
        <div id="hidden"></div>
    </footer>
    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
