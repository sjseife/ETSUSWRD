@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Contact</div>
                <div class="panel-body">
                    <div class="col-md-offset-1"><br/><br/>
                        <a href="{{'/contacts'}}" class="btn btn-default">Cancel</a>

                    </div>

                    <br/>

                        <h2>&nbsp;&nbsp;{{ $contact->firstName}}&nbsp; {{$contact->lastName }}</h2>
                        <div class="col-md-10">


                            <p>&nbsp;&nbsp;Email: &nbsp; {{ $contact->protectedEmail }}</p>

                            <p>&nbsp;&nbsp;Phone: &nbsp; {{ $contact->protectedPhoneNumber }}</p>

                            <hr>
                        </div>
                        <div class="col-md-10">
                            <p><strong>Providers</strong></p>
                            @foreach($contact->providers as $provider)
                                <p>
                                    <a href="{{ URL::to('providers/' . $provider->id) }}">
                                        {{ $provider->name }}
                                    </a>
                                </p>
                            @endforeach
                            <hr>
                        </div>
                        <div class="col-md-10">
                            <p>Reported Problems</p>
                            @if(isset($contact->flags))
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
                                <div>

                                    <!-- Flag this provider as incorrect -->
                                    <a  href="{{ URL::to('contacts/' . $contact->id. '/flag') }}">Report a problem with this contact.</a>
                                </div>
                            </div>

                        </div>
            </div>
        </div>
    </div>
        </div>

    <!-- Modal -->
    @include('contacts._deleteModal')
@endsection