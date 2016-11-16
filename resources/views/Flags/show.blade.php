@extends('layouts.general')

@section('content')
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">View Flag</div>
                <div class="panel-body">
                    <a class="btn btn-default" href="{{ URL::to('flags') }}">Back</a>
                    <!-- edit this flag (uses the edit method found at GET /flag/{id}/edit/ -->
                    <a class="btn btn-primary pull-right" href="{{ URL::to('flags/' . $flag->id. '/edit') }}">Edit Flag</a>

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
                            @include('Resources._flagShow', ['resource' => $flag->resource])
                        @elseif(isset($flag->contact))
                            @include('Contacts._flagShow', ['contact' => $flag->contact])
                        @elseif(isset($flag->user))
                            @include('Users._flagShow', ['user' => $flag->user])
                        @elseif(isset($flag->event))
                            @include('Events._flagShow', ['event' => $flag->event])
                        @endif
                    </div>
                    <div class="col-md-offset-3">
                        <br/>
                        @if(!$flag->resolved)
                            <button type="button" class="btn btn-success btn-lg pull-right" data-toggle="modal" data-target="#resolveModal">Resolve</button>
                        @endif
                        <!-- delete the flag -->
                        <!-- Trigger the modal with a button -->

                        <br/>
                        <br/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if(!$flag->resolved)
        <!-- Resolve Modal -->
        @include('flags._resolveModal')
    @endif
@stop
@push('scripts')
<script>
    @if (session()->has('flash_notification.message'))
        @if(session('flash_notification.level') == 'success')
            toastr.success('{{session('flash_notification.message')}}');
        @elseif(session('flash_notification.level') == 'danger')
            toastr.error('{{session('flash_notification.message')}}');
        @elseif(session('flash_notification.level') == 'info')
            toastr.info('{{session('flash_notification.message')}}');
        @endif
    @endif
</script>
@endpush