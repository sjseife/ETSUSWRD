@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Contact</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Resource Name</dt>
                            <dd>
                                @foreach($resource as $r)
                                    @if($r->Id == $id->resource_id)
                                        {{$r->Name}}
                                    @endif
                                @endforeach
                            </dd>
                            <dt>First Name</dt>
                            <dd>
                                {{ $id->firstName}}
                            </dd>
                            <dt>Last Name</dt>
                            <dd>
                                {{ $id->lastName}}
                            </dd>
                            <dt>Phone Number</dt>
                            <dd>{{ $id->phoneNumber}}</dd>
                            <dt>Email</dt>
                            <dd>{{ $id->email}}</dd>
                        </dl>
                        <div class="col-lg-6"><br/><br/>
                            <div class="text-center"><a href="{{'/contact'}}">Go To Contact Index</a></br></br>
                            </div>
                            <div class="text-center"><a href="{{'/contact'}}">Go To Resource Index</a></br></br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection