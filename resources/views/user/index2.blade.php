@extends('layouts.dataTables')

@section('content')
    <!-- create a new user (uses the create method found at GET /user/create -->
    {{--<a class="btn btn-small btn-primary pull-right" style="margin-bottom: 20px;" href="{{ URL::to('user/create') }}">Create New</a>--}}
    <table class="table table-bordered" id="users-table">
        <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Created At</th>
            <th>Updated At</th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        </thead>
    </table>
@stop

@push('scripts')
<script>
    $(function() {
        $('#users-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{!! route('users.data') !!}',
            columns: [
                { data: 'id', name: 'id'},
                { data: 'name', name: 'name' },
                { data: 'email', name: 'email' },
                { data: 'role', name: 'role' },
                { data: 'created_at', name: 'created_at' },
                { data: 'updated_at', name: 'updated_at' },
                { render: function (data, type, row, meta) {
                    return '<a href="user/view/'+row.id+'">View</a>';
                    }
                },
                { render: function (data, type, row, meta) {
                    return '<a href="user/edit/'+row.id+'">Edit</a>';
                }
                },
                { render: function (data, type, row, meta) {
                    return '<a href="user/delete/'+row.id+'">Delete</a>';
                }
                }
        ]
        });

    });


</script>
@endpush