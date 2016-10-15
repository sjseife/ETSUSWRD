@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Provider</div>
                <div class="panel-body">
                    <div class="col-md-offset-3"><br/><br/>
                        <div>
                            <a href="{{'/providers'}}">Back to Providers</a></br></br>
                        </div>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $provider->name }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $provider->protectedEmail }}</dd>
                        <dt>Phone Number</dt>
                        <dd>{{ $provider->protectedPhoneNumber }}</dd>
                        <dt>Contacts</dt>
                        @foreach($provider->contacts as $contact)
                            <dd>
                                <a href="{{ URL::to('contacts/' . $contact->id) }}">
                                    {{ $contact->full_name }}
                                </a>
                            </dd>
                        @endforeach
                        <dt>Resources</dt>
                        @foreach($provider->resources as $resource)
                            <dd>
                                <a href="{{ URL::to('resources/' . $resource->id) }}">
                                    {{ $resource->name }}
                                </a>
                            </dd>
                        @endforeach
                        <dt>Events</dt>
                        @foreach($provider->events as $event)
                            <dd>
                                <a href="{{ URL::to('events/' . $event->id) }}">
                                    {{ $event->name }}
                                </a>
                            </dd>
                        @endforeach<br>
                        <dt>Reported Problems</dt>
                        @if(isset($provider->flags))
                            @foreach($provider->flags as $flag)
                                @if(!$flag->resolved)
                                    <dd>{{ $flag->comments }}</dd>
                                @endif
                            @endforeach
                        @else
                            <dd>No problems reported</dd>
                        @endif
                    </dl>

                    <div class="col-md-offset-2">
                        <br/>
                        <br/>
                        <!-- Flag this resource as incorrect -->
                        <a class="btn btn-lg btn-link" href="{{ URL::to('providers/' . $provider->id. '/flag') }}">Report a problem with this provider.</a>
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
                    </div>
                        @endif

                </div>
            </div>
        </div>
    </div>
</div>
    <!-- Modal -->
    @include('Providers._deleteModal')
@endsection