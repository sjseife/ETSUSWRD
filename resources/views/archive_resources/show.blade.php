@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">View Resource</div>
                <div class="panel-body ">
                    <a href="{{ url('/archive_resources') }}" class="btn btn-default">Back</a>
                    <h2><em>{{ $resource->name }}</em></h2>
                    <div class="col-md-4">
                        <p><b>Address:</b></p>
                        {{--If there is a street 2, display. Else do not--}}
                        @if($resource->streetAddress2 != null)
                            <p>{{ $resource->streetAddress }}<br>
                                {{ $resource->streetAddress2 }}</p>
                        @else
                            <p>{{ $resource->streetAddress }}</p>
                        @endif

                        <p>{{ $resource->city }}, {{ $resource->state }} {{ $resource->zipCode }}</p>
                        <p>{{ $resource->county }}</p>
                    </div>
                    <div class="col-md-3">
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

                        @foreach($resource->hours as $day)
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
                        <ul style="list-style:none;">
                            <li>Phone: {{ $resource->publicPhoneNumber }} @if($resource->publicPhoneNumber == null) N/A @endif </li>
                            <li>Email: {{ $resource->publicEmail }} @if($resource->publicEmail == null) N/A @endif </li>
                            <li>Website: {{ $resource->website }} @if($resource->website == null) N/A @endif </li>
                        </ul>
                        <h5 class="list-heading"><b>Categories:</b></h5>
                        <ul style="list-style:none;">
                            @foreach ($resource->categories as $category)
                                <li><a href="{{ URL::to('categories/' . $category->id) }}">
                                        | {{ $category->name }}
                                    </a>|</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <p><b>Description:</b></p>
                        <p>{{ $resource-> description }}</p>


                        <hr />
                        <p><b>Comments:</b></p>
                        <p>{{ $resource->comments }}</p>
                        <hr />
                    </div>
                    <div class="col-md-10">
                        <p><b>Reported Problems:</b></p>
                        @if($resource->flags != null)
                            @foreach($resource->flags as $flag)
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
                    @if(Auth::user()->role->delete == '1')

                        <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                            <a class="btn btn-lg btn-info" href="{{ URL::to('archive_resources/showrestore/' . $resource->id) }}">Restore</a>
                            <a class="btn btn-lg btn-danger" href="{{ URL::to('archive_resources') }}">Cancel</a>

                            <!-- delete the event -->
                            <!-- Trigger the modal with a button -->
                        @endif
                  </div>
                    <br/>
                    <br/>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
@endsection