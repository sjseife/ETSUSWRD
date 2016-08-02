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
                            <dd>{{ $resource->Name }}</dd>
                        @endforeach
                    </dl>
                    <div class="col-md-offset-2">
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