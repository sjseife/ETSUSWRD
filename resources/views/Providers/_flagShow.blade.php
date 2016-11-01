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
        </div>
    @endif


</div>

@include('providers._deleteModal')