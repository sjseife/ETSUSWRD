@extends('layouts.app')

@section('content')
    <div class="content">
        <form class="form-horizontal" method="post" action="{{ action('ResourceController@createResource') }}" accept-charset="UTF-8">
            <div class="form-group">
                <label class="col-md-2 control-label" for="Name">Name</label>
                <div class="col-md-4">
                    <input id="name" name="Name" type="text" placeholder="Name" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="StreetAddress">Street Address</label>
                <div class="col-md-4">
                    <input id="streetaddress" name="StreetAddress" type="text" placeholder="123 Byron Way" class="form-control input-md">
                </div>
            </div>
        </form>
    </div>
@endsection