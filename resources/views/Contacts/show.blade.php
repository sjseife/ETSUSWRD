@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Contact</div>
                <div class="panel-body">
                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                            <a href="{{'/contacts'}}">Back to Contacts</a></br></br>
                        </div>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>First Name</dt>
                        <dd>{{ $contact->firstName }}</dd>
                        <dt>Last Name</dt>
                        <dd>{{ $contact->lastName }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $contact->email }}</dd>
                        <dt>Phone Number</dt>
                        <dd>{{ $contact->phoneNumber }}</dd>
                        <dt>Resources</dt>
                        @foreach($contact->resources as $resource)
                            <dd>
                                <a href="{{ URL::to('resources/' . $resource->id) }}">
                                    {{ $resource->Name }}
                                </a>
                            </dd>
                        @endforeach
                        <dt>Reported Problems</dt>
                        @if(isset($contact->flags))
                            @foreach($contact->flags as $flag)
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
                        <a class="btn btn-lg btn-link" href="{{ URL::to('contacts/' . $contact->id. '/flag') }}">Report a problem with this contact.</a>
                        <br/>
                        <br/>
                        <!-- edit this contact (uses the edit method found at GET /contact/{id}/edit -->
                        <a class="btn btn-lg btn-info" href="{{ URL::to('contacts/' . $contact->id. '/edit') }}">Edit</a>
                        <!-- delete the resource -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('Contacts._deleteModal')
@endsection