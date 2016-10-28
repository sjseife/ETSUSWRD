@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Provider</div>
                <div class="panel-body">
                    <div class="col-md-offset-1">

                    </div>
                    <h2><em>{{ $provider->name }}</em></h2>
                    <div class="col-md-10">
                        <p>Email:</p>
                        <p>{{ $provider->publicEmail }}</p>
                        <p>Phone:</p>
                        <p>{{ $provider->publicPhoneNumber }}</p>
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

                    <div class="col-md-10 col-md-offset-3">
                        <br/>

                        <br/>
                        <br/>
                    @if (Auth::user()->role == 'GA' || Auth::user()->role == 'Admin')

                        <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                            <a class="btn btn-lg btn-info" href="{{ URL::to('archive_providers/showrestore/' . $provider->id) }}">Restore</a>
                            <a class="btn btn-lg btn-danger" href="{{ URL::to('archive_providers') }}">Cancel</a>
                            <!-- delete the event -->
                            <!-- Trigger the modal with a button -->
                        @endif


                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
@endsection