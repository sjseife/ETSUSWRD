@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View User</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
                            <dd>{{ $id->name }}</dd>
                            <dt>Email</dt>
                            <dd>{{ $id->email }}</dd>
                            <dt>Role</dt>
                            <dd>{{ $id->role }}</dd>
                        </dl>
                        <div class="col-lg-6"><br/><br/>
                            <a class="btn btn-small btn-info" href="{{'/users'}}">Go Back to Users Page</a>
                            <a class="btn btn-small btn-info" href="{{'/home'}}">Go Back to Home Page</a>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection