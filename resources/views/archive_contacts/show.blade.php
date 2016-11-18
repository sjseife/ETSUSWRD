@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Contact</div>
                <div class="panel-body">
                    <a href="{{ url('/archive_contacts') }}" class="btn btn-default">Back</a>

                    <h2><em>{{ $contact->firstName}}&nbsp; {{$contact->lastName }}</em></h2>
                    <div class="col-md-4">
                        <p><b>Email:</b></p>
                        {{ $contact->protectedEmail }}
                    </div>
                    <div class="col-md-4">
                        <p><b>Phone Number:</b></p>
                        <?php
                        include (public_path() . '/php/functions.php');
                        echo phoneFormat($contact->protectedPhoneNumber);
                        ?>
                    </div>
                    <div class="col-md-4">
                        <p><strong>Resources:</strong></p>
                        @if(!$contact->resources->isEmpty())
                            @foreach($contact->resources as $resource)
                                <p>
                                    <a href="{{ URL::to('resources/' . $resource->id) }}">
                                        {{ $resource->name }}
                                    </a>
                                </p>
                            @endforeach
                        @else
                            <p>None</p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <p><strong>Events:</strong></p>
                        @if(!$contact->events->isEmpty())
                            @foreach($contact->events as $event)
                                <p>
                                    <a href="{{ URL::to('events/' . $event->id) }}">
                                        {{ $event->name }}
                                    </a>
                                </p>
                            @endforeach
                        @else
                            <p>None</p>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <hr/>
                    </div>
                    <div class="col-md-10">
                        <p><b>Reported Problems:</b></p>
                        @if(!$contact->flags->isEmpty())
                            @foreach($contact->flags as $flag)
                                @if(!$flag->resolved)
                                    <p>{{ $flag->comments }}</p>
                                @endif
                            @endforeach
                        @else
                            <p>No problems reported</p>
                        @endif
                    </div>
                    <div class="col-md-10">
                        <hr/>
                    </div>
                    <div class="col-md-10 col-md-offset-4">
                        <br/>
                        @if(Auth::user()->role->delete == '1')

                            <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                                <a class="btn btn-lg btn-info" href="{{ URL::to('archive_contacts/showrestore/' . $contact->id) }}">Restore</a>
                                <a class="btn btn-lg btn-danger" href="{{ URL::to('archive_contacts') }}">Cancel</a>
                                <!-- delete the event -->
                                <!-- Trigger the modal with a button -->
                            @endif
                        <br/>
                        <br/>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
@endsection