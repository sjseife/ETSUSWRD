<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Help People</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="stylesheet" href="/css/style.css">
    <!--Select2-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

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
    @include('layouts._NavBar')
    <div class="container">
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        @endif
        @yield('content')
    </div>

    <!-- Footer -->
    <div id="footer">
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
<footer>
        <div class="main">
            <div class="privacy"><span>East Tennessee State University</span>&nbsp;<span id="directedit">
                <!-- com.omniupdate.ob --><a id="de" href="http://a.cms.omniupdate.com/10?skin=etsu&amp;account=east-tennessee-state&amp;site=ETSU_Web_Linux&amp;action=de&amp;path=/coe/chs/humanservices/default.pcf" style="text-decoration:none;">©</a><!-- /com.omniupdate.ob -->
             </span>&nbsp; <span id="year">2016</span>&nbsp; All Rights Reserved &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp; <a href="/etsuhome/documents/webprivacystatement.pdf">Privacy Policy</a>
            </div>
        </div>
        <div id="hidden"></div>
    </footer>
        </div>
    @yield('footer')

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
    @stack('scripts')

</body>
</html>
