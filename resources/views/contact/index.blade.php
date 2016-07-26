@extends('layouts.dataTables')

@section('content')
    <h1 class="text-center">All Contacts</h1>

    <!-- create a new contact (uses the create method found at GET /user/create -->
    <a class="btn btn-small btn-primary pull-right" href="{{ URL::to('contact/create')  }}" style="margin-bottom: 20px;">Create New Contact</a>
    <div class="container">
        <div class="row">
            <table class="table table-striped table-bordered" id="ContactTable">
                <thead>
                <tr>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($contacts as $key => $value)
                    <tr>
                        <td>{{ $value->firstName }}</td>
                        <td>{{ $value->lastName }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->phoneNumber }}</td>
                        <td class="text-center col-md-3">

                            <!-- show the contact (uses the show method found at GET /contact/view/{id} -->
                            <a class="btn btn-small btn-success" href="{{ URL::to('contact/view/' . $value->id) }}">View</a>

                            <!-- edit this contact (uses the edit method found at GET /contact/edit/{id} -->
                            <a class="btn btn-small btn-info" href="{{ URL::to('contact/edit/' . $value->id) }}">Edit</a>

                            <!-- delete the contact (uses the delete method found at GET /contact/{id} -->
                            <a class="btn btn-small btn-warning" href="{{ URL::to('contact/delete/' . $value->id) }}">Delete</a>
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
        $('#ContactTable').DataTable();
    });
</script>
@endpush