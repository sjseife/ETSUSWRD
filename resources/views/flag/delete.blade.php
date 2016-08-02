@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="/flag/destroy/{{$id->Id}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <dl class="dl-horizontal">
                                <dt>Resource Name</dt>
                                <dd>
                                    @foreach($resource as $r)
                                        @if($r->Id == $id->resource_id)
                                            {{$r->Name}}
                                        @endif
                                    @endforeach
                                </dd>
                                <dt>Submitted By</dt>
                                <dd>
                                    @foreach($user as $u)
                                        @if($u->id == $id->user_id)
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
                                <div class="text-center">Delete this flag from the database?</br></br>
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