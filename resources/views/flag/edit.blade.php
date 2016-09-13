@extends('layouts.dashboard')

@section('content')

    @php
        $res = false;
        $us = false;
        $con = false;
    @endphp

    @foreach($resource as $r)
        @if($id->resource_id == $r->Id)
            @php ($res = true)
        @endif
    @endforeach
    @foreach($user as $u)
        @if($id->user_id == $u->id)
            @php ($us = true)
        @endif
    @endforeach
    @foreach($contact as $c)
        @if($id->contacts_id == $c->id)
            @php ($con = true)
        @endif
    @endforeach
    <div class="container">
        <h1>Edit Flag {{$id->Id}}</h1>
        <br/>
    </div>

    <div class="content">
        <form class="form-horizontal" method="post" action="/flag/{{$id->Id}}" accept-charset="UTF-8">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-2 control-label" for="radio">Flag Type</label>
                <div class="col-md-4">
                    <select class="form-control input-md" disabled>
                        @if($res)
                            <option selected="selected" value="">Resource</option>
                        @endif
                        @if($con)
                            <option selected="selected" value="">Contact</option>
                        @endif
                        @if($us)
                            <option selected="selected" value="">User</option>
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="resource_id">Name</label>
                <div class="col-md-4">
                    <select id="item_id" name="item_id" class="form-control input-md" disabled>
                        @if($res)
                            @foreach($resource as $r)
                                @if($r->Id == $id->resource_id)
                                    <option selected="selected" value="{{$r->Id}}">{{$r->Name}}</option>
                                @endif
                            @endforeach
                        @endif
                        @if($con)
                            @foreach($contact as $c)
                                @if($c->id == $id->contacts_id)
                                    <option selected="selected" value="{{$c->id}}">{{$c->lastName}}, {{$c->firstName}}</option>
                                @endif
                            @endforeach
                        @endif
                        @if($us)
                            @foreach($user as $u)
                                @if($u->id == $id->user_id)
                                    <option selected="selected" value="{{$u->id}}">{{$u->email}}</option>
                                @endif
                            @endforeach
                        @endif
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
                    <input id="Date" name="Date" type="date" value="<?php echo \Carbon\Carbon::now()->toDateString(); ?>" class="form-control input-md">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="user_id">Submitted By</label>
                <div class="col-md-4">
                    <select id="submitted_by" name="submitted_by" class="form-control input-md">
                        @foreach($user as $u)
                            @if($u->id == $id->submitted_by)
                                <option selected="selected" value="{{$u->id}}">{{$u->email}}</option>
                            @else
                                <option value="{{$u->id}}">{{$u->email}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="Comments">Comments</label>
                <div class="col-md-4">
                    <textarea name="Comments" id="Comments" cols="30" rows="4" class="form-control input-md">{{$id->Comments}}</textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-2"></div>
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="col-md-4">
                    <button id="submit_button" type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('page-script')
    <script>
        $(document).ready((function(){
            var select = $("#item_id"),
                    options = select.find('option');

            var visibleItems = options.filter('[name*="resource"]').show();
            options.not(visibleItems).hide();

            if(visibleItems.length > 0)
            {
                select.val(visibleItems.eq(0).val());
            }
            buttoncheck();
        }));

        var select = $("#item_id"),
                options = select.find('option');

        function check(input){
            var visibleItems = options.filter('[name*="' + $(input).val()  + '"]').show();
            options.not(visibleItems).hide();

            if(visibleItems.length > 0)
            {
                select.val(visibleItems.eq(0).val());
            }
            buttoncheck();
        };

        function buttoncheck(){
            if(document.getElementById("item_id").options[document.getElementById("item_id").selectedIndex].value < 1){
                document.getElementById("submit_button").disabled = true;
            }
            else{
                document.getElementById("submit_button").disabled = false;
            }
        };

        $("#radio1").click(function(){
            check(this);
        });
        $("#radio2").click(function(){
            check(this);
        });
        $("#radio3").click(function(){
            check(this);
        });


        $("#item_id").click(function(){
            buttoncheck();
        });
    </script>
@endsection

<!-- If user does not enter required field.-->
@include('errors.list')