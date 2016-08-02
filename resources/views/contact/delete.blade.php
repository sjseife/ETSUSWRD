@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete</div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="/contact/destroy/{{$id->id}}" accept-charset="UTF-8">
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
                                <dt>First Name</dt>
                                <dd>{{ $id->firstName }}</dd>
                                <dt>Last Name</dt>
                                <dd>{{ $id->lastName }}</dd>
                                <dt>Phone Number</dt>
                                <dd>{{ $id->phoneNumber }}</dd>
                                <dt>Email</dt>
                                <dd>{{ $id->email}}</dd>
                            </dl>
                            <div class="col-lg-6"><br><br>
                                <div class="text-center">Delete this contact from the database?<br><br>
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
@endsection