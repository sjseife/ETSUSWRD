@extends('layouts.dashboard')

@section('content')

    <div class="content">
        <div class="col-md-11 text-center">
            <a href="/contact" class="btn btn-link" type="link">Back to Contacts</a>
        </div>
        <form class="form-horizontal" method="POST" action="/contact/{{$id->id}}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-2 control-label" for="resource_id">Resource</label>
                <div class="col-md-4">
                    <select id="resource_id" name="resource_id" class="form-control input-md">
                        @foreach($resource as $r)
                            @if($r->Id == $id->resource_id)
                                <option selected="selected" value="{{$r->Id}}">{{$r->Name}}</option>
                            @else
                                <option value="{{$r->Id}}">{{$r->Name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="user_id">First Name</label>
                <div class="col-md-4">
                    <input id="FirstName" name="FirstName" value="{{$id->firstName}}" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="user_id">Last Name</label>
                <div class="col-md-4">
                    <input id="LastName" name="LastName"  value="{{$id->lastName}}" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="user_id">Phone Number</label>
                <div class="col-md-4">
                    <input id="PhoneNumber" name="PhoneNumber" value="{{$id->phoneNumber}}" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="user_id">Email</label>
                <div class="col-md-4">
                    <input id="Email" name="Email" type="email" value="{{$id->email}}" class="form-control input-md">
                </div>
            </div>
            <div class="col-md-5 text-center">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>
    </div>
@endsection