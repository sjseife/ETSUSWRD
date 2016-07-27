@extends('layouts.app')

@section('content')
    <div class="content">
        <form class="form-horizontal" method="post" action="{{ action('CategoryController@store') }}" accept-charset="UTF-8">
            <div class="form-group">
                <label class="col-md-2 control-label" for="Name">Name</label>
                <div class="col-md-4">
                    <input id="name" name="Name" type="text" placeholder="Name" class="form-control input-md">
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