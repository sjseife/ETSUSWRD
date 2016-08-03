@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Resource</div>
                <div class="panel-body">
                    <dl class="dl-horizontal">
                        <div class="col-md-offset-2">
                            <!-- edit this resource (uses the edit method found at GET /resource/edit/{id} -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('resources/edit/' . $resource->Id) }}">Edit</a>
                            <!-- delete the resource (uses the delete method found at GET /resource/{id} -->
                            <a class="btn btn-small btn-warning" href="{{ URL::to('resources/delete/' . $resource->Id) }}">Delete</a>
                            <br/>
                            <br/>
                        </div>
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
                        <dt>Categories</dt>
                        @foreach ($resource->categories as $category)
                            <dd>{{ $category->name }}</dd>
                        @endforeach
                    </dl>
                    <div class="col-lg-6"><br/><br/>
                        <div class="text-center">
                            <a href="{{'/home'}}">Go Back to Home Page</a></br></br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection