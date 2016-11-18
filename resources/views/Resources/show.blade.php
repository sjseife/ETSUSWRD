@extends('layouts.dataTables')
<style>
    .removeReport {
        background-color: #c9302c!important;
        border-color: #ac2925!important;
        color: white!important;
    }
    .addReport{
        background-color: #041E42!important;
        border-color: #2e6da4!important;
        color: white!important;

    }
</style>
@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-primary">
                <div class="panel-heading">View Resource</div>
                <div class="panel-body ">
                    <a href="{{ url('/resources') }}" class="btn btn-default">Back</a>
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
                            @if(Auth::user()->role == 'Admin' || Auth::user()->role == 'GA')
                                <p><b>Private Contacts:</b></p>
                                <ul>
                                    @foreach($resource->contacts as $contact)
                                        <li><a href="{{ URL::to('contacts/' . $contact->id) }}"></a></li>
                                    @endforeach
                                </ul>
                            @endif
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
                        <button type="button" class="btn btn-md btn-primary report
                        @if(Auth::user()->resources->contains($resource))
                            removeReport" name="{{$resource->id}}">Remove From Report</button>
                        @else
                            addReport" name="{{$resource->id}}">Add To Report</button>
                        @endif
                        @if (Auth::user()->role->create_update == '1')
                            <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                            | <a class="btn btn-md btn-info" href="{{ URL::to('resources/' . $resource->id. '/edit') }}">Edit</a>
                        @endif
                        @if(Auth::user()->role->delete == '1')

                            <!-- delete the resource -->
                            <!-- Trigger the modal with a button -->
                            | <button type="button" class="btn btn-warning btn-md" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        @endif
                        <div class=""><br/><br/>
                            <div>

                                <!-- Flag this resource as incorrect -->
                                <a  href="{{ URL::to('resources/' . $resource->id. '/flag') }}" class="btn btn-danger">Report a problem with this resource.</a>
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
    @include('resources._deleteModal')
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
           var resourceName = "{!! $resource->name !!}";
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
                            toastr["success"]( resourceName + " successfully added to the report", "Resource Added to Report");
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
                            toastr["success"]("You have successfully removed the resource from the report", "Resource Removed from Report");
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
