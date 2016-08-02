@extends('layouts.dashboard')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">View Category</div>
                    <div class="panel-body">
                        <dl class="dl-horizontal">
                            <dt>Name</dt>
                            <dd>{{ $category->Name }}</dd>
                            <dt>Created At</dt>
                            <dd>{{ $category->created_at }}</dd>
                            <dt>Updated At</dt>
                            <dd>{{ $category->updated_at }}</dd>
                            <dt>Resources</dt>
                            @foreach ($category->resources() as $resource)
                                <dd>{{ $resource->name }}</dd>
                            @endforeach
                        </dl>
                        <div class="col-lg-6"><br/><br/>
                            <div class="text-center"><a href="{{'/home'}}">Go Back to Home Page</a></br></br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection