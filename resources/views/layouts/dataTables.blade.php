<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Community Resource Allocation</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">--}}
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs-3.3.6/jq-2.2.3/dt-1.10.12/r-2.1.0/datatables.min.css"/>
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }

        td.details-control {
            background: url('https://datatables.net/examples/resources/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('https://datatables.net/examples/resources/details_close.png') no-repeat center center;
        }
        .privacy{
            width:90%;
            margin:0 auto;
            vertical-align:middle;
        }
    </style>
</head>

<body>
    @include('layouts._NavBar')

    <div class="container" style="padding-left: 3px; padding-right: 3px;">
        @if (Session::has('flash_message'))
            <div class="alert alert-success">
                {{ Session::get('flash_message') }}
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            </div>
        @endif
        @yield('content')
    </div>
    <!-- Footer -->
    <div class="container_24">
        <img src="{{ asset('images/mountains.png') }}" alt="Image of Mountains" class="img-responsive center-block">
    </div>
    <aside id="asidelinks">
        <div id="linksblock" class="container_24">
            <article class="grid_6"><!-- com.omniupdate.editor csspath="/_resources14/ou/editor/maincontent.css" cssmenu="/_resources14/ou/editor/maincontent.txt" -->
                <div class="container">
                    <div class="row"  style="padding-top:50px">
                        <div class="col-xs-6">

                            <p >
                                Human Services Program <br>
                                Department of Counseling &amp; Human Services<br>
                                PO Box 70701<br>Johnson City, TN 37614 <br>
                                423-439-7692</p>
                        </div>

                        <div class="col-xs-6"  style="padding-top:35px">
                            <p align="right">
                                East Tennessee State University<br>
                                PO Box 70300 |  Johnson City, TN 37614<br>
                                423-439-1000 | <a href="mailto:info@etsu.edu">info@etsu.edu</a></p>

                        </div>
                        <div class="col-xs-12">
                            <p style="border-bottom: 1px solid #7790ab"></p>
                        </div>
                    </div>

                </div>


            </article>
        </div>
    </aside>
    <footer>
        <article class="grid_6 privacy">
            <div class="col-md-offset-4"><span>East Tennessee State University</span>&nbsp;<span id="directedit">
                <!-- com.omniupdate.ob --><a id="de" href="http://a.cms.omniupdate.com/10?skin=etsu&amp;account=east-tennessee-state&amp;site=ETSU_Web_Linux&amp;action=de&amp;path=/coe/chs/humanservices/default.pcf" style="text-decoration:none;">©</a><!-- /com.omniupdate.ob -->
             </span>&nbsp; <span id="year">2016</span>&nbsp; All Rights Reserved &nbsp;&nbsp;&nbsp;|&nbsp;&nbsp; <a href="http://www.etsu.edu/etsuhome/documents/webprivacystatement.pdf">Privacy Policy</a>
            </div>
        </article>
        <div id="hidden"></div>
    </footer>
    @yield('footer')

    <!-- jQuery -->
    {{--<script src="//code.jquery.com/jquery.js"></script>--}}
    <!-- DataTables -->
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs-3.3.6/jq-2.2.3/dt-1.10.12/r-2.1.0/datatables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('/js/app.js') }}"></script>

    <!-- Bootstrap JavaScript -->
    {{--<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>--}}
    <!-- App scripts -->
    @stack('scripts')


</body>
</html>