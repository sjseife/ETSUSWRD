@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <form class="form-horizontal" method="post" action="{{ action('ContactController@createContact') }}" accept-charset="UTF-8">

            <div class="form-group">
                <label class="col-md-2 control-label" for="firstName">Contact First Name</label>
                <div class="col-md-4">
                    <input id="firstName" name="firstName" type="text" placeholder="Jon" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="lastName">Contact Last Name</label>
                <div class="col-md-4">
                    <input id="lastName" name="lastName" type="text" placeholder="Snow" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label" for="email">Email</label>
                <div class="col-md-4">
                    <input id="email" name="email" type="text" placeholder="abc@123.com" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="phoneNumber">Phone Number</label>
                <div class="col-md-4">
                    <input id="phoneNumber" name="phoneNumber" type="text" placeholder="4238576545" class="form-control input-md">
                </div>
            </div>

            <div class="form-group">
                <div class="col-md-2"></div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-4">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
@endsection