@extends('layouts.dataTables')

@section('content')
    <style>
        .imglink {
            width: 100%;
            margin: 0 auto;
            margin-bottom: 10px;

        }
        .tableText{
            margin-top:0px;
            margin-bottom:0px;
            margin: 0 auto;
            font-size: 89%;
            border:2px solid #041E42;
            white-space: nowrap;

        }
        th, td {
            padding-left: 10px;
            padding-bottom: 8px;
            padding-top: 5px;
            text-align: left;

        }
        .name{
            table-layout:fixed;
            word-wrap:break-word;
            width:20%;
        }
        .tableHeader{
            margin:0 auto;
            width:50%;
            font-size: 14px;
            border-bottom: 2px solid #041E42!important;
        }
        th{
            background-color: #FFC72C!important;
            color: #041E42!important;
        }
        .purple-btn{
            background-color: #041E42;
            color: white;
            border:2px solid #FFC72C!important;
            outline:none;
            white-space: nowrap;

        }
        .purple-btn:hover{
            background-color: #041E42;
            color: white;
            border:2px solid #FFC72C!important;
            outline:none;
        }
        .purple-btn:active{
            background-color: #041E42;
            color: white;
            border:2px solid #FFC72C!important;
            outline:none;
        }
        .purple-btn:focus{
            background-color: #041E42;
            color: white;
            border:2px solid #FFC72C!important;
            outline:none;
        }
        .orange{
            background-color: #FFC72C;
            color: #041E42;
            border:2px solid #041E42!important;
            font-weight: bold;

        }
        .orange:hover{
            background-color: #FFC72C;
            color: #041E42;
            border:2px solid #041E42!important;
            font-weight: bold;
        }
        .orange:active{
            background-color: #FFC72C;
            color: #041E42;
            border:2px solid #041E42!important;
            font-weight: bold;
        }
        .orange:focus{
            background-color: #FFC72C;
            color: #041E42;
            border:2px solid #041E42!important;
            font-weight: bold;
        }
        .purple-text{
            color: #FFC72C!important;
            border-bottom: 2px solid #041E42!important;
        }
        .view-btn{
            margin-top:15px;
        }
        .panel-heading{
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
            border:3px solid #FFC72C!important;
            background-color:#041E42!important;
            vertical-align: middle;
        }
        .panel-body{
            border: none!important;
        }
        .panel-primary{
            border: none!important;
            background-color: #ffffff!important;
        }
        .zeroTopMargin{
            margin-top: 0px;
            margin-bottom:0px;
        }
        .footerlink {
            width: 100%;
            margin-top: 0px;
            text-decoration:  none;
            margin-bottom: 20px;
            text-align: center;
            font-size:160%;
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
        <div class="row " >
            <div class="col-md-10 col-md-offset-1 ">
                <div class="panel-body panel-primary zeroTopMargin">
                    <div class="panel-heading sw-heading"> <h4 class="siteheading">Department of Social Work<br></h4><p class="sitesubheading">College of Arts & Sciences</p></div>

                    <div class="panel-body w3-panel w3-blue w3-round-xlarge">

                        <div class="row">
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 "><a href="/archive_events"><img src="\images\archive-events-y.png" alt="Archived Events" class="imglink"  ></a><h3 class="footerlink"><a  href="/archive_events">Archived Events</a></h3></div>

                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 "><a href="/archive_resources"><img src="\images\archive-resources-b.png" alt="Archived Resources" class="imglink"  ></a><h3 class="footerlink"><a  href="/archive_resources">Archived Resources</a></h3></div>

                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 "><a href="/archive_contacts"><img src="\images\archive-contacts-y.png" alt="Archived Contacts" class="imglink"  ></a><h3 class="footerlink"><a  href="/archive_contacts">Archived Contacts</a></h3></div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4"><a href="/archive_categories"><img src="\images\archive-categories-b.png" alt="Archived Categories" class="imglink" ></a> <h3 class="footerlink"><a  href="/archive_categories">Archived Categories</a></h3></div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4"><a href="/archive_flags"><img src="\images\archive-flags-y.png" alt="Archived Flags" class="imglink" ></a> <h3 class="footerlink"><a  href="/archive_flags">Archived Flags</a></h3></div>

                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 "><a href="/archive_users"><img src="\images\archive-users-b.png" alt="Archived Users" class="imglink"  ></a><h3 class="footerlink"><a  href="/archive_users">Archived Users</a></h3></div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script>
    $(document).ready(function(){
        $("#hide").click(function(){
            $("#UpcomingEventsTable").toggle();
            $(this).text(function (i, text){
                return text === "Hide Events" ? "Show Events" : "Hide Events";
            })
            $("#hide").toggleClass('orange');
        });
        $('#UpcomingEventsTable').dataTable({
            "paging":   false,
            "ordering": false,
            "info":     false,
            "searching": false
        });

    });

</script>
</head>
@endpush
