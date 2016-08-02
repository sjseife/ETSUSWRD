@extends('layouts.dashboard')

@section('content')
<h1 class="text-center">All Users</h1>
<!-- create a new user (uses the create method found at GET /user/create -->
<a class="btn btn-small btn-primary pull-right" href="{{ URL::to('user/create')  }}" style="margin-bottom: 20px;">Create New User</a>
<div class="container">
    <div class="row">
        <table class="table table-striped table-bordered" id="UserTable">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created</th>
                <th>Updated</th>
                <th></th>
            </tr>
            </thead>
            <tbody>
            @foreach($users as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->name }}</td>
                    <td>{{ $value->email }}</td>
                    <td>{{ $value->role }}</td>
                    <td>{{ $value->created_at }}</td>
                    <td>{{ $value->updated_at }}</td>
                    <td class="text-center col-md-3">

                        <!-- show the user (uses the show method found at GET /user/view/{id} -->
                        <a class="btn btn-small btn-success" href="{{ URL::to('user/view/' . $value->id) }}">View</a>

                        <!-- edit this user (uses the edit method found at GET /user/edit/{id} -->
                        <a class="btn btn-small btn-info" href="{{ URL::to('user/edit/' . $value->id) }}">Edit</a>

                        <!-- delete the user (uses the delete method found at GET /user/{id} -->
                        <a class="btn btn-small btn-warning" href="{{ URL::to('user/delete/' . $value->id) }}">Delete</a>
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
            $('#UserTable').DataTable();
        });
    </script>
@endpush