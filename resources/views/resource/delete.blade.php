@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="/resource/destroy/{{$id->Id}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
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
                                <dt>Phone Number</dt>
                                <dd>{{ $id->PhoneNumber }}</dd>
                                <dt>OpeningHours</dt>
                                <dd>{{ $id->OpeningHours }}</dd>
                                <dt>ClosingHours</dt>
                                <dd>{{ $id->ClosingHours }}</dd>
                                <dt>Comments</dt>
                                <dd>{{ $id->Comments }}</dd>
                            </dl>
                            <div class="col-lg-6"><br/><br/>
                                <div class="text-center">Delete <b>{{ $id->Name  }}</b> from the database?</br></br>
                                    <div class="col-md-5 text-center">
                                        <input class="btn btn-primary" type="submit" value="Yes!">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection