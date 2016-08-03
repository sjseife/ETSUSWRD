@extends('layouts.dashboard')

@section('content')
    <h1 class="text-center">All Contacts for {{$id->Name}}</h1>

    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
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
                            <td>{{ $c->firstName }} </td>
                            <td>{{ $c->lastName }}</td>
                            <td>{{ $c->email }}</td>
                            <td>{{ $c->phoneNumber }}</td>
                            <td class="text-center col-md-3">

                                <!-- show the contact (uses the show method found at GET /contact/view/{id} -->
                                <a class="btn btn-small btn-success" href="{{ URL::to('contact/view/' . $c->id) }}">View</a>

                                <!-- edit this contact (uses the edit method found at GET /contact/edit/{id} -->
                                <a class="btn btn-small btn-info" href="{{ URL::to('contact/edit/' . $c->id) }}">Edit</a>

                                <!-- delete the contact (uses the delete method found at GET /contact/{id} -->
                                <a class="btn btn-small btn-warning" href="{{ URL::to('contact/delete/' . $c->id) }}">Delete</a>
                            </td>
                        @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection