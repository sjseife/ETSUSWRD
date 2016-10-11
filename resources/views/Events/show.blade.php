@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">

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
            <div class="col-md-2">
                <p><b>Hours:</b></p>
                <p>{{ date('F jS, Y', strtotime($event->startDate)) }} - {{ date('F jS, Y', strtotime($event->endDate)) }}</p>
                @foreach($event->hours as $day)
                    <p>{{ $day->day }} : {{ date('g:i A', strtotime($day->openTime)) }} - {{ date('g:i A', strtotime($day->closeTime)) }}</p>
                @endforeach
            </div>
            <div class="col-md-4">
                <p><b>Contact Methods:</b></p>
                <ul>
                    <li>Phone Number: {{ $event->publicPhoneNumber }} @if($event->publicPhoneNumber == null) N/A @endif </li>
                    <li>Email: {{ $event->publicEmail }} @if($event->publicEmail == null) N/A @endif </li>
                    <li>Website: {{ $event->website }} @if($event->website == null) N/A @endif </li>
                </ul>

            </div>
            <div class="col-md-10">
                <hr />
                <p><b>Description:</b></p>
                <p>{{ $event-> description }}</p>

                <p><b>Categories</b></p>
                <p>
                    @foreach ($event->categories as $category)
                        <a href="{{ URL::to('categories/' . $category->id) }}">
                            | {{ $category->name }}
                        </a>
                    @endforeach
                    | </p>
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
                <div class="col-md-10">
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <br/>
                    <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                    <a class="btn btn-lg btn-info" href="{{ URL::to('events/' . $event->id. '/edit') }}">Edit</a>
                    <!-- delete the event -->
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                            <a href="{{'/events'}}">Back to Events</a></br>

                            <!-- Flag this event as incorrect -->
                            <a  href="{{ URL::to('events/' . $event->id. '/flag') }}">Report a problem with this event.</a>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>

        </div>
        <!-- Modal -->
    @include('Events._deleteModal')
@endsection