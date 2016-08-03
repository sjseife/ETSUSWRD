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
                            <dd>{{ $id->name }}</dd>
                            <dt>Created At</dt>
                                <dd>{{ $id->created_at }}</dd>
                            <dt>Updated At</dt>
                            <dd>{{ $id->updated_at }}</dd>
                        </dl>
                        <div class="col-lg-6"><br/><br/>
                            <div class="text-center"><a href="{{'/category'}}">Go Back to Categories Page</a></br></br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection