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
                            <dd>{{ $id->Name }}</dd>
                            <dt>StreetAddress</dt>
                            <dd>{{ $id->StreetAddress }}</dd>
                            <dt>StreetAddress2</dt>
                            <dd>{{ $id->StreetAddress2 }}</dd>
                            <dt>City</dt>
                            <dd>{{ $id->City }}</dd>
                            <dt>County</dt>
                            <dd>{{ $id->County }}</dd>
                            <dt>State</dt>
                            <dd>{{ $id->State }}</dd>
                            <dt>Zipcode</dt>
                            <dd>{{ $id->Zipcode }}</dd>
                            <dt>ContactName</dt>
                            <dd>{{ $id->ContactName }}</dd>
                            <dt>ContactPhone</dt>
                            <dd>{{ $id->ContactPhone }}</dd>
                            <dt>OpeningHours</dt>
                            <dd>{{ $id->OpeningHours }}</dd>
                            <dt>ClosingHours</dt>
                            <dd>{{ $id->ClosingHours }}</dd>
                            <dt>Comments</dt>
                            <dd>{{ $id->Comments }}</dd>
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