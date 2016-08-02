@extends('layouts.dashboard')

@section('content')

    <div class="content">
        <div class="col-md-11 text-center">
            <a href="/flag" class="btn btn-link" type="link">Back to Flags</a>
        </div>
        <form class="form-horizontal" method="POST" action="/flag/{{$id->Id}}">
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
                <label class="col-md-2 control-label" for="user_id">Submitted By</label>
                <div class="col-md-4">
                    <select id="user_id" name="user_id" class="form-control input-md">
                        @foreach($user as $u)
                            @if($u->id == $id->user_id)
                                <option selected="selected" value="{{$u->id}}">{{$u->email}}</option>
                            @else
                                <option value="{{$u->id}}">{{$u->email}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Level">Level</label>
                <div class="col-md-4">
                    <select id="Level" name="Level" class="form-control input-md">
                        @if($id->Level == 0)
                            <option selected="selected" value="0">Resolved</option>
                        @else
                            <option value="0">Resolved</option>
                        @endif
                        @if($id->Level == 1)
                            <option selected="selected" value="1">GA</option>
                        @else
                            <option value="0">GA</option>
                        @endif
                        @if($id->Level == 2)
                            <option selected="selected" value="1">Admin</option>
                        @else
                            <option value="0">Admin</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Date">Date</label>
                <div class="col-md-4">
                    <input id="Date" name="Date" type="date" value="{{$id->Date}}" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Comments">Comments</label>
                <div class="col-md-4">
                    <textarea name="Comments" id="Comments" cols="30" rows="4" class="form-control input-md">{{$id->Comments}}</textarea>
                </div>
            </div>
            <div class="col-md-5 text-center">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>
    </div>
@endsection