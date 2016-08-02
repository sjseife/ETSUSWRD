@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">All Contacts for {{$id->Name}}</h1>

    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td><b>Contact ID</b></td>
                    <td><b>First Name</b></td>
                    <td><b>Last Name</b></td>
                    <td><b>Email</b></td>
                    <td><b>Phone Number</b></td>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $c)
                    @if($c->resource_id == $id->Id)
                        <tr>
                            <td>{{ $c->id }}</td>
                            <td>{{ $c->firstName }} </td>
                            <td>{{ $c->lastName }}</td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->phoneNumber }}</td>
                            <td class="text-center col-md-3">

                                <a class="btn btn-small btn-success" href="{{ URL::to('contact/view/' . $c->Id) }}">View</a>

                                <a class="btn btn-small btn-info" href="{{ URL::to('contact/edit/' . $c->Id) }}">Edit</a>

                                <a class="btn btn-small btn-warning" href="{{ URL::to('contact/delete/' . $c->Id) }}">Delete</a>
                            </td>
                        @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection