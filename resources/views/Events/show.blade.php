@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">View Event</div>
                <div class="panel-body">
            <h2><em>{{ $event->name }}</em></h2>
            <div class="col-md-4">
                <p><b>Address:</b></p>
                {{--If there is a street 2, display. Else do not--}}
                @if($event->streetAddress2 != null)
                    <p>{{ $event->streetAddress }}<br>
                        {{ $event->streetAddress2 }}</p>
                @else
                    <p>{{ $event->streetAddress }}</p>
                @endif

                <p>{{ $event->city }}, {{ $event->state }} {{ $event->zipCode }}</p>
                <p>{{ $event->county }}</p>
            </div>

            <div class="col-md-4">
                <p><b>Dates:</b></p>
                <p>{{ date('M jS, Y', strtotime($event->startDate)) }} - {{ date('M jS, Y', strtotime($event->endDate)) }}</p>
                <p><b>Hours:</b></p>
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
                        echo '<p>' . $item[0] . ':<br>' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '</p>';
                    }
                    else
                    {
                        echo '<p>' . $item[0] . ' - ' . end($item) . ':<br>' . date('g:i A',strtotime($openTimeArr[$key])) . ' - ' . date('g:i A',strtotime($closeTimeArr[$key])) . '</p>';
                    }
                }
                ?>
            </div>
            <div class="col-md-4">
                <h5 class="list-heading"><b>Contact Methods:</b></h5>
                <ul>
                    <li>Phone Number: {{ $event->publicPhoneNumber }} @if($event->publicPhoneNumber == null) N/A @endif </li>
                    <li>Email: {{ $event->publicEmail }} @if($event->publicEmail == null) N/A @endif </li>
                    <li>Website: {{ $event->website }} @if($event->website == null) N/A @endif </li>
                </ul>
                <h5 class="list-heading"><b>Categories:</b></h5>
               <ul>
                    @foreach ($event->categories as $category)
                        <li><a href="{{ URL::to('categories/' . $category->id) }}">
                            | {{ $category->name }}
                        </a>|</li>
                    @endforeach
                    </ul>
            </div>
            <div class="col-md-10">

                <hr />
                <p><b>Description:</b></p>
                <p>{{ $event-> description }}</p>


                <hr />
                <p><b>Comments:</b></p>
                <p>{{ $event->comments }}</p>
                <hr />
            </div>
            <div class="col-md-10">
                <p><b>Reported Problems:</b></p>
                @if($event->flags == null)
                    @foreach($event->flags as $flag)
                        @if(!$flag->resolved)
                            <p>{{ $flag->comments }}</p>
                        @endif
                    @endforeach
                @else
                    <p>No problems reported</p>
                @endif
                </div>
                <div class="col-md-10 col-md-offset-4">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')

                    <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                    <a class="btn btn-lg btn-info" href="{{ URL::to('events/' . $event->id. '/edit') }}">Edit</a>
                    <!-- delete the event -->
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    @endif
                    <div class=""><br/><br/>
                        <div>
                            <a href="{{'/events'}}">Back to Events</a></br>

                            <!-- Flag this event as incorrect -->
                            <a  href="{{ URL::to('events/' . $event->id. '/flag') }}">Report a problem with this event.</a>
                        </div>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>

        </div>
                </div>
        <!-- Modal -->
    @include('events._deleteModal')
@endsection