@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">All Flags for {{$id->Name}}</h1>

    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td><b>Flag ID</b></td>
                    <td><b>Comment</b></td>
                    <td><b>Flagged For</b></td>
                    <td><b>Submitted By</b></td>
                    <td><b>Date Created</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($flag as $f)
                    @if($f->resource_id == $id->Id)
                        <tr>
                            <td>{{ $f->Id }}</td>
                            <td>{{ $f->Comments }} </td>
                            @if($f->Level == 0)
                                <td> Resolved </td>
                            @elseif($f->Level == 1)
                                <td> GA </td>
                            @elseif($f->Level == 2)
                                <td> Admin </td>
                            @endif
                            @foreach($user as $u)
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
                        @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection