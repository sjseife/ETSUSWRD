@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Resource</div>
                    <div class="panel-body">
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
                            <dt>Contact First Name</dt>
                            <dd>{{ $resource->ContactFirstName }}</dd>
                            <dt>Contact Last Name</dt>
                            <dd>{{ $resource->ContactLastName }}</dd>
                            <dt>Contact Phone</dt>
                            <dd>{{ $resource->ContactPhone }}</dd>
                            <dt>Opening Hours</dt>
                            <dd>{{ $resource->OpeningHours }}</dd>
                            <dt>Closing Hours</dt>
                            <dd>{{ $resource->ClosingHours }}</dd>
                            <dt>Comments</dt>
                            <dd>{{ $resource->Comments }}</dd>
                            <dt>Categories</dt>
                            @foreach ($categories as $category)
                                <dd>{{ $category->name }}</dd>
                            @endforeach
                        </dl>
                        <div class="col-lg-6"><br/><br/>
                            <div class="text-center"><a href="{{'/home'}}">Go Back to Home Page</a></br></br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection