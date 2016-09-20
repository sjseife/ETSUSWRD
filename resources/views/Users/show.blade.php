@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View User</div>
                <div class="panel-body">
                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                            <a href="{{'/users'}}">Back to Users</a></br></br>
                        </div>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $user->name }}</dd>
                        <dt>Email</dt>
                        <dd>{{ $user->email }}</dd>
                        <dt>Role</dt>
                        <dd>{{ $user->role }}</dd>
                        <dt>Reported Problems</dt>
                        @if(isset($user->flags))
                            @foreach($user->flags as $flag)
                                @if(!$flag->resolved)
                                    <dd>{{ $flag->comments }}</dd>
                                @endif
                            @endforeach
                        @else
                            <dd>No problems reported</dd>
                        @endif
                    </dl>
                    <div class="col-md-offset-2">
                        <br/>
                        <br/>
                        <!-- Flag this user as incorrect -->
                        <a class="btn btn-lg btn-link" href="{{ URL::to('users/' . $user->id. '/flag') }}">Report a problem with this contact.</a>
                        <br/>
                        <br/>
                        <!-- edit this contact (uses the edit method found at GET /contact/{id}/edit -->
                        <a class="btn btn-lg btn-info" href="{{ URL::to('users/' . $user->id. '/edit') }}">Edit</a>
                        <!-- delete the resource -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('Users._deleteModal')
@endsection