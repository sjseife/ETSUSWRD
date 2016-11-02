@extends('layouts.dataTables')

@section('content')
    <style>
        .table-bordered{
            border-bottom: solid 3px  #041E42!important;
        }
    </style>
    <div class="text-center"><h1 class="page-header">All Flags</h1></div>

    <div class="container">
        <!-- create a new flag (uses the create method found at GET /flags/create -->
       {{-- <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('flags/create') }}" style="margin-bottom: 20px;">Create New Flags</a>--}}
        <div class="row">
            <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%" id="FlagTable">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Name</th>
                        <th>Flagged For</th>
                        <th>Submitted By</th>
                        <th>Submitted At</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($flags as $key => $flag)
                    <?php $link = false; ?>
                    <tr>
                        @if(isset($flag->resource))
                            <td>Resource</td>
                            <td>{{ $flag->resource->name }}</td>
                        @elseif(isset($flag->contact))
                            <td>Contact</td>
                            <td>{{ $flag->contact->full_name }}</td>
                        @elseif(isset($flag->user))
                            <td>User</td>
                         <td>{{ $flag->user->email }}</td>
                        @elseif(isset($flag->event))
                            <td>Event</td>
                            <td>{{ $flag->event->name }}</td>
                        @elseif(isset($flag->provider))
                            <td>Provider</td>
                            <td>{{ $flag->provider->name }}</td>
                        @endif

                        <td>{{ $flag->level }}</td>
                            <td>{{ $flag->submitter->name }}</td>
                            <td>{{ $flag->created_at }}</td>

                            @if($flag->resolved)
                                <td>Resolved</td>
                            @else
                                <td>Unresolved</td>
                            @endif
                        <td class="text-center col-md-1">
                            <!-- show the resource (uses the show method found at GET /flag/view/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('flags/' . $flag->id) }}">View</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

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
    $(document).ready(function() {
        $('#FlagTable').DataTable();
    });
</script>
@endpush