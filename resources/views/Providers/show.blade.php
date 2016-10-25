@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Provider</div>
                <div class="panel-body">
                    <div class="col-md-offset-1"><br/><br/>

                    </div>
                    <h2><em>{{ $provider->name }}</em></h2>
                    <div class="col-md-10">
                        <p>Email:</p>
                        <p>{{ $provider->protectedEmail }}</p>
                        <p>Phone:</p>
                        <p>{{ $provider->protectedPhoneNumber }}</p>
                        <hr>
                    </div>
                    <div class="col-md-10">
                        <p><strong>Contacts</strong></p>
                        @foreach($provider->contacts as $contact)
                            <p>
                                <a href="{{ URL::to('contacts/' . $contact->id) }}">
                                    {{ $contact->full_name }}
                                </a>
                            </p>
                        @endforeach
                        <hr>
                    </div>
                    <div class="col-md-10">
                        <p><strong>Resources</strong></p>
                        @foreach($provider->resources as $resource)
                            <p>
                                <a href="{{ URL::to('resources/' . $resource->id) }}">
                                    {{ $resource->name }}
                                </a>
                            </p>
                        @endforeach
                        <hr>
                    </div>
                    <div class="col-md-10">
                        <p><strong>Events</strong></p>
                        @foreach($provider->events as $event)
                            <p>
                                <a href="{{ URL::to('events/' . $event->id) }}">
                                    {{ $event->name }}
                                </a>
                            </p>
                        @endforeach<br>
                        <hr>
                        <p>Reported Problems</p>
                        @if(isset($provider->flags))
                            @foreach($provider->flags as $flag)
                                @if(!$flag->resolved)
                                    <p>{{ $flag->comments }}</p>
                                @endif
                            @endforeach
                        @else
                            <p>No problems reported</p>
                        @endif
                    </div>

                    <div class="col-md-10">
                        <br/>

                        <br/>
                        <br/>
                        @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')
                        <div class="col-md-offset-2">
                        <!-- edit this provider (uses the edit method found at GET /provider/{id}/edit -->
                        <a class="btn btn-lg btn-info" href="{{ URL::to('providers/' . $provider->id. '/edit') }}">Edit</a>
                        <!-- delete the resource -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        <br/>
                        <br/>
                            <div>
                                <a href="{{'/providers'}}">Back to Providers</a></br>
                                <!-- Flag this provider as incorrect -->
                                <a  href="{{ URL::to('privders/' . $provider->id. '/flag') }}">Report a problem with this resource.</a>
                            </div>
                    </div>
                        @endif


                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    @include('providers._deleteModal')
@endsection