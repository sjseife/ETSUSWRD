@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Delete</div>
                    <div class="panel-body">
                        <form class="form-horizontal" method="post" action="/user/destroy/{{$id->id}}" accept-charset="UTF-8">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <dl class="dl-horizontal">
                                <dt>Name</dt>
                                <dd>{{ $id->name }}</dd>
                                <dt>Email</dt>
                                <dd>{{ $id->email }}</dd>
                                <dt>Role</dt>
                                <dd>{{ $id->role }}</dd>
                            </dl>
                                <div class="text-left">Delete <b>{{ $id->name }}</b> from the database?</br></br>
                                    <div class="col-md-5 text-left">
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                        <a class="btn btn-small btn-info" href="{{'/users'}}">Go Back to Users Page</a>
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