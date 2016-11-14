@extends('layouts.dataTables')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">View Event</div>
                <div class="panel-body">
                    <a href="{{ '/events' }}" class="btn btn-default">Back</a>

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
                @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'GA')
                    <p><b>Private Contacts:</b></p>
                    <ul>
                    @foreach($event->contacts as $contact)
                        <li><a href="{{ URL::to('contacts/' . $contact->id) }}"></a></li>
                        @endforeach
                    </ul>
                @endif
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
                    <button type="button" class="btn btn-md btn-primary report
                        @if(Auth::user()->events->contains($event))
                            removeReport" name="{{$event->id}}">Remove From Report</button>
                    @else
                        addReport" name="{{$event->id}}">Add To Report</button>
                    @endif
                    @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
                    <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                        | <a class="btn btn-md btn-info" href="{{ URL::to('events/' . $event->id. '/edit') }}">Edit</a> |
                        <!-- delete the resource -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    @endif
                    <div class=""><br/><br/>
                        <div>


                            <!-- Flag this event as incorrect -->
                            <a  href="{{ URL::to('events/' . $event->id. '/flag') }}" class="btn btn-danger">Report a problem with this event.</a>
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
@stop
@push('scripts')
<script>
    @if (session()->has('flash_notification.message'))
        @if(session('flash_notification.level') == 'success')
            toastr.success('{{session('flash_notification.message')}}');
    @elseif(session('flash_notification.level') == 'danger')
            toastr.error('{{session('flash_notification.message')}}');
    @elseif(session('flash_notification.level') == 'info')
            toastr.info('{{session('flash_notification.message')}}');
        @endif
    @endif
    $(document).ready(function() {
            //Ajax for add to report button
            $(".report").click(function (){
                var button = $(this);
                var index = button.attr("name");
                var remove = $(this).hasClass("removeReport");
                var add = $(this).hasClass("addReport");
                var resourceName = "{!! $event->name !!}";
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                if (add) {
                    $.ajax({

                        type: "GET",
                        url: 'add/' + $(this).attr("name"),
                        dataType: 'json',
                        success: function (data) {
                            //alerts users to successful button pushing.
                            /* html = '<div class="alert alert-success">' + resourceNames[index] + ' Added to Report!<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                             $('#successOrFailure').html(html);*/
                            toastr["success"]( resourceName + " successfully added to the report", "Event Added to Report");
                            button.css({"background-color": "#c9302c", "color": "white", "border-color": "#ac2925"});
                            button.addClass('removeReport').removeClass('addReport');
                            button.text(function (i, text) {
                                return "Remove From Report";
                            })

                        },
                        error: function (data) {
                            if (data.status === 401) //redirect if not authenticated user.
                                $(location).prop('pathname', 'auth/login');
                            if (data.status === 422) {
                                //process validation errors here.
                                var errors = data.responseJSON; //this will get the errors response data.
                                //show them somewhere in the modal
                                errorsHtml = '<div class="alert alert-danger"><ul>';

                                $.each(errors, function (key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                                });
                                errorsHtml += '</ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';

                                $('#successOrFailure').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                            } else {
                                html = '<div class="alert alert-danger"><ul><li>There was a problem processing your request. ' +
                                        'Please try again later.</li></ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                                $('#successOrFailure').html(html);
                            }
                        }
                    });
                }
                else if (remove) {
                    $.ajax({

                        type: "GET",
                        url: 'removeReport/' + $(this).attr("name"),
                        dataType: 'json',
                        success: function (data) {
                            //alerts users to successful button pushing.
                            /* html = '<div class="alert alert-danger">' + resourceNames[index] + ' Removed from Report!<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                             $('#successOrFailure').html(html);*/
                            toastr["success"]("You have successfully removed the event from the report", "Event Removed from Report");
                            button.css({"background-color": "#337ab7", "color": "white", "border-color": "#2e6da4"});
                            button.addClass('addReport').removeClass('removeReport');
                            button.text(function (i, text) {
                                return "Add To Report";
                            })

                        },
                        error: function (data) {
                            if (data.status === 401) //redirect if not authenticated user.
                                $(location).prop('pathname', 'auth/login');
                            if (data.status === 422) {
                                //process validation errors here.
                                var errors = data.responseJSON; //this will get the errors response data.
                                //show them somewhere in the modal
                                errorsHtml = '<div class="alert alert-danger"><ul>';

                                $.each(errors, function (key, value) {
                                    errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
                                });
                                errorsHtml += '</ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';

                                $('#successOrFailure').html(errorsHtml); //appending to a <div id="form-errors"></div> inside form
                            } else {
                                html = '<div class="alert alert-danger"><ul><li>There was a problem processing your request. ' +
                                        'Please try again later.</li></ul><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button></div>';
                                $('#successOrFailure').html(html);
                            }
                        }
                    });
                }
            });
        } );
    </script>
@endpush
