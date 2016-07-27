@extends('layouts.app')


@section('content')

    <div class="content">
        <div class="col-md-11 text-center">
            <a href="/category" class="btn btn-link" type="link">Back to Categories</a>
        </div>
        <form class="form-horizontal" method="POST" action="/category/{{$category->Id}}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <div class="form-group">
                <label class="col-md-2 control-label" for="Name">Name</label>
                <div class="col-md-4">
                    <input id="Name" name="Name" type="text" class="form-control input-md" value="{{ $category->Name }}">
                </div>
            </div>
            <div class="col-md-5 text-center">
                <input class="btn btn-primary" type="submit" value="Update">
            </div>
        </form>
    </div>
@endsection