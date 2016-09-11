@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <h1>Create a New Flag</h1>
        <br/>
    </div>

    <div class="content">
        <form class="form-horizontal" method="post" action="{{ action('FlagController@createFlag') }}" accept-charset="UTF-8">
            <input id="submitted_by" name="submitted_by" type="hidden" value="{{$currentUser->id}}">
            <div class="form-group">
                <label class="col-md-2 control-label" for="radio">Flag Type</label>
                <div class="col-md-4">
                    <fieldset id="radio_field" name="radio" class="form-control input-md">
                        <input id="radio1" name="radio" type="radio" value="resource" class="radio-inline" checked />Resource
                        <input id="radio2" name="radio" type="radio" value="user" class="radio-inline" />User
                        <input id="radio3" name="radio" type="radio" value="contact" class="radio-inline" />Contact
                    </fieldset>
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label" for="resource_id">Selection</label>
                <div class="col-md-4">
                    <select id="item_id" name="item_id" class="form-control input-md">
                        <option name="resource" value="" selected="selected" disabled>Please make a Selection...</option>
                        <option name="user" value="" selected="selected" disabled>Please make a Selection...</option>
                        <option name="contact" value="" selected="selected" disabled>Please make a Selection...</option>
                        @foreach($resource as $r)
                            <option name="resource" value="{{$r->Id}}">{{$r->Name}}</option>
                        @endforeach
                        @foreach($user as $u)
                            <option name="user" value="{{$u->id}}">{{$u->email}}</option>
                        @endforeach
                        @foreach($contact as $c)
                            <option name="contact" value="{{$c->id}}">{{$c->lastName}}, {{$c->firstName}}</option>
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
                    <button id="submit_button" type="submit" class="btn btn-primary">Submit</button>
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

