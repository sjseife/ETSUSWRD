@extends('layouts.general')

@section('content')
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
            <div class="col-md-2">
                <p><b>Hours:</b></p>
                @foreach($resource->hours as $day)
                    <p>{{ $day->day }} : {{ date('g:i A', strtotime($day->openTime)) }} - {{ date('g:i A', strtotime($day->closeTime)) }}</p>
                @endforeach
            </div>
            <div class="col-md-4">
                <p><b>Contact Methods:</b></p>
                <ul>
                    <li>Phone Number: {{ $resource->publicPhoneNumber }} @if($resource->publicPhoneNumber == null) N/A @endif </li>
                    <li>Email: {{ $resource->publicEmail }} @if($resource->publicEmail == null) N/A @endif </li>
                    <li>Website: {{ $resource->website }} @if($resource->website == null) N/A @endif </li>
                </ul>

            </div>
            <div class="col-md-10">
                <hr />
                <p><b>Description:</b></p>
                <p>{{ $resource-> description }}</p>

                <p><b>Categories</b></p>
                <p>
                @foreach ($resource->categories as $category)
                        <a href="{{ URL::to('categories/' . $category->id) }}">
                           | {{ $category->name }}
                        </a>
                @endforeach
                | </p>
                <hr />
                <p><b>Comments:</b></p>
                <p>{{ $resource->comments }}</p>
                <hr />
            </div>
            <div class="col-md-10">
                <p><b>Reported Problems:</b></p>
                @if($resource->flags == null)
                    @foreach($resource->flags as $flag)
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
                    <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                    <a class="btn btn-lg btn-info" href="{{ URL::to('resources/' . $resource->id. '/edit') }}">Edit</a>
                    <!-- delete the resource -->
                    <!-- Trigger the modal with a button -->
                    <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                            <a href="{{'/resources'}}">Back to Resources</a></br>

                            <!-- Flag this resource as incorrect -->
                            <a  href="{{ URL::to('resources/' . $resource->id. '/flag') }}">Report a problem with this resource.</a>
                        </div>
                    </div>
                    <br/>
                    <br/>
                </div>
            </div>

    </div>
    <!-- Modal -->
    @include('Resources._deleteModal')
@endsection