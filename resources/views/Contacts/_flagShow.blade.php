
    <br/>

    <h2>&nbsp;&nbsp;{{ $contact->firstName}}&nbsp; {{$contact->lastName }}</h2>
    <div class="col-md-10">


        <p>&nbsp;&nbsp;Email: &nbsp; {{ $contact->protectedEmail }}</p>

        <p>&nbsp;&nbsp;Phone: &nbsp; {{ $contact->protectedPhoneNumber }}</p>

        <hr>
    </div>
    <div class="col-md-10">
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
        <hr>
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
    </div>=
    <div class="col-md-10">
        <br/>
        <br/>
        <br/>

        <div class="col-md-offset-2">
            <!-- edit this contact (uses the edit method found at GET /contact/{id}/edit -->
            <a class="btn btn-lg btn-info" href="{{ URL::to('contacts/' . $contact->id. '/edit') }}">Edit</a>
            <!-- delete the resource -->
            <!-- Trigger the modal with a button -->
            <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
            <br/>
            <br/>
        </div>

    </div>
    <!-- Modal -->
    @include('contacts._deleteModal')