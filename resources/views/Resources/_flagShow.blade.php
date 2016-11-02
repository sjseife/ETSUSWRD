<div class="row">
    <div class="col-md-10 col-md-offset-1">
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
                </div>
                <div class="col-md-10 col-md-offset-4">
                    <br/>
                    <br/>
                    <br/>
                    @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
                    <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                        <a class="btn btn-md btn-info" href="{{ URL::to('resources/' . $resource->id. '/edit') }}">Edit</a> |
                        <!-- delete the resource -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    @endif
                </div>
                <br/>
                <br/>
            </div>
</div>