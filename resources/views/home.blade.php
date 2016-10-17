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
            width:65%;
            border:2px solid #7790ab;
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

         }
        th{
            background-color: #663399;
            color: #ffffff;
        }
        .btn{
              background-color: #663399;
              color: white;
          }
        .btn:hover{
            background-color: #663399;
            color: white;
        }
        .btn:active{
            background-color: #663399;
            color: white;
        }
        .btn:focus{
            background-color: #663399;
            color: white;
        }
        .orange{
            background-color: #FFA500;
            color: white;
        }
        .orange:hover{
            background-color: #FFA500;
            color: white;
        }
        .orange:active{
            background-color: #FFA500;
            color: white;
        }
        .orange:focus{
            background-color: #FFA500;
            color: white;
        }
        .purple-text{
            color: #663399;
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
        <div class="col-md-10 col-md-offset-1" >
        <?php
        if(!empty($upcomingEvents))
            echo  '<button class="btn btn-sm btn-white pull-right" id="hide">Hide Events</button>';

        ?>
        <table class="dt-responsive nowrap tableText pull-right" cellspacing="0" width="75%"  id="UpcomingEventsTable" frame="hsides" rules="thead , row='1'" >
            <thead>
            <tr>
                <!-- class all for always show, lower data priority numbers stay longer-->
                <th class="all tableHeader" > Upcoming Events:</th> {{--0--}}

                <th class="all purple-text">Dates:</th> {{--3--}}
                <th data-priority="1" class="purple-text">Hours of Operation:</th> {{--4--}}
                <th data-priority="3" class="purple-text">Street Address:</th> {{--8--}}
                <th data-priority="3" class="purple-text"></th> {{--9--}}
                <th data-priority="1" class="purple-text">County:</th> {{--1--}}
                <th data-priority="1" class="purple-text">City:</th> {{--10--}}
                <th data-priority="1" class="purple-text">State:</th> {{--11--}}
                <th data-priority="3" class="purple-text">Zip Code:</th> {{--12--}}
                <th data-priority="1" class="purple-text">Phone:</th> {{--5--}}
                <th data-priority="3" class="purple-text">Email:</th> {{--6--}}
                <th data-priority="3" class="purple-text">Website:</th> {{--7--}}
                <th data-priority="1" class="purple-text">Category</th> {{--2--}}
                <th data-priority="3" class="purple-text">Provider:</th> {{--13--}}
                <th data-priority="3" class="purple-text">Description:</th> {{--14--}}
                <th data-priority="3" class="purple-text">Comments:</th> {{--15--}}
            </thead>
            </tr>
            <tbody>

            @foreach($upcomingEvents as $key => $event)
                <?php
                $link = false;
                ?>
                <tr>
                    <td>{{ $event->name }}</td>
                    <td>
                        {{ date('M d, Y', strtotime($event->startDate)) }}
                        - {{ date('M d, Y', strtotime($event->endDate)) }}
                    </td>
                    <td>
                    <ul>
                        <?php
                        $tempDay = array();
                        $tempNextDay = '';
                        $days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
                        $tempOpen = '';
                        $tempClose = '';
                        $dayArr = array();
                        $openTimeArr = array();
                        $closeTimeArr = array();
                        ?>
                        @foreach($event->hours as $day)

                            <?php

                            if (empty($tempDay))
                            {
                                $tempDay[] = $day->day;
                                $key = array_search($day->day, $days); // returns key of matching day in array
                                if($key < 6)
                                    $tempNextDay = $days[$key + 1];
                                $tempOpen = $day->openTime;
                                $tempClose = $day->closeTime;
                            }
                            elseif(($tempOpen == $day->openTime) && ($tempClose == $day->closeTime) && ($tempNextDay == $day->day))
                            {
                                $tempDay[] = $day->day;
                                $key = array_search($tempNextDay, $days); // returns key of matching day in array
                                if($key < 6)
                                    $tempNextDay = $days[$key + 1];
                            }
                            else
                            {
                                $dayArr[] = $tempDay;
                                unset($tempDay);
                                $tempDay[] = $day->day;
                                $openTimeArr[] = $tempOpen;
                                $closeTimeArr[] = $tempClose;
                                $tempOpen = $day->openTime;
                                $tempClose = $day->closeTime;
                                $key = array_search($day->day, $days); // returns key of matching day in array
                                if($key < 6)
                                    $tempNextDay = $days[$key + 1];
                            }

                            ?>
                        @endforeach

                        <?php
                        $dayArr[] = $tempDay;
                        $openTimeArr[] = $tempOpen;
                        $closeTimeArr[] = $tempClose;
                        foreach($dayArr as $key => $item)
                        {
                            if(empty($item))
                            {
                                echo '';
                            }
                            elseif (count($item) < 2)
                            {
                                echo '<li>' . $item[0] . ':<br>' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '</li>';
                            }
                            else
                            {
                                echo '<li>' . $item[0] . ' - ' . end($item) . ':<br>' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '</li>';
                            }
                        }
                        ?>
                    </ul>
                    </td>
                    <td>{{ $event->streetAddress }}</td>
                    <td>&nbsp;&nbsp;&nbsp;&nbsp; {{ $event->streetAddress2 }}</td>
                    <td>{{ $event->county }}</td>
                    <td>{{ $event->city }}</td>
                    <td>{{ $event->state }}</td>
                    <td>{{ $event->zipCode }}</td>

                    <td><?php
                        $tempPhoneNumber = $event->publicPhoneNumber;
                        $tempPhoneNumber = preg_replace("/[^0-9,x]/", "", $tempPhoneNumber );
                        if(strlen($tempPhoneNumber) > 10)
                        {
                            $tempPhoneNumber = preg_replace("/^[1]/", "", $tempPhoneNumber );
                        }
                        $tempPhoneNumber = '(' . substr($tempPhoneNumber,0, 3) . ') '
                                . substr($tempPhoneNumber, 3, 3) . '-'
                                . substr($tempPhoneNumber, 6, 4) . ' '
                                . substr($tempPhoneNumber, 10, (strlen($tempPhoneNumber) - 10));
                        echo $tempPhoneNumber;

                        ?></td>
                    <td>{{ $event->publicEmail }}</td>
                    <td>{{ $event->website }}</td>
                    <td>
                        @foreach ($event->categories as $category)
                            {{ $category->name }}
                        @endforeach
                    </td>
                    <td>{{ $event->provider->name }}</td>
                    <td><div width="50%"><span style="white-space: normal;">{{ $event->description }}</span></div></td>
                    <td><div width="50%"><span style="white-space: normal;">{{ $event->comments }}</span></div></td>

                </tr>

            @endforeach
            </tbody>
        </table>
    </div>
        </div>
    <div class="row">
        <div class="col-md-10 col-md-offset-1 ">

            <div class="panel-body panel-primary pull-right">
                <div class="panel-heading"><h3>Community Resource Allocation</h3></div>

                <div class="panel-body w3-panel w3-blue w3-round-xlarge">

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/events"><img src="\images\EventsImg.jpg" alt="Events" class="imglink"  ></a><h3 class="footerlink"><a  href="/Events">Events</a></h3></div>

                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/resources"><img src="\images\lightbulb.ico" alt="Resources" class="imglink"  ></a><h3 class="footerlink"><a  href="/resources">Resources</a></h3></div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/providers"><img src="\images\providers.png" alt="Providers" class="imglink"  ></a><h3 class="footerlink"><a  href="/providers">Providers</a></h3></div>

                    @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/contacts"><img src="\images\Contacts2.png" alt="Contacts" class="imglink"  ></a><h3 class="footerlink"><a  href="/contacts">Contacts</a></h3></div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"><a href="/categories"><img src="\images\CategoriesImg.png" alt="Categories" class="imglink" ></a> <h3 class="footerlink"><a  href="/categories">Categories</a></h3></div>
                            <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"><a href="/flags"><img src="\images\waving-flag.jpg" alt="Flags" class="imglink" ></a> <h3 class="footerlink"><a  href="/flags">Flags</a></h3></div>
                        @endif

                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="/worklist/generateReport"><img src="\images\report-icon-2.png" alt="Report" class="imglink"  ></a><h3 class="footerlink"><a  href="/resources/generateReport">Report</a></h3></div>
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
@push('scripts')
<script>
    $(document).ready(function(){
        $("#hide").click(function(){
            $("table").toggle();
            $("h4").toggle();
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
