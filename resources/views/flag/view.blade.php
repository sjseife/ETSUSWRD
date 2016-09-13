@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Flag</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
                            <dd>
                                @foreach($resource as $r)
                                    @if($r->Id == $id->resource_id)
                                        {{$r->Name}}
                                    @endif
                                @endforeach
                                @foreach($user as $u)
                                    @if($u->id == $id->user_id)
                                        {{$u->email}}
                                    @endif
                                @endforeach
                                @foreach($contact as $c)
                                @if($c->id == $id->contacts_id)
                                      {{$c->firstName}} {{$c->lastName}}
                                @endif
                                    @endforeach
                            </dd>
                            <dt>Submitted By</dt>
                            <dd>
                                @foreach($user as $u)
                                    @if($u->id == $id->submitted_by)
                                        {{$u->email}}
                                    @endif
                                @endforeach
                            </dd>
                            <dt>Level</dt>
                            <dd>
                                @if($id->Level == 0)
                                    Resolved
                                @elseif($id->Level == 1)
                                    GA
                                @else
                                    Admin
                                @endif
                            </dd>
                            <dt>Date</dt>
                            <dd>{{ $id->Date }}</dd>
                            <dt>Comments</dt>
                            <dd>{{ $id->Comments }}</dd>
                        </dl>
                        <div class="col-lg-6"><br/><br/>
                            <div class="text-center"><a href="{{'/flag'}}">Go Back Index</a></br></br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection