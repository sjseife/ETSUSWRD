@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">All Flags</h1>

    <div class="container">
        <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('flag/create') }}" style="margin-bottom: 20px;">Create New</a>
        <div class="row">
            <table class="table table-striped table-bordered" id="FlagTable">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Resource</th>
                    <th>Flagged For</th>
                    <th>Submitted By</th>
                    <th>Date Created</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($flags as $f)
                    <tr>
                        <td>{{ $f->Id }}</td>
                        @foreach($resources as $r)
                            @if($r->Id == $f->resource_id)
                                <td>{{ $r->Name }} </td>
                            @endif
                        @endforeach
                        @if($f->Level == 0)
                            <td> Resolved </td>
                        @elseif($f->Level == 1)
                            <td> GA </td>
                        @elseif($f->Level == 2)
                            <td> Admin </td>
                        @endif
                        @foreach($users as $u)
                            @if($u->id == $f->user_id)
                                <td>{{ $u->email }} </td>
                            @endif
                        @endforeach
                        <td>{{ $f->Date }}</td>
                        <td class="text-center col-md-3">

                            <a class="btn btn-small btn-success" href="{{ URL::to('flag/view/' . $f->Id) }}">View</a>

                            <a class="btn btn-small btn-info" href="{{ URL::to('flag/edit/' . $f->Id) }}">Edit</a>

                            <a class="btn btn-small btn-warning" href="{{ URL::to('flag/delete/' . $f->Id) }}">Delete</a>
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