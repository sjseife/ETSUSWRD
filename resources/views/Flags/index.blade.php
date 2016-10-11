@extends('layouts.dataTables')

@section('content')
    <h1 class="text-center">All Flags</h1>

    <div class="container">
        <!-- create a new flag (uses the create method found at GET /flags/create -->
        {{--<a class="btn btn-small btn-primary pull-right" href="{{ URL::to('flags/create') }}" style="margin-bottom: 20px;">Create New Flags</a>--}}
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
                        @else
                            <td>User</td>
                            <td></td>
                            {{--<td>{{ $flag->user->email }}</td>--}}
                        @endif

                        <td>{{ $flag->level }}</td>
                            <td>{{ $flag->submitter->email }}</td>
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
    $(document).ready(function() {
        $('#FlagTable').DataTable();
    });
</script>
@endpush