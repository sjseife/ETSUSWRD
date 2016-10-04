@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Resource</div>
                <div class="panel-body">
                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                            <a href="{{'/resources'}}">Back to Resources</a></br></br>
                        </div>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $resource->Name }}</dd>
                        <dt>Street Address</dt>
                        <dd>{{ $resource->StreetAddress }}</dd>
                        <dt>Street Address 2</dt>
                        <dd>{{ $resource->StreetAddress2 }}</dd>
                        <dt>City</dt>
                        <dd>{{ $resource->City }}</dd>
                        <dt>County</dt>
                        <dd>{{ $resource->County }}</dd>
                        <dt>State</dt>
                        <dd>{{ $resource->State }}</dd>
                        <dt>Zip code</dt>
                        <dd>{{ $resource->Zipcode }}</dd>
                        <dt>Opening Hours</dt>
                        <dd>{{ $resource->OpeningHours }}</dd>
                        <dt>Closing Hours</dt>
                        <dd>{{ $resource->ClosingHours }}</dd>
                        <dt>Comments</dt>
                        <dd>{{ $resource->Comments }}</dd>
                        <dt>Contacts</dt>
                        @foreach($resource->contacts as $contact)
                            <dd>
                                <a href="{{ URL::to('contacts/' . $contact->id) }}">
                                    {{ $contact->full_name }}
                                </a>
                            </dd>
                        @endforeach
                        <dt>Categories</dt>
                        @foreach ($resource->categories as $category)
                            <dd>
                                <a href="{{ URL::to('categories/' . $category->id) }}">
                                    {{ $category->name }}
                                </a>
                            </dd>
                        @endforeach
                        <dt>Reported Problems</dt>
                        @if(isset($resource->flags))
                            @foreach($resource->flags as $flag)
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
                        <br/>
                        <!-- Flag this resource as incorrect -->
                        <a class="btn btn-lg btn-link" href="{{ URL::to('resources/' . $resource->id. '/flag') }}">Report a problem with this resource.</a>
                        <br/>
                        <br/>
                        <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                        <a class="btn btn-lg btn-info" href="{{ URL::to('resources/' . $resource->id. '/edit') }}">Edit</a>
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
    @section('footer')
    <!-- Modal -->
    @include('Resources._deleteModal')
@endsection