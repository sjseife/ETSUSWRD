@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Category</div>
                <div class="panel-body">
                    <a href="{{ url('/archive_categories') }}" class="btn btn-default">Back</a>
                    <div class="col-md-offset-2"><br/><br/>

                    </div>
                    <dl class="dl-horizontal">
                        <dt>Name</dt>
                        <dd>{{ $category->name }}</dd>
                        <dt>Resources</dt>
                        @foreach($category->resources as $resource)
                            <dd>
                                <a href="{{ URL::to('resources/' . $resource->id) }}">
                                    {{ $resource->name }}
                                </a>
                            </dd>
                        @endforeach
                        <dt>Events</dt>
                        @foreach($category->events as $event)
                            <dd>
                                <a href="{{ URL::to('events/' . $event->id) }}">
                                    {{ $event->name }}
                                </a>
                            </dd>
                        @endforeach
                    </dl>
                    <div class="col-md-offset-4">
                        @if(Auth::user()->role->delete == '1')
                            <br>
                            <br>
                        <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                            <a class="btn btn-lg btn-info" href="{{ URL::to('archive_categories/showrestore/' . $category->id) }}">Restore</a>
                            <a class="btn btn-lg btn-danger" href="{{ URL::to('archive_categories') }}">Cancel</a>
                            <!-- delete the event -->
                            <!-- Trigger the modal with a button -->
                        @endif
                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    @include('categories._deleteModal')
@endsection