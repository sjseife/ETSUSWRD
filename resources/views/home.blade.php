@extends('layouts.dataTables')

@section('content')
    <style>
        .imglink {
            width: 100%;
            margin: 0 auto;
            margin-bottom: 10px;

        }
        .imglink2 {
            width: 93%;
            margin: 0 auto;
            margin-bottom: 18px;
            padding-left: 10px;

        }

        .long-link{
            font-size:91%;
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

         <div class="padsome">
             <?php
                if(!empty($upcomingEvents))
                {
                    echo  '<button class="purple-btn pull-right nowrap" id="hide">Hide Events</button>';
                    echo "<table class='dt-responsive nowrap tableText pull-right' cellspacing='0' width='100%' id='UpcomingEventsTable' frame='hsides' rules='thead , row='1'' >";
                }
                else
                    {
                        echo "<table class='dt-responsive nowrap tableText pull-right hidden' cellspacing='0' width='100%' id='UpcomingEventsTable' frame='hsides' rules='thead , row='1'' >";
                    }
             ?>
            <thead>
            <tr >
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
                <th data-priority="3" class="purple-text">Description:</th> {{--14--}}
                <th data-priority="3" class="purple-text">Comments:</th> {{--15--}}
                <th data-priority="3" class="purple-text">View Event:</th>

            </thead>
            </tr>
            <tbody>

            @foreach($upcomingEvents as $key => $event)
                <?php
                $link = false;
                ?>
                <tr>
                    <td><div width="50%"><span class="wrapcell">{{ $event->name }}</span></div></td>
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

                            if(empty($tempDay))
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
                    <td><div width="50%"><span style="white-space: normal;">{{ $event->description }}</span></div></td>
                    <td><div width="50%"><span style="white-space: normal;">{{ $event->comments }}</span></div></td>
                    <td class="text-center col-md-3">
                        <a class="btn btn-sm btn-success view-btn" href="{{ URL::to('events/' . $event->id) }}">View</a>
                    </td>
                </tr>

            @endforeach
            </tbody>
        </table>
         </div>
            <div class="panel-body panel-primary zeroTopMargin">
                <div class="panel-heading sw-heading"> <h4 class="siteheading">Department of Social Work<br></h4><p class="sitesubheading">College of Arts & Sciences</p></div>

                <div class="panel-body w3-panel w3-blue w3-round-xlarge">

                    @if(Auth::user()->role->base == '1')
                        <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="{{ url('/events') }}"><img src="{{ asset('images\EventsImg.jpg') }}" alt="Events" class="imglink"  ></a><h3 class="footerlink"><a  href="{{ url('/events') }}">Events</a></h3></div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="{{ url('/resources') }}"><img src="{{ asset('images\lightbulb.ico') }}" alt="Resources" class="imglink"  ></a><h3 class="footerlink"><a  href="{{ url('/resources') }}">Resources</a></h3></div>
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="{{ url('/worklist/generateReport') }}"><img src="{{ asset('images\report-icon-2.png') }}" alt="PDF Report" class="imglink"  ></a><h3 class="footerlink"><a  class="long-link" href="{{ url('/worklist/generateReport') }}">Report</a></h3></div>
                    @endif
                    @if(Auth::user()->role->extended == '1')
                         <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="{{ url('/contacts') }}"><img src="{{ asset('images\contacts2.png') }}" alt="Contacts" class="imglink"  ></a><h3 class="footerlink"><a  href="{{ url('/contacts') }}">Contacts</a></h3></div>
                         <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"><a href="{{ url('/categories') }}"><img src="{{ asset('images\CategoriesImg.png') }}" alt="Categories" class="imglink" ></a> <h3 class="footerlink"><a  href="{{ url('/categories') }}">Categories</a></h3></div>
                         <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3"><a href="{{ url('/flags') }}"><img src="{{ asset('images\waving-flag.jpg') }}" alt="Flags" class="imglink2" ></a> <h3 class="footerlink"><a  href="{{ url('/flags') }}">Flags</a></h3></div>
                    @endif
                    @if(Auth::user()->role->users == '1')
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="{{ url('/users') }}"><img src="{{ asset('images\usersimg.png') }}" alt="Users" class="imglink"  ></a><h3 class="footerlink"><a  href="{{ url('/users') }}">Users</a></h3></div>
                    @endif
                    @if(Auth::user()->role->archive == '1')
                        <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3 "><a href="{{ url('/archive') }}"><img src="{{ asset('images\archive-icon.png') }}" alt="Users" class="imglink"  ></a><h3 class="footerlink"><a  href="{{ url('/archive') }}">Archive</a></h3></div>
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
@endpush
