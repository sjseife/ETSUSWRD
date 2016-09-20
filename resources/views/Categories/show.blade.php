@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">View Category</div>
                <div class="panel-body">
                    <div class="col-md-offset-2"><br/><br/>
                        <div>
                            <a href="{{'/categories'}}">Back to Categories</a></br></br>
                        </div>
                    </div>
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $category->name }}</dd>
                        <dt>Resources</dt>
                        @foreach($category->resources as $resource)
                            <dd>
                                <a href="{{ URL::to('resources/' . $resource->id) }}">
                                    {{ $resource->Name }}
                                </a>
                            </dd>
                        @endforeach
                    </dl>
                    <div class="col-md-offset-2">
                        <br/>
                        <!-- edit this contact (uses the edit method found at GET /category/{id}/edit -->
                        <a class="btn btn-lg btn-info" href="{{ URL::to('categories/' . $category->id. '/edit') }}">Edit</a>
                        <!-- delete the resource -->
                        <!-- Trigger the modal with a button -->
                        <button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#deleteModal">Delete</button>
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('Categories._deleteModal')
@endsection