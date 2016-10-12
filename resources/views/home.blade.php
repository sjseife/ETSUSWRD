@extends('layouts.general')

@section('content')
    <style>
        .imglink {
            width: 100%;
            margin: 0 auto;
            margin-bottom: 10px;

        }
        .footerlink {
            width: 100%;
            margin-top: 0px;
            text-decoration:  none;
            margin-bottom: 20px;
            text-align: center;
        }
        a:link, a:visited {
            text-decoration:  none;
            cursor: auto;
            margin-bottom: 20px;
        }
        a:link:active, a:visited:active {
            text-decoration: none;
        }


    </style>
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel-body panel-primary">
                <div class="panel-heading"><h3>Community Resource Allocation</h3></div>

                <div class="panel-body w3-panel w3-blue w3-round-xlarge">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/events"><img src="\images\EventsImg.jpg" alt="Events" class="imglink"  ></a><h3 class="footerlink"><a  href="/Events">Events</a></h3></div>

                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/resources"><img src="\images\resourcesimg.jpg" alt="Resources" class="imglink"  ></a><h3 class="footerlink"><a  href="/resources">Resources</a></h3></div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/providers"><img src="\images\providers.png" alt="Providers" class="imglink"  ></a><h3 class="footerlink"><a  href="/providers">Providers</a></h3></div>

                    @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/contacts"><img src="\images\ContactsImg.png" alt="Contacts" class="imglink"  ></a><h3 class="footerlink"><a  href="/contacts">Contacts</a></h3></div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"><a href="/categories"><img src="\images\CategoriesImg.png" alt="Categories" class="imglink" ></a> <h3 class="footerlink"><a  href="/categories">Categories</a></h3></div>
                        @endif
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"><a href="/flags"><img src="\images\redflag.png" alt="Flags" class="imglink" ></a> <h3 class="footerlink"><a  href="/flags">Flags</a></h3></div>

                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/resources/generateReport"><img src="\images\ReportImg.gif" alt="Report" class="imglink"  ></a><h3 class="footerlink"><a  href="/resources/generateReport">Report</a></h3></div>
                        @if (Auth::user()->role == 'Admin')
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/users"><img src="\images\usersimg.png" alt="Users" class="imglink"  ></a><h3 class="footerlink"><a  href="/users">Users</a></h3></div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
