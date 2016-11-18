@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Flag</div>
                <div class="panel-body">
                    <a class="btn btn-default" href="{{ URL::to('archive_flags') }}">Back</a>
                    <!-- edit this flag (uses the edit method found at GET /flag/{id}/edit/ -->
                    <div class="col-md-offset-2"><br/><br/>
                    </div>
                    <dl class="dl-horizontal">

                        @if(isset($flag->resource))
                            <dt>Resource Name</dt>
                            <dd>{{ $flag->resource->Name }}</dd>
                        @elseif(isset($flag->contact))
                            <dt>Contact Name</dt>
                            <dd>{{ $flag->contact->full_name }}</dd>
                        @elseif(isset($flag->event))
                            <dt>Event Name</dt>
                            <dd>{{ $flag->event->name }}</dd>
                        @endif
                        <dt>Submitted By</dt>
                        <dd>{{ $flag->submitter->name }}</dd>
                        <dt>Level</dt>
                        <dd>{{ $flag->level }}</dd>
                        <dt>Submitted At</dt>
                        <dd>{{ $flag->created_at }}</dd>
                        <dt>Status</dt>
                        @if($flag->resolved)
                            <dd>Resolved</dd>
                        @else
                            <dd>Unresolved</dd>
                        @endif

                        <dt>Description of Issue</dt>
                        <dd>{{ $flag->comments }}</dd>
                    </dl>
                    <hr />

                    <div>
                        @if(isset($flag->resource))
                            @include('resources._flagShow', ['resource' => $flag->resource])
                        @elseif(isset($flag->contact))
                            @include('contacts._flagShow', ['contact' => $flag->contact])
                        @elseif(isset($flag->user))
                            @include('users._flagShow', ['user' => $flag->user])
                        @elseif(isset($flag->event))
                            @include('events._flagShow', ['event' => $flag->event])
                        @endif
                    </div>
                    <div class="col-md-offset-3">
                        <br/>
                        @if(Auth::user()->role->delete == '1')
                            <br>
                            <br>
                            <!-- edit this event (uses the edit method found at GET /event/edit/{id} -->
                            <a class="btn btn-lg btn-info" href="{{ URL::to('archive_flags/showrestore/' . $flag->id) }}">Restore</a>
                            <a class="btn btn-lg btn-danger" href="{{ URL::to('archive_flags') }}">Cancel</a>
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

    <!-- Delete Modal -->

    @if(!$flag->resolved)
        <!-- Resolve Modal -->
        @include('flags._resolveModal')
    @endif
@endsection