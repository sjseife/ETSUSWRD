@extends('layouts.dashboard')

@section('content')
    <div class="content">
        <form class="form-horizontal" method="post" action="{{ action('FlagController@createFlag') }}" accept-charset="UTF-8">
            <div class="form-group">
                <label class="col-md-2 control-label" for="resource_id">Resource</label>
                <div class="col-md-4">
                    <select id="resource_id" name="resource_id" class="form-control input-md">
                        @foreach($resource as $r)
                            <option value="{{$r->Id}}">{{$r->Name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="user_id">Submitted By</label>
                <div class="col-md-4">
                    <select id="user_id" name="user_id" class="form-control input-md">
                        @foreach($user as $u)
                            <option value="{{$u->id}}">{{$u->email}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Level">Level</label>
                <div class="col-md-4">
                    <select id="Level" name="Level" class="form-control input-md">
                        <option value="0">Resolved</option>
                        <option value="1">GA</option>
                        <option value="2">Admin</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Date">Date</label>
                <div class="col-md-4">
                    <input id="Date" name="Date" type="date" value="<?php echo \Carbon\Carbon::now()->toDateString(); ?>" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Comments">Comments</label>
                <div class="col-md-4">
                    <textarea name="Comments" id="Comments" cols="30" rows="4" class="form-control input-md"> </textarea>
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